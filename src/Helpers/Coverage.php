<?php

declare(strict_types=1);

namespace CoverageCheck\Helpers;

use SimpleXMLElement;

class Coverage
{
    public static function fromXml(SimpleXMLElement $xml, int $precision): float
    {
        $metrics = $xml->xpath('//metrics');
        $totalElements = 0;
        $checkedElements = 0;

        foreach ($metrics as $metric) {
            $totalElements += (int) $metric['elements'];
            $checkedElements += (int) $metric['coveredelements'];
        }

        $coverage = ($checkedElements / $totalElements) * 100;

        return round($coverage, $precision);
    }

    public static function isAcceptable(float $coverage, int $percentage): bool
    {
        return $coverage >= $percentage;
    }
}
