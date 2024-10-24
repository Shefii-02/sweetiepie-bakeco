<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\{Category,ProductPage,ProductPageCategory};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Collection;

class PageBuilderController extends Controller
{
    
    public function index($page_slug,$category,$city){
   
  
        // 
        // $category_items = Category::where('slug',$category)->first();
     
        $page   =   ProductPage::with('contents','categories','categories.product_list')
                                ->where('slug',$page_slug)
                                ->where('keyword_slug',$city);
      
                 
        if($category != 'all'){
            $page   =   $page->where('category_slug',$category);
        }
              
        $page = $page->first();
        
        if(!$page && $category != 'all'){
          
             return redirect(route('category',$category));
        }
        elseif(!$page && $category == 'all'){
             return redirect(route('category-list'));
        }
  
        $allCategories = Category::where('status',1)->get();
        
        $products = Product::where('status',1)->get();
        
        $related_page_links = ProductPage::where('slug',$page_slug)->get();
        
        $title      = $page->seo_title != null ? $page->seo_title : $page->title;
        $keywords   = $page->seo_keywords;
        $description=$page->seo_description;

        return view('frontend.product_page',compact('category','city','allCategories','products','page','page_slug','title','keywords','description','related_page_links'));
    }
    
}