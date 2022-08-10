<?php

namespace Modules\SeoSorcery\Contracts;

interface IRadar
{
    function with(array $scanners): static;

    function add(string|array $scanners): static;

    function scan(ICanBeSeoAnalyzed $entity): static;

    function results(): array;
}
