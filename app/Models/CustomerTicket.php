<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CustomerTicket extends Model
{
    use HasFactory;

    protected $table = 'customer_ticket';


    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
