<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Posts extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'id',
        'user_id',
        'image',
        'slug',
        'title',
        'body',
        'status',
        'publish_date',
        'post_type',
        'kategori_id',
        'views'
    ];
    public function scopePage($query)
    {
        return $query->where('post_type','page');
    }
    public function scopeBlog($query)
    {
        return $query->where('post_type','blog');
    }
    function tags()
    {
        return $this->belongsToMany(Tags::class)->withTimestamps();
    }
    public function kategori(){
        return $this->belongsTo('App\Kategori','kategori_id');
    }
    public function author(){
        return $this->belongsTo('App\User','user_id');
    }
    public function getdateIndoAttribute()
    {
        return Carbon::parse($this->created_at)->isoFormat('dddd, D MMMM Y H:mm:s');
    }
    
}
