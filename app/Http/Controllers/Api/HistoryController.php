<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateHistoryRequest;
use App\Http\Requests\Api\HistoryRequest;
use App\Models\History;
use App\Repository\HistoryRepository;
use Illuminate\Http\JsonResponse;
use Exception;

class HistoryController extends Controller {

    public function index(HistoryRequest $request): JsonResponse
    {
        $histories = HistoryRepository::init()
            ->getLastClientValues(
                $request->input('client_key'),
                $request->route('limit')
            )
            ->map(function (History $history) {
                return $history->value;
            });

        return $this->jsonSuccess(['histories' => $histories]);
    }

    public function store(CreateHistoryRequest $request): JsonResponse
    {
        try {
            History::create($request->validated());
        } catch (Exception $e) {
            return $this->jsonError($e->getMessage());
        }

        return $this->jsonSuccess();
    }

}
