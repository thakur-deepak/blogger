<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function setUp() : void
    {
        parent::setUp();
    }

    public function tearDown() : void
    {
        $this->artisan('migrate:reset');
        parent::tearDown();
    }
}
