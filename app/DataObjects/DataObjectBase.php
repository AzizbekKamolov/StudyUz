<?php

namespace App\DataObjects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class DataObjectBase implements DataObjectContract
{
    protected array $_parameters = [];

    protected function prepare(): void {}

    /**
     * @param  array  $parameters
     * @param       $field
     * @param       $defaultValue
     * @return mixed
     */
    protected function getValue(array $parameters, $field, $defaultValue = null): mixed
    {
        return ($parameters[$field] ?? $parameters[Str::snake($field)] ?? $defaultValue);
    }

    /**
     * @param  array  $model
     * @return static
     * @noinspection PhpExpressionResultUnusedInspection
     */
    public static function createFromArray(array $model): static
    {
        $fields = DOCache::resolve(static::class, static function () {
            $class  = new \ReflectionClass(static::class);
            $fields = [];
            foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $reflectionProperty) {
                if ($reflectionProperty->isStatic()) {
                    continue;
                }
                $field          = $reflectionProperty->getName();
                $fields[$field] = $reflectionProperty;
            }

            return $fields;
        });

        $class              = new static();
        $class->_parameters = $model;
        /** @var array|\ReflectionProperty[] $fields */
        foreach ($fields as $field => $validator) {
            $value = ($class->_parameters[$field] ?? $class->_parameters[Str::snake($field)] ?? $validator->getDefaultValue() ?? null);
            if ($validator->getType() instanceof \ReflectionUnionType) {
                $types = $validator->getType()->getTypes();
                //array data objectlardan tashkil topgan bo`lsa
                if (!is_null($types) && !is_null($value) && count($types) === 2 && $types[1]->getName() === 'array') {
                    $dataObjectName = $types[0]->getName();
                    if (class_exists($dataObjectName) && new $dataObjectName instanceof self) {
                        $value = array_map(static fn($item) => $dataObjectName::createFromArray($item), $value);
                    }
                } else {
                    $value = [];
                }
                //DataObjectBase classdan tashkil topgan bo`lsa
            } elseif (is_array($value) && !is_null($validator->getType()) && class_exists($validator->getType()->getName())) {
                $dataObject = $validator->getType()->getName();
                if (class_exists($dataObject) && new $dataObject instanceof self) {
                    $value = $dataObject::createFromArray($value);
                }
            } elseif (!is_null($validator->getType()) && class_exists($validator->getType()->getName())) {
                $dataObject = $validator->getType()->getName();
                if (!($value instanceof $dataObject) && !(new $dataObject instanceof self)) {
                    $newClass = $validator->getType()->getName();
                    $value    = new $newClass($value);
                }
            }
            $validator->setAccessible(true);
            $validator->setValue($class, $value);
        }
        $class->prepare();

        return $class;
    }

    /**
     * @param  Model  $model
     * @return static
     */
    public static function createFromEloquentModel(Model $model): static
    {
        return self::createFromArray($model->toArray());
    }

    /**
     * @param  string  $json
     * @return static
     * @throws \JsonException
     */
    public static function createFromJson(string $json): static
    {
        return self::createFromArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
    }

    /**
     * @param  Model  $model
     * @return static
     */
    public static function fromModel(Model $model): static
    {
        return self::createFromEloquentModel($model);
    }

    /**
     * @param  array  $model
     * @return static
     */
    public static function fromArray(array $model): static
    {
        return self::createFromArray($model);
    }

    /**
     * @param  string  $json
     * @return static
     * @throws \JsonException
     */
    public static function fromJson(string $json): static
    {
        return self::createFromJson($json);
    }

    /**
     * @param  bool  $trim_nulls
     * @return array
     */
    public function toArray(bool $trim_nulls = false): array
    {
        $data = [];
        try {
            //TODO: Bunga ham DOCache qo`shish kerak
            $class      = new \ReflectionClass(static::class);
            $properties = $class->getProperties(\ReflectionProperty::IS_PUBLIC);
            foreach ($properties as $reflectionProperty) {
                if ($reflectionProperty->isStatic()) {
                    continue;
                }
                $value = $reflectionProperty->getValue($this);
                if ($trim_nulls === true) {
                    if (!is_null($value)) {
                        $data[$reflectionProperty->getName()] = $value;
                    }
                } else {
                    $data[$reflectionProperty->getName()] = $value;
                }
            }
        } catch (\Exception $exception) {

        }

        return $data;
    }

    /**
     * @param  bool  $trim_nulls
     * @return array
     */
    public function toSnakeArray(bool $trim_nulls = false): array
    {
        $data = [];
        try {
            $class      = new \ReflectionClass(static::class);
            $properties = $class->getProperties(\ReflectionProperty::IS_PUBLIC);
            foreach ($properties as $reflectionProperty) {
                if ($reflectionProperty->isStatic()) {
                    continue;
                }
                $value = $reflectionProperty->getValue($this);
                if ($trim_nulls === true) {
                    if (!is_null($value)) {
                        $data[Str::snake($reflectionProperty->getName())] = $value;
                    }
                } else {
                    $data[Str::snake($reflectionProperty->getName())] = $value;
                }
            }
        } catch (\Exception $exception) {

        }

        return $data;
    }

    /**
     * @param  bool  $trim_nulls
     * @return array
     */
    public function all(bool $trim_nulls = false): array
    {
        return $this->toArray($trim_nulls);
    }

    public static function arrayToClassProperty(array $array, bool $camelCase = false): string
    {
        $string = '';
        foreach ($array as $key => $value) {
            $type = match (gettype($value)) {
                'integer' => 'int',
                'double'  => 'float',
                'string'  => 'string',
                'array'   => 'array',
                default   => '?string',
            };
            if (str_contains($key, 'id')) {
                $type = 'readonly int';
            }
            $key    = $camelCase ? Str::camel($key) : $key;
            $string .= 'public '.$type.' $'.$key.';'.PHP_EOL;
        }

        return $string;
    }

    /**
     * @param  mixed  $model
     * @param  bool  $camelCase
     * @return string
     */
    public static function createProperty(mixed $model, bool $camelCase = false): string
    {
        if (is_array($model)) {
            return self::arrayToClassProperty($model, $camelCase);
        }

        if ($model instanceof Model) {
            return self::arrayToClassProperty($model->toArray(), $camelCase);
        }

        if (is_object($model) && method_exists($model, 'first') && method_exists($model, 'toArray')) {
            return self::arrayToClassProperty($model->first()->toArray(), $camelCase);
        }

        if (is_object($model) && method_exists($model, 'toArray')) {
            return self::arrayToClassProperty($model->toArray(), $camelCase);
        }

        throw new \Exception('Invalid model type', 404);
    }
}