<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

/**
 * @property bool $active
 * @property int $user_id
 * @property string $name
 */
class Category extends Model
{
    use AsSource, HasFactory;
}
