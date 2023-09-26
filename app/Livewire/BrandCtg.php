<?php

namespace App\Livewire;

use App\Livewire\Forms\BrandForm;
use App\Models\Brand;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class BrandCtg extends Component
{
    use WithPagination;

    public BrandForm $form;
    public $brandId;
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

    #[On('show-marcas')]
    public function render()
    {

        if ($this->readyToLoad) {
          

            $brands = $this->form->read($this->sort, $this->orderBy, $this->list);
        } else {
            $brands = [];
         
        }

        return view('livewire.brand-ctg', [
          
            'brands' => $brands,
        ]);
    }

    public function save()
    {
        
        $this->form->store();
        $this->dispatch('show-marcas');
        $this->dispatch('alert-marcas', 'Marca creada con exito!');

        $this->closeModal();
    }

    public function edit(Brand $brand)
    {
        $this->form->setBrand($brand);
        $this->brandId = $brand->id;
        $this->openModal();
    }


    public function update()
    {
        $this->form->update();
        $this->dispatch('show-marcas');
        $this->reset('brandId');
        $this->dispatch('alert-marcas', 'Marca actualizada con exito!');

        $this->closeModal();
    }

#[On('delete-brand')]
    public function delete(Brand $brand)
    {
        $this->form->setBrand($brand);
        $this->form->delete();
        $this->dispatch('show-marcas');
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
    public function loadBrands()
    {
        $this->readyToLoad = true;
    }
    
}
