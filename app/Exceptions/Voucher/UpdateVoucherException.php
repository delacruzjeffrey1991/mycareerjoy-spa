<?php

namespace App\Exceptions\Voucher;

use Exception;

class UpdateVoucherException extends Exception
{

    public function render($request)
    {
        $response = [
            'status' => 'error',
            'message' => 'Error occur while updating voucher'
        ];

        return response()->json($response, 500);
    }
}
