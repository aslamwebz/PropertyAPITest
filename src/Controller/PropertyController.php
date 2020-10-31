<?php

namespace App\Controller;

use App\Model\Property;
use Config\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class PropertyController
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function index()
    {
        $property = Property::getAll();
        View::render('index', $property);
    }


    /**
     * Show the property
     *
     * @return void
     */
    public function show($id)
    {
        // View::render('show');
    }

    /**
     * Show the create page
     *
     * @return void
     */
    public function create()
    {
        View::render('create');
    }

    /**
     * Show the add page
     *
     * @return void
     */
    public function insert($request, $FILES)
    {
        Property::addProperty($request, $FILES);
    }

    /**
     * Show the add page
     *
     * @return void
     */
    public function edit($request)
    {
        $data = Property::getSingle($request['edit']);

        View::render('edit', $data);
    }


    /**
     * Add the Property 
     *
     * @return void
     */
    public function update($request, $FILES)
    {
        Property::updateProperty($request, $FILES);
    }

    /**
     * Delete Property or multiple Propertys
     *
     * @return void
     */
    public function delete($request)
    {

        if (isset($request['delete'])) {
            Property::deleteProperty($request['delete']);
        }

        $Property = Property::getAll();
        header("Location:/");
    }

    /**
     * Filter the data
     *
     * @return array
     */
    public function filter($request)
    {
        Property::filterProperty($request);
    }
}
