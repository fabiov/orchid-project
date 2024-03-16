<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property ?Carbon $updated_at
 * @property Carbon $created_at
 * @property int $user_id
 * @property string $name
 */
class Account extends Model
{
    use AsSource, Attachable, Filterable, HasFactory;
}
