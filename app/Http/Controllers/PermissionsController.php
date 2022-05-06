<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:permissions.index|permissions.create|permissions.store|permissions.show|permissions.edit|permissions.update|permissions.destroy', ['only' => ['index', 'show']]);
        $this->middleware('permission:permissions.create|permissions.store', ['only' => ['create', 'store']]);
        $this->middleware('permission:permissions.edit|permissions.update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permissions.destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();

        return view('permissions.list', [
            'permissions' => $permissions
        ]);
    }


    /**
     * Show form for creating permissions
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name'
        ]);

        Permission::create($request->only('name'));

        return redirect()->route('permissions.index')
            ->withSuccess(__('Permission created successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Permission  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', [
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id
        ]);

        $permission->update($request->only('name'));

        return redirect()->route('permissions.index')
            ->withSuccess(__('Permission updated successfully.'));
    }

    /**
     * Process datatables ajax request.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $permissiondata = Permission::select('permissions.id', 'permissions.name', 'permissions.guard_name', 'permissions.created_at', 'permissions.updated_at');
        return Datatables::of($permissiondata)
            ->filter(function ($query) use ($request) {
                if ($request->has('permission') && $request->get('permission') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('permissions.name', 'like', "%{$request->get('permission')}%");
                    });
                }
            })
            ->addColumn('name', function ($permissiondata) {
                return $name = (isset($permissiondata->name)) ? ucwords($permissiondata->name) : "";
            })
            ->addColumn('guard_name', function ($permissiondata) {
                return $guard_name = (isset($permissiondata->guard_name)) ? ucwords($permissiondata->guard_name) : "";
            })
            ->addColumn('action', function ($permissiondata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('permissions.destroy', $permissiondata->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Do you really want to delete the permission?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $editlink = '
                    <div class="btn-group">
                        <a href="' . route('permissions.edit', $permissiondata->id) . '" class="btn btn-sm  mt-1 mb-1 bg-yellow" title="Edit" ><i class="fas fa-pencil-alt"></i></a>
                    </div>
                ';

                $final = $editlink . $link;
                // $final = "";
             
                return $final;
            })
            ->make(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')
            ->withSuccess(__('Permission deleted successfully.'));
    }
}
