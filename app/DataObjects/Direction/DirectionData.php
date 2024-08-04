<?php
declare(strict_types=1);
namespace App\DataObjects\Direction;

use App\DataObjects\DataObjectBase;
use Illuminate\Support\Carbon;

class DirectionData extends DataObjectBase
{
    public int $id;
    public array $name;
    public array $requirement;
    public array $contract_currency;
    public int $contract_amount;
    public int $university_id;

}
