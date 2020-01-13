<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public $timestamps = false;

    protected $casts = [
        'reported_at' => 'date:d-m-Y',
        'processed_at' => 'date:d-m-Y',
        'solved_at' => 'date:d-m-Y'
    ];


    protected $dates = [
        'reported_at',
        'processed_at',
        'solved_at'
    ];
}
