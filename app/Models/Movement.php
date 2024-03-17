<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property ?Category $category
 * @property Account $account
 * @property Carbon $date
 * @property float $amount
 * @property int $id
 * @property string $description
 */
class Movement extends Model
{
    use AsSource, Attachable, Filterable, HasFactory;

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
