<?php
declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use App\ActionData\Auth\LoginUserActionData;
use App\Http\Controllers\Controller;
use App\Services\Admin\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $service)
    {
    }

    /**
     * @param LoginUserActionData $actionData
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(LoginUserActionData $actionData): RedirectResponse
    {
        $this->service->loginUser($actionData);
        return redirect()->route("admin.index")->with('res', [
            'method' => "success",
            'msg' => "Siz tizimga muvaqqiyatli kirdingiz",
        ]);
    }

    public function logOut(Request $request): RedirectResponse
    {
        auth()->logout();
        return redirect()->route("auth.login");
    }
}
