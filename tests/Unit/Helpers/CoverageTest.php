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
            'coverage_100.xml' => 100,
            'coverage_1.xml'   => 1.4598540145985401,
        ];

        foreach ($input as $file => $expectedValue) {
            $xml = new SimpleXMLElement(file_get_contents(__DIR__ . '/../../Fixtures/' . $file));

            $this->assertEquals($expectedValue, Coverage::fromXml($xml));
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
