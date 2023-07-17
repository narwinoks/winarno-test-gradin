<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courier\IndexRequest;
use App\Http\Requests\Courier\StoreRequest;
use App\Http\Resources\Courier\CorierCollection;
use App\Http\Resources\Courier\CourierRespource;
use App\Responses\CourierResponse;
use App\Services\CourierService;
use Illuminate\Http\Request;
use function App\Helpers\success;

class CourierController extends Controller
{
    protected CourierService $courierService;
    public function __construct(CourierService $courierService)
    {
        $this->courierService = $courierService;
    }

    public  function index(IndexRequest $request)
    {
        $courier            =  $this->courierService->index($request);
        $courierResource    = new CorierCollection($courier);
        $courierTransform   = json_decode($courierResource->toResponse($request)->getContent(), true);
        return success(CourierResponse::COURIER_SUCCESS, $courierTransform, 200);
    }

    public  function show($id,Request $request)
    {
        $courier            =  $this->courierService->show($id);
        $courierResource    = new CourierRespource($courier);
        $courierTransform   = json_decode($courierResource->toResponse($request)->getContent(), true);
        return success(CourierResponse::COURIER_SUCCESS, $courierTransform, 200);
    }

    public  function store(StoreRequest $request){
        $data               =$request->only('name' ,'telp','city' ,'level');
        $courier            =  $this->courierService->store($data);
        $courierResource    = new CourierRespource($courier);
        $courierTransform   = json_decode($courierResource->toResponse($request)->getContent(), true);
        return success(CourierResponse::COURIER_STORE_SUCCESS, $courierTransform, 201);
    }

    public  function update(StoreRequest $request ,$id){
        $data               =$request->only('name' ,'telp','city' ,'level');
        $courier            =  $this->courierService->update($id,$data);
        $courierResource    = new CourierRespource($courier);
        $courierTransform   = json_decode($courierResource->toResponse($request)->getContent(), true);
        return success(CourierResponse::COURIER_UPDATE_SUCCESS, $courierTransform, 200);
    }
    public  function destroy(Request $request ,$id){
        $courier = $this->courierService->destroy($id);
        return success(CourierResponse::COURIER_DELETE_SUCCESS,[], 200);
    }
}
