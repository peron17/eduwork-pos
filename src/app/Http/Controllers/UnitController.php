<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use DataTables;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Unit::all();
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('action', function($model){
                    return view('unit.partials.action', [
                        'model' => $model,
                        'route' => 'unit'
                    ]);
                })
                ->make();
        }

        return view('unit.index');
    }
}
