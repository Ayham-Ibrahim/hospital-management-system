<?php

namespace Modules\DoctorManagement\Traits;

trait HttpResponses
{

    protected function success($data, $message = "null", $code = 200)
    {
        return response()->json([
            "stauts" => "request was successful",
            "meassage" => $message,
            "data" => $data
        ], $code);
    }

    protected function error($data, $message = "null", $code)
    {
        return response()->json([
            "stauts" => "Error has occured ...",
            "meassage" => $message,
            "data" => $data
        ], $code);
    }
}
