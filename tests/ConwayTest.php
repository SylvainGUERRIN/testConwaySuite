<?php


namespace App\Tests;


use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\TestCase;

class ConwayTest extends TestCase
{
    public function testShouldDrawNextLineOfConwaySuite(): void
    {
        $this->expectConwaySuite("1", "1\n1 1");
        $this->expectConwaySuite("2", "2\n1 2");
        $this->expectConwaySuite("2 2", "2 2\n2 2");
        $this->expectConwaySuite("2 1", "2 1\n1 2 1 1");
        $this->expectConwaySuite("2 1 3", "2 1 3\n1 2 1 1 1 3");
        $this->expectConwaySuite("2 1 1 1", "2 1 1 1\n1 2 3 1");
        $this->expectConwaySuite("2 1 1 1", "2 1 1 1\n1 2 3 1");
        //$conwaySuite = new ConwaySuite();
        //self::assertThat($conwaySuite->draw("1"), self::equalTo("1\n1 1"));
        //self::assertThat($conwaySuite->draw("2"), self::equalTo("2\n1 2"));
        //self::assertThat($conwaySuite->draw("2 2"), self::equalTo("2 2\n2 2"));
        //self::assertThat($conwaySuite->draw("2 1"), self::equalTo("2 1\n1 2 1 1"));
        //self::assertThat($conwaySuite->draw("2 1 3"), self::equalTo("2 1 3\n1 2 1 1 1 3"));
    }

    private function expectConwaySuite($line, $expectedLines): void
    {
        $conwaySuite = new ConwaySuite();
        self::assertThat($conwaySuite->draw($line), self::equalTo($expectedLines));
    }
}
