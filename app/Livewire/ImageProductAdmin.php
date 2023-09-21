<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ImageProductAdmin extends Component
{
    public $images = []; 
    public $openImg = false; 
            
 
    
    public function openModalImage()
    {
        $this->openImg = true;
        // $this->reset('images');

    }

    // Método para cerrar el modal
    public function closeModalImage()
    {
        $this->openImg = false;
        // $this->reset('images');
    }


    public function render()
    {
        return view('livewire.image-product-admin');
    }
}
