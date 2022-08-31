<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\LendingStatus;
use Carbon\Carbon;

class Lending extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'lender_id', 'amount_number', 'amount_word', 'client_id', 'dues_current', 'dues_quantity', 'dues_amount', 'status'];


    protected $casts = [
        'status' => LendingStatus::class,
        'date' => 'date:Y-m-d'
    ];
    public function lender()
    {
        return $this->belongsTo(User::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function must(): float
    {
        return $this->amount_number - $this->dues_amount * ($this->dues_current - 1);
    }
    public function nextPayment()
    {
        return Carbon::parse($this->date)->addMonth($this->dues_current)->format('d-m-Y');
    }
}
