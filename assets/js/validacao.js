const spinnerLoading = `
<div class="loadingLoginContratante text-center">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div> 
`;

const ValidacaoPadrao = function(classeCss, $ = jQuery) {
    var erros = 0;
    var msgErro = '<span role="alert" class="wpcf7-not-valid-tip">O campo é obrigatório.</span>';
    var findErro = 'span.wpcf7-not-valid-tip';

    $(classeCss).each(function(index) {
        if ($(this).prop('required') == true && $(this).val().trim().length <= 0) {
            ($(this).parent().find(findErro).length <= 0) ? $(this).parent().append(msgErro): '';
            erros++;
        } else {
            $(this).parent().find(findErro).remove();
        }
    });
    return (erros == 0) ? true : false;
}

const ValidacaoRadio = function($ = jQuery) {
    var erros = 0;
    var msgErro = '<span role="alert" class="wpcf7-not-valid-tip">O campo é obrigatório.</span>';
    var findErro = 'span.wpcf7-not-valid-tip';

    $('.rdoButtonPadrao').each(function(index) {

        if ($(this).find('input[type="radio"]').prop('required') == true && $(this).find('input[type="radio"]').is(':checked') == false) {
            ($(this).parent().find(findErro).length <= 0) ? $(this).parent().append(msgErro): '';
            erros++;
            // console.log('tem erro');
        } else {
            $(this).parent().find(findErro).remove();
            // console.log('não tem erro');
        }
    });

    return (erros == 0) ? true : false;
}

const ValidaTermo = function($ = jQuery) {
    var erros = 0;
    var msgErro = '<span role="alert" class="wpcf7-not-valid-tip">O campo é obrigatório.</span>';
    var findErro = 'span.wpcf7-not-valid-tip';
    var termo = $('input[name="termo[]"]');

    if (termo.is(':checked') == false) {
        (termo.parent().find(findErro).length <= 0) ? termo.parent().append(msgErro): '';
        erros++;
    } else {
        termo.parent().find(findErro).remove();
    }

    return (erros == 0) ? true : false;
}

const disableForm = function($form, $ = jQuery) {
    if (typeof $form != typeof undefined) {
        $('input, select, button, textarea, radio, number, date', $form).attr('disabled', true);
    }
};
const enableForm = function($form, $ = jQuery) {
    if (typeof $form != typeof undefined) {
        $('input, select, button, textarea radio, number, date', $form).attr('disabled', false);
    }
};
const cleanValuesForm = function($form, $ = jQuery) {
    if (typeof $form != typeof undefined) {
        $('input, select, textarea', $form).val('');
        $('input[type="radio"], input[type="checkbox"]', $form).prop('checked', false);
        $('input[name="termo[]"]', $form).attr('checked', false);
        $('.lblTermo', $form).find('.checkbox').removeClass('ativo');
    }
};