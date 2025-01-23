<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckHttpResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Executa a requisição e obtém a resposta
        $response = $next($request);
        // Verifica o status HTTP da resposta
        $http_code = $response->getStatusCode();
        switch ($http_code) {
            case 400:
                return response()->json([
                    'message' => 'Houve um problema com a solicitação.',
                    'status_code' => $response->getStatusCode()
                ], $response->getStatusCode());
                break;
            case 500:
                return response()->json([
                    'message' => 'Houve um problema com a solicitação...',
                    'status_code' => $response->getStatusCode()
                ], $response->getStatusCode());
                break;
            
            default:
                # code...
                break;
        }        if ($response->getStatusCode() >= 400) {
            // Personalize o comportamento para erros
            
        }

        // Continua o fluxo normal
        return $response;
    }
}
