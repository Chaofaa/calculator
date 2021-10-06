<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;

class CalculatorController extends Controller {

    public function index(Request $request): Response
    {
        $client_key = $request->cookie('client_key') ?: Uuid::uuid4();

        return response(
            view('calculator')
                ->with('client_key', $client_key)
        )->cookie('client_key', $client_key, 360);
    }

}
