<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/login', array('controller' => 'users', 'action' => 'login', 'home'));
	Router::connect('/', array('controller' => 'users', 'action' => 'login', 'home'));
	Router::connect('/register', array('controller' => 'users', 'action' => 'register', 'home'));
	Router::connect('/product', array('controller' => 'products', 'action' => 'index', 'home'));
	//Router::connect('/', array('controller' => 'fronts', 'action' => 'index', 'home'));
	Router::connect('/specification', array('controller' => 'fronts', 'action' => 'specification', 'home'));
	Router::connect('/about', array('controller' => 'fronts', 'action' => 'about', 'home'));
	Router::connect('/faqs', array('controller' => 'fronts', 'action' => 'faq', 'home'));
	Router::connect('/admin', array('controller' => 'users', 'action'=>'login', 'admin' => true));
	
	Router::connect('/contact', array('controller' => 'fronts', 'action'=>'contact','home' => true));
	Router::connect('/technical-literature/*', array('controller' => 'fronts', 'action'=>'technical_literature','home' => true));
	Router::connect('/durooem', array('controller' => 'fronts', 'action'=>'durooem','home' => true));
	Router::connect('/durolab', array('controller' => 'fronts', 'action'=>'durolab','home' => true));
	Router::connect('/flake', array('controller' => 'fronts', 'action'=>'flake','home' => true));
	Router::connect('/video', array('controller' => 'fronts', 'action'=>'video','home' => true));
	Router::connect('/durotech-institute-of-waterproofing', array('controller' => 'fronts', 'action'=>'institute_waterproofing','home' => true));
	/* Router::connect('/shop/*', array('controller' => 'fronts', 'action'=>'shop','home' => true));
	
	Router::connect('/login', array('controller' => 'fronts', 'action'=>'login','home' => true));
	Router::connect('/cart', array('controller' => 'fronts', 'action'=>'cart','home' => true));
	Router::connect('/profile', array('controller' => 'customers', 'action'=>'profile','home' => true));
	Router::connect('/forgot-password', array('controller' => 'customers', 'action'=>'forgot_password','home' => true));
	Router::connect('/change-password', array('controller' => 'customers', 'action'=>'change_password','home' => true));
	Router::connect('/orders-list', array('controller' => 'customers', 'action'=>'orders_list','home' => true));
	Router::connect('/checkout', array('controller' => 'fronts', 'action'=>'checkout','home' => true));
	Router::connect('/product-detail/*', array('controller' => 'fronts', 'action'=>'product_detail','home' => true)); */
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
