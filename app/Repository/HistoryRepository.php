<?php

namespace App\Repository;

use App\Models\History;
use Illuminate\Database\Eloquent\Collection;

class HistoryRepository extends AbstractRepository {

    protected string $modelClassName = History::class;

    public function getLastClientValues(string $client_key, int $limit = 5): Collection
    {
        return History::query()
            ->where('client_key', $client_key)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

}
