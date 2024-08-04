<?php
declare(strict_types=1);
namespace App\ActionData\Direction;

use App\ActionData\ActionDataBase;

class DirectionActionData extends ActionDataBase
{
    public ?array $name;
    public ?array $requirement;
    public ?array $contract_currency;
    public ?int $contract_amount;
    public ?int $university_id;
    protected array $rules = [
        "name" => "required|array",
        "requirement" => "required|array",
        "contract_currency" => "required|array",
        "contract_amount" => "required|integer",
        "university_id" => "required|integer|exists:universities,id",
    ];
}
