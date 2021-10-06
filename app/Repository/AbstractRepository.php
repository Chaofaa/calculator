<?php

namespace App\Repository;

use Exception;
use Illuminate\Database\Eloquent\Model;

class AbstractRepository {

    protected Model $model;

    protected string $modelClassName;

    /**
     * @throws Exception
     */
    public function __construct($model = false)
    {
        $this->model = $model ?: app($this->modelClassName);

        if (!($this->model instanceof Model)) {
            throw new Exception('$model must be instance of Illuminate\Database\Eloquent\Model class');
        }

    }

    public static function init(): static
    {
        return new static();
    }

}
