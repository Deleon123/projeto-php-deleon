<?php

namespace App;

use Config\Init\Boot;

class Routes extends Boot
{
    /**
     * Function that starts the routes from the project
     *
     * @return void
     */
    protected function initRoutes(): void
    {
        $routes['home'] = array(
            'route' => '/',
            'controller' => 'IndexController',
            'method' => 'index'
        );

        $routes['products'] = array(
            'route' => '/products',
            'controller' => 'ProductsController',
            'method' => 'index'
        );

        $routes['signin_user'] = array(
            'route' => '/signin',
            'controller' => 'UsersController',
            'method' => 'signIn'
        );

        $routes['register_user'] = array(
            'route' => '/register_user',
            'controller' => 'UsersController',
            'method' => 'registerUser'
        );

        $routes['authenticator'] = array(
            'route' => '/authenticator',
            'controller' => 'AuthController',
            'method' => 'authenticator'
        );

        $routes['exec_authenticator'] = array(
            'route' => '/exec_authenticator',
            'controller' => 'AuthController',
            'method' => 'exec_authenticator'
        );

        $routes['logout'] = array(
            'route' => '/logout',
            'controller' => 'UsersController',
            'method' => 'logout'
        );

        // Restrito
        $routes['products_register'] = array(
            'route' => '/register_product',
            'controller' => 'ProductsController',
            'method' => 'registerProduct'
        );

        $routes['exec_register'] = array(
            'route' => '/exec_register_product',
            'controller' => 'ProductsController',
            'method' => 'exec_register'
        );
        $routes['product_search'] = array(
            'route' => '/search',
            'controller' => 'ProductsController',
            'method' => 'search'
        );
        
        parent::setRoutes($routes);
    }
}
