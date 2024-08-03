<?php
declare(strict_types=1);
namespace App\ActionData\Country;

use App\ActionData\ActionDataBase;

class CountryActionData extends ActionDataBase
{
    public ?array $name;
    protected array $rules = [
        "name" => "required|array",
        "name.uz" => "required|string"
    ];
}
