<?php

namespace Modules\ApiConnector\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Modules\ApiConnector\Entities\ApiConnection;
use Modules\ApiConnector\Entities\ApiConnectionParameter;
use Modules\ApiConnector\Services\ApiConnectorService;

class ApiConnectionController extends Controller
{
    public function index()
    {
        $connections = ApiConnection::with('parameters')->withCount('logs')
            ->orderBy('name')
            ->paginate(10)
            ->onEachSide(2)
            ->appends(request()->query());

        return Inertia::render('ApiConnector::List', [
            'connections' => $connections,
            'filters' => request()->all('search'),
        ]);
    }

    public function create()
    {
        return Inertia::render('ApiConnector::Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_url' => 'required|string|max:255',
            'endpoint_path' => 'nullable|string|max:255',
            'method' => 'required|in:GET,POST,PUT,PATCH,DELETE',
            'auth_type' => 'required|in:none,basic,bearer,api_key,digest,oauth2,ntlm,hawk,jwt',
            'auth_config' => 'nullable|json',
            'headers' => 'nullable|json',
            'body_type' => 'required|in:none,json,xml,form_data,form_urlencoded,graphql,soap,binary',
            'body_template' => 'nullable|string',
            'response_type' => 'required|in:json,xml,text,binary',
            'send_extra_params' => 'boolean',
            'timeout' => 'integer|min:1|max:300',
            'retry_count' => 'integer|min:0|max:10',
            'status' => 'boolean',
            'parameters' => 'nullable|array',
            'parameters.*.name' => 'required|string|max:255',
            'parameters.*.label' => 'nullable|string|max:255',
            'parameters.*.type' => 'required|in:string,integer,boolean,number,date,file',
            'parameters.*.location' => 'required|in:query,header,body_json,body_xml,body_form,path',
            'parameters.*.required' => 'boolean',
            'parameters.*.default_value' => 'nullable|string',
            'parameters.*.description' => 'nullable|string',
            'parameters.*.validation_rules' => 'nullable|string',
            'parameters.*.sort_order' => 'integer',
        ]);

        $connection = ApiConnection::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'base_url' => $data['base_url'],
            'endpoint_path' => $data['endpoint_path'] ?? null,
            'method' => $data['method'],
            'auth_type' => $data['auth_type'],
            'auth_config' => $data['auth_config'] ?? null,
            'headers' => json_decode($data['headers'] ?? '{}', true),
            'body_type' => $data['body_type'],
            'body_template' => $data['body_template'] ?? null,
            'response_type' => $data['response_type'],
            'send_extra_params' => $data['send_extra_params'] ?? false,
            'timeout' => $data['timeout'] ?? 30,
            'retry_count' => $data['retry_count'] ?? 0,
            'status' => $data['status'] ?? true,
        ]);

        if (!empty($data['parameters'])) {
            foreach ($data['parameters'] as $i => $param) {
                $connection->parameters()->create([
                    'name' => $param['name'],
                    'label' => $param['label'] ?? null,
                    'type' => $param['type'],
                    'location' => $param['location'],
                    'required' => $param['required'] ?? false,
                    'default_value' => $param['default_value'] ?? null,
                    'description' => $param['description'] ?? null,
                    'validation_rules' => $param['validation_rules'] ?? null,
                    'sort_order' => $param['sort_order'] ?? $i,
                ]);
            }
        }

        return redirect()->route('api_connector')
            ->with('message', 'Conexion API creada correctamente');
    }

    public function edit($id)
    {
        $connection = ApiConnection::with('parameters')->findOrFail($id);
        return Inertia::render('ApiConnector::Edit', [
            'connection' => $connection,
        ]);
    }

    public function update(Request $request, $id)
    {
        $connection = ApiConnection::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_url' => 'required|string|max:255',
            'endpoint_path' => 'nullable|string|max:255',
            'method' => 'required|in:GET,POST,PUT,PATCH,DELETE',
            'auth_type' => 'required|in:none,basic,bearer,api_key,digest,oauth2,ntlm,hawk,jwt',
            'auth_config' => 'nullable|json',
            'headers' => 'nullable|json',
            'body_type' => 'required|in:none,json,xml,form_data,form_urlencoded,graphql,soap,binary',
            'body_template' => 'nullable|string',
            'response_type' => 'required|in:json,xml,text,binary',
            'send_extra_params' => 'boolean',
            'timeout' => 'integer|min:1|max:300',
            'retry_count' => 'integer|min:0|max:10',
            'status' => 'boolean',
            'parameters' => 'nullable|array',
            'parameters.*.id' => 'nullable|integer',
            'parameters.*.name' => 'required|string|max:255',
            'parameters.*.label' => 'nullable|string|max:255',
            'parameters.*.type' => 'required|in:string,integer,boolean,number,date,file',
            'parameters.*.location' => 'required|in:query,header,body_json,body_xml,body_form,path',
            'parameters.*.required' => 'boolean',
            'parameters.*.default_value' => 'nullable|string',
            'parameters.*.description' => 'nullable|string',
            'parameters.*.validation_rules' => 'nullable|string',
            'parameters.*.sort_order' => 'integer',
        ]);

        $connection->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'base_url' => $data['base_url'],
            'endpoint_path' => $data['endpoint_path'] ?? null,
            'method' => $data['method'],
            'auth_type' => $data['auth_type'],
            'auth_config' => $data['auth_config'] ?? null,
            'headers' => json_decode($data['headers'] ?? '{}', true),
            'body_type' => $data['body_type'],
            'body_template' => $data['body_template'] ?? null,
            'response_type' => $data['response_type'],
            'send_extra_params' => $data['send_extra_params'] ?? false,
            'timeout' => $data['timeout'] ?? 30,
            'retry_count' => $data['retry_count'] ?? 0,
            'status' => $data['status'] ?? true,
        ]);

        $existingIds = $connection->parameters()->pluck('id')->toArray();
        $incomingIds = [];

        if (!empty($data['parameters'])) {
            foreach ($data['parameters'] as $i => $param) {
                if (!empty($param['id'])) {
                    $parameter = ApiConnectionParameter::find($param['id']);
                    if ($parameter) {
                        $parameter->update([
                            'name' => $param['name'],
                            'label' => $param['label'] ?? null,
                            'type' => $param['type'],
                            'location' => $param['location'],
                            'required' => $param['required'] ?? false,
                            'default_value' => $param['default_value'] ?? null,
                            'description' => $param['description'] ?? null,
                            'validation_rules' => $param['validation_rules'] ?? null,
                            'sort_order' => $param['sort_order'] ?? $i,
                        ]);
                        $incomingIds[] = $param['id'];
                    }
                } else {
                    $newParam = $connection->parameters()->create([
                        'name' => $param['name'],
                        'label' => $param['label'] ?? null,
                        'type' => $param['type'],
                        'location' => $param['location'],
                        'required' => $param['required'] ?? false,
                        'default_value' => $param['default_value'] ?? null,
                        'description' => $param['description'] ?? null,
                        'validation_rules' => $param['validation_rules'] ?? null,
                        'sort_order' => $param['sort_order'] ?? $i,
                    ]);
                    $incomingIds[] = $newParam->id;
                }
            }
        }

        $toDelete = array_diff($existingIds, $incomingIds);
        if (!empty($toDelete)) {
            ApiConnectionParameter::whereIn('id', $toDelete)->delete();
        }

        return redirect()->route('api_connector')
            ->with('message', 'Conexion API actualizada correctamente');
    }

    public function destroy($id)
    {
        $connection = ApiConnection::findOrFail($id);
        $connection->delete();

        return redirect()->route('api_connector')
            ->with('message', 'Conexion API eliminada correctamente');
    }

    public function test(Request $request, $id)
    {
        $connection = ApiConnection::with('parameters')->findOrFail($id);

        $params = $request->input('params', []);

        $service = new ApiConnectorService();
        $result = $service->test($connection, $params);

        return response()->json($result);
    }
}
