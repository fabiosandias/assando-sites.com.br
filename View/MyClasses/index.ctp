		<section class="conteudo grid_8">
			<h2>Escolha uma turma</h2>
			<p>As turmas duram cerca de <strong>cinco semanas</strong>, mas você sempre vai ter acesso à todo o material compartilhado durante as aulas e suporte através da lista de discussão do curso</p>

			<?php if (!empty($data)) { ?>
			
			<div class="atencao">Você pode pagar em até <strong>12x</strong> no <strong>cartão de crédito</strong>, com boleto ou transferência bancária</div>
			
			<?php echo $this->Form->create('MyClass', array('url' => array('controller' => 'students', 'action' => 'signup'))) ?>
			<?php
			#App::import('Inflector');
			foreach ($data AS $class) {
				$MyClass = $class['MyClass'];

				$class = Inflector::slug(strtolower(preg_replace('/[0-9]/', '', $MyClass['title'])), ' ');
			?>
			<article class="<?php echo $class ?>" data-turma-id="<?php echo $MyClass['id'] ?>" itemscope itemtype="http://schema.org/Event">
				<h3 itemprop="name"><?php echo $MyClass['title'] ?></h3>
				<p itemprop="description"><?php echo $MyClass['description'] ?></p>
				<meta itemprop="startDate" content="<?php echo $this->Time->format('c', $MyClass['start']) ?>" />
				<meta itemprop="endDate" content="<?php echo $this->Time->format('c', $MyClass['end']) ?>" />
				
				<aside class="preco">
					<?php if ($MyClass['price_discount'] < $MyClass['price']) { ?>
					<span class="desconto">de <del><?php echo $this->Number->format($MyClass['price'], array('before' => 'R$ ', 'decimals' => ',', 'thousands' => '.')) ?></del> por</span>
					<?php } ?>
					<?php echo $this->Number->format($MyClass['price_discount'], array('before' => 'R$ ', 'decimals' => ',', 'thousands' => '.')) ?>
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

			<?php } else { ?>
			
			<div class="atencao">Inscrições encerradas! <?php echo $this->Html->link('Seja avisado quando a próxima turma abrir', '/#novas-turmas') ?></div>

			<?php } ?>
		
		</section>

		<section class="grid_3 sidebar sobre">

			<h3>Como funciona o curso?</h3>
			<p>Todo o <?php echo $this->Html->link('conteúdo do curso', array('controller' => 'pages', 'action' => 'display', 'about')) ?> é dado ao vivo e online, através de áudio e slides.</p>
			<p>Após cada aula você receberá os slides e um <strong>vídeo</strong> da aula.</p>
			<p>Temos também uma <strong>ferramenta para você tirar dúvidas</strong> e compartilhar o seu progresso com os outros participantes.</p>
			
		</section>

		<script>mpq.track("Listagem de turmas");</script>