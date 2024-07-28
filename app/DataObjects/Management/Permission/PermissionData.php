<?php
declare(strict_types=1);
namespace App\DataObjects\Management\Permission;

use App\DataObjects\DataObjectBase;
use Illuminate\Support\Carbon;

class PermissionData extends DataObjectBase
{
    public int $id;
    public string $name;
    public string $guard_name;
    public Carbon $created_at;

}
