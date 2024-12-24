<?php

namespace App\Models;

class ProgramCall extends Base
{
    protected $table  = 'program_calls';

    protected $fillable = [
        'program',
        'title',
        'description',
        'status',
        'application'
    ];
}