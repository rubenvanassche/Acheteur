<?php

namespace App\Providers;

use App\Configuration;
use App\Event;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Request;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }


    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');

            $eventSlug = Request::segment(1);

            $router->group(['prefix' => $eventSlug.'/admin'], function ($router) use (&$event) {
                // Set the current event in the configuration
                $router->resource('product', 'ProductController');
                $router->get('product/{id}/delete', 'ProductController@delete');
                $router->resource('order', 'OrderController', ['except' => ['show']]);
                $router->get('order/{id}/delete', 'OrderController@delete');
                $router->resource('order.orderlist', 'OrderlistController');
                $router->get('order/printer', 'OrderController@printer');
                $router->get('order/excel', 'OrderController@excel');
                $router->resource('shift', 'ShiftController');
                $router->get('shift/{id}/delete', 'ShiftController@delete');
                // Availability
                $router->get('product/{product_id}/availability', 'ProductAvailabilityController@index');
                $router->get('product/{product_id}/availability/edit', 'ProductAvailabilityController@edit');
                $router->put('product/{product_id}/availability/edit', 'ProductAvailabilityController@update');

                $router->resource('page', 'PageController');
                $router->get('page/{id}/delete', 'PageController@delete');
                $router->get('page/{id}/editTemplate', 'PageController@editTemplate');
                $router->put('page/{id}/updateTemplate', 'PageController@updateTemplate');
                $router->resource('page.section', 'SectionController');
                $router->get('page/{pageId}/section/{id}/delete', 'SectionController@delete');
                $router->resource('orderextrafields', 'OrderExtraFieldsController');
                $router->resource('payment', 'PaymentController');

                // Dashboard
                $router->get('dashboard', 'DashboardController@index');

                // Auth
                $router->get('logout', 'AuthController@logout');
                $router->get('login', 'AuthController@login');
                $router->post('checkLogin', 'AuthController@checkLogin');

                // Sir Trevor JS
                $router->any('sirtrevor/upload', ['uses' => 'SirTrevorJsController@upload']);
                $router->any('sirtrevor/tweet', ['uses' => 'SirTrevorJsController@tweet']);

                // Preferences
                $router->get('preferences', ['uses' => 'PreferencesController@index']);
                $router->get('preferences/editGeneral', ['uses' => 'PreferencesController@editGeneral']);
                $router->put('preferences/updateGeneral', ['uses' => 'PreferencesController@updateGeneral']);
                $router->get('preferences/emails', ['uses' => 'PreferencesController@emails']);
                $router->get('preferences/editEmail/{type}', ['uses' => 'PreferencesController@editEmail']);
                $router->put('preferences/updateEmail/{type}', ['uses' => 'PreferencesController@updateEmail']);
                $router->get('preferences/about', ['uses' => 'PreferencesController@about']);
                $router->get('preferences/license', ['uses' => 'PreferencesController@license']);
            });

            // Front routes
            $router->get($eventSlug.'/{pageSlug}', 'FrontController@page');
            $router->get($eventSlug, 'FrontController@home');
            $router->post($eventSlug.'/order', 'FrontController@order');
        });
    }
}
