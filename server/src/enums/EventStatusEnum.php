<?php

namespace App\App\enums;

enum EventStatusEnum: string {
    case PENDING = 'Pendente';
    case CONFIRMED = 'Confirmado';
    case CANCELED = 'Cancelado';
}