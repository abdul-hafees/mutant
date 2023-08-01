<?php

namespace App\Admin\Http\Controllers;

use App\Mail\AdminMail;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Builder;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
//        $this->authorize('viewAny', Admin::class);

        if(request()->ajax()) {
            $query = Admin::query()
                ->orderBy('updated_at','desc');
            return \Yajra\DataTables\Facades\DataTables::of($query)
                ->filter(function ($query) {
                    if (request()->filled('filter.search')) {
                        $query->where(function ($query) {
                            $query->where('name', 'like', "%" . request('filter.search') . "%")
                                ->orWhere('email',request('filter.search'));

                        });
                    }
                })
//                ->editColumn('role', function ($admin){
//                    $adminRoleIds = $admin->adminRoles()->pluck('admin_roles.role_id');
//                    if($adminRoleIds->count() > 0) {
//                        $adminRoles = Role::whereIn('id', $adminRoleIds)->pluck('name')->toArray();
//
//                        $roleNames = [];
//                        foreach ($adminRoles as $adminRole){
//                            $roleName = Role::roleName($adminRole);
//                            array_push($roleNames, $roleName);
//                        }
//                        return implode(', ', $roleNames);
//                    }else{
//                        return '-';
//                    }
//                })
                ->addColumn('action', 'admin::pages.admins.action')
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
        ])
            ->parameters([
                'searching' => false,
                'ordering' => false,
                'pageLength' => 15
            ])
            ->addAction(['title' => '', 'class' => 'text-right p-3', 'width' => 70]);


        return view('admin::pages.admins.index', compact('html'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $this->authorize('create', Admin::class);

//        $roles = Role::get();

        return view('admin::pages.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->authorize('create', Admin::class);

        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191|unique:admins',
        ]);

        DB::beginTransaction();
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $password = Str::random('8');
        $admin->password = Hash::make($password);
        $admin->save();

//        $roles = $request->input('roles');
//        if ($roles != NULL) {
//            foreach ($roles as $role) {
//                $admin->adminRoles()->attach($admin->id, ['role_id' => $role]);
//
//                $adminRole = Role::findOrFail($role);
////                $adminRole = Str::lower($adminRole);
////                $replaced = str_replace(' ', '_', $adminRole);
//                $admin->assignRole($adminRole->name);
//            }
//        }

        $admin_details['name'] = $request->name;
        $admin_details['email'] = $request->email;
        $admin_details['admin_email'] = $request->email;
        $admin_details['password'] = $password;

        DB::commit();

        try {
            Mail::send(new AdminMail($admin_details));
        } catch (\Exception $e) {
            logger()->error($e->getMessage(), ['exception' => $e]);
        }

        return redirect()->route('admin.admins.index')->with('success', "Successfully Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::findOrFail($id);
//        $this->authorize('view', $admin);
        return view('admin::pages.admins.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
//        $adminSelectedRoles = $admin->adminRoles()->get();
//        $roles = Role::get();

//        $this->authorize('update', $admin);

        return view('admin::pages.admins.edit');
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
        $this->validate($request, [
            'name' => 'required|max:191',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->name = $request->input('name');
//        $roles = $request->input('roles');
//        $admin->adminRoles()->detach();
//        if ($roles != NULL) {
//            foreach ($roles as $role) {
//                $admin->adminRoles()->attach($admin->id, ['role_id' => $role]);
//
//                $adminRole = Role::findOrFail($role);
//
//                $admin->assignRole($adminRole->name);
//            }
//        }
        return redirect()->route('admin.admins.index')->with('success', "Successfully Updated");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
