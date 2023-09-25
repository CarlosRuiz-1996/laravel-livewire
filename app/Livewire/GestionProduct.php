<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductForm;
use App\Models\Brand;
use App\Models\Category;
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
    public $sort = "id";
    public $orderBy = "desc";
    public $entrada = array('5', '10', '15', '20', '50', '100');
    public $list = '10';
    public $readyToLoad = false;

    //para limpiar la url de los filtros cuando regresen a su valor inicial
    // y esto hace que me muestre en la url el filtro que se ha aplicado
    protected $queryString = [
        'list' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'orderBy' => ['except' => 'desc'],
        'form.search' => ['except' => ''],
    ];

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

        if ($this->readyToLoad) {
            $brands = Brand::all();
            $provider = Provider::all();
            $categories = Category::all();

            $products = $this->form->read($this->sort, $this->orderBy, $this->list);
        } else {
            $brands = [];
            $provider = [];
            $products = [];
            $categories = [];
        }

        return view('livewire.gestion-product', [
            'products' => $products,
            'providers' => $provider,
            'brands' => $brands,
            'categories'=> $categories
        ]);
    }

    public function save()
    {
        
        $this->form->store();
        $this->dispatch('show-productos');
        $this->closeModal();
    }

    public function edit(Product $product)
    {
        $this->form->setProduct($product);
        $this->productId = $product->id;
        $this->openModal();
    }


    public function update()
    {
        $this->form->update();
        $this->dispatch('show-productos');
        $this->reset('productId');

        $this->closeModal();
    }


    public function delete(Product $product)
    {
        $this->form->setProduct($product);
        $this->form->delete();
        $this->dispatch('show-productos');
    }


    //ordenar los filtros de las columnas
    public function order($sort)
    {

        if ($this->sort == $sort) {
            if ($this->orderBy == 'desc') {
                $this->orderBy = 'asc';
            } else {
                $this->orderBy = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->orderBy = 'desc';
        }
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }

    //renderisa la tabla una ves que carga la pagina
    public function loadProducts()
    {
        $this->readyToLoad = true;
    }
}
