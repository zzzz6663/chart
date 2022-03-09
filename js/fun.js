function escapeHtml(text) {
    if (text.length>0){
        return text.trim()
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }else {
        return ' ';
    }

}

function note_success(str ,element ){
    $("body").overhang({
        type: "success",
        message: str
    });

}
function note_error(str,element){
    $("body").overhang({
        type: "error",
        message: str,
        closeConfirm: false
    });
}

function load_animation(){
    $('body').loadingModal({
        position:'auto',
        text:'لطفا صبر نمایید .....',
        color:'#fff',
        opacity:'0.7',
        backgroundColor:'rgb(۲۵,۱۰۹,۱۸۰)',
        animation:'cubeGrid'
    });
}
function stop_animation(){
    $('body').loadingModal('destroy');
}

function valid_form(form,url) {
    var ss=form+' *';
             var form=$('#'+form);
        if(!form.valid()){
            $('#'+ss).filter(':input[required]:visible').each(function(){
                var element=$(this);
                if (!element.valid()) {
                    element.removeClass('animated bounce');
                    note_error('تمام فیلد ها را به درستی وارد کنید  ',element)
                    setTimeout(function(){element.addClass('animated bounce');}, 1000);
                    return  false
                }
            });
            return  false
        }else {
            var str = form.serializeArray();
            // console.log(str)

            $.ajax(path+url,{
                type:'post',
                data: str,
                async:false,
                success:function (data) {
                    console.log(data)
                    note_success( 'ثبت شد ',form)
                    form.each(function(){
                        this.reset();
                    });

                },
                error: function (request, status, error) {
                }
            });
            return  true
        }
}
function downloadURI(uri, name) {
    var link = document.createElement("a");

    link.download = name;
    link.href = uri;
    document.body.appendChild(link);
    link.click();
    link='';

}
function  simple_ajax(url,str='' ){
    console.log(str)
    var dd;
    $.ajax(path+url,{
        data: str,
        type:'post',
        success:function (data) {
            console.log('simple_ajax'+data)
            return dd=data

        },
        error: function (request, status, error) {
        }
    });
}

