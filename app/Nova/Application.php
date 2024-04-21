<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Application extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Booking>
     */
    public static $model = \App\Models\Booking::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')
                ->sortable()
                ->onlyOnIndex()
                ->displayUsing(function ($value) {
                    return substr($value, 0, 35) . '...';
                }),

            Text::make('Name')
                ->rules('required', 'string')
                ->hideFromIndex(),

            Text::make('Description')
                ->sortable()
                ->onlyOnIndex()
                ->displayUsing(function ($value) {
                    return substr($value, 0, 35) . '...';
                }),

            Text::make('Description')
                ->rules('required', 'string')
                ->hideFromIndex(),

            Date::make('Start Date')
                ->sortable()
                ->rules('string'),

            Date::make('End Date')
                ->sortable()
                ->hideFromIndex()
                ->rules('string'),

            // DateTime::make('Start Time'),
            // DateTime::make('End Time'),

            Text::make('Starts At')->resolveUsing(function ($date) {
                $timestamp = new \DateTime($date);
                return $timestamp->format('H:i');
            })->hideFromIndex()->rules('date_format:"H:i"')->withMeta(['extraAttributes' => ['type' => 'time']]),

            Text::make('Ends At')->resolveUsing(function ($date) {
                $timestamp = new \DateTime($date);
                return $timestamp->format('H:i');
            })->hideFromIndex()->rules('date_format:"H:i"')->withMeta(['extraAttributes' => ['type' => 'time']]),

            Badge::make('Status')->map([
                'rejected' => 'danger',
                'pending' => 'info',
                'invoice' => 'warning',
                'approved' => 'success',
            ]),

            // Select::make('Status')->options([
            //     'Rejected' => 'rejected',
            //     'Pending' => 'pending',
            //     'Invoice' => 'invoice',
            //     'Approved' => 'approved',
            // ])->displayUsingLabels()->hideFromIndex(),
            // Text::make('status')
            //     ->sortable()
            //     ->hideFromIndex()
            //     ->rules('required', 'string'),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
