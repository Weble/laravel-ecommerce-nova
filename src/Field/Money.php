<?php


namespace Weble\LaravelEcommerceNova\Field;

use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class Money extends Number
{
    public $component = 'nova-laravel-ecommerce-money-field';

    protected string $currency;

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->defaultCurrency();
    }

    public function userCurrency(): self
    {
        $this->withCurrency(config('ecommerce.currency.user', 'USD'));

        return $this;
    }

    public function defaultCurrency(): self
    {
        $this->withCurrency(config('ecommerce.currency.default', 'USD'));

        return $this;
    }

    public function withCurrency(string $currency): self
    {
        $units = currencyManager()->availableCurrencies()->subunitFor(
            currencyManager()->currency($currency)
        );

        $this->withMeta([
            'currency' => $currency,
            'subUnits' => $units,
        ]);

        $this->step( 1 / pow(10, $units));

        $this
            ->displayUsing(function(\Cknow\Money\Money $value) {
                return (string) $value;
            })
            ->resolveUsing(function (\Cknow\Money\Money $value) {
                return $value->getAmount() /  pow(10, $this->meta()['subUnits']);
            })
            ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                $value = $request[$requestAttribute];
                $value *= pow(10, $this->meta()['subUnits']);
                $model->{$attribute} = new \Cknow\Money\Money($value, currencyManager()->currency($this->meta()['currency']));
            });

        return $this;
    }
}
