<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use HasFactory;
    use Notifiable;
    protected $table = 'transactions';

    /**
     * @return HasMany
     */
    public function transactionProduct(): HasMany
    {
        return $this->hasMany(TransactionProduct::class, 'trans_no', 'trans_no');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'open_id', 'open_id');
    }
}
