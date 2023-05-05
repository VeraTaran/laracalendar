<?php

namespace App\Models\Admin\V1\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'date',
    ];
    public function event(){
        return $this->belongsTo(\App\Models\Admin\V1\Pages\Event::class);
    }
}
