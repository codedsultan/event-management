<?php

namespace App\Nova\Actions;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Repeater\LineItem;
// use R64\NovaFields\JSON;
use Stepanenko3\NovaJson\Fields\JsonArray;
use Stepanenko3\NovaJson\Fields\JsonRepeatable;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Currency;

class CreateApplicationInvoice extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        // dd($fields);
        foreach ($models as $model) {
            $invoice = new Invoice();

            $invoice->total_amount = $fields->total_amount;
            $invoice->booking_id = $model->id;
            $invoice->vendor_id = $model->vendor->id;
            $invoice->save();
            $invoice->items()->saveMany($fields->invoice_items, true);
            $model->status = 'invoice';
            $model->save();
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {

        return [
            // Number::make('Total Amount'),
            // Number::make('Total Amount'),


            // JSON::make('Content', [
            //     Text::make('Name'),
            //     Number::make('Total Amount'),
            // ], 'content_json'),

            // ID::make(),
			// Repeater::make('Line Items')
			// 	->repeatables([
			// 		LineItem::make(),
			// 	]),
            JsonRepeatable::make('Invoice Items')
            ->fullWidth()
            ->rules([
                // 'required',
                'array',
                'between:1,10',
            ])
            ->fields([
                // Country::make('Country', 'country')
                //     ->fullWidth()
                //     ->rules([
                //         'required',
                //     ]),
                Number::make('Quantity')->rules('required', 'numeric'),
			    Textarea::make('Description')->rules('required', 'max:255'),
			    Currency::make('Price')->rules('required', 'numeric'),

                // JsonArray::make('Item', 'item')
                //     ->fullWidth()
                //     ->rules([
                //         'required',
                //         'array',
                //         'between:1,10',
                //     ])
                //     ->field(
                //         field: Text::make('Name', 'value')
                //             ->fullWidth()
                //             ->rules([
                //                 'required',
                //             ]),
                //     ),
            ]),

        ];
    }
}
