<?php

$config = array(
	'Meta' => array(
		'title' => 'Assando Sites, curso online de CakePHP',

		'description' => 'Assando Sites é um curso prático de CakePHP onde você vai aprender a desenvolver sites e portais de forma rápida e eficiente',
		'keywords' => 'CakePHP, Framework, Curso de CakePHP, Curso CakePHP, Curso Online, PHP',
		
		'canonical' => 'http://assando-sites.com.br/'
	),
	
	'Inscricao' => array(
		'Desconto' => array(
			array(
				'porcentagem' => 25,
				'limite' => '-30 days'			
			),
			array(
				'porcentagem' => 15,
				'limite' => '-15 days'
			)
		)
	),
	
	'Google' => array(
		'analytics' => 'UA-23766967-1',
		'webmasters' => array(
			'Nu7lnulZmJaaU7I1U0boWtRdpWJ2rOkRgX0daK8QXks',
			'bpLRVmTEyj5jP9lX-t99vnUCz4Pr1YM2Fz-CMAELEg8',
			'uEgQR49boaOpdbRkFLCLCJVecO7nNWYtX9nNUb9H2pU',
		)
	),
	
	'Email' => array(
		'from' => array('Thiago Belem' => 'thiago.belem@assando-sites.com.br'),
		'replyTo' => array('Thiago Belem' => 'thiago.belem@assando-sites.com.br')
	)
);

?>