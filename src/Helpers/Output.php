<?php

declare(strict_types=1);

namespace CoverageCheck\Helpers;

class Output
{
    public static function message(string $coverageDisplay, int $percentage, bool $isAcceptable): string
    {
        $message = 'Code coverage is ' . $coverageDisplay;

        if (!$isAcceptable) {
            return '[ERROR] ' . $message . ', which is not accepted (>=' . $percentage . '%)' . PHP_EOL;
        }

        return '[OK] ' . $message . ', which is accepted (>=' . $percentage . '%)' . PHP_EOL;
    }

    public static function gitHub(string $name, string $value): string
    {
        return '##"' . $name . '=' . $value . '" >> $GITHUB_OUTPUT' . PHP_EOL;
    }
}
