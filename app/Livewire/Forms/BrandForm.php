<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use App\Models\Brand;
use Livewire\Form;

class BrandForm extends Form
{
    public ?Brand $brand;

    public $search = "";

    public $name;
    public $description;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',

    ];

    public function setBrand(Brand $brand)
    {
        $this->brand = $brand;
        $this->name = $brand->name;
        $this->description = $brand->description;
    }

    public function read($sort, $orderBy, $list)
    {
        return Brand::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%');
                
        })

            ->orderBy($sort, $orderBy)
            ->paginate($list);
    }


    public function store()
    {

        $this->validate();
        Brand::create($this->only(['name', 'description']));
        $this->reset();
    }


    public function update()
    {
        $this->validate();
        $this->brand->update($this->all());
        $this->reset();
    }


    public function delete()
    {
        $this->brand->delete();
        $this->reset();
    }
}
