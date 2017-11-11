<?php
declare(strict_types=1);

namespace pantry\Models;

use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{
    public $timestamps = false;
    public $table = 'Intake';
    public $primaryKey = "Id";
}
