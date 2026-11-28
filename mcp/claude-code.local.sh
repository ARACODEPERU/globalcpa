#!/usr/bin/env bash
# Agrega el servidor MCP del Académico a Claude Code (scope de usuario).
# Token generado con: php artisan mcp:token admin@gmail.com --abilities=academic:read,academic:write --name=Claude-Code
claude mcp add --transport http --scope user academic-aracode   http://base_aracode.test/mcp/academic   --header "Authorization: Bearer 14|vtdfek5W7DXXuyz6BScU6CvwSFfSCXdMlRpV8Sjdbb790d35"
