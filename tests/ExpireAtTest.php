<?php

namespace Tests;

use Tests\TestCase;
use Carbon\Carbon;
use App\Helpers\TeHelper;

class YourModelTest extends TestCase
{
    public function testWillExpireAtWithin90Hours()
    {
        $dueTime = now()->addHours(89); // TODO: set a due time within 90 hours from now
        $createdAt = now();

        $result = TeHelper::willExpireAt($dueTime, $createdAt);

        $this->assertEquals($dueTime->format('Y-m-d H:i:s'), $result);
    }

    public function testWillExpireAtWithin24Hours()
    {
        $dueTime = now()->addHours(25); // TODO: set a due time more than 24 hours from now
        $createdAt = now();

        $result = TeHelper::willExpireAt($dueTime, $createdAt);

        $expectedTime = $createdAt->copy()->addMinutes(90);
        $this->assertEquals($expectedTime->format('Y-m-d H:i:s'), $result);
    }

    public function testWillExpireAtWithin72Hours()
    {
        $dueTime = now()->addHours(73); // TODO: set a due time more than 72 hours from now
        $createdAt = now();

        $result = TeHelper::willExpireAt($dueTime, $createdAt);

        $expectedTime = $createdAt->copy()->addHours(16);
        $this->assertEquals($expectedTime->format('Y-m-d H:i:s'), $result);
    }

    public function testWillExpireAtMoreThan72Hours()
    {
        $dueTime = now()->addHours(100); // TODO: set a due time more than 72 hours from now
        $createdAt = now();

        $result = TeHelper::willExpireAt($dueTime, $createdAt);

        $expectedTime = $dueTime->copy()->subHours(48);
        $this->assertEquals($expectedTime->format('Y-m-d H:i:s'), $result);
    }
}
