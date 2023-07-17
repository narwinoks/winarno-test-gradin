<?php

namespace App\Services;

use App\Interface\CourierInterface;
use App\Responses\CourierResponse;
use  Exception;
use function App\Helpers\error;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;


class CourierService
{
    protected  CourierInterface $courierInterface;
    public function __construct(CourierInterface $courierInterface)
    {
        $this->courierInterface = $courierInterface;
    }
    public  function index($request)
    {

        try{
            $data =$this->courierInterface->index($request);
        }catch (Exception $exception){
            Log::error('COURIER GET : '.json_encode($exception->getMessage(),JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(CourierResponse::COURIER_FAILED));
        }
        return $data;
    }

    public  function show($id){
        try{
            $data =$this->courierInterface->show($id);
            if ($data == null){
                throw new HttpResponseException(error(CourierResponse::COURIER_NOT_FOUND,404));
            }
        }catch (Exception $exception){
            Log::error('COURIER SHOW : '.json_encode($exception->getMessage(),JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(CourierResponse::COURIER_NOT_FOUND,404));
        }
        return $data;
    }
    public  function store($data){
        try {
            $courier =$this->courierInterface->store($data);
        }catch (Exception $exception){
            Log::error('COURIER STORE : '.json_encode($exception->getMessage(),JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(CourierResponse::COURIER_FAILED));
        }

        return $courier;
    }

    public  function update($id,$newData){
        try{
            $data =$this->courierInterface->show($id);
            if ($data == null){
                throw new HttpResponseException(error(CourierResponse::COURIER_NOT_FOUND,404));
            }
            $updated =$this->courierInterface->update($data,$newData);
        }catch (Exception $exception){
            Log::error('COURIER UPDATE : '.json_encode($exception->getMessage(),JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(CourierResponse::COURIER_NOT_FOUND,404));
        }
        return $updated;
    }

    public  function destroy($id){
        try {
            $data =$this->courierInterface->show($id);
            if ($data == null){
                throw new HttpResponseException(error(CourierResponse::COURIER_NOT_FOUND,404));
            }
            $destroy =$this->courierInterface->delete($data);
        }catch (Exception $exception){
            Log::error('COURIER DESTROY : '.json_encode($exception->getMessage(),JSON_PRETTY_PRINT));
            throw new HttpResponseException(error(CourierResponse::COURIER_NOT_FOUND,404));
        }
        return $destroy;
    }
}
