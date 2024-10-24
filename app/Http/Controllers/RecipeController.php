<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\HomepageProduct;
use App\Models\Gallery;
use App\Models\Media;
use App\Models\BakingInstruction;
use App\Models\Faq;
use App\Models\LandingPage;
use App\Models\Page;
use App\Models\Subscribe;
use App\Models\CareerJob;
use App\Models\MenuCategory;
use App\Models\Store;
use App\Models\CareerRequest;
use App\Models\StoreTiming;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    
    
    public function instructions()
    {
        $instructions         = BakingInstruction::get();
        return view('frontend.baking-instruction',compact('instructions'));
    }
    
    public function instruction_single($single)
    {
        $instruction   = BakingInstruction::where('slug',$single)->firstOrfail();
        $instructions         = BakingInstruction::Limit(5)->get();
        $title = 'Sweetiepie-'.$instruction->name;
        $description = Str::limit(strip_tags($instruction->description), 160); 
        return view('frontend.single-baking-instruction',compact('instructions','instruction','title','description'));
    }
    
}
