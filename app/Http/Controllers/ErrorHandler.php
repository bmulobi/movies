<?php
namespace App\Http\Controllers;

trait ErrorHandler
{
    public function getError($e, $code) {
        switch (get_class($e)) {
            case 'Illuminate\Validation\ValidationException':
                $error = $e->errors();
                break;
            case 'Illuminate\Database\QueryException':
                $error = $e->errorInfo;
                break;
            default:
                $error = $e->getTraceAsString();
        }

        return \response(['message' => $e->getMessage(), 'error' => $error, 'file' => $e->getFile(), 'line' => $e->getLine()], $code);
    }
}
