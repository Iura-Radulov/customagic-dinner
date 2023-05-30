<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserListRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserListCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserListCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\UserList::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user-list');
        CRUD::setEntityNameStrings(trans('labels.user-list'), trans('labels.user-list'));
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        $this->crud->addColumns([
            [
                'name'  => 'created_at', // The db column name
                'label' => trans('labels.created_at'), // Table column heading
                'type'  => 'date',
                'format' => 'Y-MM-DD H:mm', // use something else than the base.default_date_format config value
            ],
            [
                'name'  => 'date_from', // The db column name
                'label' => trans('labels.date_from'), // Table column heading
                'type'  => 'date',
                'format' => 'Y-MM-DD', // use something else than the base.default_date_format config value
            ],

            [
                'name'  => 'date_to', // The db column name
                'label' => trans('labels.date_to'), // Table column heading
                'type'  => 'date',
                'format' => 'Y-MM-DD', // use something else than the base.default_date_format config value
            ],

    ]);
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
        CRUD::setValidation(UserListRequest::class);

        $this->crud->addFields([

        [
            'name'  => 'date_from', // The db column name
            'label' => trans('labels.date_from'), // Table column heading
            'type'  => 'date',
            'format' => 'Y-MM-DD', // use something else than the base.default_date_format config value
        ],
            [
                'name'  => 'date_to', // The db column name
                'label' => trans('labels.date_to'), // Table column heading
                'type'  => 'date',
//                'format' => 'Y-MM-DD', // use something else than the base.default_date_format config value
            ],
            [   // SelectMultiple = n-n relationship (with pivot table)
                'label'     =>  trans('labels.users'),
                'type'      => 'checklist',
                'name'      => 'users', // the method that defines the relationship in your Model

                // optional
                'entity'    => 'users', // the method that defines the relationship in your Model
                'model'     => "App\Models\User", // foreign key model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
                'number_columns' => 2,
//                "default" => 1,
//                'attributes' => [
//                    'checked' => true,
//                ],
                // also optional
//                'options'   => (function ($query) {
//                    return $query->orderBy('name', 'ASC')->where('active', 1)->select('name')->get();
//                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
            ],
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
//    protected function setupUpdateOperation()
//    {
//        $this->setupCreateOperation();
//    }
}
