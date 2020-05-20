<?php

namespace Weble\LaravelEcommerceNova\Tests;

use Weble\LaravelEcommerceNova\Http\Controllers\ToolController;
use Weble\LaravelEcommerceNova\LaravelEcommerceNova;
use Symfony\Component\HttpFoundation\Response;

class ToolControllerTest extends TestCase
{
    /** @test */
    public function it_can_can_return_a_response()
    {
        $this
            ->get('nova-vendor/weble/laravel-ecommerce-nova/endpoint')
            ->assertSuccessful();
    }
}
