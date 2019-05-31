<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AnimalRequest as StoreRequest;
use App\Http\Requests\AnimalRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class AnimalCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AnimalCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Animal');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/animal');
        $this->crud->setEntityNameStrings('animal', 'animals');

        $this->crud->addColumn([
            'name' => 'name', // The db column name
            'label' => "Nombre del Animal", // Table column heading
            'type' => 'Text'
            ]);

        $this->crud->addColumn([
            'name' => 'weight', // The db column name
            'label' => "Peso", // Table column heading
            'type' => 'number'
            ]);

        $this->crud->addColumn([
            'name' => 'class', // Nombre de la columna en tabla local (animal)
            'label' => "Clase Animal", // titulo del campo en la tabla
            'type' => 'select', // Tipo de columna.  select
            'entity'    => 'classs', // Método que define la relación 
            'attribute' => "name", // Campo de la tabla foránea (classes) que se mostrará
            'model'     => AnimalClass::class, // El modelo que se relaciona
            ]
        );
        
        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Nombre"
          ]);

          $this->crud->addField([
            'name' => 'weight',
            'type' => 'number',
            'label' => "Peso en Libras"
          ]);

          $this->crud->addField([
            'name' => 'born',
            'type' => 'date',
            'label' => "Fecha de Nacimiento"
          ]);

          $this->crud->addField([
            'label' => "Clase Animal",
            'type' => 'select',
            'name' => 'class', // the db column for the foreign key
            'entity' => 'classs', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\AnimalClass", // foreign key model
          ]);

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // add asterisk for fields that are required in AnimalRequest
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
