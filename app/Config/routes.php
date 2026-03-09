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

	Router::connect('/admin', array('controller' => 'users', 'action'=>'login', 'admin' => true));
	Router::connect('/', array('controller' => 'fronts', 'action'=>'index','home' => true));
	Router::connect('/about', array('controller' => 'fronts', 'action'=>'about','home' => true));
	Router::connect('/consulting', array('controller' => 'fronts', 'action'=>'consulting','home' => true));
	Router::connect('/promotions', array('controller' => 'fronts', 'action'=>'promotions','home' => true));
	Router::connect('/suppliers', array('controller' => 'fronts', 'action'=>'suppliers','home' => true));
	Router::connect('/products', array('controller' => 'fronts', 'action'=>'products','home' => true));
	
	Router::connect('/our-services', array('controller' => 'fronts', 'action'=>'services','home' => true));
	Router::connect('/user-area', array('controller' => 'fronts', 'action'=>'user_area','home' => true));
	Router::connect('/pricing', array('controller' => 'fronts', 'action'=>'pricing','home' => true));
	//Router::connect('/services', array('controller' => 'fronts', 'action'=>'services','home' => true));
	Router::connect('/policies', array('controller' => 'fronts', 'action'=>'policies','home' => true));
	Router::connect('/blog/*', array('controller' => 'blogs', 'action'=>'index','home' => true));
	Router::connect('/contact-us', array('controller' => 'fronts', 'action'=>'contact','home' => true));
	Router::connect('/solar-home', array('controller' => 'fronts', 'action'=>'solar_home','home' => true));
	Router::connect('/solar-business', array('controller' => 'fronts', 'action'=>'solar_business','home' => true));
	Router::connect('/solar-types', array('controller' => 'fronts', 'action'=>'solar_types','home' => true));
	Router::connect('/solar-calculator', array('controller' => 'fronts', 'action'=>'calculator','home' => true));
	Router::connect('/final-calculation', array('controller' => 'fronts', 'action'=>'cal_next','home' => true));
	Router::connect('/thank-you', array('controller' => 'fronts', 'action'=>'thank_you','home' => true));
	
	Router::connect('/quick-notes/*', array('controller' => 'quicks', 'action'=>'index','home' => true));
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
