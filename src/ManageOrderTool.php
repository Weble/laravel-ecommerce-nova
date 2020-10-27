<?php

namespace Weble\LaravelEcommerceNova;

use Illuminate\Support\Str;
use Laravel\Nova\ResourceTool;
use Weble\LaravelEcommerce\LaravelEcommerceServiceProvider;
use Weble\LaravelEcommerce\Order\Order;

class ManageOrderTool extends ResourceTool
{
    private $hide = false;

    /**
     * @var Order
     */
    protected Order $order;

    public function __construct(Order $order)
    {
        parent::__construct();

        // Be 100% sure we loaded the deferred provider, so we have a state machine to work with
        app()->registerDeferredProvider(LaravelEcommerceServiceProvider::class);

        $this->order = $order;

        $this->withMeta([
            'transitions' => $this->order->possibleTransitions( )->mapWithKeys(function($transition) {
                $metadata = $this->order->stateMachine()->metadata()->transition($transition);
                $metadata['title'] ??= Str::title($transition);
                $metadata['title'] = __($metadata['title']);

                return [$transition => $metadata];
            })
        ]);
    }

    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Manage Order';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'workflow';
    }

    /**
     * Prepare the panel for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge([
            'component'    => 'panel',
            'name'         => $this->name,
            'showToolbar'  => $this->showToolbar,
            'transactions' => $this->meta()
        ], $this->element->meta());
    }
}
