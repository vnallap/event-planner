<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'registrations';

    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'user_name',
        'user_email',
        'event_title',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
