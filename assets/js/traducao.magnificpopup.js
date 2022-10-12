jQuery(document).ready(function($) {
	$.extend(true, $.magnificPopup.defaults, {
		tClose: 'Fechar', // Alt text on close button
		tLoading: 'Carregando...', // Text that is displayed during loading. Can contain %curr% and %total% keys
		gallery: {
			tPrev: 'Anterior', // Alt text on left arrow
			tNext: 'Próximo', // Alt text on right arrow
			tCounter: '%curr% de %total%' // Markup for "1 of 7" counter
		},
		image: {
			tError: '<a href="%url%">A imagem</a> não pode ser carregada.' // Error message when image could not be loaded
		},
		ajax: {
			tError: '<a href="%url%">O conteúdo</a> não pode ser carregado.' // Error message when ajax request failed
		}
	});
});