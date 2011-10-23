
		<section class="conteudo grid_8">
			<h2>Inscrição de aluno</h2>
			<p>Preencha o formulário à seguir com os seus dados para dar início à sua inscrição</p>
			
			<?php echo $this->Form->create('Student', array('action' => 'signup', 'class' => 'form')) ?>
				
				<?php $MyClass = $MyClass['MyClass'] ?>
				<h3 class="grid_8 alpha omega">Turma escolhida <small>&ndash; <?php echo $this->Html->link('Escolha outra turma', array('controller' => 'my_classes', 'action' => 'index')) ?></small></h3>
				<article class="turma" data-turma-id="<?php echo $MyClass['id'] ?>">
					<h3><?php echo $MyClass['title'] ?></h3>
					<p><?php echo $MyClass['description'] ?></p>
					
					<aside class="preco">
						<?php if ($MyClass['price_discount'] < $MyClass['price']) { ?>
						<span class="desconto">de <strike><?php echo $this->Number->format($MyClass['price'], array('before' => 'R$ ', 'decimals' => ',', 'thousands' => '.')) ?></strike> por</span>
						<?php } ?>
						<?php echo $this->Number->format($MyClass['price_discount'], array('before' => 'R$ ', 'decimals' => ',', 'thousands' => '.')) ?>
					</aside>
					
					<?php if ($MyClass['price_discount'] >= $MyClass['price']) { ?>
						<span class="limite">Inscrições até <?php echo $this->Html->tag('strong', $this->Time->format('d/m', $MyClass['signup_limit'])) ?></span>
					<?php } ?>
				</article>
				
				<?php if ($MyClass['price_discount'] < $MyClass['price']) { ?>
				<div class="atencao"><strong>Atenção:</strong> O valor acima é um valor promocional que poderá ser alterado sem aviso prévio</div>
				<?php } ?>
							
				<h3 class="grid_8 alpha omega">Dados pessoais</h3>
				
				<?php echo $this->Form->input('name', array('label' => 'Nome', 'placeholder' => 'Fulano', 'class' => 'text', 'div' => array('class' => 'grid_3 alpha'))) ?>
				<?php echo $this->Form->input('surname', array('label' => 'Sobrenome', 'placeholder' => 'da Silva', 'class' => 'text', 'div' => array('class' => 'grid_3 suffix_2 omega'))) ?>			
				<?php echo $this->Form->input('email', array('label' => 'Email', 'placeholder' => 'fulano@silva.com.br', 'class' => 'text', 'type' => 'email', 'div' => array('class' => 'grid_5 alpha suffix_3'))) ?>
				<?php echo $this->Form->input('password', array('label' => 'Senha', 'class' => 'text', 'type' => 'password', 'div' => array('class' => 'grid_4 alpha'))) ?>
				<?php echo $this->Form->input('password_verify', array('label' => 'Repita a senha', 'class' => 'text', 'type' => 'password', 'div' => array('class' => 'grid_4 omega'))) ?>
			
				<h3 class="grid_8 alpha omega">Outras informações</h3>
				
				<?php echo $this->Form->input('phone', array('label' => 'Celular', 'placeholder' => '(21) 8888-8888', 'class' => 'text', 'type' => 'tel', 'div' => array('class' => 'grid_2 alpha'))) ?>			
				<?php echo $this->Form->input('state', array('label' => 'Estado', 'placeholder' => 'RJ', 'class' => 'text small', 'div' => array('class' => 'grid_1'))) ?>			
				<?php echo $this->Form->input('city', array('label' => 'Cidade', 'placeholder' => 'Rio de Janeiro', 'class' => 'text', 'div' => array('class' => 'grid_4 suffix_1 omega'))) ?>
					
				<?php echo $this->Form->submit('Inscrever', array('class' => 'botao vermelho menor')) ?>
				
			<?php echo $this->Form->end() ?>
		</section>

		<section class="grid_3 sidebar sobre">

			<h3>Como funciona o curso?</h3>
			
			<p>O curso é <em>on-line</em>! São <strong>cinco aulas</strong> de <strong>três horas</strong>, aos domingos.</p>
			<p>Todo o <?php echo $this->Html->link('conteúdo do curso', array('controller' => 'pages', 'action' => 'display', 'about')) ?> é dado através de vídeo e slides.</p>
			<p>Após cada aula você receberá os slides e um <strong>vídeo</strong> da aula.</p>
			<p>Temos também uma <strong>ferramenta para você tirar dúvidas</strong> e compartilhar o seu progresso com os outros participantes.</p>

			<h3 style="margin-top: 30px">O que acontece após a inscrição?</h3>
			
			<p>Após a inscrição você será direcionado para o efetuar o pagamento no <strong>PagSeguro</strong>.</p>
			<p>Assim que o pagamento for confirmado, sua vaga estará garantida!</p>
			
		</section>