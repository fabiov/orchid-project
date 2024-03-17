<?php

declare(strict_types=1);

namespace App\Orchid\Resources;

use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class AccountResource extends Resource
{
    /**
     * @var string
     */
    public static $model = Account::class;

    /**
     * @return array<Field>
     */
    public function fields(): array
    {
        return [
            Input::make('name')
                ->title('Name')
                ->placeholder('Enter name here'),
            Select::make('status')
                ->title('Status')
                ->options(['closed' => 'Closed', 'open' => 'Open', 'highlight' => 'Highlight']),
        ];
    }

    /**
     * @return array<TD>
     */
    public function columns(): array
    {
        return [
            TD::make('id'),
            TD::make('name'),
            TD::make('status'),
            TD::make('created_at', 'Date of creation')
                ->render(fn (Account $model) => $model->created_at->toDateTimeString()),
            TD::make('updated_at', 'Update date')
                ->render(fn (Account $model) => $model->updated_at?->toDateTimeString()),
        ];
    }

    /**
     * @return array<Sight>
     */
    public function legend(): array
    {
        return [
            Sight::make('id'),
            Sight::make('name'),
            Sight::make('status'),
        ];
    }

    /**
     * @return array<Filter>
     */
    public function filters(): array
    {
        return [];
    }

    public function onSave(ResourceRequest $request, Account $model): void
    {
        /** @var User $user */
        $user = Auth::getUser();

        $model->user_id = $user->id;
        $model->name = $request->get('name');
        $model->status = $request->get('status');

        $model->save();
    }
}
