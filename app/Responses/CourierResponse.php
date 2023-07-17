<?php

namespace App\Responses;

class CourierResponse
{
    public const COURIER_SUCCESS = [
        'success' => true,
        'code' => 200,
        'message' => 'Get Data Successfully',
    ];
    public const COURIER_FAILED = [
        'success' => false,
        'code' => 500,
        'message' => 'Get Data Failed',
    ];

    public const COURIER_NOT_FOUND= [
        'success' => false,
        'code' => 404,
        'message' => 'Data Not Found',
    ];
    public const COURIER_STORE_SUCCESS= [
        'success' => true,
        'code' => 201,
        'message' => 'Create Courier Success',
    ];
    public const COURIER_UPDATE_SUCCESS= [
        'success' => true,
        'code' => 200,
        'message' => 'Update Courier Success',
    ];

    public const COURIER_DELETE_SUCCESS= [
        'success' => true,
        'code' => 200,
        'message' => 'Delete Courier Success',
    ];
}
