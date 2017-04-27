<?php

namespace Bench\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        //set up the routes
        //in a real setup there might be some changes to this
        \Route::group([
            'prefix' => 'api',
            'as' => 'api.'
            ], function () {
                \Route::resource('user', \Bench\Tests\Controllers\UserController::class);
        });
    }
}
