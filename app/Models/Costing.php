<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Costing extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'attachment',
        'payment_note',
        'vendor_name',
        'product_name',
        'price',
        'quantity',
        'subtotal',
        'grand_total',
        'paid_amount',
        'due',
        'created_by',
        'updated_by',
    ];

    public function vendor_names()
    {
        return $this->belongsTo(Vendor::class, 'vendor_name','id');
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
