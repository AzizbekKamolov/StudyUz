<?php
declare(strict_types=1);
namespace App\DataObjects\Management\User;


use Akbarali\DataObject\DataObjectBase;

class UserData extends DataObjectBase
{
    public int $id;
    public string $first_name;
    public string $last_name;
    public ?string $middle_name;
    public string $phone;
    public string $email;
    public ?array $roles;
}
