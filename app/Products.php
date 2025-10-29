<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Products extends Model
{
    protected $table = "products";
    protected $fillable = [
        'id',
        'user_id',
        'kategori_id',
        'karya_id',
        'title',
        'slug',
        'description',
        'price',
        'diskon',
        'stock',
        'sku',
        'weight',
        'asuransi',
        'long',
        'width',
        'status',
        'kondisi',
        'kelipatan',
        'end_date',
    ];
    public function images(){
        return $this->hasMany('App\ProductImage','products_id');
    }

    public function imageUtama()
    {
        return $this->hasOne('App\ProductImage', 'products_id')->where('name', '=', 'img_utama');
    }
    public function imageDepan()
    {
        return $this->hasOne('App\ProductImage', 'products_id')->where('name', '=', 'img_depan');
    }
    public function imageSamping()
    {
        return $this->hasOne('App\ProductImage', 'products_id')->where('name', '=', 'img_samping');
    }
    public function imageAtas()
    {
        return $this->hasOne('App\ProductImage', 'products_id')->where('name', '=', 'img_atas');
    }
    
    public function getpriceStrAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, '', '.');
    }
    public function getkelipatanBidAttribute()
    {
        return 'Rp ' . number_format($this->kelipatan, 0, '', '.');
    }
    
    public function getendDateIndoAttribute()
    {
        return Carbon::parse($this->end_date)->isoFormat('dddd, D MMMM Y H:mm:s');
    }
    
    public function kategori(){
        return $this->belongsTo('App\Kategori','kategori_id');
    }
    public function karya(){
        return $this->belongsTo('App\Karya','karya_id');
    }
    public function getstatusTxtAttribute()
    {
        if ($this->status == '1') {
            return '<span class="badge bg-info text-white rounded-0">PUBLISHED</span>';
        } elseif ($this->status == '2') {
            return '<span class="badge bg-danger text-white rounded-0">SOLD OUT</span>';
        } elseif ($this->status == '3') {
            return '<span class="badge bg-success text-white rounded-0">LELANG EXPIRED</span>';
        } else{
            return '<span class="badge bg-warning text-white rounded-0">DRAFT</span>';
        }
    }
    public function bid()
    {
      return $this->hasMany(Bid::class);
    }
    function kelengkapans()
    {
        return $this->belongsToMany(Kelengkapan::class)->withTimestamps();
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    

}
