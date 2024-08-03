<?php

namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    use HasFactory, EloquentFilterTrait;
    protected $table = 'countries';
    protected $fillable = [
      'name',
      'created_at',
      'updated_at',
    ];
    protected $casts = [
      "name" => "array"
    ];
}
