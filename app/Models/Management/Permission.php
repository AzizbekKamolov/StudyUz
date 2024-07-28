<?php

namespace App\Models\Management;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as Model;
class Permission extends Model
{
    use HasFactory, EloquentFilterTrait;
    protected $table = 'permissions';
}
