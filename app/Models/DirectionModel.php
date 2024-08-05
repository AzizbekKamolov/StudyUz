<?php
declare(strict_types=1);
namespace App\Models;

use App\Filters\Trait\EloquentFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @property int $id
 * @property array $name
 * @property array $requirement
 * @property int $university_id
 * @property array $contract_currency
 * @property int $contract_amount
 * @property string $created_at
 */
class DirectionModel extends Model
{
    use HasFactory, EloquentFilterTrait;

    protected $table = 'directions';
    protected $fillable = [
        'name',
        'requirement',
        'university_id',
        'contract_amount',
        'contract_currency',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'name' => "array",
        'requirement' => "array",
        'contract_currency' => "array",
    ];

    public function university():BelongsTo
    {
        return $this->belongsTo(UniversityModel::class, 'university_id');
    }
}
