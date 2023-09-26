<?php


namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use App\Models\Provider;
use Livewire\Form;

class ProviderForm extends Form
{
    public ?Provider $provider;

    public $search = "";
//  'email', 'phone', 'contact', 'web'
    public $name;
    public $description;
    public $email;
    public $phone;
    public $contact;
    public $web;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'contact' => 'required',
        'web' => 'required',

    ];

    public function setProvedor(Provider $provider)
    {
        $this->provider = $provider;
        $this->name = $provider->name;
        $this->description = $provider->description;
        $this->email = $provider->email;
        $this->phone = $provider->phone;
        $this->contact = $provider->contact;
        $this->web = $provider->web;

    }

    public function read($sort, $orderBy, $list)
    {
        return Provider::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('phone', 'like', '%' . $this->search . '%')
                ->orWhere('contact', 'like', '%' . $this->search . '%')
                ->orWhere('web', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%');
                
        })

            ->orderBy($sort, $orderBy)
            ->paginate($list);
    }


    public function store()
    {

        $this->validate();
        Provider::create($this->only(['name', 'description','email', 'phone', 'contact', 'web']));
        $this->reset();
    }


    public function update()
    {
        $this->validate();
        $this->provider->update($this->all());
        $this->reset();
    }


    public function delete()
    {
        $this->provider->delete();
        $this->reset();
    }
}

