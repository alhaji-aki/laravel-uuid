<?php

namespace AlhajiAki\LaravelUuid\Tests;

use AlhajiAki\LaravelUuid\HasUuid;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    use HasUuid;

    protected $table = 'test_models';

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
