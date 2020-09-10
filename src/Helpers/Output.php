<?php

declare(strict_types=1);

namespace CoverageCheck\Helpers;

class Output
{
    /** @SuppressWarnings(PHPMD.ExitExpression) */
    public static function message($coverage, $percentage): string
    {
        $message = 'Code coverage is ' . $coverage . '%';

        if (!Coverage::isAcceptable($coverage, $percentage)) {
            return '[ERROR] ' . $message . ', which is not accepted (>=' . $percentage . '%)' . PHP_EOL;
        }

        return '[OK] ' . $message . ', which is accepted (>=' . $percentage . '%)!' . PHP_EOL;
    }

    public static function gitHubCoverage($coverage): string
    {
        return '##[set-output name=coverage;]' . $coverage . PHP_EOL;
    }
}
