<?php

// namespace App\App\Controller\Meeting;

// use App\App\Errors\ResourceNotFoundError;
// use App\App\Model\EventModel;


// class GetSpecifyMeetingController{
//     public function handle(){
//         try {
//             $id = $param['id'];
//             $event = new EventModel();
//             $getSpecifyMeetingControllerUseCase = new GetSpecifyMeetingControllerUseCase($event);

//             $stmt = $getSpecifyMeetingControllerUseCase->execute($id);

//             http_response_code(200);
//             echo json_encode($stmt);
//         } catch (ResourceNotFoundError $err) {
//             $statusCode = $err->execute();
//             $message = $err->getMessage();

//             http_response_code($statusCode);
//             echo json_encode([
//                 "message"=>$message,
//             ]);
//         }
//     }
// }