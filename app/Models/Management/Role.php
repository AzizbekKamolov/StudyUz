<?php
declare(strict_types=1);
namespace App\Models\Management;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as Model;

/**
 * /**
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property string $created_at
 * /
 */
class Role extends Model
{
    use HasFactory, EloquentFilterTrait;
    protected $table = 'roles';
}
