<?php

namespace AlhajiAki\LaravelUuid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    abstract public function getUuidColumn(): string;

    protected static function bootHasUuid(): void
    {
        static::creating(function (Model $model) {
            $model->{$model->getUuidColumn()} = Str::uuid();
        });
    }
}
