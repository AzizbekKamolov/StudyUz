<?php

namespace App\Models\Management;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
}
