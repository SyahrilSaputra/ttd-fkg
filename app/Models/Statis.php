<?php

namespace App\Models;

use Illuminate\Http\Response;


class Statis
{
    public static function intToRupiah($int)
    {
        $hasil_rupiah = "Rp " . number_format($int,0,',','.');
	    return $hasil_rupiah;
    }

    public static function randNumber()
    {
        // $number = "23456789";
        // $randomNumber = '';

        // for ($j = 0; $j < 7; $j++) {
        //     $index = rand(0, strlen($number) - 1);
        //     $randomNumber .= $number[$index];
        // }
        // return $randomNumber;
        return mt_rand(217647264, 9174528745);
    }

    public static function roleNotPermitted()
    {
        $statusCode = Response::HTTP_BAD_REQUEST;
        return response()->json([
            'status' => 'Error',
            'message' => "You don't have permission",
        ], $statusCode);
    }

    public static function internalServerError()
    {
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        return response()->json([
            'status' => 'Error',
            'message' => "Internal Server Error"
        ], $statusCode);
    }

    public static function Ok($data, $message){
        $statusCode = Response::HTTP_OK;
        return response()->json([
            'status' => 'Success',
            'data' => $data,
            'message' => $message,
        ], $statusCode);
    }
    public static function successCreateData(){
        $statusCode = Response::HTTP_OK;
        return response()->json([
            'status' => 'Success',
            'message' => 'Create data success',
        ], $statusCode);
    }
    public static function successUpdateData(){
        $statusCode = Response::HTTP_OK;
        return response()->json([
            'status' => 'Success',
            'message' => 'Update data success',
        ], $statusCode);
    }
    public static function successDeleteData(){
        $statusCode = Response::HTTP_OK;
        return response()->json([
            'status' => 'Success',
            'message' => 'Delete data success',
        ], $statusCode);
    }
    public static function successGetData($data)
    {
        return response()->json($data);
    }
    public static function badRequest($field, $message){
        $statusCode = Response::HTTP_BAD_REQUEST;
        return response()->json([
            'status' => 'Error',
            'field' => $field,
            'message' => $message,
        ], $statusCode);
    }
    public static function Unauthorized(){
        $statusCode = Response::HTTP_UNAUTHORIZED;
        return response()->json([
            'status' => 'Error',
            'message' => 'Unauthorized',
        ], $statusCode);
    }
    
    public static function requiredMessage($field)
    {
        $statusCode = Response::HTTP_BAD_REQUEST;
        return response()->json([
            'status' => 'Error',
            'field' => $field,
            'message' => 'You must fill '.$field.' field',
        ], $statusCode);
    }
    public static function notPermittedMessage($field)
    {
        $statusCode = Response::HTTP_BAD_REQUEST;
        return response()->json([
            'status' => 'Error',
            'field' => $field,
            'message' => 'You cannot fill '.$field.' with this value',
        ], $statusCode);
    }
    public static function existMessage($value, $field)
    {
        $statusCode = Response::HTTP_BAD_REQUEST;
        return response()->json([
            'status' => 'Error',
            'field' => $field,
            'message' => $value.' already exist',
        ], $statusCode);
    }
    public static function mustEmailMessage($field)
    {
        $statusCode = Response::HTTP_BAD_REQUEST;
        return response()->json([
            'status' => 'Error',
            'field' => $field,
            'message' => 'Enter valid email',
        ], $statusCode);
    }
    public static function minLengthMessage($field, $min)
    {
        $statusCode = Response::HTTP_BAD_REQUEST;
        return response()->json([
            'status' => 'Error',
            'field' => $field,
            'message' => 'Min '.$field.' length is '.$min,
        ], $statusCode);
    }
    public static function unprocessable(string $message, array $errors)
    {
        $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
}