<?php
declare(strict_types=1);

namespace App\ViewModels\Management\User;

use App\ViewModels\BaseViewModel;
use Carbon\Carbon;

class UserViewModel extends BaseViewModel
{
    public int $id;
    public string $first_name;
    public string $last_name;
    public ?string $middle_name;
    public string $phone;
    public string $email;
    public ?array $roles;

    protected function populate(): void
    {
    }
}
