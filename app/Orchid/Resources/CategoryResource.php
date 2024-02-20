<?php

declare(strict_types=1);

namespace App\Orchid\Resources;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class CategoryResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Category::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('name')
                ->title('Name')
                ->placeholder('Enter name here'),
            CheckBox::make('active')
                ->title('Active')
                ->sendTrueOrFalse(),
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
            TD::make('name'),
            TD::make('active')
                ->render(fn (Category $model) => $model->active ? 'Sì' : 'No'),
            TD::make('created_at', 'Date of creation')
                ->render(fn (Category $model) => $model->created_at->toDateTimeString()),
            TD::make('updated_at', 'Update date')
                ->render(fn (Category $model) => $model->updated_at->toDateTimeString()),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('id'),
            Sight::make('active'),
            Sight::make('name'),
        ];
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

    /**
     * Action to create and update the model
     *
     * @param ResourceRequest $request
     * @param Model $model
     */
    public function onSave(ResourceRequest $request, Category $model)
    {
        $model->user_id = Auth::getUser()->id;
        $model->name = $request->get('name');
        $model->active = (bool) $request->get('active');

        $model->save();
    }
}
