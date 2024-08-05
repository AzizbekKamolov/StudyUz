<?php
declare(strict_types=1);
namespace App\DataObjects\Country;

use Akbarali\DataObject\DataObjectBase;
use Illuminate\Support\Carbon;

class CountryData extends DataObjectBase
{
    public int $id;
    public ?array $name;
    public ?Carbon $created_at;
}
