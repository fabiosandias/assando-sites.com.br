
		<section class="conteudo grid_8">
			<h2>Pagamento</h2>
			<p>Clique no botão a seguir para ir até o site do <strong>PagSeguro</strong> efetuar o pagamento da sua inscrição.</p>
			<p>Assim que o PagSeguro confirmar o pagamento a sua vaga estará garantida!</p>
			
			<?php
			$Student = $Student['Student'];
			
			echo $this->PagSeguro->checkoutButton(array(
				'cliente' => array(	
					'nome' => $Student['fullname'],
					'email' => $Student['email']
				),
				'produtos' => array(
					array(
						'id' => $MyClass['code'],
						'descricao' => 'Inscrição - Assando Sites, ' . $MyClass['title'],
						'quantidade' => 1,
						'valor' => (float)$MyClass['price']
					)
				),
				'desconto' => (float)$MyClass['price'] - (float)$MyClass['price_discount'], 
				'reference' => sha1($Student['email'])
			));
			?>		

			<div class="atencao">Caso você tenha algum problema durante a inscrição, envie um email para <?php echo $this->Html->link('thiago.belem@assando-sites.com.br', 'mailto:thiago.belem@assando-sites.com.br') ?></div>
				
			
		</section>

		<section class="grid_3 sidebar sobre">

			<h3>Como funciona o curso?</h3>
			
			<p>O curso é <em>on-line</em>! São <strong>cinco aulas</strong> de <strong>três horas</strong>, aos domingos.</p>
			<p>Todo o <?php echo $this->Html->link('conteúdo do curso', array('controller' => 'pages', 'action' => 'display', 'about')) ?> é dado através de vídeo e slides.</p>
			<p>Após cada aula você receberá os slides e um <strong>vídeo</strong> da aula.</p>
			<p>Temos também uma <strong>ferramenta para você tirar dúvidas</strong> e compartilhar o seu progresso com os outros participantes.</p>
			
		</section>