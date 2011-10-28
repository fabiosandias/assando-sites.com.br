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
	
	// Reordena os depoimentos e esconde > 4
	$depoimentos = $('section.depoimentos article');
	$depoimentos.sort(function() { return (Math.round(Math.random())-0.5); });
	$('section.depoimentos article').remove();
	$('section.depoimentos').append($depoimentos);
	$('section.depoimentos article:gt(3)').hide();
	
	
	$('section.depoimentos article').hover(function() {
		$('.avatar', this).addClass('animated swing');
	}, function() {
		$('.avatar', this).removeClass('animated swing');
	});
		
	// Rotaciona o avatar dos depoimentos
	$('section.depoimentos .avatar').each(function() {
		$(this).addClass(function() {
			return (Math.random() > 0.5) ? 'rotate-left' : 'rotate-right';
		});
	});
	
})(jQuery);