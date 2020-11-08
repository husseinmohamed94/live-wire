<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\User;
class Post extends Model
{
   protected $guarded = [];

   public function user(){
       return $this->belongsTo(User::class,'user_id','id');
   }
   public function Category(){
    return $this->belongsTo(Category::class,'category_id','id');
}
}
