<?php

namespace Modules\SeoSorcery\Contracts;

interface IScanResult
{
    public static function make(): IScanResult;

    public function hasFailed(): bool;

    public function hasPassed(): bool;

    public function meta(): array;

    public function messages(): array;

    public function group(): string;

    public function description(): string;

    public function name(): string;

    public function with(string $key, $value): IScanResult;

    public function put(string $label, string $message): IScanResult;

    public function passed(): IScanResult;

    public function failed(): IScanResult;
}
