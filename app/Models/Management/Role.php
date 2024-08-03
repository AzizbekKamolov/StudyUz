<?php
declare(strict_types=1);
namespace App\Models\Management;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as Model;

class Role extends Model
{
    use HasFactory, EloquentFilterTrait;
    protected $table = 'roles';
}
