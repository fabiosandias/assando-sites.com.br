<p style="font-size: 1.4em; color: #555">Olá <strong><?php echo $Student['name']?></strong>,</p>
<p>A sua nova senha de acesso ao <?php echo $this->Html->link('Painel do Aluno', $this->Html->url(array('controller' => 'students', 'action' => 'dashboard', 'aluno' => true), true)) ?> é:</p>
<div style="margin: 10px 0; padding: 10px 20px; background: #DBFFDB; border-radius: 6px; display: inline-block; font-size: 1.3em; font-family: monospace; letter-spacing: 3px"><?php echo $password ?></div>
<p>Mantenha esta senha em um local seguro e não compartilhe-a com ninguém!</p>
