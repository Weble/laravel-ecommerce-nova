<?php


namespace Weble\LaravelEcommerceNova\Field;

use CommerceGuys\Addressing\Formatter\DefaultFormatter;
use CommerceGuys\Addressing\Formatter\FormatterInterface;
use Laravel\Nova\Fields\Field;

class Address extends Field
{
    public $component = 'text-field';
    protected FormatterInterface $formatter;
    protected array $formatterOptions = [];

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this
            ->exceptOnForms()
            ->readonly()
            ->withMeta(['asHtml' => true])
            ->formatUsing(app()->make(DefaultFormatter::class))
            ->resolveUsing(function (\Weble\LaravelEcommerce\Address\Address $address) {
                return $this->formatter->format($address, $this->formatterOptions);
            });
    }

    public function formatUsing(FormatterInterface $formatter, array $options = []): self
    {
        $this->formatter = $formatter;
        $this->formatterOptions = $options;

        return $this;
    }
}
