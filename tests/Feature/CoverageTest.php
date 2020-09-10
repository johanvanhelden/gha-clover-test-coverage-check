<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class CoverageTest extends TestCase
{
    /** @test */
    public function it_can_calculate_the_coverage_percentage(): void
    {
        $output = $this->runCoverageCheck('/coverage_100.xml');

        $this->assertStringContainsString('coverage is 100%', $output);

        $output = $this->runCoverageCheck('/coverage_1.xml', '1');

        $this->assertStringContainsString('coverage is 1.46%', $output);
    }

    /** @test */
    public function it_knows_coverage_is_acceptable(): void
    {
        $output = $this->runCoverageCheck('coverage_100.xml');

        $this->assertStringContainsString('[OK]', $output);
    }

    /** @test */
    public function it_knows_coverage_is_unacceptable(): void
    {
        $output = $this->runCoverageCheck('coverage_1.xml', '50');

        $this->assertStringContainsString('[ERROR]', $output);
    }

    /** @test */
    public function it_can_round_the_percentage(): void
    {
        $output = $this->runCoverageCheck('coverage_1.xml', '50', '0');

        $this->assertStringContainsString('1%', $output);
    }
}
