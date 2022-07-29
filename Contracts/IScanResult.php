<?php

namespace Modules\SeoSorcery\Contracts;

interface IScanResult
{
    public static function make(): IScanResult;

    public static function failed(): IScanResult;

    public static function passed(): IScanResult;

    public function hasFailed(): bool;

    public function hasPassed(): bool;

    public function status(bool $passed, string $message = null): IScanResult;

    public function add(string $key, $value): IScanResult;
}
