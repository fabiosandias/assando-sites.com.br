Olá <?php echo $Student['name']?>,

Você está recebendo este email para confirmar a sua inscrição no curso Assando Sites, na turma <?php echo $MyClass['code'] ?> - que começa dia <?php echo date('d/m', strtotime($MyClass['start'])) ?>.

Sua inscrição foi recebida com sucesso e assim que o *PagSeguro* confirmar o seu pagamento a sua vaga estará garantida.

Se você ainda não efetuou o pagamento, acesse o endereço à seguir:

<?php echo $this->Html->url(array('controller' => 'students', 'action' => 'payment', 'token' => $token), true) . PHP_EOL ?>

Após a confirmação do pagamento nós entraremos em contato para confirmar sua vaga e tirar qualquer dúvida sua.

Caso tenha algum problema com a inscrição ou com o pagamento, é só responder este email. :)