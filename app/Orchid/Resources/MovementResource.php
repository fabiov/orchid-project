<?php

declare(strict_types=1);

namespace App\Orchid\Resources;

use App\Models\Account;
use App\Models\Category;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;

class MovementResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Movement::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Relation::make('account_id')
                ->fromModel(Account::class, 'name')
                ->required()
                ->title('Account'),
            DateTimer::make('date')
                ->format('Y-m-d')
                ->required()
                ->title('Date'),
            Input::make('amount')
                ->inlineAttributes(['step' => '0.01'])
                ->required()
                ->type('number')
                ->title('Amount'),
            Input::make('description')
                ->required()
                ->title('Description'),
            Select::make('category_id')
                ->empty('No select')
                ->fromModel(Category::class, 'name')
                ->title('Category'),
            
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id'),

            TD::make('created_at', 'Date of creation')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),

            TD::make('updated_at', 'Update date')
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }
}
