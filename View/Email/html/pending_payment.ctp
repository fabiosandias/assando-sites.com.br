<p style="font-size: 1.4em; color: #555">Olá <strong><?php echo $Student['name']?></strong>,</p>
<p>Ainda não recebemos a confirmação do seu pagamento referente à sua inscrição no <?php echo $this->Html->link('Assando Sites', $this->Html->url('/', true)) ?>.</p>
<p>Sua vaga só estará garantida quando o <strong style="color: #20510f">PagSeguro</strong> confirmar o seu pagamento.</p>
<p>Para efetuar o pagamento acesse o endereço à seguir:</p>
<div style="margin: 10px 0; padding: 20px; background: #DBFFDB; border-radius: 6px; display: inline-block; font-size: 1.2em"><?php echo $this->Html->link($this->Html->url(array('controller' => 'students', 'action' => 'payment', 'token' => $token), true)) ?></div>
<p>Se o seu pagamento não for confirmado até o dia <?php echo $this->Html->tag('strong', $this->Time->format('d/m', $limit)) ?>, a sua inscrição será cancelada automáticamente.</p>
<p>Após a confirmação do pagamento nós entraremos em contato para confirmar sua vaga e tirar qualquer dúvida sua.</p>
<p>Caso tenha algum problema com a inscrição ou com o pagamento, é só responder este email. :)</p>