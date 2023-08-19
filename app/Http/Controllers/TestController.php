<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Exceptions\TestException;




class TestController extends Controller
{
    public function Test()
    {
//        try {
            $this->makeSomethingRisky();

//        } catch (TestException $e) {
//            dd(1);
//            return response()->json([
//                'message' => $e->getMessage(),
//            ], $e->getCode());
//        };

//        return response()->json([
//            'message' => 'hi'
//        ]);
    }

    protected function makeSomethingRisky()
    {
        throw TestException::checkError();

    }
}
