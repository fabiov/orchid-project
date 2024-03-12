<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property Carbon $date
 * @property float $amount
 * @property int $user_id
 * @property string $description
 */
class Provision extends Model
{
    use AsSource, Attachable, Filterable, HasFactory;
}
