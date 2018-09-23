<?php
namespace App\Http\Controllers;

trait ErrorHandler
{
    public function getError($e, $code) {
        return \response(
            ['message' => $e->getMessage(), 'error' => $e->errorInfo],
            $code
        );
    }
}
