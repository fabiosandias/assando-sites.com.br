<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as 
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Plugin' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'Model' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'View' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'Controller' => array('/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'Model/Datasource' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'Model/Behavior' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'Controller/Component' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'View/Helper' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'Vendor' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'Console/Command' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

/**
 * Custom Inflector rules, can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

Inflector::rules('plural', array(
	'irregular' => array(
		'status' => 'status',
		'informacao' => 'informacoes'
	)));

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */

CakePlugin::loadAll();

/**
 * Gera o endereço do gravatar de um email
 * 
 * @param string $email
 * @param integer $size
 */
function gravatar($email, $size = 70, $default = 'mm') {
	return 'https://secure.gravatar.com/avatar/' . md5($email) . '?s=' . $size . '&d=' . urlencode($default);
}
	
/**
 * Status gerais
 */
define('STATUS_ATIVO', 1);
define('STATUS_INATIVO', 2);
define('STATUS_DELETADO', 3);
	
/**
 * Status de alunos
 */
define('STATUS_STUDENT_INSCRICAO_PENDENTE', 8);
define('STATUS_STUDENT_INSCRICAO_CONFIRMADA', 9);
define('STATUS_STUDENT_DELETADO', 10);

/**
 * Status de turmas
 */
define('STATUS_CLASS_PENDENTE', 4);
define('STATUS_CLASS_INSCRICOES_ABERTAS', 5);
define('STATUS_CLASS_INSCRICOES_FECHADAS', 6);
define('STATUS_CLASS_ENCERRADA', 7);

/**
 * Status de pagamento
 */
define('STATUS_PAYMENT_AGUARDANDO_PAGAMENTO', 11);
define('STATUS_PAYMENT_EM_ANALISE', 12);
define('STATUS_PAYMENT_PAGO', 13);
define('STATUS_PAYMENT_DISPONIVEL', 14);
define('STATUS_PAYMENT_EM_DISPUTA', 15);
define('STATUS_PAYMENT_DEVOLVIDO', 16);
define('STATUS_PAYMENT_CANCELADO', 17);

/**
 * Gateway des pagamento
 */
define('PAYMENT_GATEWAY_PAGSEGURO', 1);
define('PAYMENT_GATEWAY_PAYPAL', 2);