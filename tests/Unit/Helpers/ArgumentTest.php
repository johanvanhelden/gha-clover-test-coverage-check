<?php

declare(strict_types=1);

namespace Tests\Feature\Helpers;

use CoverageCheck\Helpers\Argument;
use Tests\TestCase;

class ArgumentTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider stringProvider
     */
    public function it_retrieves_a_string_value(string $input, ?string $expected): void
    {
        $this->assertEquals($expected, Argument::getString([$input], 0));
    }

    /**
     * @test
     *
     * @dataProvider intProvider
     */
    public function it_retrieves_an_int_value(string $input, ?int $expected): void
    {
        $this->assertEquals($expected, Argument::getInt([$input], 0));
    }

    /**
     * @test
     *
     * @dataProvider boolProvider
     */
    public function it_retrieves_a_bool_value(string $input, ?bool $expected): void
    {
        $this->assertEquals($expected, Argument::getBool([$input], 0));
    }

    /**
     * @test
     *
     * @dataProvider percentageProvider
     */
    public function it_retrieves_a_percentage_value(string $input, ?int $expected): void
    {
        $this->assertEquals($expected, Argument::getPercentage([$input], 0));
    }

    /** @test */
    public function it_returns_null_if_an_argument_is_not_set(): void
    {
        $arguments = [];

        $this->assertTrue(is_null(Argument::getBool($arguments, 2)));
    }

    /** @test */
    public function it_returns_null_if_an_argument_is_empty(): void
    {
        $arguments = [''];

        $this->assertTrue(is_null(Argument::getBool($arguments, 0)));
    }

    public function stringProvider(): array
    {
        return [
          ['0', '0'],
          ['hi', 'hi'],
          ['', null],
        ];
    }

    public function intProvider(): array
    {
        return [
          ['0', 0],
          ['50', 50],
          ['100', 100],
          ['', null],
        ];
    }

    public function boolProvider(): array
    {
        return [
          ['true', true],
          ['false', false],
          ['', null],
        ];
    }

    public function percentageProvider(): array
    {
        return [
          ['0', 0],
          ['1.5', 1],
          ['50.50', 50],
          ['75', 75],
          ['100', 100],
          ['100.50', 100],
          ['50000', 100],
          ['', null],
        ];
    }
}
