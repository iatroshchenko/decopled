<?php


namespace App\Auth\Test\Unit\Entity\User;

use App\Auth\Entity\User\Status;
use PHPUnit\Framework\TestCase;

/**
 * Class StatusTest
 * @package App\Auth\Test\Unit\Entity\User
 * @coversDefaultClass \App\Auth\Entity\User\Status
 */
class StatusTest extends TestCase
{
    /**
     * @covers ::active
     * @covers ::isActive
     */
    public function testActive()
    {
        $status = Status::active();
        $this->assertFalse($status->isWait());
        $this->assertTrue($status->isActive());
    }

    /**
     * @covers ::wait
     * @covers ::isWait
     */
    public function testWait()
    {
        $status = Status::wait();
        $this->assertTrue($status->isWait());
        $this->assertFalse($status->isActive());
    }

}