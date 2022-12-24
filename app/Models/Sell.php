<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'project_name',
        'employee_name',
        'sell_amount',
        'sell_date',
    ];

    public function customer_names()
    {
    	return $this->belongsTo(Client::class, 'customer_name','id');
    } 

    public function project_names()
    {
    	return $this->belongsTo(Inventory::class, 'project_name','id');
    }

    public function employee_names()
    {
    	return $this->belongsTo(Employee::class, 'employee_name','id');
    }
}
