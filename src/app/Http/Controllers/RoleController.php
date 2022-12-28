<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new RoleService;    
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Role::orderBy('id', 'desc')->get();
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('action', function($model){
                    if ($model->name != RoleService::SUPER_ADMIN) {
                        return view('partials.action', [
                            'model' => $model,
                            'route' => 'role'
                        ]);
                    }
                })
                ->make();
        }

        return view('role.index', [
            'guards' => $this->service::GUARDS
        ]);
    }

    public function store(CreateRoleRequest $request)
    {
        if (!$request->ajax())
            return response(Response::$statusTexts[Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);

        $validated = $request->validated();

        return response()->json($this->service->create($validated, new Role()));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        if (!$request->ajax())
            return response(Response::$statusTexts[Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);

        $validated = $request->validated();

        return response()->json($this->service->update($validated, $role));
    }

    public function destroy(Role $role)
    {
        return response()->json($this->service->destroy($role));
    }
}
