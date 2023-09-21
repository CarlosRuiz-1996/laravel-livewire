<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductForm;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Provider;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class GestionProduct extends Component
{
    use WithPagination;

    public ProductForm $form;
    public $productId;
    public $open = false;
    public $sort="";
    public $order="desc";

    public function openModal()
    {
        $this->resetValidation();
        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
    }

    #[On('show-productos')]
    public function render()
    {
        $brands = Brand::all();
        $provider = Provider::all();
        return view('livewire.gestion-product', [
            'products' => $this->form->read(),
            'providers' => $provider,
            'brands' => $brands
        ]);
    }

    public function save()
    {
        $this->form->store();
        $this->dispatch('show-productos');
        $this->closeModal();
    }

    public function edit(Product $product){
        $this->form->setProduct($product);
        $this->productId = $product->id;
        $this->openModal();
    }


    public function update(){
        $this->form->update();
        $this->dispatch('show-productos');
        $this->reset('productId');

        $this->closeModal();
    }


    public function delete(Product $product){
        $this->form->setProduct($product);
        $this->form->delete();
        $this->dispatch('show-productos');

    }

}
