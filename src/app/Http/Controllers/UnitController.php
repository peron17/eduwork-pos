<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\Unit;
use App\Services\UnitService;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Http\Response;

class UnitController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new UnitService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Unit::orderBy('id', 'desc')->get();
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('action', function($model){
                    return view('partials.action', [
                        'model' => $model,
                        'route' => 'unit'
                    ]);
                })
                ->make();
        }

        return view('unit.index');
    }

    public function store(CreateUnitRequest $request)
    {
        if (!$request->ajax())
            return response(Response::$statusTexts[Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);

        $validated = $request->validated();
        if (!$this->service->create($validated))
            return response()->json(['status'=>false, 'message'=>'Failed to save data']);

        return response()->json(['status'=>true]);
    }

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        if (!$request->ajax())
            return response(Response::$statusTexts[Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);

        $validated = $request->validated();
        if (!$this->service->update($validated, $unit))
            return response()->json(['status'=>false, 'message'=>'Failed to save data']);

        return response()->json(['status'=>true]);
    }

    public function destroy(Unit $unit)
    {
        if ($unit->delete())
            return response()->json(['status'=>true]);
     
        return response()->json(['status'=>false]);
    }
}
