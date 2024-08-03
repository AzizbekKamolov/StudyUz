<?php
declare(strict_types=1);
namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityModel extends Model
{
    use HasFactory, EloquentFilterTrait;
    protected $table = 'universities';
    protected $fillable = [
      'logo',
      'name',
      'country_id',
      'city_id',
      'description_uz',
      'description_ru',
      'description_en',
      'created_at',
      'updated_at',
    ];
}
