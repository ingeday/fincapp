<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Models\Animal;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SaleRequest as StoreRequest;
use App\Http\Requests\SaleRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class SaleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SaleCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Sale');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/sale');
        $this->crud->setEntityNameStrings('sale', 'sales');

        $this->crud->addColumn([
            'name' => 'time', // The db column name
            'label' => "Fecha Venta", // Table column heading
            'type' => 'date'
         ]);

        $this->crud->addColumn([
            'name' => 'animal_id', // Nombre de la columna en tabla local (animal)
            'label' => "Animal", // titulo del campo en la tabla
            'type' => 'select', // Tipo de columna.  select
            'entity'    => 'animal', // Método que define la relación 
            'attribute' => "name", // Campo de la tabla foránea (classes) que se mostrará
            'model'     => Animal::class, // El modelo que se relaciona
            ]
        );

        $this->crud->addColumn([
            'name' => 'client_id', // Nombre de la columna en tabla local (animal)
            'label' => "Cliente", // titulo del campo en la tabla
            'type' => 'select', // Tipo de columna.  select
            'entity'    => 'client', // Método que define la relación 
            'attribute' => "name", // Campo de la tabla foránea (classes) que se mostrará
            'model'     => Client::class, // El modelo que se relaciona
            ]
        );

        


        $this->crud->addField([
            'label' => "Cliente",
            'type' => 'select2',
            'name' => 'client_id', // the db column for the foreign key
            'entity' => 'client', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Client", // foreign key model
          ]);


          $this->crud->addField([
            'label' => "Animal",
            'type' => 'select2',
            'name' => 'animal_id', // the db column for the foreign key
            'entity' => 'animal', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Animal", // foreign key model
            'options'   => (function ($query) {
                return $query->where('sold',0)->get();
            })
          ]);

          $this->crud->removeAllButtons();

          
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // add asterisk for fields that are required in SaleRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        // get animal id
        $animalId=$request->animal_id;
        // update the sale state
        Animal::find($animalId)->setSold();
        
        
        
        
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
