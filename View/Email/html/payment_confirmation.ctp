<p style="font-size: 1.4em; color: #555">Olá <strong><?php echo $Student['name']?></strong>,</p>
<p>Gostaríamos de informar que recebemos a confirmação do o seu pagamento de <strong><?php echo $this->Number->format($Payment['value'], array('before' => 'R$ ', 'decimals' => ',', 'thousands' => '.')) ?></strong> através do <?php echo $Payment['PaymentGateway']['name'] ?>.</p>
<p>Sua vaga na turma <strong><?php echo $Student['MyClass'][0]['code'] ?></strong> do <?php echo $this->Html->link('Assando Sites', $this->Html->url('/', true)) ?> está garantida!</p>

<p>Fique atento e não se esqueça do período de aulas:</p>
<div style="margin: 10px 0; padding: 20px; background: #DBFFDB; border-radius: 6px; display: inline-block; font-size: 1.2em">
	<?php echo $Student['MyClass'][0]['description'] ?>
</div>

<p>Aguarde mais informações após o dia <strong><?php echo $this->Time->format('d/m', $Student['MyClass'][0]['signup_limit']) ?></strong>, quando as inscrições terminam e a organização da turma começa.</p>
<p>Para participar das aulas os alunos precisam apenas de um navegador atualizado e com suporte à Flash.</p>
<p>Caso tenha alguma dúvida, é só responder este email. :)</p>