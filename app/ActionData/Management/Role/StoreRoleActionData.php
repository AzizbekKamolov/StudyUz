<?php
declare(strict_types=1);
namespace App\ActionData\Management\Role;

use App\ActionData\ActionDataBase;

class StoreRoleActionData extends ActionDataBase
{
    public string $name;
    public ?string $guard_name = 'web';
    public ?array $permission_id = [];
    protected array $rules = [
        "name" => "required|unique:permissions,name",
        "permission_id" => "nullable|array",
        "permission_id.*" => "string"
    ];
}
