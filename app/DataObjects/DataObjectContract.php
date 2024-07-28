<?php

namespace App\DataObjects;

use Illuminate\Database\Eloquent\Model;

interface DataObjectContract
{

    /**
     * @param  Model  $model
     * @return static
     */
    public static function createFromEloquentModel(Model $model): static;

    /**
     * @param  array  $model
     * @return static
     */
    public static function createFromArray(array $model): static;

    /**
     * @param  string  $json
     * @return static
     */
    public static function createFromJson(string $json): static;

    /**
     * @param  array  $model
     * @return static
     */
    public static function fromArray(array $model): static;

    /**
     * @param  Model  $model
     * @return static
     */
    public static function fromModel(Model $model): static;

    /**
     * @param  string  $json
     * @return static
     */
    public static function fromJson(string $json): static;

    /**
     * @param  bool  $trim_nulls
     * @return array
     */
    public function toSnakeArray(bool $trim_nulls = false): array;

    /**
     * @param  bool  $trim_nulls
     * @return array
     */
    public function toArray(bool $trim_nulls = false): array;

    /**
     * @param  bool  $trim_nulls
     * @return array
     */
    public function all(bool $trim_nulls = false): array;

}
