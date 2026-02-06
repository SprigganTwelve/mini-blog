<?php

namespace App\Enums;

enum UserRoles: string
{
    case ADMIN = "ROLE_ADMIN";
    case USER = "ROLE_USER";
}