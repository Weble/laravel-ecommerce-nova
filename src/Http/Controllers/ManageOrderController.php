<?php

namespace Weble\LaravelEcommerceNova\Http\Controllers;

use Weble\LaravelEcommerce\Order\Order;
use Illuminate\Routing\Controller;

class ManageOrderController extends Controller
{
    public function __invoke(Order $order, string $transition)
    {
        try {
            $order->stateMachine()->apply($transition);
            $order->save();
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }
}
