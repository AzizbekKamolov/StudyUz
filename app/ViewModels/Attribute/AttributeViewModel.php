<?php
declare(strict_types=1);

namespace App\ViewModels\Attribute;

use Akbarali\DataObject\DataObjectBase;
use Akbarali\ViewModel\BaseViewModel;
use App\Enums\AttributeType;
use Carbon\Carbon;

class AttributeViewModel extends BaseViewModel
{

    public int $id;
    public array $name;
    public ?string $nameTr;
    public ?string $name_uz;
    public ?string $name_ru;
    public ?string $name_en;
    public int $type;
    public ?string $typeName;
    public Carbon|string $created_at = "";
    protected DataObjectBase $_data;
    protected function populate(): void
    {
        $this->typeName = AttributeType::getType($this->type);
        $this->nameTr = $this->trans($this->name);
        $this->name_uz = $this->trans($this->name, 'uz');
        $this->name_ru = $this->trans($this->name, 'ru');
        $this->name_en = $this->trans($this->name, 'en');
        $this->created_at = $this->created_at->format("d.m.Y H:i");
    }
}
