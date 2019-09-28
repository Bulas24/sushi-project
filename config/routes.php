<?php

use ishop\Router;

//user routes
    Router::add('^product/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Product', 'action' => 'view']);
    Router::add('^category/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Category', 'action' => 'view']);
//    Router::add('^brands/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Brands', 'action' => 'view']);
//    Router::add('^brands/(?P<alias>[a-z0-9-]+)/product-all/?$', ['controller' => 'Brands', 'action' => 'index']);

// default routes
    Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix'
    => 'admin']);
    Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix'
    => 'admin']);

    Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
    Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');