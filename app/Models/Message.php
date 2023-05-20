<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_is_admin',
        'complain_id',
        'related_to_id',
        'body',
        'send_status',
        'recieve_status',
        'seen_status',
        'is_updated_to_seen_on_sender',
     ];
}
