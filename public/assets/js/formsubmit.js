$('document').ready(function () {
    $(document).on('submit', 'form:not(.validated, .not-ajax)', async function (e) {
       
        let handlers = $._data($(this)[0], 'events');
        let submitHandlers = handlers && handlers.submit ? handlers.submit.length : 0;
        // if (submitHandlers > 1) {
        //     return false;
        // }
        e.preventDefault();
        e.stopPropagation();
        let $form = $(this);
        let continueBTN = $(e.target).find(':submit:focus'); //$form.find('button');
        let defbtnText = continueBTN.text();
        continueBTN.startLoading();
        let formData = new FormData(this);
        if (!$form.hasClass('no-load')) {
            formData.append('prevalidate', 'true');
        }
        //replace mask phone number (000) 00-00-000
        await $form.find('[name="phone"]').each(function(){
            formData.append('phone', $(this).val().replace(/\D/g, '')); 
        });
        
        await $form.find('[name="s_phone"]').each(function(){
            formData.append('s_phone', $(this).val().replace(/\D/g, '')); 
        });
        
        await $form.find('[name="b_phone"]').each(function(){
            formData.append('b_phone', $(this).val().replace(/\D/g, '')); 
        });
             
        
      
        
        if ($form.attr('data-appends')) {
            try {
                let appends = JSON.parse($form.attr('data-appends'));
                for (let key in appends) {
                    let data = eval(appends[key]);
                    if (data && data != undefined){
                        if(Array.isArray(data)){
                            for (var i = 0; i < data.length; i++) {
                                formData.append(`${key}[]`, data[i].file);
                            }
                        }else{
                            formData.append(key, eval(appends[key]));
                        }
                    }
                }
            } catch (error) {
            }
        }
        
        try {
            await $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                //data: $form.serialize(),
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    $("#loader-overlay").fadeOut();
                    if ($form.attr('data-callback')){
                         $form.addClass('validated');
                            window[$form.attr('data-callback')]($form, data);
                            
                        return false;
                    }
                            
                    if (!$form.hasClass('no-load')) {
                        $form.addClass('validated');
                        if ($form.attr('data-classes'))
                            $form.addClass($form.attr('data-classes'));
                            
                        $form.submit();
                        $("#loader-overlay").fadeIn();
                    } else {
                        if ($form.attr('data-callback'))
                            window[$form.attr('data-callback')](data);
                    }
                },
                error: function (data) {
                    makeError2(data, $form);
                }
            });
        } catch (e) { }
        continueBTN.stopLoading(defbtnText);
    });
    $(document).on('submit', 'form.validated', async function (e) {
        $(this).removeClass('validated');
    });
    $(document).on('change', '.element-error *', function () {
        $(this).closest('.element-error').removeClass('element-error');
    });
});
const makeError2 = function (data = null, $form) {
    if (data && data.responseJSON)
        return handleAPIErrors2(data.responseJSON, $form);
    // else
        // toast('Something went wrong, please try again later.', 'warning')
}
const handleAPIErrors2 = async function (result, $form) {

    $('.form-group').removeClass('error');
    let html = '';
    await $.each(result.errors, async function (key, values) {
      
        $.each(values, function (i, error) {
            html += `<p>${error}</p>`;
        })
        
        if(key == 'g-recaptcha-response'){ 
            $('.g-captcha-error').html(values[0]);
        }
        
        let keyNames = key.split(".");
        let keyName = keyNames[0];
        keyNames.shift();
        keyNames.forEach(function (v) {
            keyName += `[${v}]`;
        });
        try {
   
            if ($form.find(`[name="${keyName}"]`).length > 1) {
                var childCount = $form.find(`[name="${keyName}"]`).length;
                var parentElement = await $form.find(`[name="${keyName}"]`).eq(0).parents().filter(function () {
                    return $(this).find(`[name="${keyName}"]`).length === childCount;
                }).eq(0);
                parentElement.addClass('element-error').attr('data-error', values[0]);
            } else {
                $form.find(`[name="${keyName}"]`).parent().addClass('element-error').attr('data-error', values[0]);
            }

        }
        catch (e) { 
            
                console.log(e);
        }
    });
    html = `<div class="APIerrors">${html}</div>`;
    // toastAPIError(result.message, html);
}
/**
 * Make ajax error
 * @param {*} data 
 * @returns 
 */
$(function () {
    $.fn.startLoading = function (args) {
        swal.close();
        $(this).each(function () {
             $("#loader-overlay").fadeIn();
            $(this).html(`Please hold on`).attr('disabled', true);
        })
        return this;
    };
    $.fn.stopLoading = function (defbtnText) {
        $(this).each(function () {
             $("#loader-overlay").fadeOut();
            $(this).html(defbtnText).removeAttr('disabled', true);
        })
        return this;
    };
})


/**
 * =============================================================================================================
 * =============================================================================================================
 */