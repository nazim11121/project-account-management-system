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
    	'date',
        'voucher_no',
		'income_head',
        'expense_head',
		'giver',
        'receiver',
        'amount',
        'total',
        'source',
        'project_name',
        'description',
        'payment_note',
        'attachment',
        'type',
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

    public function expense_heads()
    {
        return $this->belongsTo(ExpenseHead::class, 'expense_head','id');
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
