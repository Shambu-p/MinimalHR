<?php

class Response {

    static function prepare($data){
        
        header("Content-Type: application/json");
        print json_encode([
            "header" => [
                "error" => "false",
                "message" => "",
            ],
            "data" => $data
        ]);

    }

    static function prepareError($message){

        header("Content-Type: application/json");
        print json_encode([
            "header" => [
                "error" => "true",
                "message" => $message,
            ],
            "data" => []
        ]);

    }

}