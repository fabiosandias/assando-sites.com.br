Olá <?php echo $Student['name']?>,

Gostaríamos de informar que recebemos a confirmação do o seu pagamento de <?php echo $this->Number->format($Payment['value'], array('before' => 'R$ ', 'decimals' => ',', 'thousands' => '.')) ?> através do <?php echo $Payment['PaymentGateway']['name'] ?>.

Sua vaga na turma <?php echo $Student['MyClass'][0]['code'] ?> do Assando Sites está garantida!

Fique atento e não se esqueça do período de aulas:

<?php echo strip_tags($Student['MyClass'][0]['description']) . PHP_EOL ?>

Aguarde mais informações após o dia <?php echo $this->Time->format('d/m', $Student['MyClass'][0]['signup_limit']) ?>, quando as inscrições terminam e a organização da turma começa.

Para participar das aulas os alunos precisam apenas de um navegador atualizado e com suporte à Flash.

Caso tenha alguma dúvida, é só responder este email. :)