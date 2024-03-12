<?php

declare(strict_types=1);

namespace App\Orchid\Resources;

use App\Models\Account;
use App\Models\Provision;
use Illuminate\Support\Facades\Auth;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class ProvisionResource extends Resource
{
    public static $model = Provision::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array<Field>
     */
    public function fields(): array
    {
        return [
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
        ];
    }

    /**
     * @return array<TD>
     */
    public function columns(): array
    {
        return [
            TD::make('id'),
            TD::make('date'),
            TD::make('amount'),
            TD::make('description'),
            TD::make('created_at', 'Date of creation')
                ->render(fn ($model) =>  $model->created_at->toDateTimeString()),
            TD::make('updated_at', 'Update date')
                ->render(fn ($model) => $model->updated_at->toDateTimeString()),
        ];
    }

    /**
     * @return array<Sight>
     */
    public function legend(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [];
    }

    public function onSave(ResourceRequest $request, Provision $model): void
    {
        $model->user_id = Auth::getUser()->id;
        $model->description = $request->get('description');
        $model->amount = $request->get('amount');
        $model->date = $request->get('date');

        $model->save();
    }
}
