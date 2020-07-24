<?php


namespace App\Tests;


use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\TestCase;

class ConwayTest extends TestCase
{
    public function testShouldDrawNextLineOfConwaySuite(): void
    {


        $conwaySuite = new ConwaySuite();
        self::assertThat($conwaySuite->draw("1"), self::equalTo("1\n1 1"));
        self::assertThat($conwaySuite->draw("2"), self::equalTo("2\n1 2"));
        self::assertThat($conwaySuite->draw("2 2"), self::equalTo("2 2\n2 2"));
        self::assertThat($conwaySuite->draw("2 1"), self::equalTo("2 1\n1 2 1 1"));
    }
}
