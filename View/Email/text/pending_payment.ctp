Olá <?php echo $Student['name']?>,

Ainda não recebemos a confirmação do seu pagamento referente à sua inscrição no Assando Sites.

Sua vaga só estará garantida quando o *PagSeguro* confirmar o seu pagamento.

Para efetuar o pagamento acesse o endereço à seguir:

<?php echo $this->Html->url(array('controller' => 'students', 'action' => 'payment', 'token' => $token), true) . PHP_EOL ?>

Se o seu pagamento não for confirmado até o dia *<?php echo $this->Time->format('d/m', $limit) ?>*, a sua inscrição será cancelada automáticamente.

Após a confirmação do pagamento nós entraremos em contato para confirmar sua vaga e tirar qualquer dúvida sua.

Caso tenha algum problema com a inscrição ou com o pagamento, é só responder este email. :)