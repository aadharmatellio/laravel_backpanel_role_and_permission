<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {

        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials)) :
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        $rolespermissions = $user->getPermissionsViaRoles(); // collection of name strings

        $assignedPermissions = [];
        foreach ($rolespermissions as $key => $value) {
            $assignedPermissions[] = $value->name;
        }

        if ($user->status != "1") {
            return redirect()->to('login')
                ->withErrors("Your Account is disabled. Please contact the administrator");
        }

        $roles = $user->getRoleNames(); // Returns a collection
        if ((!in_array("login.perform", $assignedPermissions)) || ($user->status != "1")) {
            return redirect()->to('login')
                ->withErrors("You role is disabled. Please contact the administrator");
        }

        Auth::login($user);
        // $user = auth()->user(); dd($user);
        return $this->authenticated($request, $user);
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended('home');
    }
}
