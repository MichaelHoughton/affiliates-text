<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\DataSource\Affiliate;

class AffiliateTest extends TestCase
{
    /**
     * Formats the json and returns the data as an array
     *
     * @return void
     */
    public function testGet()
    {
        $affiliates = Affiliate::get();

        $this->assertCount(32, $affiliates);

        // lets check it sorts by ID
        $this->assertEquals(1, $affiliates->first()->affiliate_id);
    }

    /**
     * Runs some tests to filter the data by the location to the office
     *
     * @return void
     */
    public function testGetWithinDistance()
    {
    	$affiliates = Affiliate::getWithinDistance(100);
    	$this->assertCount(16, $affiliates);

    	$affiliates = Affiliate::getWithinDistance(50);
    	$this->assertCount(8, $affiliates);
    }
}
