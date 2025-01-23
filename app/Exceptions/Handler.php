<?php


namespace App\Exceptions;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Throwable;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Response;
use App\Models\CustomLog;

class Handler
{
    /**
     * Define retornos para exceções específicas
     */
    function hasCustomThrowable(Throwable $exception) 
    {
        $class_exception = class_basename(get_class($exception));
        switch ($class_exception) {
            # NotFoundHttpException
            case 'NotFoundHttpException':
                return [
                    'message'   => 'A Rota(url) informada não existe.',
                    'error_code'=> response::HTTP_NOT_FOUND
                ];
            break;
            case 'QueryException':
                return [
                    'message'   => 'SQLSTATE: Banco de dados retornou query inválida',
                    'error_code'=> response::HTTP_INTERNAL_SERVER_ERROR
                ];
            break;
            
            default:
                return false;
            break;
        }
    }

    /**
     * Renderiza a exceção para uma resposta HTTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function renderException(Exceptions $exceptions)
    {
        $exceptions->render(function (Throwable $e) {
            $trace_data = $this->setTraceData($e);
            $response = [
                'message'   => 'Ocorreu um erro inesperado. Por favor, tente novamente mais tarde...',
                'trace'     => $trace_data['trace'],
                'trace_code'=> $trace_data['trace_code'],
                'error_code'=> $trace_data['error_code']
            ];

            $hasCustomThrowable = $this->hasCustomThrowable($e);
            if($hasCustomThrowable) {
                $response['message'] = $hasCustomThrowable['message'];
                $response['error_code'] = $hasCustomThrowable['error_code'];
            }
           
            $this->saveLog($trace_data);
            return response()->json($response, $response['error_code']);
        });
    }

    function setTraceData(Throwable $e) 
    {
        $APP_DEBUG = env('APP_DEBUG');
        $trace_code = uniqid();
        $trace = 'Verifique os logs do sistema para mais informações';
        if($APP_DEBUG) {
            $trace = $e->getMessage().' na linha '.$e->getLine().' de '.$e->getFile();
        }
        return [
            'trace'=>$trace, 
            'trace_code'=>$trace_code,
            'error_code'=>Response::HTTP_INTERNAL_SERVER_ERROR
        ];
    }

    function saveLog($trace_data) 
    {
        $log = new CustomLog();
        $log_values = [
            'error_code'=>$trace_data['error_code'],
            'trace_code'=>$trace_data['trace_code'],
            'trace'=>$trace_data['trace']
        ];
        $log->set($log_values);
        $log->save();
    }
}