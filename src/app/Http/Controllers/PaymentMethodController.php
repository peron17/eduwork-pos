<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class PaymentMethodController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new BaseService();    
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = PaymentMethod::orderBy('id', 'desc')->get();
            return DataTables::of($model)
                ->addIndexColumn()
                ->editColumn('is_active', fn ($model) => $model->active)
                ->addColumn('action', function($model){
                    return view('partials.action', [
                        'model' => $model,
                        'route' => 'payment-method'
                    ]);
                })
                ->rawColumns(['is_active'])
                ->make();
        }

        return view('payment-method.index');
    }

    public function store(PaymentMethodRequest $request)
    {
        if (!$request->ajax())
            return response(Response::$statusTexts[Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);

        $validated = $request->validated();
        if (!$this->service->create($validated, new PaymentMethod()))
            return response()->json(['status'=>false, 'message'=>'Failed to save data']);

        return response()->json(['status'=>true]);
    }

    public function update(PaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        if (!$request->ajax())
            return response(Response::$statusTexts[Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);

        $validated = $request->validated();
        if (!$this->service->update($validated, $paymentMethod))
            return response()->json(['status'=>false, 'message'=>'Failed to save data']);

        return response()->json(['status'=>true]);
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->delete())
            return response()->json(['status'=>true]);
     
        return response()->json(['status'=>false]);
    }
}
