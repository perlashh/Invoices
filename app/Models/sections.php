<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\products;
class sections extends Model
{
   // use HasFactory;
 protected  $fillable = [
    'section_name',
    'description',
    'created_by'
 ];
 // protected  $guarded = [];
 public function product()
 {
     return $this->hasMany('App\Models\products');
 }

 public function invoice()
 {
     return $this->hasMany('App\Models\invoices');
 }


}
