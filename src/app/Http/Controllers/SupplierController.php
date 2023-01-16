<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new SupplierService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Supplier::orderBy('id', 'desc')->get();
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('action', function($model){
                    return '<a href="'.route('supplier.show', $model->id).'" class="btn btn-xs btn-primary btn-modal btn-edit"><i class="fa fa-edit"></i></a>
                    <a href="'.route('supplier.destroy', $model->id).'" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i></a>';
                })
                ->make();
        }

        return view('supplier.index');
    }

    public function show($id, Request $request)
    {
        $supplier = Supplier::find($id);

        if ($request->ajax()) {
            return response()->json($supplier->toArray());
        }

        return response(Response::$statusTexts[Response::HTTP_BAD_REQUEST], 400);
    }

    public function store(SupplierRequest $request)
    {
        if (!$request->ajax())
            return response(Response::$statusTexts[Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);

        $validated = $request->validated();

        return response()->json($this->service->create($validated, new Supplier()));
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        if (!$request->ajax())
            return response(Response::$statusTexts[Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);

        $validated = $request->validated();

        return response()->json($this->service->update($validated, $supplier));
    }

    public function destroy(Supplier $supplier)
    {
        return response()->json($this->service->destroy($supplier));
    }
}
