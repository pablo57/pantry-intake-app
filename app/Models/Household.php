<?php
declare(strict_types=1);

namespace pantry\Models;

use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    public $timestamps = false;
    public $table = 'Household';
    public $primaryKey = "Id";
}