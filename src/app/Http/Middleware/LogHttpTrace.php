<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogHttpTrace
{
    public function handle(Request $request, Closure $next)
    {
        $requestBody = $this->getBodyContent($request->getContent());

        Log::info('Incoming request: ', [
            'method' => $request->method(),
            'uri' => $request->fullUrl(),
            'headers' => $request->headers->all(),
            'body' => $requestBody,
        ]);

        $response = $next($request);

        $responseBody = $this->getBodyContent($response->getContent());

        Log::info('Outgoing response: ', [
            'status' => $response->getStatusCode(),
            'headers' => $response->headers->all(),
            'body' => $responseBody,
        ]);

        return $response;
    }

    private function getBodyContent($body)
    {
        $decoded = json_decode($body, true);

        if (is_array($decoded)) {
            return $this->removeSensitiveData($decoded);
        }

        return $body;
    }

    private function removeSensitiveData(array $data): array
    {
        $logSensitiveFields = config('api.log_sensitive_fields');
        foreach ($data as $key => $value) {
            if (in_array($key, $logSensitiveFields)) {
                unset($data[$key]);
            } elseif (is_array($value)) {
                $data[$key] = $this->removeSensitiveData($value);
            }
        }
        return $data;
    }
}
