<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserCardRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCardCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCardCrudController extends CrudController
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
        CRUD::setModel(\App\Models\UserCard::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user-card');
        CRUD::setEntityNameStrings(trans('labels.user-card'), trans('labels.user-cards'));
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
                'name'        => 'active',
                'label'       => trans('labels.active'),
                'type'        => 'boolean',
                'options'     => [
                    0 => 'Disabled',
                    1 => 'Active'
                ],
                'wrapper' => [
                    'element' => 'span',
                    'class' => function ($crud, $column, $entry, $related_key) {
                        if($column['text'] == 'Active'){
                            return 'badge badge-success';
                        } else {
                            return 'badge badge-danger';
                        }
                    },
                ]
            ],
            [  // Select
                'label'     => trans('labels.user'),
                'type'      => 'select',
                'name'      => 'user_id', // the db column for the foreign key
                'entity'    => 'user',
                // optional - manually specify the related model and attribute
                'model'     => "App\Models\User", // related model
                'attribute' => 'name', // foreign key attribute that is shown to user
            ],
            [  // Select
                'label'     => trans('labels.menu_types'),
                'type'      => 'select',
                'name'      => 'menu_id', // the db column for the foreign key
                'entity'    => 'menu',
                // optional - manually specify the related model and attribute
                'model'     => "App\Models\MenuType", // related model
                'attribute' => 'name', // foreign key attribute that is shown to user
            ],
            [
                'name'  => 'number',
                'label' => trans('labels.number'),
                'type'  => 'text',
            ],
            [
                'name'  => 'created_at',
                'label' => trans('labels.created'),
                'type'  => 'date',
                'format' => 'Y-MM-DD H:mm',
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
        CRUD::setValidation(UserCardRequest::class);

        $this->crud->addFields([
            [
                'name'          => 'active',
                'label'         => trans('labels.active'),
                'type'        => 'switch',
                'color'    => 'primary',

            ],

            [  // Select
                'label'     => trans('labels.user'),
                'type'      => 'select',
                'name'      => 'user_id', // the db column for the foreign key

                // optional - manually specify the related model and attribute
                'model'     => "App\Models\User", // related model
                'attribute' => 'name', // foreign key attribute that is shown to user

                // optional - force the related options to be a custom query, instead of all();
                'options'   => (function ($query) {
                    return $query->orderBy('name', 'ASC')->where('active', 1)->get();
                }), //  you can use this to filter the results show in the select
            ],
            [  // Select
                'label'     => trans('labels.menu_types'),
                'type'      => 'select',
                'name'      => 'menu_id', // the db column for the foreign key
                'entity'    => 'menu',
                'model'     => "App\Models\MenuType", // related model
                'attribute' => 'name', // foreign key attribute that is shown to user

            ],
            [
                'name'  => 'number',
                'label' => trans('labels.number'),
                'type'  => 'text',
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
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
