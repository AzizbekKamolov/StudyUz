<?php
declare(strict_types=1);

namespace App\Enums;
enum AttributeType: int
{
    case UNIVERSITY_TYPE = 1;
    case DIRECTION_TYPE = 2;

    public static function getType(int $type):string
    {
        return match ($type) {
            self::UNIVERSITY_TYPE->value => __('form.university.university'),
            self::DIRECTION_TYPE->value => __('form.direction.direction'),
            default => "Not found"
        };
    }
}
