<?php

namespace Modules\SeoSorcery\Scanning;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Fluent;
use Modules\SeoSorcery\Contracts\IScanResult;

class ScanResult implements IScanResult, Arrayable, Jsonable
{

    private bool $status;
    private array $messages = [];
    private array $meta = [];

    public function __construct(public string $name, public ?string $description = null, public ?string $group = null)
    {

    }

    public static function make(...$arguments): static
    {
        return new static(...$arguments);
    }

    public function passed(): IScanResult
    {
        return $this->status(true);
    }

    public function failed(): IScanResult
    {
        return $this->status(false);
    }


    public function hasFailed(): bool
    {
        return !$this->status;
    }

    public function hasPassed(): bool
    {
        return $this->status;
    }


    public function status(bool $passed): static
    {
        $this->status = $passed;

        return $this;
    }

    public function with(string $key, $value): static
    {
        $this->meta[$key] = $value;

        return $this;
    }

    public function toArray(): array
    {
        return [];
    }


    public function messages(): array
    {
        return $this->messages;
    }

    public function meta(): array
    {
        return $this->meta;
    }

    public function toJson($options = 0): bool|string
    {
        return json_encode($this->toArray(), $options);
    }

    public function put(string $label, string $message, string $help = null): IScanResult
    {
        $this->messages[] = compact('label', 'message', 'help');

        return $this;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function group(): string
    {

        return $this->group;
    }
}
