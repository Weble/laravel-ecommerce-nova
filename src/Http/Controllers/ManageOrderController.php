<?php

namespace Weble\LaravelEcommerceNova\Http\Controllers;

use Weble\LaravelEcommerce\Order\Order;
use Illuminate\Routing\Controller;

class ManageOrderController extends Controller
{
    public function __invoke($order, string $transition)
    {
        $class = config('ecommerce.classes.orderModel', Order::class);
        $order = $class::findOrFail($order);

        try {
            $order->stateMachine()->apply($transition);
            $order->save();
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }
}
