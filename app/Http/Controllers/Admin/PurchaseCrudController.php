<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PurchaseRequest as StoreRequest;
use App\Http\Requests\PurchaseRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class PurchaseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PurchaseCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Purchase');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/purchase');
        $this->crud->setEntityNameStrings('purchase', 'purchases');

        $this->crud->addField([
            'label' => "Proveedor",
            'type' => 'select2',
            'name' => 'provider_id', // the db column for the foreign key
            'entity' => 'provider', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Provider", // foreign key model
          ]);

          $this->crud->addField([
            'name'  => 'user_id', 
            'type'  => 'hidden', 
            'value' => '',
        ]);

        $this->crud->addColumn([
            'name' => 'provider_id', // Nombre de la columna en tabla local (animal)
            'label' => "Proveedor", // titulo del campo en la tabla
            'type' => 'select', // Tipo de columna.  select
            'entity'    => 'provider', // Método que define la relación 
            'attribute' => "name", // Campo de la tabla foránea (classes) que se mostrará
            'model'     => Provider::class, // El modelo que se relaciona
            ]
        );

        $this->crud->addColumn([
            'name' => 'user_id', // Nombre de la columna en tabla local (animal)
            'label' => "Usuario", // titulo del campo en la tabla
            'type' => 'select', // Tipo de columna.  select
            'entity'    => 'user', // Método que define la relación 
            'attribute' => "name", // Campo de la tabla foránea (classes) que se mostrará
            'model'     => User::class, // El modelo que se relaciona
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        $this->crud->allowAccess('show'); // Activar botón de vista previa

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // add asterisk for fields that are required in PurchaseRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {

        $request->merge(['user_id' => backpack_user()->id]);

        
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
