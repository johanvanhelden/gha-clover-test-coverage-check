<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class GitHubOutputTest extends TestCase
{
    /** @test */
    public function it_outputs_the_coverage(): void
    {
        $output = $this->runCoverageCheck('/coverage_1.xml');

        $this->assertStringContainsString('##[set-output name=coverage;]1.46', $output);
    }

    /** @test */
    public function it_outputs_the_rounded_coverage(): void
    {
        $output = $this->runCoverageCheck('/coverage_1.xml', '50', '0');

        $this->assertStringContainsString('##[set-output name=coverage;]1', $output);
    }

    /** @test */
    public function it_outputs_the_display_coverage(): void
    {
        $output = $this->runCoverageCheck('/coverage_1.xml', '50', '0');

        $this->assertStringContainsString('##[set-output name=coverage-display;]1%', $output);
    }

    /** @test */
    public function it_outputs_if_the_coverage_is_acceptable(): void
    {
        $output = $this->runCoverageCheck('/coverage_1.xml', '50', '0');

        $this->assertStringContainsString('##[set-output name=coverage-acceptable;]false', $output);
    }
}
