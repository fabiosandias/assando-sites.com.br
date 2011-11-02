<p style="font-size: 1.4em; color: #555">Olá <strong><?php echo $Student['name']?></strong>,</p>
<p>Você está recebendo este email para confirmar a sua inscrição no curso <?php echo $this->Html->link('Assando Sites', $this->Html->url('/', true)) ?>, na turma <strong><?php echo $MyClass['code'] ?></strong> - que começa dia <?php echo date('d/m', strtotime($MyClass['start'])) ?>.
<p>Sua inscrição foi recebida com sucesso e assim que o <strong style="color: #20510f">PagSeguro</strong> confirmar o seu pagamento a sua vaga estará garantida.</p>
<p>Se você ainda não efetuou o pagamento, acesse o endereço à seguir:</p>
<div style="margin: 10px 0; padding: 20px; background: #DBFFDB; border-radius: 6px; display: inline-block; font-size: 1.2em"><?php echo $this->Html->link($this->Html->url(array('controller' => 'students', 'action' => 'payment', 'token' => $token), true)) ?></div>
<p>Após a confirmação do pagamento nós entraremos em contato para confirmar sua vaga e tirar qualquer dúvida sua.</p>
<p>Caso tenha algum problema com a inscrição ou com o pagamento, é só responder este email. :)</p>