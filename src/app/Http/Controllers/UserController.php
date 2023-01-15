<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
                ->addColumn('action', function($model){
                    return view('partials.action', [
                        'model' => $model,
                        'route' => 'user'
                    ]);
                })
                ->make();
        }

        return view('user.index', [
            'role' => Role::pluck('name', 'id')
        ]);
    }

    public function store(UserRequest $request)
    {
        if (!$request->ajax())
            return response(Response::$statusTexts[Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);

        $validated = $request->validated();

        return response()->json($this->service->create($validated, new User()));
    }

    public function destroy(User $user)
    {
        return response()->json($this->service->destroy($user));
    }
}
