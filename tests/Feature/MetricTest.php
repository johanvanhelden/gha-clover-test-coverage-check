<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class MetricTest extends TestCase
{
    /** @test */
    public function it_parses_the_passed_metric(): void
    {
        $output = $this->runCoverageCheck('/coverage_100.xml', '50', '2', 'elements');

        $this->assertStringContainsString('coverage is 100%', $output);

        $output = $this->runCoverageCheck('/coverage_1.xml', '50', '2', 'methods');

        $this->assertStringContainsString('coverage is 7.1428571428571%', $output);
    }
}
