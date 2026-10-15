<?php

namespace App\App\Controller\Meeting;

use App\App\enums\HttpCode;
use App\App\Errors\ResourceNotFoundError;
use App\App\Repository\MeetingRepository;
use App\App\UseCases\Meeting\DeleteMeetingUseCase;
class DeleteMeetingController{
    public function handle($params){
        $id = $params['id'];

        try{
            $meetingRepository = new MeetingRepository();
            $deleteMeetingUseCase = new DeleteMeetingUseCase($meetingRepository);

            $deleteMeetingUseCase->execute($id);

            http_response_code(HttpCode::NO_CONTENT);

        }catch(ResourceNotFoundError $err){
            $statusCode = $err->getCode();
            $message = $err->getMessage();

            http_response_code($statusCode);
            echo json_encode([
                'message'=> $message
            ]);
        }
    }
}