<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Profit extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
    	'income_date',
		'income_head',
		'giver',
		'voucher_no',
        'amount',
        'source',
        'attachment',
        'payment_note',
        'description',
        'created_by',
        'updated_by',
    ];

    public function sources()
    {
        return $this->belongsTo(BankCash::class, 'source','id');
    }

    public function income_heads()
    {
        return $this->belongsTo(IncomeHead::class, 'income_head','id');
    }

    public static function boot(){
        
        parent::boot();
        static::creating(function($model)
        {
            $user = Auth::user();           
            $model->created_by = $user->id;
            $model->updated_by = $user->id;
        });
        static::updating(function($model)
        {
            $user = Auth::user();
            $model->updated_by = $user->id;
        });       
    }
}
