<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\PermissionService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new UserService;    
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = User::orderBy('id', 'desc')->get();
            return DataTables::of($model)
                ->addIndexColumn()
                ->editColumn('is_active', function ($model) {
                    return labeledStatus($model->is_active);
                })
                ->addColumn('action', function($model){
                    return view('user.action', [
                        'model' => $model,
                        'route' => 'user'
                    ]);
                })
                ->rawColumns(['is_active'])
                ->make();
        }

        return view('user.index', [
            'role' => Role::pluck('name', 'id')
        ]);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');

        $permissions = PermissionService::groupListing();

        return view('user.create', compact('roles', 'permissions'));
    }

    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $response = $this->service->create($validated, new User());
        if (!$response['status'])
            return redirect()->route('user.index')->with('error', trans('message.alert save failed'));
            
        return redirect()->route('user.index')->with('success', trans('message.success save'));
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        
        $permissions = PermissionService::groupListing($user);

        return view('user.edit', compact('roles', 'permissions', 'user'));
    }

    public function update(User $user, UserRequest $request)
    {
        $validated = $request->validated();

        $response = $this->service->updateUser($validated, $user);
        if (!$response['status'])
            return redirect()->route('user.index')->with('error', trans('message.alert save failed'));
            
        return redirect()->route('user.index')->with('success', trans('message.success save'));
    }

    public function destroy(User $user, Request $request)
    {
        if ($request->ajax())
            return response()->json($this->service->destroy($user));

    }
}
