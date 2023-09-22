<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Form;

class ProductForm extends Form
{
    public ?Product $product;

    public $search = "";

    public $name;
    public $description;
    public $price;
    public $stock;
    public $brand_id;
    public $provider_id;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'stock' => 'required',
        'brand_id' => 'required',
        'provider_id' => 'required',

    ];

    public function setProduct(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->brand_id = $product->brand_id;
        $this->provider_id = $product->provider_id;
    }

    public function read($sort, $orderBy, $list)
    {
        return Product::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhere('price', 'like', '%' . $this->search . '%')
                ->orWhere('stock', 'like', '%' . $this->search . '%');
        })
            ->orWhereHas('brand', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('provider', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($sort, $orderBy)
            ->paginate($list);
    }


    public function store()
    {

        $this->validate();
        Product::create($this->only(['name', 'description', 'price', 'stock', 'brand_id', 'provider_id']));
        $this->reset();
    }


    public function update()
    {
        $this->validate();
        $this->product->update($this->all());
        $this->reset();

    }


    public function delete()
    {
        $this->product->delete();
        $this->reset();

    }
}
