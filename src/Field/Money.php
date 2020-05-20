<?php


namespace Weble\LaravelEcommerceNova\Field;

use Money\Currency;
use Laravel\Nova\Fields\Number;
use Money\Currencies\ISOCurrencies;
use Money\Currencies\BitcoinCurrencies;
use Money\Currencies\AggregateCurrencies;
use Laravel\Nova\Http\Requests\NovaRequest;

class Money extends Number
{
    public $component = 'nova-money-field';

    public function __construct($name, $currency = 'USD', $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $units = currencyManager()->availableCurrencies()->subunitFor(
            currencyManager()->currency($currency),
        );

        $this->withMeta([
            'currency' => $currency,
            'subUnits' => $units,
        ]);

        $this->step(1 / $units);

        $this
            ->resolveUsing(function ($value) use ($currency) {
                return (string) $value;
            })
            ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) use ($currency) {
                $value = $request[$requestAttribute];
                $model->{$attribute} = $value;
            });
    }
}
