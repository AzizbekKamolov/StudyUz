<?php
declare(strict_types=1);
namespace App\ActionData\Management\Permission;

use App\ActionData\ActionDataBase;

class UpdatePermissionActionData extends ActionDataBase
{
    public string $name;
    public ?string $guard_name = 'web';
    protected array $rules = [
        "name" => "required"
    ];
}
