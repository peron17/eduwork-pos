<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Models\Unit;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class UnitController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new BaseService;
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

    public function store(UnitRequest $request)
    {
        dd($request->all());
        if (!$request->ajax())
            return response(Response::$statusTexts[Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);

        $validated = $request->validated();

        return response()->json($this->service->create($validated, new Unit()));
    }

    public function update(UnitRequest $request, Unit $unit)
    {
        if (!$request->ajax())
            return response(Response::$statusTexts[Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);

        $validated = $request->validated();

        return response()->json($this->service->update($validated, $unit));
    }

    public function destroy(Unit $unit)
    {
        return response()->json($this->service->destroy($unit));
    }
}
