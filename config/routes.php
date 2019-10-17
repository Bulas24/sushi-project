<?php

use ishop\Router;

//user routes
    Router::add('^product/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Product', 'action' => 'view']);
    Router::add('^category/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Category', 'action' => 'view']);

// default routes
    Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix'
    => 'admin']);
    Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix'
    => 'admin']);

    Router::add('^manager$', ['controller' => 'Main', 'action' => 'index', 'prefix'
    => 'manager']);
    Router::add('^manager/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix'
    => 'manager']);

    Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
    Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');