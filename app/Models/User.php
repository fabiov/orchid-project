<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Platform\Models\User as Authenticatable;

/**
 * @property array<Category> $categories
 * @property int $id
 */
class User extends Authenticatable
{
    /**
     * @var array<string>
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * @var array<string>
     */
    protected $hidden = ['password', 'remember_token', 'permissions'];

    /**
     * @var array<string, string>
     */
    protected $casts = ['permissions' => 'array', 'email_verified_at' => 'datetime'];

    /**
     * @var array<string, string>
     */
    protected $allowedFilters = [
           'id'         => Where::class,
           'name'       => Like::class,
           'email'      => Like::class,
           'updated_at' => WhereDateStartEnd::class,
           'created_at' => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array<string>
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
