<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
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

        return view('user.index');
    }
}
