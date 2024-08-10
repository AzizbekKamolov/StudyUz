<?php

namespace App\DataObjects\University;


use Akbarali\DataObject\DataObjectBase;

class UniversityAttributeData extends DataObjectBase
{
    public int $id;
    public int $university_id;
    public string $value;
    public int $attribute_id;
}
