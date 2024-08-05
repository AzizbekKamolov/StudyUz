<?php
declare(strict_types=1);

namespace App\ActionData\Attribute;


use Akbarali\ActionData\ActionDataBase;
use Illuminate\Validation\Rule;

class UpdateAttributeActionData extends ActionDataBase
{
    public array $name;
    public int $type = 1;

    public function prepare(): void
    {
        $this->rules = [
            "name" => "required|array",
            "name.uz" => [
                "required",
                Rule::unique('attributes', 'name->uz')
                    ->where('type', $this->type)->ignore(request('id'))
            ],
            "type" => "required|in:1,2"
        ];
    }
}
