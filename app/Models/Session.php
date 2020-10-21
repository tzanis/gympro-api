<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'store_id', 'instructor_id'];

    protected $visible = ['id', 'name', 'description', 'instructor_id', 'instructor', 'weeklySchedule'];

    /**
     * Get the instructor record associated with the session.
     */
    public function instructor()
    {
        return $this->belongsTo('App\Models\Instructor');
    }

    /**
     * Get the instructor record associated with the session.
     */
    public function weeklySchedule()
    {
        return $this->hasMany('App\Models\WeeklySchedule');
    }
}
