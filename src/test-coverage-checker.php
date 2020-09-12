<?php

declare(strict_types=1);

namespace CoverageCheck;

require __DIR__ . '/includes/autoloader.php';

use CoverageCheck\Helpers\Argument;
use CoverageCheck\Helpers\Coverage;
use CoverageCheck\Helpers\Output;
use InvalidArgumentException;
use SimpleXMLElement;

$inputFile = Argument::getString($argv, 1);
$percentage = Argument::getPercentage($argv, 2);
$roundedPrecision = Argument::getInt($argv, 3);
$shouldExit = Argument::getBool($argv, 4);

if (!file_exists($inputFile)) {
    throw new InvalidArgumentException('The coverage file could not be found: ' . $inputFile);
}

if (!$percentage) {
    throw new InvalidArgumentException('An integer percentage must be given as second parameter.');
}

$xml = new SimpleXMLElement(file_get_contents($inputFile));

$coverage = Coverage::fromXml($xml);
$coverageDisplay = $coverage . '%';

$coverageRounded = $coverage;
$coverageRoundedDisplay = $coverage . '%';

if (!is_null($roundedPrecision)) {
    $coverageRounded = round($coverageRounded, $roundedPrecision);
    $coverageRoundedDisplay = $coverageRounded . '%';
}

$isAcceptable = Coverage::isAcceptable($coverage, $percentage);

echo Output::message($coverageDisplay, $percentage, $isAcceptable);

echo Output::gitHub('coverage', (string) $coverage);
echo Output::gitHub('coverage-display', (string) $coverageDisplay);

echo Output::gitHub('coverage-rounded', (string) $coverageRounded);
echo Output::gitHub('coverage-rounded-display', (string) $coverageRoundedDisplay);

echo Output::gitHub('coverage-acceptable', $isAcceptable ? 'true' : 'false');

if ($shouldExit && !$isAcceptable) {
    exit(1);
}
