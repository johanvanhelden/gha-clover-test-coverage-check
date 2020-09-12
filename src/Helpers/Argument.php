<?php

declare(strict_types=1);

namespace CoverageCheck\Helpers;

class Argument
{
    public static function getString(array $arguments, int $position): ?string
    {
        $value = self::normalize($arguments, $position);

        if (is_null($value)) {
            return $value;
        }

        return (string) $value;
    }

    public static function getInt(array $arguments, int $position): ?int
    {
        $value = self::normalize($arguments, $position);

        if (is_null($value)) {
            return $value;
        }

        return (int) $value;
    }

    public static function getBool(array $arguments, int $position): ?bool
    {
        $value = self::normalize($arguments, $position);

        if (is_null($value)) {
            return $value;
        }

        return $value === 'true';
    }

    public static function getPercentage(array $arguments, int $position): ?int
    {
        $value = self::normalize($arguments, $position);

        if (is_null($value)) {
            return $value;
        }

        return min(100, max(0, (int) $value));
    }

    private static function normalize(array $arguments, int $position): ?string
    {
        if (!isset($arguments[$position])) {
            return null;
        }

        if ($arguments[$position] == '') {
            return null;
        }

        return $arguments[$position];
    }
}
