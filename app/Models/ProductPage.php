<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProductPage extends Model
{
    protected $fillable = ['title', 'slug', 'seo_title', 'seo_description', 'published', 'seo_keyword', 'category_id', 'company_id', 'h1', 'keyword', 'parent_id'];
    
    public function contents(){
        return $this->hasMany(ProductPageContent::class, 'page_id', 'id');
    }
    
    
    public function childs(){
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
    
    public function parent(){
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
    
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'master_id');
    }
    
    public function categories() {
        return $this->belongsToMany('App\Models\Category', 'product_page_categories', 'page_id', 'category_id');
    }
}