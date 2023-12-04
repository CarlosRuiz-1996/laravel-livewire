<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    
  
    public function render()
    {
        $categories = Category::all();
        $products= Product::all();
        return view('livewire.cart', compact('categories','products'));
    }


  
}
