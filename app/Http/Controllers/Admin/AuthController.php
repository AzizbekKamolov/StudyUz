<?php

namespace App\Http\Controllers\Admin;

use App\ActionData\Management\Auth\LoginUserActionData;
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
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request): RedirectResponse
    {
        $actionData = LoginUserActionData::fromRequest($request);
        $this->service->loginUser($actionData);
        return redirect()->route("admin.index");
    }
}
