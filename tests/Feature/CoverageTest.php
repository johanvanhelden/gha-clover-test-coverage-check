<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class CoverageTest extends TestCase
{
    /** @test */
    public function it_shows_the_coverage_percentage(): void
    {
        $output = $this->runCoverageCheck('/coverage_100.xml');

        $this->assertStringContainsString('coverage is 100%', $output);

        $output = $this->runCoverageCheck('/coverage_1.xml');

        $this->assertStringContainsString('coverage is 1.4598540145985%', $output);
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
}
