<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //

    protected function baseRespond($message, $code = 200)
    {
        # code...
        return response()->json([
            'message' => $message,
            'code' => $code
        ], $code);
    }

    protected function respondCreated($data = null, $message = 'data created', $code = 201)
    {
        # code...
        return response()->json([
            'message' => $message,
            'code' => $code,
            'data' => $data
        ], $code);
    }

    protected function respondUpdated($data = null, $message = 'data updated', $code = 200)
    {
        # code...
        return response()->json([
            'message' => $message,
            'code' => $code,
            'data' => $data
        ], $code);
    }

    protected function respondDeleted($message = 'data deleted', $code = 200, $soft = true)
    {
        # code...
        if ($soft) {
            return response()->json([
                'message' => 'data deleted (soft)',
                'code' => $code
            ], $code);
        }

        return response()->json([
            'message' => $message,
            'code' => $code
        ], $code);
    }

    public function respondError($message = 'Unknown Error!', $code = 500)
    {
        # code...
        return response()->json([
            'error' => $message
        ], $code);
    }
}
