<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'unit_id', 'quantity'];

    protected $casts = [
        'quantity' => 'decimal:2',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(InventoryTransaction::class)->orderBy('created_at', 'desc');
    }

    public function canDeduct(float $amount): bool
    {
        return $this->quantity >= $amount;
    }

    public function addStock(float $amount): void
    {
        $this->increment('quantity', $amount);
        
        InventoryTransaction::create([
            'item_id' => $this->id,
            'type' => 'add',
            'quantity' => $amount,
        ]);
    }

    public function deductStock(float $amount): bool
    {
        if (!$this->canDeduct($amount)) {
            return false;
        }

        $this->decrement('quantity', $amount);
        
        InventoryTransaction::create([
            'item_id' => $this->id,
            'type' => 'deduct',
            'quantity' => $amount,
        ]);

        return true;
    }
}