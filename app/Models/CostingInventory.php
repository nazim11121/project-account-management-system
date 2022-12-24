<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class CostingInventory extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
    	'costing_id',
        'invoice_no',
        'product_name',
        'price',
        'quantity',
        'subtotal',
        'created_by',
        'updated_by',
    ];

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