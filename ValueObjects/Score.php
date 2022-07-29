<?php

namespace Modules\SeoSorcery\ValueObjects;

use Illuminate\Support\Collection;
use Modules\SeoSorcery\Contracts\IScore;
use Modules\SeoSorcery\Enum\Severity;

class Score implements IScore
{
    private int $value;
    private int $maxScore;
    private Severity $severity;

    public function __construct(Collection $results, int $value = 0, $maxScore = 100)
    {
        $this->maxScore = $maxScore;
        $this->value = $value;
        $this->calculate($results);
    }

    public static function make(...$args): static
    {
        return new static(...$args);
    }

    public function value(): int
    {
        return $this->value;
    }

    public function severity(): Severity
    {
        return $this->severity;
    }

    private function calculate(Collection $results): void
    {
        $total = $results->count();
        $totalPassed = $results->filter(fn($result) => $result->isPassed())->count();
        // How many passed of total: 10 tests = 100 score
        $this->value = ($totalPassed / $total) * $this->maxScore;
        $this->severity = $this->calculateSeverity();
    }

    private function calculateSeverity(): Severity
    {
        $score = $this->value;

        // > 75 <= 100
        if ($score > 75 && $score <= 100) {
            return Severity::LOW;
        }

        //> 55 <= 75
        if ($score > 55 && $score <= 75) {
            return Severity::MEDIUM;
        }

        //  > 30 <= 55
        if ($score > 30 && $score <= 55) {
            return Severity::HIGH;
        }

        // <= 30
        return Severity::CRITICAL;
    }
}
