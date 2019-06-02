<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProviderRequest as StoreRequest;
use App\Http\Requests\ProviderRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class ProviderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProviderCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Provider');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/provider');
        $this->crud->setEntityNameStrings('provider', 'providers');

        $this->crud->addField([   // Enum
            'name' => 'typeofdocument',
            'label' => 'Tipo Documento',
            'type' => 'enum'
        ]);

        $this->crud->addField([   // Enum
            'name' => 'idnumber',
            'label' => 'No. Documento',
            'type' => 'Text'
        ]);

        

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // add asterisk for fields that are required in ProviderRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
