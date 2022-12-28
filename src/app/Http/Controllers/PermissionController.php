<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new PermissionService;    
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Permission::orderBy('id', 'desc')->get();
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('action', function($model){
                    return view('partials.action', [
                        'model' => $model,
                        'route' => 'permission'
                    ]);
                })
                ->make();
        }

        return view('permission.index');
    }

    public function store(PermissionRequest $request)
    {
        if (!$request->ajax())
            return response(Response::$statusTexts[Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);

        $validated = $request->validated();

        return response()->json($this->service->create($validated, new Permission()));
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        if (!$request->ajax())
            return response(Response::$statusTexts[Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);

        $validated = $request->validated();

        return response()->json($this->service->update($validated, $permission));
    }

    public function destroy(Permission $permission)
    {
        return response()->json($this->service->destroy($permission));
    }
}
