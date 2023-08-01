<?php

namespace App\Admin\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        $this->authorize('viewAny', Role::class);

        if (request()->ajax()) {
            $query = Role::query()->withCount('permissions');

            return DataTables::of($query)
                ->filter(function ($query) {
                    if(request()->has('filter')) {
                        if (request()->filled('filter.q')) {
                            $query->where('name', 'like', "%" . request('filter.q') . "%");
                        }
                    }
                })
                ->addColumn('action', function ($role){
                    return view('admin::pages.roles.action', compact('role'));
                })
                ->editColumn('name', function ($role){
                    $name = $role->name;
                    $roleName = Role::roleName($name);
                    return $roleName;
                })
                ->rawColumns(['action', 'count'])
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Name', 'searchable' => true],
            ['data' => 'permissions_count', 'name' => 'permissions_count', 'title' => 'Total Permission', 'searchable' => true],
        ])->addAction(
            ['title' => '', 'class' => 'text-right p-3', 'width' => 70]
        )->parameters([
            'ordering' => false,
        ]);

        return view('admin::pages.roles.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        $permissions = Permission::all();

        return view('admin::pages.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);

        $validated = $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required|array',
        ]);

        $string = Str::lower($request->name);
        $string = str_replace(' ', '_', $string);

        /** @var Role $role */
        $role = Role::create(['name' => $string]);
        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('admin.roles.index')->with('success', "Role created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $name = $role->name;
        $roleName = Role::roleName($name);

        $this->authorize('update', $role);

        $permissions = Permission::all();

        return view('admin::pages.roles.edit', compact('role', 'permissions', 'roleName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $this->authorize('update', $role);

        $validated = $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required|array',
        ]);

        $role->name = $validated['name'];
        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('admin.roles.index')->with('success', "Role updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        $role = Role::findOrFail($id);
        $role->delete();

        $role->permissions()->where('id', $id)->wherePivot('role_id', $id)->detach();

        DB::commit();

    }
}
