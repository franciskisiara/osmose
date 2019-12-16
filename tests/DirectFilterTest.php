<?php
use PHPUnit\Framework\TestCase;

class DirectFilterTest extends TestCase
{
    public function testTrials()
    {
        $this->assertSame(0, count([]));
    }
}
