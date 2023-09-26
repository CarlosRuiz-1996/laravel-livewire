<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Forms\ProviderForm;

use App\Models\Provider;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ProviderCtg extends Component
{



    use WithPagination;

    public ProviderForm $form;
    public $providerId;
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

    #[On('show-provedores')]
    public function render()
    {

        if ($this->readyToLoad) {


            $providers = $this->form->read($this->sort, $this->orderBy, $this->list);
        } else {
            $providers = [];
        }

        return view('livewire.provider-ctg', [

            'providers' => $providers,
        ]);
    }

    public function save()
    {

        $this->form->store();
        $this->dispatch('show-provedores');
        $this->dispatch('alert-provider', 'Provedor creado con exito.');
        $this->closeModal();
    }

    public function edit(Provider $provider)
    {
        $this->form->setProvedor($provider);
        $this->providerId = $provider->id;
        $this->openModal();
    }


    public function update()
    {
        $this->form->update();
        $this->dispatch('show-provedores');
        $this->reset('providerId');
        $this->closeModal();
        $this->dispatch('alert-provider', 'Provedor actualizado con exito.');
    }

    #[On('delete-provider')]
    public function delete(Provider $provider)
    {
        $this->form->setProvedor($provider);
        $this->form->delete();
        $this->dispatch('show-provedores');
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
    public function loadProviders()
    {
        $this->readyToLoad = true;
    }
}
