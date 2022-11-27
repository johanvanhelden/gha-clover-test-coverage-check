<?php

declare(strict_types=1);

namespace Tests\Feature\Helpers;

use CoverageCheck\Helpers\Output;
use Tests\TestCase;

class OutputTest extends TestCase
{
    /** @test */
    public function it_can_output_for_github(): void
    {
        $this->assertEquals(
            '"awesome-coverage=check" >> $GITHUB_OUTPUT' . PHP_EOL,
            Output::gitHub('awesome-coverage', 'check')
        );
    }

    /** @test */
    public function it_can_output_for_an_acceptable_check(): void
    {
        $this->assertEquals(
            '[OK] Code coverage is 50%, which is accepted (>=50%)' . PHP_EOL,
            Output::message('50%', 50, true)
        );
    }

    /** @test */
    public function it_can_output_for_an_unacceptable_check(): void
    {
        $this->assertEquals(
            '[ERROR] Code coverage is 50%, which is not accepted (>=100%)' . PHP_EOL,
            Output::message('50%', 100, false)
        );
    }
}
