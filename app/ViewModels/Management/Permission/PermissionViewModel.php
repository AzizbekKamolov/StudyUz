<?php
declare(strict_types=1);

namespace App\ViewModels\Management\Permission;

use Akbarali\DataObject\DataObjectBase;
use Akbarali\ViewModel\BaseViewModel;
use Carbon\Carbon;

class PermissionViewModel extends BaseViewModel
{

    public int $id;
    public string $name;
    public string $guard_name;
    public Carbon|string $created_at = "";
    protected DataObjectBase $_data;

    protected function populate(): void
    {
        $this->created_at = $this->created_at->format("d.m.Y H:i");
    }
}
