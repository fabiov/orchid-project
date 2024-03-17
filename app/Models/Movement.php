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
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property Carbon $date
 * @property float $amount
 * @property int $id
 * @property string $description
 */
class Movement extends Model
{
    use AsSource, Attachable, Filterable, HasFactory;
}
