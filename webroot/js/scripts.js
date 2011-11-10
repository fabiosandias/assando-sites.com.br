(function($) {
	
	// Anima o botão de inscrição
	$('#topo .inscricao a.botao').addClass('animated bounceIn');
	
	// Faz links com rel=external abrirem em uma nova janela
	$('a[rel*=external]').attr('target', '_blank');

	// Esconde o radio e o submit da seleção de turmas
	$('input:radio, input:submit, label', '.inscricao.turmas #conteudo').hide();
	
	// Ao clicar na turma, marca o radio e envia o formulário
	$('.inscricao.turmas #conteudo #MyClassIndexForm article.turma').click(function(e){
		e.preventDefault();
		
		// Marca o input
		$('input:radio[value=' + $(this).data('turmaId') + ']', '.inscricao.turmas #conteudo').attr('checked', true);
		
		$('#MyClassIndexForm').submit();
	});
		
	// Rotaciona o avatar dos depoimentos
	$('section.depoimentos .avatar').each(function() {
		$(this).addClass(function() {
			return (Math.random() > 0.5) ? 'rotate-left' : 'rotate-right';
		});
	});
	
	// Anima o avatar dos depoimentos
	$('section.depoimentos article').hover(function() {
		$('.avatar', this).addClass('animated swing');
	}, function() {
		$('.avatar', this).removeClass('animated swing');
	});
	
	// Inscrição na newsletter
	$('#NewsletterSignupForm').submit(function() {
		var $form = $(this),
			data = $form.serialize(),
			url = $form.attr('action');

		$('input', $form).removeClass('error');

		$('input[type=submit]', $form).attr('disabled', true).css('visibility', 'hidden');
		$('.loading', $form).fadeIn();
		
		$.post(url, data, function(response) {
			$('input[type=submit]', $form).attr('disabled', false).css('visibility', 'visible');
			$('.loading', $form).stop().hide().css('opacity', 1);

			// Houve algum erro?
			if (response.errors && response.errors.length) {
				for (i in response.errors) {
					console.log('input[name*="' + response.errors[i] + '"]');
					$('input[name*="' + response.errors[i] + '"]', $form).addClass('error');
				}
			} else {
				alert('Inscrição realizada com sucesso!');
				$('input[type=text],input[type=email]', $form).val('');
			}
			
		}, 'json');
		
		return false;
	});
	
})(jQuery);

/**
 * Carrega scripts assíncronamente
 * 
 * @param script
 */
function loadAssync(script) {
	var po = document.createElement('script');
		po.type = 'text/javascript';
		po.async = true;
		po.src = script;

	var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(po, s);
}