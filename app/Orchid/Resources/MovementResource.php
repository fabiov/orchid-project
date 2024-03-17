<?php

declare(strict_types=1);

namespace App\Orchid\Resources;

use App\Models\Account;
use App\Models\Category;
use App\Models\Movement;
use App\Orchid\Filters\DescriptionFilter;
use App\Orchid\Filters\UserFilter;
use Illuminate\Contracts\Container\BindingResolutionException;
use Orchid\Crud\Filters\DefaultSorted;
use Orchid\Crud\Resource;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class MovementResource extends Resource
{
    public static $model = Movement::class;

    /**
     * @return array<Field>
     * @throws BindingResolutionException
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
                ->required()
                ->step(0.01)
                ->title('Amount')
                ->type('number'),
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
     * @return array<TD>
     */
    public function columns(): array
    {
        return [
            TD::make('date')->render(fn (Movement $movement) => $movement->date),
            TD::make('amount')->align(TD::ALIGN_RIGHT),
            TD::make('description')->width(550),
            TD::make('account', 'Account')->render(fn (Movement $movement) => $movement->account->name),
            TD::make('category', 'Category')->render(fn (Movement $movement) => $movement->category?->name),
        ];
    }

    /**
     * @return array<Sight>
     */
    public function legend(): array
    {
        return [
            Sight::make('id'),
            Sight::make('date')->render(fn (Movement $movement) => $movement->date),
            Sight::make('amount'),
            Sight::make('description'),
            Sight::make('created_at', 'Date of creation')
                ->render(fn (Movement $model) => $model->created_at?->toDateTimeString()),
            Sight::make('updated_at', 'Update date')
                ->render(fn (Movement $model) => $model->updated_at?->toDateTimeString()),
        ];
    }

    /**
     * @return array<Filter>
     */
    public function filters(): array
    {
        return [
            new DefaultSorted('date', 'desc'),
            new UserFilter(),
        ];
    }
}
