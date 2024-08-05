<?php
declare(strict_types=1);
namespace App\DataObjects\Attribute;

use Akbarali\DataObject\DataObjectBase;
use Illuminate\Support\Carbon;

class AttributeData extends DataObjectBase
{
    public int $id;
    public array $name;
    public int $type;
    public ?Carbon $created_at;
}
