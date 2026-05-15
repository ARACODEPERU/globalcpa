<?php

namespace Modules\ApiConnector\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\ApiConnector\Entities\ApiConnection;
use Modules\ApiConnector\Entities\ApiConnectionLog;

class ApiConnectorService
{
    private ?ApiConnection $connection = null;

    public function connection(int|string $connection): self
    {
        if (is_numeric($connection)) {
            $this->connection = ApiConnection::with('parameters')->findOrFail($connection);
        } else {
            $this->connection = ApiConnection::with('parameters')->where('name', $connection)->firstOrFail();
        }
        return $this;
    }

    public function call(array $params = []): ApiConnectionLog
    {
        if (!$this->connection) {
            throw new \RuntimeException('No se ha especificado una conexion. Use connection() primero.');
        }

        $connection = $this->connection;
        $startTime = microtime(true);

        $url = $this->buildUrl($connection, $params);
        $headers = $this->buildHeaders($connection, $params);
        $body = $this->buildBody($connection, $params);

        try {
            $client = $this->buildClient($connection, $headers);
            $method = strtolower($connection->method);

            if (in_array($connection->body_type, ['json', 'graphql'])) {
                $response = $client->asJson()->$method($url, is_array($body) ? $body : []);
            } else {
                $response = $client->$method($url, $body);
            }
            $responseTime = (int) ((microtime(true) - $startTime) * 1000);

            $logData = [
                'api_connection_id' => $connection->id,
                'request_url' => $url,
                'request_method' => $connection->method,
                'request_headers' => $headers,
                'request_body' => is_string($body) ? $body : json_encode($body),
                'response_status' => $response->status(),
                'response_headers' => $response->headers(),
                'response_body' => $response->body(),
                'response_time_ms' => $responseTime,
                'ip_address' => request()->ip(),
                'user_id' => auth()->id(),
            ];

            $log = ApiConnectionLog::create($logData);

            $connection->update([
                'last_tested_at' => now(),
                'last_test_status' => $response->status(),
                'last_test_response' => substr($response->body(), 0, 500),
            ]);

            return $log;
        } catch (\Exception $e) {
            $responseTime = (int) ((microtime(true) - $startTime) * 1000);

            $logData = [
                'api_connection_id' => $connection->id,
                'request_url' => $url,
                'request_method' => $connection->method,
                'request_headers' => $headers,
                'request_body' => is_string($body) ? $body : json_encode($body),
                'response_status' => null,
                'response_headers' => null,
                'response_body' => $e->getMessage(),
                'response_time_ms' => $responseTime,
                'ip_address' => request()->ip(),
                'user_id' => auth()->id(),
            ];

            $log = ApiConnectionLog::create($logData);

            $connection->update([
                'last_tested_at' => now(),
                'last_test_status' => null,
                'last_test_response' => 'Error: ' . $e->getMessage(),
            ]);

            throw $e;
        }
    }

    public function test(int|ApiConnection $connection, array $params = []): array
    {
        if (is_numeric($connection)) {
            $connection = ApiConnection::findOrFail($connection);
        }

        $this->connection = $connection;

        $url = $this->buildUrl($connection, $params);
        $headers = $this->buildHeaders($connection, $params);
        $body = $this->buildBody($connection, $params);

        $startTime = microtime(true);

        try {
            $client = $this->buildClient($connection, $headers);
            $method = strtolower($connection->method);

            if (in_array($connection->body_type, ['json', 'graphql'])) {
                $response = $client->asJson()->$method($url, is_array($body) ? $body : []);
            } else {
                $response = $client->$method($url, $body);
            }

            $responseTime = (int) ((microtime(true) - $startTime) * 1000);

            $result = [
                'success' => true,
                'request' => [
                    'url' => $url,
                    'method' => $connection->method,
                    'headers' => $headers,
                    'body' => $body,
                ],
                'response' => [
                    'status' => $response->status(),
                    'headers' => $response->headers(),
                    'body' => $response->body(),
                    'time_ms' => $responseTime,
                ],
                'curl' => $this->generateCurlCommand($connection, $headers, $body),
            ];

            $connection->update([
                'last_tested_at' => now(),
                'last_test_status' => $response->status(),
                'last_test_response' => substr($response->body(), 0, 500),
            ]);

            return $result;
        } catch (\Exception $e) {
            $responseTime = (int) ((microtime(true) - $startTime) * 1000);

            return [
                'success' => false,
                'request' => [
                    'url' => $url,
                    'method' => $connection->method,
                    'headers' => $headers,
                    'body' => $body,
                ],
                'response' => [
                    'status' => null,
                    'headers' => null,
                    'body' => $e->getMessage(),
                    'time_ms' => $responseTime,
                ],
                'error' => $e->getMessage(),
                'curl' => $this->generateCurlCommand($connection, $headers, $body),
            ];
        }
    }

    public function buildUrl(ApiConnection $connection, array $params): string
    {
        $url = rtrim($connection->base_url, '/');

        if ($connection->endpoint_path) {
            $path = $connection->endpoint_path;

            foreach ($connection->parameters as $param) {
                if ($param->location === 'path' && isset($params[$param->name])) {
                    $path = str_replace('{' . $param->name . '}', $params[$param->name], $path);
                }
            }

            $url .= '/' . ltrim($path, '/');
        }

        $queryParams = [];

        // API Key in query
        if ($connection->auth_type === 'api_key') {
            $config = $connection->auth_config ? json_decode($connection->auth_config, true) : [];
            if (($config['in'] ?? 'header') === 'query') {
                $keyName = $config['key_name'] ?? 'api_key';
                $keyValue = $config['key_value'] ?? '';
                $queryParams[$keyName] = $keyValue;
            }
        }

        foreach ($connection->parameters as $param) {
            if ($param->location === 'query') {
                if (isset($params[$param->name])) {
                    $queryParams[$param->name] = $params[$param->name];
                } elseif ($param->default_value !== null) {
                    $queryParams[$param->name] = $param->default_value;
                }
            }
        }

        if (!empty($queryParams)) {
            $separator = (str_contains($url, '?')) ? '&' : '?';
            $url .= $separator . http_build_query($queryParams);
        }

        return $url;
    }

    public function buildHeaders(ApiConnection $connection, array $params): array
    {
        $rawHeaders = $connection->headers ?? [];

        // Normalize from [{name, value}] to flat [name => value]
        $headers = [];
        foreach ($rawHeaders as $h) {
            if (is_array($h) && isset($h['name'])) {
                $headers[$h['name']] = $h['value'] ?? '';
            } elseif (is_string($h['name'] ?? null)) {
                $headers[$h['name']] = $h['value'] ?? '';
            }
        }

        $authHeaders = $this->resolveAuth($connection);
        $headers = array_merge($headers, $authHeaders);

        foreach ($connection->parameters as $param) {
            if ($param->location === 'header') {
                if (isset($params[$param->name])) {
                    $headers[$param->name] = $params[$param->name];
                } elseif ($param->default_value !== null) {
                    $headers[$param->name] = $param->default_value;
                }
            }
        }

        if ($connection->body_type === 'json' && !isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/json';
        } elseif ($connection->body_type === 'xml' && !isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/xml';
        } elseif ($connection->body_type === 'soap' && !isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'text/xml; charset=utf-8';
        } elseif ($connection->body_type === 'form_urlencoded' && !isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }

        if (!isset($headers['Accept'])) {
            $headers['Accept'] = $connection->response_type === 'xml' ? 'application/xml' : 'application/json';
        }

        return $headers;
    }

    public function buildBody(ApiConnection $connection, array $params): string|array|null
    {
        $bodyType = $connection->body_type;

        if ($bodyType === 'none') {
            return null;
        }

        if ($bodyType === 'json') {
            $body = [];
            $configuredNames = [];
            foreach ($connection->parameters as $param) {
                if (in_array($param->location, ['body_json'])) {
                    $configuredNames[] = $param->name;
                    if (isset($params[$param->name])) {
                        $body[$param->name] = $this->castValue($params[$param->name], $param->type);
                    } elseif ($param->default_value !== null) {
                        $body[$param->name] = $this->castValue($param->default_value, $param->type);
                    }
                }
            }
            // Include extra params not configured
            if ($connection->send_extra_params) {
                foreach ($params as $key => $value) {
                    if (!in_array($key, $configuredNames)) {
                        $body[$key] = $value;
                    }
                }
            }
            return $body;
        }

        if (in_array($bodyType, ['xml', 'soap']) && $connection->body_template) {
            $body = $connection->body_template;
            foreach ($connection->parameters as $param) {
                if (in_array($param->location, ['body_xml'])) {
                    $value = $params[$param->name] ?? $param->default_value ?? '';
                    $body = str_replace('{{' . $param->name . '}}', $value, $body);
                }
            }
            return $body;
        }

        if (in_array($bodyType, ['form_data', 'form_urlencoded'])) {
            $body = [];
            foreach ($connection->parameters as $param) {
                if ($param->location === 'body_form') {
                    if (isset($params[$param->name])) {
                        $body[$param->name] = $params[$param->name];
                    } elseif ($param->default_value !== null) {
                        $body[$param->name] = $param->default_value;
                    }
                }
            }
            return $body;
        }

        if ($bodyType === 'graphql' && $connection->body_template) {
            $query = $connection->body_template;
            foreach ($connection->parameters as $param) {
                if (in_array($param->location, ['body_json'])) {
                    $value = $params[$param->name] ?? $param->default_value ?? '';
                    $query = str_replace('{{' . $param->name . '}}', $value, $query);
                }
            }
            return ['query' => $query];
        }

        return null;
    }

    private function buildClient(ApiConnection $connection, array $headers): PendingRequest
    {
        $client = Http::timeout($connection->timeout)
            ->withHeaders($headers);

        if ($connection->retry_count > 0) {
            $client->retry($connection->retry_count, 100);
        }

        return $client;
    }

    private function resolveAuth(ApiConnection $connection): array
    {
        $authType = $connection->auth_type;
        $config = $connection->auth_config ? json_decode($connection->auth_config, true) : [];

        return match ($authType) {
            'basic' => ['Authorization' => 'Basic ' . base64_encode(($config['username'] ?? '') . ':' . ($config['password'] ?? ''))],
            'bearer' => ['Authorization' => 'Bearer ' . ($config['token'] ?? '')],
            'jwt' => ['Authorization' => ($config['prefix'] ?? 'Bearer') . ' ' . $this->resolveJwtToken($config)],
            'api_key' => $this->resolveApiKeyAuth($config),
            'digest' => ['Authorization' => 'Digest username="' . ($config['username'] ?? '') . '", realm="", nonce="", uri="", response=""'],
            'oauth2' => ['Authorization' => 'Bearer ' . ($config['access_token'] ?? $this->getOAuth2Token($config))],
            'ntlm' => ['Authorization' => 'NTLM ' . base64_encode(($config['username'] ?? '') . ':' . ($config['password'] ?? ''))],
            'hawk' => ['Authorization' => 'Hawk id="' . ($config['id'] ?? '') . '", mac="", ts=""'],
            default => [],
        };
    }

    private function resolveApiKeyAuth(array $config): array
    {
        $keyName = $config['key_name'] ?? 'X-API-Key';
        $keyValue = $config['key_value'] ?? '';
        $in = $config['in'] ?? 'header';

        if ($in === 'query') {
            return [];
        }

        return [$keyName => $keyValue];
    }

    private function getOAuth2Token(array $config): string
    {
        try {
            $response = Http::asForm()->post($config['token_url'] ?? '', [
                'grant_type' => $config['grant_type'] ?? 'client_credentials',
                'client_id' => $config['client_id'] ?? '',
                'client_secret' => $config['client_secret'] ?? '',
                'scope' => $config['scopes'] ?? '',
            ]);
            $data = $response->json();
            return $data['access_token'] ?? '';
        } catch (\Exception $e) {
            Log::error('OAuth2 token error: ' . $e->getMessage());
            return '';
        }
    }

    private function resolveJwtToken(array $config): string
    {
        if (($config['mode'] ?? 'token') === 'token') {
            return $config['token'] ?? '';
        }

        $secret = $config['secret'] ?? '';
        $algorithm = $config['algorithm'] ?? 'HS256';
        $claims = $config['claims'] ?? '{}';

        if (is_string($claims)) {
            $claims = json_decode($claims, true) ?? [];
        }

        $header = ['alg' => $algorithm, 'typ' => 'JWT'];
        $claims['iat'] = $claims['iat'] ?? time();
        $claims['exp'] = $claims['exp'] ?? time() + 3600;

        $segments = [];
        $segments[] = $this->base64UrlEncode(json_encode($header));
        $segments[] = $this->base64UrlEncode(json_encode($claims));

        $signingInput = implode('.', $segments);

        $algMap = [
            'HS256' => 'sha256',
            'HS384' => 'sha384',
            'HS512' => 'sha512',
        ];

        $hashFunc = $algMap[$algorithm] ?? 'sha256';
        $signature = hash_hmac($hashFunc, $signingInput, $secret, true);
        $segments[] = $this->base64UrlEncode($signature);

        return implode('.', $segments);
    }

    private function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function castValue(mixed $value, string $type): mixed
    {
        return match ($type) {
            'integer' => (int) $value,
            'boolean' => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            'number' => (float) $value,
            default => (string) $value,
        };
    }

    private function generateCurlCommand(ApiConnection $connection, array $headers, string|array|null $body): string
    {
        $method = $connection->method;
        $url = $this->buildUrl($connection, []);

        $cmd = "curl -X $method";

        foreach ($headers as $key => $value) {
            $val = is_array($value) ? implode(', ', $value) : $value;
            $cmd .= " -H \"$key: $val\"";
        }

        if ($body !== null) {
            $bodyStr = is_string($body) ? $body : json_encode($body);
            $cmd .= " -d '$bodyStr'";
        }

        $cmd .= " '$url'";

        return $cmd;
    }
}
