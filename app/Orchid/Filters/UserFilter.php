<?php

namespace App\Orchid\Filters;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;

class UserFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return '';
    }

    /**
     * @return array<string>|null
     */
    public function parameters(): ?array
    {
        return [];
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        /** @var User $user */
        $user = Auth::user();

        return $builder
            ->join('accounts', 'movements.account_id', '=', 'accounts.id')
            ->where('accounts.user_id', $user->id);

    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [];
    }
}
