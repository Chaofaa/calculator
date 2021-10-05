<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property int $id
 * @property string $key
 * @property string|null $value
 *
 * @property string|Carbon $created_at
 * @property string|Carbon $updated_at
 *
 * @mixin Builder
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class History extends Model
{
    use HasFactory;

    protected $table = 'histories';

    protected $fillable = [
        'key',
        'value'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
