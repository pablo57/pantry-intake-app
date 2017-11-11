<?php
declare(strict_types=1);

namespace pantry\Models;

use Illuminate\Database\Eloquent\Model;

class MemberSearch extends Model
{
    public $timestamps = false;
    public $table = 'MemberSearch';
    public $primaryKey = "Id";
}
