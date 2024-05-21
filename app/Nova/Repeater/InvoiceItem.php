<?php

namespace App\Nova\Repeater;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Repeater\Repeatable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class InvoiceItem extends Repeatable
{

    public static $model = \App\Models\InvoiceItem::class;
    private string $invoice_id;
    /**


	 * Get the fields displayed by the repeatable.
	 *
	 * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
	 * @return array
	 */
	public function fields(NovaRequest $request)
	{
		return [
            Text::make('Invoice id')->hideFromIndex(function (NovaRequest $request, $resource) {
                return $this->invoice_id === $resource->id;
            }),
			Number::make('Quantity')->rules('required', 'numeric'),
			Textarea::make('Description')->rules('required', 'max:255'),
			Currency::make('Price')->rules('required', 'numeric'),
		];
	}
}
