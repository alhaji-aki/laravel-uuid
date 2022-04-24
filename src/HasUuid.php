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
            $uuid = Str::uuid();

            while (static::where($model->getUuidColumn(), $uuid)->exists()) {
                static::bootHasUuid();
            }

            $model->{$model->getUuidColumn()} = $uuid;
        });
    }
}
