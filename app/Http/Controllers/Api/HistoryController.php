<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\HistoryRequest;
use App\Models\History;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class HistoryController extends Controller {

    public function index(Request $request)
    {
        // $request->route('limit');


        $histories = History::query()
            ->limit(5)
            ->orderBy('created_at', 'desc')
            ->get();

        $histories = $histories->map(function ($history) {
            return $history->value;
        });

        return response()->json(['status' => 'success', 'histories' => $histories]);
    }

    public function store(HistoryRequest $request): JsonResponse
    {
        try {
            History::create($request->validated());
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }

        return response()->json(['status' => 'success']);
    }

}
