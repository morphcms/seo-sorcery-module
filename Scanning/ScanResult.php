<?php

namespace Modules\SeoSorcery\Scanning;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Fluent;
use Modules\SeoSorcery\Contracts\IScanResult;

/**
 * @property bool $status
 * @property string $name
 * @property string $help
 * @property string $message
 * @property array $meta
 * @property string $group
 * @method name(string $value = null)
 * @method help(string $value = null)
 * @method message(string $value = null)
 * @method meta(array $values = [])
 * @method group(string $value = null)
 */
class ScanResult extends Fluent implements IScanResult, Arrayable, Jsonable
{

    public static function make(...$arguments): static
    {
        return new static(...$arguments);
    }

    public static function failed(...$args): static
    {
        return (new static(...$args))->status(false);
    }

    public static function passed(...$args): static
    {
        return (new static(...$args))->status(true);
    }


    public function hasFailed(): bool
    {
        return !$this->status;
    }

    public function hasPassed(): bool
    {
        return $this->status;
    }


    public function status(bool $passed, string $message = null): static
    {
        $this->status = $passed;
        $this->message = $message;


        return $this;
    }

    public function add(string $key, $value): static
    {
        $this->meta[$key] = $value;

        return $this;
    }

}
