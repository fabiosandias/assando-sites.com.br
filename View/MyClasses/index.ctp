		<section class="conteudo grid_8">
			<h2>Escolha uma turma</h2>
			<p>As turmas duram cerca de <strong>cinco semanas</strong>, mas você sempre vai ter acesso à todo o material compartilhado durante as aulas e suporte através da lista de discussão do curso</p>
			
			<?php echo $this->Form->create('MyClass', array('url' => array('controller' => 'students', 'action' => 'signup'))) ?>
			<?php
			#App::import('Inflector');
			foreach ($data AS $class) {
				$MyClass = $class['MyClass'];

				$class = Inflector::slug(strtolower(preg_replace('/[0-9]/', '', $MyClass['title'])), ' ');
			?>
			<article class="<?php echo $class ?>" data-turma-id="<?php echo $MyClass['id'] ?>" itemscope itemtype="http://schema.org/Event">
				<h3 itemprop="name"><?php echo $MyClass['title'] ?></h3>
				<p><?php echo $MyClass['description'] ?></p>
				<meta itemprop="startDate" content="<?php echo $this->Time->format('c', $MyClass['start']) ?>" />
				<meta itemprop="endDate" content="<?php echo $this->Time->format('c', $MyClass['end']) ?>" />
				
				<aside class="preco">
					<?php if ($MyClass['price_discount'] < $MyClass['price']) { ?>
					<span class="desconto">de <del><?php echo $this->Number->format($MyClass['price'], array('before' => 'R$ ', 'decimals' => ',', 'thousands' => '.')) ?></del> por</span>
					<?php } ?>
					<ins><?php echo $this->Number->format($MyClass['price_discount'], array('before' => 'R$ ', 'decimals' => ',', 'thousands' => '.')) ?></ins>
				</aside>
					
				<?php if ($MyClass['price_discount'] >= $MyClass['price']) { ?>
					<span class="limite">Inscrições até <?php echo $this->Html->tag('strong', $this->Time->format('d/m', $MyClass['signup_limit'])) ?></span>
				<?php } ?>
			</article>
			<?php } ?>
			<?php echo $this->Form->radio('id', $ids, array('legend' => false)) ?>
			<?php echo $this->Form->submit('Enviar', array('class' => 'botao vermelho menor', 'div' => false)) ?>
			<?php echo $this->Form->end() ?>
			
			<div class="atencao">Curso voltado para <strong>Desenvolvedores</strong> e <strong>Programadores</strong> que trabalham com PHP e conhecem os conceitos da <em>Orientação à Objetos</em></div>
		
		</section>

		<section class="grid_3 sidebar sobre">

			<h3>Como funciona o curso?</h3>
			
			<p>O curso é <em>on-line</em>! São <strong>cinco aulas</strong> de <strong>três horas</strong>, aos domingos.</p>
			<p>Todo o <?php echo $this->Html->link('conteúdo do curso', array('controller' => 'pages', 'action' => 'display', 'about')) ?> é dado através de vídeo e slides.</p>
			<p>Após cada aula você receberá os slides e um <strong>vídeo</strong> da aula.</p>
			<p>Temos também uma <strong>ferramenta para você tirar dúvidas</strong> e compartilhar o seu progresso com os outros participantes.</p>
			
		</section>