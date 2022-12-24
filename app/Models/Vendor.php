<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Vendor extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'company_name',
        'contact_person_name',
        'designation',
        'mobile',
        'email',
        'address',
        'website',
        'details',
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
