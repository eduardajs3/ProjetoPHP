<?php
namespace App\App\Commons\ResponseCommons;
use App\App\enums\HttpCode;
class Responses
{
  public function response($data, $successMsg, $errMsg){
    if($data){
      return $this->successResponse($data, $successMsg);
    }else{
      return $this->errorResponse($errMsg, $data);
    }
  }
  private function successResponse($data, $message)
  {
    http_response_code(HttpCode::OK);
    return json_encode(
      [
        "message" => $message,
        "data" => $data
      ]
    );
  }

  private function errorResponse($message, $error)
  {
      http_response_code(HttpCode::USER_ERROR);
      return json_encode(
        [
          "message"=> $message,
          "error"=> $error
        ]
      );
  }

  static function serverError($message, $error)
  {
     http_response_code(HttpCode::SERVER_ERROR);
  }
}