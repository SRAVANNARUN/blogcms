<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use softDeletes;
   protected $fillable =([
        'product_name',
        'price',
        'image',
        'product_detail',
        'submenu_id',
        'slug'
   ]);

    // public function getImageAttribute($image){
    //     return asset($image);
    // }
    public function deleteImage(){
        Storage::delete($this->image);
    }
    // protected $dates=['deleted_at'];
    
    // public function getImageAtrribute(){
    //     $url = Storage::url($this->$image);
    //     return $url;
    // }
    public function submenu()
    {
        return $this->belongsTo('App\Submenu');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    //check if a post has tag
    public function hasTag($tagId){
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }
}
