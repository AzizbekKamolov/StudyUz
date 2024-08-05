<?php
declare(strict_types=1);
namespace App\DataObjects\Direction;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\University\UniversityData;

class DirectionData extends DataObjectBase
{
    public int $id;
    public array $name;
    public array $requirement;
    public array $contract_currency;
    public int $contract_amount;
    public int $university_id;
    public ?UniversityData $university;

}
