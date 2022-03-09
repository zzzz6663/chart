var path='/chart/'
function printDiv(divToPrint)
{


    var newWin=window.open('','Print-Window');

    newWin.document.open();

    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

    newWin.document.close(); 

    setTimeout(function(){newWin.close();},10);

}
function loading_setting_body(pageindex=1 ,search='') {
    var setting_body=$('#setting_body');
    if (typeof(search) != "undefined" && search !== null){
        search=escapeHtml(search);
    }

    $.ajax(path+'setting/loading_setting_body/'+pageindex+'/'+search,{
        type:'post',
        dataType: 'json',
        success:function (data) {
            console.log(data.htm)
            setting_body.html(data.htm);
            setting_body.show(200);
            var bloodpressure_lab_report=  $("#uploadDivId").uploadFile({
                url:path+"login/upload",
                maxFileCount:1,
                autoSubmit: true,
                showProgress: true,
                allowedTypes:"*",
                fileName:"myfile",
                onSuccess:function(files,data,xhr,pd)
                {
                    bloodpressure_lab_report.reset()
                    note_success('با موفقیت اپدیت شد ')
                }

            });

        },
        error: function (request, status, error) {
            stop_animation()
            console.log('error'+error)
                note_error('ارتباط با سرور  برقرار نیست ')
        }
    });
}


function changedashboard(option=11,id=''){
    // load_animation()
    var content=$('#content');
    content.empty();
    var goal=null;
    switch (option) {
        case 90: goal=path+'setting/load_setting_head';
            setTimeout(
                function()
                {
                    loading_setting_body()
                }, 700);break;

    }
    content.hide(400);
    $.ajax(goal,{
        type:'post',
        dataType: 'json',
        success:function (data) {
            content.html(data.htm);
            content.show(200);
        },
        error: function (request, status, error) {
            // stop_animation()
            //     note_error('ارتباط با سرور  برقرار نیست ')
            // alert(error);
        }
    });

}


var num;
var p=0;
jQuery(document).ready(function($){
    changedashboard(90);
    $('.editable').jinplace();

    var selector = document.getElementById("start_year");

    // var im = new Inputmask("999-999-999-999-999-999-999-999");
    // im.mask(selector);

    var options = {
        chart: {
            type: 'line'
        },
        series: [
            {
                name: 'sales',
                data: [44, 55, 41, 64, 22, 43, 21]
            },
            {
                name: 'sss',
                data: [53, 32, 33, 52, 13, 44, 32]
            }
        ],

        xaxis: {
            categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
        }
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    // chart.render();

    function saveAs(uri, filename) {
        var link = document.createElement('a');
        if (typeof link.download === 'string') {
            link.href = uri;
            link.download = filename;

            //Firefox requires the link to be in the body
            document.body.appendChild(link);

            //simulate click
            link.click();

            //remove the link when done
            document.body.removeChild(link);
        } else {
            window.open(uri);
        }
    }
    //*
     // global variable
    var getCanvas; // global variable


    function PDF1(){
        var doc = new jsPDF();
        // var elementHandler = {
        //     '#ignorePDF': function (element, renderer) {
        //         return true;
        //     }
        // };
        var source = window.document.getElementsByTagName("body")[0];
        doc.fromHTML(
            source,
            15,
            15,
            {
                'width': 180,'elementHandlers': elementHandler
            });

        doc.output("datauri");
    }

//*
    $('body').on('click','.export',function(){
        // var element=$(this)
        // var id = element.attr('data-id')
        // console.log('id+ '+id)
        // var  el=$('#'+id)[0]
        // html2canvas(document.querySelector("#capture")).then(function (canvas) {
        //     document.body.appendChild(canvas)
        //     console.log(canvas.toDataURL("image/jpeg", 0.9));
        //     downloadURI(canvas.toDataURL("image/jpeg",0.9),'sss');
        // });
        window.location = path+"login/pdf/pdf";

    });
    $('body').on('click','.reload',function(){
        const element = document.getElementById("capture");
        // Choose the element and save the PDF for our user.

        // html2pdf()
        //     .from(element)
        //     .save();

        // var doc = new jsPDF()
        // doc.html('Hello world!')
        // // doc.text('Hello world!', 10, 10)
        // doc.save('a4.pdf')
        // html2canvas(document.querySelector("#capture")).then(function (canvas) {
        //     document.body.appendChild(canvas)
        //     console.log(canvas.toDataURL("image/jpeg", 0.9));
        //     downloadURI(canvas.toDataURL("image/jpeg",0.9),'sss');
        // });
               location.reload();
    });
    $('body').on('click','.update_sec',function(){
        var element=$(this);
        var username =$('#username').val();
        var password =$('#password').val();
        if (username.length<3){note_error('حداقل 3 کاراکتر برای نام کاربری انتخاب کنید'); return}
        if (password.length<3){note_error('حداقل 3 کاراکتر برای   رمز عبور انتخاب کنید');return}
        $.ajax(path+'login/update_password/'+username+'/'+password,{
            type:'post',
            success:function (data) {
                console.log(data)
                note_success('اطلاعات به روز شد ')
            },
            error: function (request, status, error) {
                stop_animation()
                // note_error('ارتباط با سرور  برقرار نیست ')
            }
        });


    });
    $('body').on('click','.sv',function(){
        window.print()
    });
    $('body').on('click','.update_setting',function(){
        var element=$(this);
        var id=element.attr('data-id')
        var val= $('#ex1').val();
        if (val.length<10){
            note_error('حداقل 10 کراکتر مشخص نمایید')
            return
        }
        $.ajax(path+'login/update_option/'+val+'/'+id,{
            type:'post',
            success:function (data) {
                console.log(data)
                note_success('اطلاعات به روز شد ')
            },
            error: function (request, status, error) {
                stop_animation()
                // note_error('ارتباط با سرور  برقرار نیست ')
            }
        });
    });
    $('body').on('dblclick','.reset_amar',function(){
        $.ajax(path+'login/reset_amar/',{
            type:'post',
            success:function (data) {
                console.log(data)
                note_success('اطلاعات صفر شد  ')
                loading_setting_body()
            },
            error: function (request, status, error) {
                stop_animation()
                // note_error('ارتباط با سرور  برقرار نیست ')
            }
        });
    });
    $('body').on('focusout','.hval',function(){
        var element=$(this);
        if (element.val().length==0){
            element.val('0')
        }
    });
    $('body').on('focus','.hval',function(){
        var element=$(this);
        element.val('')
    });
    $('body').on('focus','.select',function(){
        var element=$(this);
        element.val('')
    });
    $('body').on('click','#cal',function(){

        p=0;
        var element=$(this);
        var city1=$('#city1').val();
        var city2=$('#city2').val();
        var start=$('#start_year').val();
        if (!city1 || !city2){
           note_error('لطفا شهر خود را بنویسید ')
            return;
        }
        if (!$('#role').is(":checked")){
            note_error('لطفا قوانین رو مطالعه کنید ')
            return;
        }

        start=Number(start);

        var end=$('#end_year').val();
        end=Number(end);
        end=end+1
        if (!end || !start) { note_error('لطفا سال شروع و پایان  رو  به درستی وارد کنید ')  ;   return}
        if ( end-start>10 || end-start<1){
            note_error(' بازه زمانی باید بین یک تا ده سال باشد مثلا از سال 2001  تا  سال 2010')
            return
        }
        num= end-start;
        var str='end='+end+'&start='+start+'&city1='+city1+'&city2='+city2
        load_animation()

        $.ajax(path+'login/calculate',{
            type:'post',
            data: str,
            dataType: 'json',
            success:function (data) {
                stop_animation()
                // console.log(data.htm)
                $('#show_forms').html(data.htm)
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#show_forms").offset().top
                }, 500);
                $('.money').mask('000,000,000,000,000,000,000,000,000,000' ,{reverse: true} );
                // element.hide(400)
            },
            error: function (request, status, error) {
                stop_animation()
                note_error('ارتباط با سرور  برقرار نیست ')

            }
        });
    });

    $('body').on('click','#finish',function(){

        var ch1=$('.ch1').val();var gh1=$('.gh1').val();var title1= $('.ch1').eq(0).siblings('label').text()
        if (ch1==0&&gh1==0){note_error(title1 + ' هر دو شهر نباید صفر باشد');return;}


        var ch2=$('.ch2').val();var gh2=$('.gh2').val();var title2= $('.ch2').eq(0).siblings('label').text()
        if (ch2==0&&gh2==0){note_error(title2 + ' هر دو شهر نباید صفر باشد');return;}

        var ch3=$('.ch3').val();var gh3=$('.gh3').val();var title3= $('.ch3').eq(0).siblings('label').text()
        if (ch3==0&&gh3==0){note_error(title3 + ' هر دو شهر نباید صفر باشد');return;}

        var ch4=$('.ch4').val();var gh4=$('.gh4').val();var title4= $('.ch4').eq(0).siblings('label').text()
        if (ch4==0&&gh4==0){note_error(title4 + ' هر دو شهر نباید صفر باشد');return;}

        var ch5=$('.ch5').val();var gh5=$('.gh5').val();var title5= $('.ch5').eq(0).siblings('label').text()
        if (ch5==0&&gh5==0){note_error(title5 + ' هر دو شهر نباید صفر باشد');return;}

        var ch6=$('.ch6').val();var gh6=$('.gh6').val();var title6= $('.ch6').eq(0).siblings('label').text()
        if (ch6==0&&gh6==0){note_error(title6 + ' هر دو شهر نباید صفر باشد');return;}

        var ch7=$('.ch7').val();var gh7=$('.gh7').val();var title7= $('.ch7').eq(0).siblings('label').text()
        if (ch7==0&&gh7==0){note_error(title7 + ' هر دو شهر نباید صفر باشد');return;}


        var element=$(this);

        var formname='info_'+(Number(p+1))
        var form=$('#'+formname)
        if (form.valid()){
            var str = form.serializeArray();
            load_animation()
            $.ajax(path+'login/check_form/'+(p+1)+'/5',{
                type:'post',
                data: str,
                dataType: 'json',
                success:function (data) {
                    stop_animation()
                    setTimeout(
                        function()
                        {
                            $("#show_forms2").html(data.htm)
                        }, 500);
                    setTimeout(
                        function()
                        {
                            $([document.documentElement, document.body]).animate({
                                scrollTop: $("#final").offset().top
                            }, 1000);
                            $('.editable').jinplace();
                        }, 600);

                },
                error: function (request, status, error) {
                    console.log('errorf'+error)
                    stop_animation()
                note_error('ارتباط با سرور  برقرار نیست ')
                }
            });
        }else {
            var formname2 =   'info_'+(Number(p+1))+' *'
            $('#'+formname2).filter(':input[required]:visible').each(function(){
                var element=$(this);
                if (!element.valid()) {
                    if ($(window).width()<700){
                        $([document.documentElement, document.body]).animate({
                            scrollTop: (element.offset().top-200)
                        }, 500);
                    }
                    element.removeClass('animated bounce');
                    setTimeout(function(){element.addClass('animated bounce');}, 1000);
                    return false
                }
            });
        }
        console.log('is isssss'+p)
    });
    $('body').on('click','#next',function(){
        // alert($('.part_section ').length)
        var ch1=$('.ch1').val();var gh1=$('.gh1').val();var title1= $('.ch1').eq(0).siblings('label').text()
        if (ch1==0&&gh1==0){note_error(title1 + ' هر دو شهر نباید صفر باشد');return;}


        var ch2=$('.ch2').val();var gh2=$('.gh2').val();var title2= $('.ch2').eq(0).siblings('label').text()
        if (ch2==0&&gh2==0){note_error(title2 + ' هر دو شهر نباید صفر باشد');return;}

        var ch3=$('.ch3').val();var gh3=$('.gh3').val();var title3= $('.ch3').eq(0).siblings('label').text()
        if (ch3==0&&gh3==0){note_error(title3 + ' هر دو شهر نباید صفر باشد');return;}

        var ch4=$('.ch4').val();var gh4=$('.gh4').val();var title4= $('.ch4').eq(0).siblings('label').text()
        if (ch4==0&&gh4==0){note_error(title4 + ' هر دو شهر نباید صفر باشد');return;}

        var ch5=$('.ch5').val();var gh5=$('.gh5').val();var title5= $('.ch5').eq(0).siblings('label').text()
        if (ch5==0&&gh5==0){note_error(title5 + ' هر دو شهر نباید صفر باشد');return;}

        var ch6=$('.ch6').val();var gh6=$('.gh6').val();var title6= $('.ch6').eq(0).siblings('label').text()
        if (ch6==0&&gh6==0){note_error(title6 + ' هر دو شهر نباید صفر باشد');return;}

        var ch7=$('.ch7').val();var gh7=$('.gh7').val();var title7= $('.ch7').eq(0).siblings('label').text()
        if (ch7==0&&gh7==0){note_error(title7 + ' هر دو شهر نباید صفر باشد');return;}
















        var element=$(this);
        var formname='info_'+(Number(p+1))
        console.log('is isssss'+p)
        console.log('formname'+formname)
        var form=$('#'+formname)
        if (form.valid()){
        var num=element.attr('data-num')
        $('.part_section ').eq(p).addClass('hide')
        $('.part_section ').eq(p+1).removeClass('hide')
        p++
            var str = form.serializeArray();
                console.log('pp is'+p)
            $.ajax(path+'login/check_form/'+p,{
                type:'post',
                data: str,
                dataType: 'json',
                success:function (data) {
                },
                error: function (request, status, error) {
                    console.log('errorn'+error)
                    stop_animation()
                note_error('ارتباط با سرور  برقرار نیست ')
                }
            });
        if (p==(num-1)){
            element.addClass('hide')
            $('#finish').show(400)
        }else {
            element.removeClass('hide')
            $('#finish').hide(400)
        }
        if (p==0){
            $('#perv').addClass('hide')
        }else {
            $('#perv').removeClass('hide')
        }


        }else {
            var formname2 =   'info_'+(Number(p+1))+' *'
            $('#'+formname2).filter(':input[required]:visible').each(function(){
                var element=$(this);
                if (!element.valid()) {
                    if ($(window).width()<700){
                        $([document.documentElement, document.body]).animate({
                            scrollTop: (element.offset().top-200)
                        }, 500);
                    }
                    element.removeClass('animated bounce');
                    setTimeout(function(){element.addClass('animated bounce');}, 1000);
                    return false
                }
            });
            return
        }

    });
    $('body').on('click','#perv',function(){
        // alert($('.part_section ').length)
        var element=$(this);
        $('.part_section ').eq(p).addClass('hide')
        $('.part_section ').eq(p-1).removeClass('hide')
        p--
        if (p==(num-1)){
            $('#next').addClass('hide')
            $('#finish').show(400)
        }else {
            $('#next').removeClass('hide')
            $('#finish').hide(400)
        }
        if (p==0){
            element.addClass('hide')
        }else {
            element.removeClass('hide')
        }
        console.log('is perv isssss'+p)

    });








    //========== silde bar and login start   ===============//


    $('body').on('click','#login_btn',function(){
        var element=$(this);
        var username= $('#username').val(); username=username.trim()
        var password= $('#password').val(); password=password.trim()
        if (username.length<2||password.length<2){
            note_error('اطلاعات رو به درستی وارد کنید ' ,$(this));
            return
        }
    var  str= $('#log_form').serialize()
        $.ajax(path+'login/check_login/',{
            type:'post',
            data: str,
            success:function (data) {
                console.log('data'+data)
                if (data==200){
                    window.location = path+"dashboard/dash";
                    return
                }
                if (data==0){
                    note_error('شما ادمین نیستید',element)
                    return;
                }
                if (data==101){
                    note_error('شما ادمین نیستید',element)
                    return;
                }
            },
            error: function (request, status, error) {
                stop_animation()
                note_error('ارتباط با سرور  برقرار نیست ')
            }
        });
    });

    $('body').on('click','.side_menu',function(){
        var clicked=$(this);
        var option = clicked.attr("data-option");
        $(".side_menu").removeClass('active');
        clicked.addClass('active');
        changedashboard(Number(option));
    });
    //========== silde bar and login end   ===============//


})