<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ServiceProvider;

class MacroResponseProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Response::macro('success',function($data){

            if(is_string($data)){
                return response()->json([
                    'error' => false,
                    'message' => $data
                ]);
            }else{
                return response()->json([
                    'error' => false,
                    'data' => $data
                ]);
            }


            
        });

        Response::macro('error', function ($message, $status = 400) {

            if(is_string($message)){
                $messages = new MessageBag(['generic' => $message]);

            }else{
                $messages = new MessageBag($message);

            }
            
            $content = [
                "error" => true,
                'message'         => $message,
                'errors'          => $messages,

            ];

            return \response()->json($content, $status);


        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
