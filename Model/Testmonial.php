<?php
/**
 * Model de depoimentos
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage	Model
 */

/**
 * Model de depoimentos
 */
class Testmonial extends AppModel {
	
	/**
	 * Nome da tabela
	 * 
	 * @var string
	 */
	public $useTable = false;

	/**
	 * Dados do model
	 * 
	 * @var array
	 */
	public $testmonials = array(
		array(
			'author' => array(
				'name' => 'William Espindola',
				'email' => 'bkpserver@gmail.com',
				'twitter' => 'espindola_will'
			),
			'message' => 'O curso deu uma nova perspectiva de desenvolvimento, onde obtive dinâmica e organização através de uma ferramenta fantástica'
		),
		array(
			'author' => array(
				'name' => 'Renato Paiva',
				'email' => 'renpv@hotmail.com',
				'twitter' => 'renatopaivabv'
			),
			'message' => 'Ótimo curso! Já havia feito muitos cursos mas, graças ao Thiago e ao CakePHP, agora eu sei o que é produzir um bom trabalho em pouco tempo'
		),
		array(
			'author' => array(
				'name' => 'Vinícius S. Souza',
				'email' => 'vinnylinux@hotmail.com',
				'twitter' => 'vinnylinux'
			),
			'message' => 'O curso de CakePHP agilizou muito meu trabalho na empresa, em uma semana fiz a modelagem do banco de dados, na outra semana eu já estava apresentando resultados pro meu chefe'
		),
		array(
			'author' => array(
				'name' => 'Eduardo Rabelo',
				'email' => 'oieduardorabelo@gmail.com',
				'twitter' => 'oieduardorabelo'
			),
			'message' => 'Pude absorver rápidamente o conteúdo e aplicar práticamente no meu dia-a-dia, aumentando o nível de qualidade e produção no desenvolvimento diário'
		),
		array(
			'author' => array(
				'name' => 'Gilvan Costa',
				'email' => 'gilvan@gilvancosta.com',
				'twitter' => 'gilvaju'
			),
			'message' => 'Dos cursos que fiz na área, foi o melhor curso de longe, com um feedback por parte do professor fantástico'
		),
		array(
			'author' => array(
				'name' => 'Acácio C. Costa',
				'email' => 'acacio147@gmail.com'
			),
			'message' => 'Fazer um curso com o Thiago, é realmente muito bom. Quem estiver em dúvida dá uma olhada do <a href="http://blog.thiagobelem.net" rel="external">blog dele</a>, certamente vão perceber a grande didática e como ele torna as coisas mais fáceis de entender'
		),
		array(
			'author' => array(
				'name' => 'Douglas Faria',
				'email' => 'douglasfaria@assoweb.com.br'
			),
			'message' => 'Um curso muito interessante para quem quer otimizar o seu tempo de forma segura e bem estruturada. Um ótimo <a href="http://assando-sites.com.br/conteudo-do-curso">conteúdo</a> e um professor que entende do assunto!'
		),
		array(
			'author' => array(
				'name' => 'Kelvne Pechim',
				'email' => 'kelvne.pechim@gmail.com',
				'twitter' => 'kelvne'
			),
			'message' => 'Se você quer aprender algo fantástico com um professor genial, o curso Assando Sites foi feito para você!'
		),
		// 2011.4
		array(
			'author' => array(
				'name' => 'Patrick Maciel',
				'email' => 'patrickmaciel.info@gmail.com',
				'twitter' => 'p4dev'
			),
			'message' => 'A didática é ótima e o conteúdo é de qualidade; há vários exemplos e não ficamos presos aos slides, já que ele explica situações da vida real, na prática. Mesmo já conhecendo o básico de CakePHP, o curso foi excelente.'
		),
		array(
			'author' => array(
				'name' => 'Simone Myrrha',
				'email' => 'simyrrha@yahoo.com.br',
				'twitter' => 'simonemyrrha'
			),
			'message' => 'Adquiri conhecimento de como programar de forma rápida e eficiente, aumentando a qualidade do desenvolvimento em pouco tempo de trabalho.'
		),
		// 2012.1-AV
		array(
			'author' => array(
				'name' => 'Patrick Maciel',
				'email' => 'patrickmaciel.info@gmail.com',
				'twitter' => 'p4dev'
			),
			'message' => 'O <a href="http://assando-sites.com.br/conteudo-do-curso-avancado">curso avançado</a> foi um excelente complemento ao básico. O que estava faltando para que pudéssemos ter uma visão geral de como funciona o CakePHP, foi suprido agora.'
		),
		array(
			'author' => array(
				'name' => 'Luiz Antonio',
				'email' => 'tonyzrp@gmail.com',
				'twitter' => 'tonyzrp'
			),
			'message' => 'De forma bastante dinâmica, o CakePHP foi desmembrado e conseguimos ter uma ideia ampla do funcionamento do mesmo. Com o curso, nós interagimos com a mágica do Cake e adquirimos conhecimento para criar nossos próprios truques.'
		)
	);

	/**
	 * Retorna depoimentos aleatórios
	 * 
	 * @param int $limit Número de depoimentos
	 *
	 * @return array
	 */
	public function random($limit = 4) {
		$data = $this->testmonials;

		shuffle($data);

		return array_slice($data, 0, $limit);
	}
	
}