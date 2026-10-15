<?php
namespace App\App\enums;
enum HttpCode{
    const OK = 200;
    const CREATED = 201;
    const NO_CONTENT = 204;
    const BAD_REQUEST = 400;
		const UNAUTHORIZED = 401;
    const USER_ERROR = 404;
    const SERVER_ERROR = 500;
}