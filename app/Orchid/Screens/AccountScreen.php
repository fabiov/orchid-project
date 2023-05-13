<?php

namespace App\Orchid\Screens;

use App\Models\Account;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class AccountScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'accounts' => Account::latest()->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Account';
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Account';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Add Account')
                ->modal('accountModal')
                ->method('create')
                ->icon('plus'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('accounts', [
                TD::make('name'),

                TD::make('Actions')
                    ->alignRight()
                    ->render(function (Account $account) {
                        return Button::make('Delete Account')
                            ->confirm('After deleting, the account will be gone forever.')
                            ->method('delete', ['account' => $account->id]);
                    }),
            ]),

            Layout::modal('accountModal', Layout::rows([
                Input::make('account.name')
                    ->title('Name')
                    ->placeholder('Enter task name')
                    ->help('The name of the account to be created.'),
            ]))
                ->title('Create account')
                ->applyButton('Add account'),
        ];
    }

    public function create(Request $request)
    {
        // Validate form data, save task to database, etc.
        $request->validate([
            'account.name' => 'required|max:255',
        ]);

        $account = new Account();
        $account->name = $request->input('account.name');
        $account->save();
    }

    public function delete(Account $account): void
    {
        $account->delete();
    }
}
