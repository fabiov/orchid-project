<?php

namespace App\Orchid\Screens;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CategoryEditScreen extends Screen
{
    public Category $category;

    public function createOrUpdate(Category $category, Request $request): RedirectResponse
    {
        $data = $request->get('category');

        $category->name = $data['name'];
        $category->user_id = $data['user'];
        $category->active = true;

        $category->save();

        Alert::info('You have successfully created a category.');

        return redirect()->route('platform.category.list');
    }

    public function description(): ?string
    {
        return 'User movement category';
    }

    public function query(Category $category): iterable
    {
        return [
            'category' => $category
        ];
    }

    public function name(): ?string
    {
        return $this->category->exists ? 'Edit category' : 'Creating a new category';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create category')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->category->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->category->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->category->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('category.name')
                    ->title('Name')
                    ->placeholder('Category name')
                    ->help('Specify a name.'),

                Relation::make('category.user')
                    ->title('User')
                    ->fromModel(User::class, 'name'),
            ])
        ];
    }

    public function remove(Category $category): RedirectResponse
    {
        $category->delete();

        Alert::info('You have successfully deleted the category.');

        return redirect()->route('platform.category.list');
    }
}
