<?php

namespace App\App;

date_default_timezone_set('America/Sao_Paulo');
require "../vendor/autoload.php";

use App\App\Controller\Event\CreateEventController;
use App\App\Controller\Event\DeleteEventController;
use App\App\Controller\Event\GetOneEventByIdController;
use App\App\Controller\Event\ListAllEventsByNutritionistController;
use App\App\Controller\Event\UpdateEventController;
use App\App\Controller\Nutritionist\AuthenticateNutritionistController;
use App\App\Controller\Patient\EmailConfirmationController;
use App\App\Controller\Nutritionist\CreateNutritionistController;
use App\App\Controller\Nutritionist\ListAllNutritionistsController;
use App\App\Controller\Nutritionist\GetSpecificNutritionistByIdController;
use App\App\Controller\Nutritionist\UpdateNutritionistController;
use App\App\Controller\Nutritionist\DeleteNutritionistController;
use App\App\Controller\Nutritionist\UploadNutritionistAvatarController;
use Dotenv\Dotenv;

// meeting
use App\App\Controller\Meeting\CreateMeetingController;
use App\App\Controller\Meeting\GetAllMeetingController;
use App\App\Controller\Meeting\GetSpecifyMeetingByIdController;
use App\App\Controller\Meeting\UpdateMeetingController;
use App\App\Controller\Meeting\DeleteMeetingController;



use App\App\Controller\Patient\CreatePatientController;
use App\App\Controller\Patient\ListAllPatientsController;
use App\App\Controller\Patient\GetSpecificPatientByIdController;
use App\App\Controller\Patient\UpdatePatientController;
use App\App\Controller\Patient\DeletePatientController;
use App\App\Controller\Patient\AuthenticatePatientController;
use App\App\Controller\Patient\UploadPatientAvatarController;

use App\App\enums\HttpCode;
use App\App\JWT\TokenManager;
use App\App\JWT\TokenMiddleware;
use App\App\Routes\Router;

use App\App\Controller\Notification\MarkNotificationAsReadController;
use App\App\Controller\Notification\ListAllNotificationsController;

use App\App\Controller\Patient\InvitePatientController;

use App\App\Controller\Attendee\CreateAttendeeController;
use App\App\Controller\Attendee\ListAttendeesByMeetingController;
use App\App\Controller\Meeting\ListMeetingsAndAttendeesController;

use App\App\Controller\Nutritionist\ConfirmNutritionistAccountController;

require './JWT/ensureNutritionistIsAuthenticated.php';

// use PDO;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-type: application/json; charset=utf-8");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	http_response_code(200);
	exit;
}

// email confirmation controller
$emailConfirmation = new EmailConfirmationController();

// nutricionista
$createNutritionistController = new CreateNutritionistController();
$listAllNutritionistsController = new ListAllNutritionistsController();
$getSpecificNutritionistByIdController = new GetSpecificNutritionistByIdController();
$updateNutritionistController = new UpdateNutritionistController();
$deleteNutritionistController = new DeleteNutritionistController();
$authenticateNutritionistController = new AuthenticateNutritionistController();
$uploadNutritionistAvatarController = new UploadNutritionistAvatarController();

// paciente

$createPatientController = new CreatePatientController();
$listAllPatientsController = new ListAllPatientsController();
$getSpecificPatientByIdController = new GetSpecificPatientByIdController();
$updatePatientController = new UpdatePatientController();
$deletePatientController = new DeletePatientController();
$authenticatePatientController = new AuthenticatePatientController();
$uploadPatientAvatarController = new UploadPatientAvatarController();

// events controllers
$createEventController = new CreateEventController();
$listAllEventsByNutritionistController = new ListAllEventsByNutritionistController();
$deleteEventsController = new DeleteEventController();
$getOneEventController = new GetOneEventByIdController();
$updateEventController = new UpdateEventController();

// meeting controllers
$createMeetingController = new CreateMeetingController();
$updateMeetingController = new UpdateMeetingController();
$deleteMeetingController = new DeleteMeetingController();
$listAllMeetingsController = new GetAllMeetingController();

// token
$tokenManager = new TokenManager();
$tokenMiddleware = new TokenMiddleware();

// notification

$markNotificationAsReadController = new MarkNotificationAsReadController();
$listAllNotificationsController = new ListAllNotificationsController();

$invitePatientController = new InvitePatientController();

// attendee

$createAttendeeController = new CreateAttendeeController();
$listAttendeesByMeetingController = new ListAttendeesByMeetingController();

$listMeetingsAndAttendeesController = new ListMeetingsAndAttendeesController();

$confirmNutritionistAccountController = new ConfirmNutritionistAccountController();

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// auth user
Router::get("/auth", function () use ($tokenManager) {
	if (is_null($tokenManager)) {
		echo "Erro: $tokenManager não foi instanciado corretamente.";
		return;
	}
	echo $tokenManager->validateToken();
});


// rota para confirmação de email
Router::get("/emailconfirmation/{id}", function ($id) use ($emailConfirmation) {
	echo $emailConfirmation->handle($id);
});

Router::get("/", function () {
	echo "hello, world";
});

// rotas de nutricionista
Router::get("/nutritionists", function () use ($listAllNutritionistsController) {
	ensureNutritionistIsAuthenticated();
	$listAllNutritionistsController->handle();
});

Router::post('/nutritionist/auth', function () use ($authenticateNutritionistController) {
	echo $authenticateNutritionistController->handle();
});

Router::post("/nutritionists", function () use ($createNutritionistController) {
	$createNutritionistController->handle();
});


Router::get("/nutritionists/{id}", function ($id) use ($getSpecificNutritionistByIdController) {
	ensureNutritionistIsAuthenticated();
	$params = [
		"id" => $id,
	];

	$getSpecificNutritionistByIdController->handle($params);
});


Router::put("/nutritionists/{id}", function ($id) use ($updateNutritionistController) {
	ensureNutritionistIsAuthenticated();
	$params = [
		"id" => $id,
	];

	$updateNutritionistController->handle($params);
});


Router::delete("/nutritionists/{id}", function ($id) use ($deleteNutritionistController) {
	ensureNutritionistIsAuthenticated();
	$params = [
		"id" => $id,
	];

	$deleteNutritionistController->handle($params);
});

Router::get('/nutritionists/confirm/{id}', function($id) use ($confirmNutritionistAccountController) {
	$params = [
		"id" => $id,
	];

	$confirmNutritionistAccountController->handle($params);
});


// patient

Router::post('/patients/auth', function () use ($authenticatePatientController) {
	$authenticatePatientController->handle();
});

Router::post("/patients", function () use ($createPatientController) {
	ensureNutritionistIsAuthenticated();
	$createPatientController->handle();
});

Router::get("/patients", function () use ($listAllPatientsController) {
	ensureNutritionistIsAuthenticated();
	$listAllPatientsController->handle();
});

Router::get("/patients/{id}", function ($id) use ($getSpecificPatientByIdController) {
	ensureNutritionistIsAuthenticated();
	$params = [
		"id" => $id,
	];

	$getSpecificPatientByIdController->handle($params);
});

Router::put("/patients/{id}", function ($id) use ($updatePatientController) {
	ensureNutritionistIsAuthenticated();
	$params = [
		"id" => $id,
	];

	$updatePatientController->handle($params);
});

Router::delete("/patients/{id}", function ($id) use ($deletePatientController) {
	ensureNutritionistIsAuthenticated();
	$params = [
		"id" => $id,
	];

	$deletePatientController->handle($params);
});

//reuniões

Router::get('/teste', function () use ($tokenManager) {
	$validator = $tokenManager->validateToken();
	echo json_encode(['token' => $validator]);
});

Router::post("/meeting", function () use ($createMeetingController) {
	$createMeetingController->handle();
});

Router::get("/meeting/{nutritionistId}", function ($nutritionistId) use ($listAllMeetingsController) {
	ensureNutritionistIsAuthenticated();
	$params = [
		"nutritionistId" => $nutritionistId,
	];

	$listAllMeetingsController->handle($params);
});

// Router::get("/meeting/{id}", function ($id) use ($getSpecifyMeetingControllerUseCase) {
// 	$params = [
// 		"id" => $id,
// 	];

// 	$getSpecifyMeetingControllerUseCase->handle($params);
// });

Router::put("/meeting/{id}", function ($id) use ($updateMeetingController) {
	$updateMeetingController->handle($id);
});

Router::delete("/meeting/{id}", function ($id) use ($deleteMeetingController) {
	$params = [
		"id" => $id,
	];

	$deleteMeetingController->handle($params);
});

Router::get('/meetingsAndAttendees', function () use($listMeetingsAndAttendeesController) {
	$listMeetingsAndAttendeesController->handle();
});
// fim reuniões

//events routes

Router::post('/events', function () use ($createEventController) {
	ensureNutritionistIsAuthenticated();
	$createEventController->handle();
});

// listando todos os eventos com base no id de um usuário
Router::get('/events', function () use ($listAllEventsByNutritionistController) {
	ensureNutritionistIsAuthenticated();
	$listAllEventsByNutritionistController->handle();
});

Router::get('/events/{id}', function ($id) use ($getOneEventController, $tokenManager) {
	$validator = $tokenManager->validateToken();
	if (is_object($validator)) {
		$getOneEventController->handle($id);
		return;
	}
	http_response_code(HttpCode::BAD_REQUEST);
	echo json_encode(["msg" => "Essa rota não é permitida: 'usuário desconhecido'"]);
});

Router::put('/events/{id}', function ($id) use ($updateEventController) {
	$params = [
		"id" => $id,
	];

	$updateEventController->handle($params);

});

Router::delete('/events/{id}', function ($id) use ($deleteEventsController, $tokenManager) {
	$params = [
		"id" => $id,
	];

	$deleteEventsController->handle($params);
});

Router::post('/nutritionists/upload/{id}', function ($id) use($uploadNutritionistAvatarController) {
	$params = [
		"id" => $id,
	];

	$uploadNutritionistAvatarController->handle($params);
});

Router::post('/patients/upload/{id}', function ($id) use($uploadPatientAvatarController) {
	$params = [
		"id" => $id,
	];

	$uploadPatientAvatarController->handle($params);
});

Router::post('/notifications/markAsRead/{id}', function ($id) use($markNotificationAsReadController) {
	$params = [
		"id" => $id,
	];

	$markNotificationAsReadController->handle($params);
});

Router::get('/notifications', function () use($listAllNotificationsController) {
	$listAllNotificationsController->handle();
});

Router::post('/invite', function () use ($invitePatientController) {
	$invitePatientController->handle();
});


Router::post('/attendees/{meetingId}', function ($meetingId) use ($createAttendeeController) {
	$params = [
		"meetingId" => $meetingId,
	];

	$createAttendeeController->handle($params);
});

Router::get('/attendees/{meetingId}', function ($meetingId) use ($listAttendeesByMeetingController) {
	$params = [
		"meetingId" => $meetingId,
	];

	$listAttendeesByMeetingController->handle($params);
});

Router::resolve();