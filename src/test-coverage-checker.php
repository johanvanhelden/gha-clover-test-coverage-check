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
$coverageDisplay = $coverage . '%';
$isAcceptable = Coverage::isAcceptable($coverage, $percentage);

echo Output::message($coverageDisplay, $percentage, $isAcceptable);

echo Output::gitHub('coverage', (string) $coverage);
echo Output::gitHub('coverage-display', (string) $coverageDisplay);
echo Output::gitHub('coverage-acceptable', $isAcceptable ? 'true' : 'false');

if ($shouldExit && !$isAcceptable) {
    exit(1);
}
