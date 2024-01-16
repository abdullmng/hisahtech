<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'item_type',
        'invoice_number',
        'description',
        'amount',
        'status',
        'paid_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'paid_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        if ($this->item_type == 'device') {
            return $this->belongsTo(Device::class, 'item_id');
        }
        else
        {
            return $this->belongsTo(RepairRequest::class,'item_id');
        }
    }
}
