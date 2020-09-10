<?php

declare(strict_types=1);

namespace CoverageCheck;

require __DIR__ . '/includes/autoloader.php';

use CoverageCheck\Helpers\Coverage;
use CoverageCheck\Helpers\Output;
use InvalidArgumentException;
use SimpleXMLElement;

$inputFile = $argv[1];
$percentage = min(100, max(0, (int) $argv[2]));
$precision = (int) $argv[3];
$shouldExit = $argv[4] == 'true';

if (!file_exists($inputFile)) {
    throw new InvalidArgumentException('Invalid input file provided: ' . $inputFile);
}

if (!$percentage) {
    throw new InvalidArgumentException('An integer checked percentage must be given as second parameter');
}

$xml = new SimpleXMLElement(file_get_contents($inputFile));
$coverage = Coverage::fromXml($xml, $precision);

echo Output::message($coverage, $percentage);

echo Output::gitHubCoverage($coverage);

if ($shouldExit && !Coverage::isAcceptable($coverage, $percentage)) {
    exit(1);
}
