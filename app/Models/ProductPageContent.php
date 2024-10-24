<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProductPageContent extends Model
{
    protected $appends = ['products'];
    protected $fillable = ['contents', 'type', 'position', 'page_id'];
    
    protected $casts = [
        'contents' => 'object',
    ];
    
    public function page(){
        return $this->belongsTo(ProductPage::class);
    }
    
    public function getContentAttribute(){
        return json_decode(json_encode([
            'description' => $this->contents->description ?? null,
            'products_title' => $this->contents->products_title ?? null,
            'products_type' => $this->contents->products_type ?? 'all',
            'products' => $this->contents->products ?? [],
            'banners' => $this->contents->banners ?? [],
            'cards' => $this->contents->cards ?? [],
            'info' => $this->contents->info ?? null,
        ]));
    }
    
    public function getCategoryAttribute(){
        return Category::whereMasterId($this->products_type)->first();
    }

    
    public function getProductsAttribute(){
        if($this->page->category){
            return $this->page->category->products;
        }
        
        else if($this->content->products_type == 'all'){
            return Product::all();
        }
        elseif($this->content->products_type != 'custom'){
            return Product::whereHas('categories', fn($q) => $q->where('categories.master_id', $this->content->products_type))->get();
        }
        else{
            return Product::whereIn('master_id', $this->products)->get();
        }
        return [];
    }
    
}