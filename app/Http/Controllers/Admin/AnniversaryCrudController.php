<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AnniversaryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AnniversaryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AnniversaryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Anniversary::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/anniversary');
        CRUD::setEntityNameStrings('anniversary', 'anniversaries');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        
       $this->crud->setColumns(['title','name','phone','email','birthday','wedding']);
       
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
       // $this->crud->setValidation(AnniversaryRequest::class);

        $this->crud->addField([
            'name' => 'title',
          'type' => 'text',
          'label' => "Title"
        ]);
        $this->crud->addField([
          'name' => 'name',
          'type' => 'text',
          'label' => "Name"
        ]);
        $this->crud->addField([
            'name' => 'phone',
            'type' => 'number',
            'label' => "Phone"
          ]);
          $this->crud->addField([
            'name' => 'email',
            'type' => 'email',
            'label' => "Email"
          ]);
          $this->crud->addField([
            'name' => 'birthday',
            'type' => 'date',
            'label' => "Birthdate"
          ]);
          $this->crud->addField([
            'name' => 'wedding',
            'type' => 'date',
            'label' => "Wedding Date"
          ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
