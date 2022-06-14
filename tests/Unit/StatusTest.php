<?php

namespace App\Tests\Unit;

use App\Entity\Status;
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase
{
    public function testEmptyEntity(): void
    {
        $status = new Status();
        $rp = new \ReflectionProperty($status::class, 'name');

        $this->assertFalse($rp->isInitialized($status));
    }

    public function testGettersAndSetters(): void
    {
        $status = new Status();

        $name = 'title';

        $status->setName($name);

        $this->assertSame($name, $status->getName());
    }
}
