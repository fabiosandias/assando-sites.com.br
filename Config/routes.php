<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	
	# Redirects
	Router::redirect('/inscreva-se/*', array('controller' => 'my_classes', 'action' => 'index'));
	
	# Páginas estáticas
	Router::connect('/conteudo-do-curso', array('controller' => 'pages', 'action' => 'display', 'about'));
	Router::connect('/conteudo-do-curso-avancado', array('controller' => 'pages', 'action' => 'display', 'about-advanced'));
	Router::connect('/sobre-o-cakephp', array('controller' => 'pages', 'action' => 'display', 'cakephp'));
	
	# Inscrição
	Router::connect('/inscricao/turma', array('controller' => 'my_classes', 'action' => 'index'));
	Router::connect('/inscricao/cadastro', array('controller' => 'students', 'action' => 'signup'));
	Router::connect('/inscricao/pagamento', array('controller' => 'students', 'action' => 'payment'));
	Router::connect('/inscricao/pagamento/:token', array('controller' => 'students', 'action' => 'payment'), array('token' => '[a-zA-Z0-9]{40}'));

	# Rotas do painel do aluno
	Router::connect('/aluno', array('controller' => 'students', 'action' => 'dashboard', 'aluno' => true));

	# Rotas do painel de controle
	Router::connect('/admin', array('controller' => 'students', 'action' => 'dashboard', 'admin' => true));

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
	