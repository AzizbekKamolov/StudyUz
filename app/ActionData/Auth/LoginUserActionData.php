<?php
declare(strict_types=1);

namespace App\ActionData\Auth;

use App\ActionData\ActionDataBase;

class LoginUserActionData extends ActionDataBase
{
    public ?string $username;
    public ?string $password;

    protected array $rules = [
        "username" => "required",
        "password" => "required",
    ];
}
