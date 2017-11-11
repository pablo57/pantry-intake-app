<?php
declare(strict_types=1);

namespace pantry\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public $timestamps = false;
    public $table = 'Member';
    public $primaryKey = "Id";
}
