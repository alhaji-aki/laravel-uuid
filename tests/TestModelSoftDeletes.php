<?php

namespace AlhajiAki\LaravelUuid\Tests;

use AlhajiAki\LaravelUuid\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestModelSoftDeletes extends Model
{
    use SoftDeletes;
    use HasUuid;

    protected $table = 'test_model_soft_deletes';

    protected $guarded = [];

    public $timestamps = false;

    /**
     * Get the options for generating the slug.
     */
    public function getUuidColumn(): string
    {
        return 'uuid';
    }
}
