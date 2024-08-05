<?php
declare(strict_types=1);
namespace App\ActionData\Management\User;


use Akbarali\ActionData\ActionDataBase;

class UpdateUserActionData extends ActionDataBase
{
    public string $first_name;
    public string $last_name;
    public ?string $middle_name;
    public string $phone;
    public string $email;
    public ?string $password;
    public ?array $role_id = [];
    protected array $rules = [
        "first_name" => "required",
        "last_name" => "required",
        "phone" => "required",
        "email" => "required",
        "role_id" => "nullable|array",
        "role_id.*" => "exists:roles,name",
    ];
}
