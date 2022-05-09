<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.list', compact('users'));
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request)
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $user->create(array_merge($request->validated(), [
            'password' => 'test'
        ]));

        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Process datatables ajax request.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        $usersdata = User::select('users.id', 'users.name', 'users.email', 'users.username', 'users.status', 'users.created_at', 'users.updated_at');
        return Datatables::of($usersdata)
            ->filter(function ($query) use ($request) {
                if ($request->has('name') && $request->get('name') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('users.name', 'like', "%{$request->get('name')}%");
                    });
                }
                if ($request->has('email') && $request->get('email') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('users.email', 'like', "%{$request->get('email')}%");
                    });
                }
            })
            ->addColumn('name', function ($usersdata) {
                return $name = (isset($usersdata->name)) ? ucwords($usersdata->name) : "";
            })
            ->addColumn('email', function ($usersdata) {
                return $email = (isset($usersdata->email)) ? ($usersdata->email) : "";
            })
            ->addColumn('username', function ($usersdata) {
                return $username = (isset($usersdata->username)) ? ($usersdata->username) : "";
            })
            ->addColumn('role', function ($usersdata) {
                $html = "";
                foreach ($usersdata->roles as $role) {
                    $html .=  ucwords($role->name);
                }
                return $html;
            })
            ->addColumn('status', function ($usersdata) {
                return $status = (isset($usersdata->status) && ($usersdata->status == 1)) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($usersdata) {

                $destroylink = '
                    <div class="btn-group">
                        <a href="' . route('users.destroy', $usersdata->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Do you really want to delete the permission?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $editlink = '
                    <div class="btn-group">
                        <a href="' . route('users.edit', $usersdata->id) . '" class="btn btn-sm  mt-1 mb-1 bg-purple" title="Edit" ><i class="fas fa-pencil-alt"></i></a>
                    </div>
                ';

                $showlink = '
                    <div class="btn-group">
                        <a href="' . route('users.show', $usersdata->id) . '" class="btn btn-sm  mt-1 mb-1 bg-info" title="Edit" ><i class="fas fa-eye"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('users.enable', $usersdata->id) . '" class="btn btn-sm btn-warning" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';
                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('users.disable', $usersdata->id) . '" class="btn btn-sm btn-success" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                $final = ($usersdata->status == 1) ? $showlink . $editlink . $destroylink . $inactivelink : $showlink . $editlink . $destroylink . $activelink;

                // $final = $showlink . $editlink . $destroylink;
                return $final;
            })
            ->make(true);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $user->update($request->validated());

        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')
            ->withSuccess(__('User updated successfully.'));
    }


    /**
     * Enable the specified user in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, User $user, $id)
    {
        $user = User::findOrFail($id);
        $user->status = "1";
        $user->save();
        return redirect()->route('users.index')->with('success', 'User enabled.');
    }

    /**
     * Disable the specified user in storage.
     * 
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, User $user, $id)
    {
        $user = User::findOrFail($id);
        $user->status = "0";
        $user->save();
        return redirect()->route('users.index')->with('warning', 'User disabled.');
    }

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }
}
