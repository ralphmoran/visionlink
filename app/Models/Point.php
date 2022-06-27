<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'x', 'y'];

    /**
     * Setup timestamps to not to used.
     *
     * @var boolean
     */
    public $timestamps = false;
}
