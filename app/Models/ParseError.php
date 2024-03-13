<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParseError extends Model
{
    protected $table = 'parse_errors';

    protected $fillable = [
        'link',
        'error',
        'count',
    ];


}
