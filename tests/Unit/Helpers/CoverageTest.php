<?php

declare(strict_types=1);

namespace Tests\Feature\Helpers;

use CoverageCheck\Helpers\Coverage;
use SimpleXMLElement;
use Tests\TestCase;

class CoverageTest extends TestCase
{
    /** @test */
    public function it_can_calculate_coverage(): void
    {
        $input = [
            'coverage_100.xml' => [
                'elements' => 100,
                'methods' => 100,
            ],
            'coverage_1.xml'   => [
                'elements' => 1.4598540145985401,
                'methods' => 25,
            ],
        ];

        foreach ($input as $file => $metrics) {
            $xml = new SimpleXMLElement(file_get_contents(__DIR__ . '/../../Fixtures/' . $file));

            foreach ($metrics as $metricToParse => $expectedValue) {
                $this->assertEquals($expectedValue, Coverage::fromXml($xml, $metricToParse));
            }
        }
    }

    /** @test */
    public function it_can_determine_coverage_is_unacceptable(): void
    {
        $this->assertFalse(Coverage::isAcceptable(50, 95));
    }

    /** @test */
    public function it_can_determine_coverage_is_acceptable(): void
    {
        $this->assertTrue(Coverage::isAcceptable(100, 95));
    }
}
