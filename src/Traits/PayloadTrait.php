<?php

/*
 * This file is part of the cblink/laravel-dto.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Cblink\DTO\Traits;

use Cblink\DTO\Exceptions\DTOException;
use Illuminate\Support\Str;

trait PayloadTrait
{
    /**
     * @var array
     */
    protected $payload = [];

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @var array
     */
    protected $attributes = [];

    protected function fillable(): array
    {
        if (!$this->attributes) {
            $rules = method_exists($this, 'rules') ?
                array_keys($this->rules()) :
                [];

            $this->attributes = array_unique(array_merge($this->fillable, $rules));
        }

        return $this->attributes;
    }

    protected function setPayload(array $payload = [])
    {
        $payload = $payload ?: $this->origin;

        // 如果包含 * 号则直接赋值
        if (in_array('*', $this->fillable())) {
            $this->payload = $payload;

            return;
        }

        foreach ($payload as $key => $val) {
            // 如果key值不存在，则跳过
            if (!in_array($key, $this->fillable())) {
                continue;
            }

            $this->setAttribute($key, $val);
        }
    }

    /**
     * @param $name
     *
     * @return mixed|null
     */
    protected function getAttribute($name)
    {
        $method = 'get'.ucfirst(Str::camel($name)).'Attribute';

        if (method_exists($this, $method)) {
            return call_user_func([$this, $method]);
        }

        if (!array_key_exists($name, $this->payload) && !in_array($name, $this->fillable())) {
            throw new DTOException(sprintf('%s attribute is not defined', $name));
        }

        return $this->payload[$name] ?? null;
    }

    /**
     * @param $name
     * @param $val
     */
    protected function setAttribute($name, $val)
    {
        $method = 'set'.ucfirst(Str::camel($name)).'Attribute';

        if (method_exists($this, $method)) {
            $this->payload[$name] = call_user_func_array([$this, $method], [$val]);

            return;
        }

        $this->payload[$name] = $val;
    }
}
