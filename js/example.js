function changedashboard(option=1){
    var content=$('#content');
    var goal=null;
    Cookies.remove('level');
    switch (option) {
        case 1: goal='/admin/dashbord/dashbord ';     Cookies.set('level', '1');  break;
        case 2: goal='/admin/myrequest/myrequest' ; Cookies.set('level', '2');
            setTimeout(
                function()
                {
                    members(1);
                }, 100);

            break;
        case 3: goal='/admin/financial/financial ' ;Cookies.set('level', '3');
            setTimeout(
                function()
                {
                    members(1);

                }, 100);
            setTimeout(
                function()
                {
                    get_basic_price();

                }, 200);

            break;

        case 4: goal='/admin/admins/admins' ;Cookies.set('level', '4');
            setTimeout(
                function()
                {
                    members(1);
                    selectadmin();
                }, 100);

            break;
        case 5: goal='/admin/servs/servs';Cookies.set('level', '5');

            setTimeout(
                function()
                {
                    readserv();
                }, 100);
            break;
    }
    content.hide(400);
    $.ajax(goal,{
        type:'post',
        dataType: 'json',
        success:function (data) {

            content.empty();
            content.html(data.htm);
            content.show(400);
            if ($('#content').length){
                setTimeout(
                    function()
                    {
                        $('html, body').animate({
                            scrollTop: ($('#content').first().offset().top)
                        },600)
                    }, 50);
            }

        },
        error: function (request, status, error) {
            // alert(error);
        }
    });

}

function escapeHtml(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
function backtopanel() {
    setTimeout(
        function()
        {
            window.location = "/admin/panel/panel";
        }, 1000);
}
function readserv() {

    $.ajax('/admin/servs/readserv',{
        type:'post',

        dataType: 'json',
        success:function (data) {



            $('.showservsoption1').html(data.serv1);
            $('.showservsoption2').html(data.serv2);
            $('.showservsoption3').html(data.serv3);
            $('.showservsoption4').html(data.serv4);
            $('.showservsoption5').html(data.rols);
        },
        error: function (request, status, error) {
            // alert(error);
        }
    });
}
function selectadmin() {
    $.ajax('/admin/admins/selectadmin',{
        type:'post',
        success:function (data) {
            $('#admintbody').html(data);
        },
        error: function (request, status, error) {
            // alert(error);
        }
    });
}

function members(pageIndex, sort = 1 ,sortadmin="1",search=''){



    sumserv=0;
    $('#listcont').hide(400);
    $.ajax('/admin/myrequest/members/'+pageIndex+'/'+sort+'/'+sortadmin+'/'+search,{
        type:'post',
        dataType: 'json',
        success:function (data) {
            // $('#listcont').fadeOut(100);

            $('#listcont').html(data.htm );
            // $('#listcont').fadeIn(300);
            $('#listcont').show(300);
            $("#sort").val(sort);
            // $('html, body').animate({
            //     scrollTop: ($('#content').first().offset().top)
            // },500)

        },
        error: function (request, status, error) {
            // alert(error);
        }
    });
}


function load_animation(){
    $(document.body).ajaxloader({
        cssClass: 'cssload_colordots',
    });
}
function stop_animation(){
    $(document.body).ajaxloader("stop");
}
//=================COMON FUNC  end===============
// $('body').on('click','#backtopanel',function(){
//     window.location = "/admin/panel/root";
// });



jQuery(document).ready(function($){

    $('body').on('click','#main #sidebar .sidemenu ul li',function(){
        var windowsize = $(window).width();

        if (windowsize<720){
            $('#sidebar').hide(500);
        }
    });

    $('body').on('click','#menuicon',function(){
        $('#sidebar').show(300);



    });
    readserv();
    var  cook= Cookies.get('level');
    $(".sidemenu ul li.active").removeClass("active");
    if(typeof(cook) != "undefined" && cook !== null) {
        switch (Number(cook)) {

            case 1:  changedashboard(1); $( ".sidemenu ul li:nth-child(1)" ).addClass('active'); break;
            case 2: changedashboard(2); $( ".sidemenu ul li:nth-child(2)" ).addClass('active'); break;
            case 3: changedashboard(3); $( ".sidemenu ul li:nth-child(3)" ).addClass('active'); break;
            case 4: changedashboard(4); $( ".sidemenu ul li:nth-child(4)" ).addClass('active'); break;
            case 5: changedashboard(5); $( ".sidemenu ul li:nth-child(5)" ).addClass('active'); break;
        }

    }else {
        changedashboard(1);
    }

    //=================login FUNC  START===============
    $('body').on('click','.backclick',function(){
        var level = $(this).attr("data-level");

        window.location = "/admin/panel/panel";

    });
    $('body').on('click','#loginbut',function(){
        var self = $(this);
        var  username  = escapeHtml( $("#username").val());
        var  pass  = escapeHtml( $("#pass").val());
        var v = grecaptcha.getResponse();

        if(v.length == 0)
        {
            notif({
                msg:  "لطفا تیک من ربات نیستم را بزنید",
                type: "error"
            });

            return;
        }
        if(pass.length == 0)
        {
            notif({
                msg:  "لطفا رمز عبور را وارد کنید",
                type: "error"
            });

            return;
        }
        if(username.length <2)
        {
            notif({
                msg:  "نام کاربری خود را به درستی وارد کنید",
                type: "error"
            });

            return;
        }

        var str = 'username='+ username+'&pass='+pass;
        $.ajax('/admin/login/checkpass',{
            type:'post',
            data: str,
            success:function (data) {
                if (data==1){
                    window.location = "/admin/panel/panel";
                }else {
                    notif({
                        msg: "اطلاعات شما صحیح نیست" ,
                        type: "error"
                    });
                }
            },
            error: function (request, status, error) {
                // alert(error);
            }
        });
    });
    //=================login FUNC  end ===============
    //=================panel    start ===============




    $('body').on('click','.options',function(){
        var options = $(this);
        var option = options.attr("data-option");
        $( ".options" ).removeClass( "active" );
        options.addClass('active');
        changedashboard(Number(option));
        readserv();
    });

    //=================panel    end ===============



    //================= myrequest    start ===============

    $('body').on('click','#new_request',function(){

        $("#getmobile").modal({
            fadeDuration: 500,
            fadeDelay: 0.30,
            escapeClose: true,
            clickClose: true,
        });

    });
    $('body').on('click','#deactive',function(){
        load_animation();
        var common = $(this).attr("data-common");
        var str = 'common='+common;
        $.ajax('/admin/myrequest/deactiverequest',{
            type:'post',
            data: str,
            success:function (data) {
                stop_animation();
                $.modal.close();
                notif({
                    msg: "درخواست غیر فعال شد " ,
                    type: "success"
                });

                window.location = "/admin/panel/panel/";
            },
            error: function (request, status, error) {
                // alert(error);
            }
        });
    });
    $('body').on('click','#noactive_history',function(){

        $("#noactive").modal({
            fadeDuration: 500,
            fadeDelay: 0.30,
            escapeClose: true,
            clickClose: true,
        });

        $('.active_user_now').click(function () {
            load_animation();
            var common = $(this).attr("data-common");
            var str = 'common='+common;
            $.ajax('/admin/myrequest/activerequest',{
                type:'post',
                data: str,
                success:function (data) {
                    stop_animation();
                    $.modal.close();
                    notif({
                        msg: "درخواست   فعال شد" ,
                        type: "success"
                    });

                    changedashboard(2);
                },
                error: function (request, status, error) {
                    // alert(error);
                }
            });
        });

    });
    $('body').on('click','#go_new_request',function(){
        var master=  $('#master').val();
        master =escapeHtml(master);
        if (master.length<11){
            notif({
                msg:  "لطفا همراه را به درستی وارد کنید ",
                type: "error"
            });
            return;
        }
        window.location = "/order/panel/goto_new_admin_request/"+master;
    });
    $('body').on('change','#sortadmin',function(){
        var sortadmin = $(this).find(":selected").val();
        var sort = $('#sort').find(":selected").val();
        sortadmin=escapeHtml(sortadmin);
        members(1,  sort, sortadmin);

    });
    $('body').on('change','#sort',function(){
        var sort = $(this).find(":selected").val();
        var sortadmin = $('#sortadmin').find(":selected").val();
        sort=escapeHtml(sort);
        members(1,  sort, sortadmin);

    });

    $('body').on('change','.changestatus',function(){
        var modal = $(this).attr("data-dialog");

        var  changestatus = $(this);
        $("#"+modal).modal({
            fadeDuration: 500,
            fadeDelay: 0.30,
            escapeClose: false,
            clickClose: false,
        });

        $( "#"+modal ).children( ".no_delete" ).click(function () {

            $.modal.close();

        });
        $( "#"+modal ).children( ".yes_delete" ).click(function () {


            // var select=  $(this);
            var common = changestatus.attr("data-common");
            var new_status = changestatus.find(":selected").val();

            if (new_status==3){
                $(".uploaddialog"+common).modal({
                    fadeDuration: 500,
                    fadeDelay: 0.30,
                    escapeClose: false,

                });
                var upload=   $(".fileuploader").uploadFile({
                    url:"/admin/myrequest/uploadfile",
                    dragDrop:true,
                    fileName:"myfile",
                    showProgress:true,
                    formData: {"common":common},
                    autoSubmit:false,
                    allowedTypes:"jpg,png,pdf,doc,docx",
                    onSuccess:function(files,data,xhr,pd)
                    {
                        var  stat=     upload.getResponses();

                        stat = JSON.parse(stat);
                        var  status=  stat.status ;


                        if ( status =='ok'){
                            $.modal.close();
                            notif({
                                msg: "فایل  با موفقیت اپلود شد " ,
                                type: "success"
                            });
                            var master = changestatus.attr("data-master");
                            var common = changestatus.attr("data-common");
                            new_status=escapeHtml(new_status);
                            master=escapeHtml(master);
                            common=escapeHtml(common);
                            var str = 'master='+ master+'&common='+common+'&status='+new_status;
                            $.ajax('/admin/myrequest/changestatus',{
                                type:'post',
                                data: str,
                                success:function (data) {
                                    stop_animation();
                                    notif({
                                        msg: "وضعیت تغییر کرد" ,
                                        type: "success"
                                    });
                                },
                                error: function (request, status, error) {
                                    // alert(error);
                                }
                            });
                            // members(1 ,)

                        } else {
                            notif({
                                msg: "فایل  اپلود نشد " ,
                                type: "error"
                            });
                            return;
                        }
                    }
                });

                $('.upload').click(function () {

                    upload.startUpload();
                    load_animation();


                });





            }else {
                load_animation();
                var master = changestatus.attr("data-master");
                // var common = select.attr("data-common");
                new_status=escapeHtml(new_status);
                master=escapeHtml(master);
                common=escapeHtml(common);
                var str = 'master='+ master+'&common='+common+'&status='+new_status;

                $.ajax('/admin/myrequest/changestatus',{
                    type:'post',
                    data: str,
                    success:function (data) {
                        $.modal.close();
                        stop_animation();

                        notif({
                            msg: "وضعیت تغییر کرد" ,
                            type: "success"
                        });
                    },
                    error: function (request, status, error) {
                        // alert(error);
                    }
                });
            }


        });
    });

    $('body').on('click','#searchbut',function(){


        var search = $('#searchinput').val();
        search=escapeHtml(search);
        if (search.length<3) {
            notif({
                msg: "حداقل سه کاراکتر وارد کنید" ,
                type: "error"
            });
            return;
        }

        members(1, Number('7'),search);
    });



    $('body').on('click','.seemodeal',function(){
        var modal = $(this).attr("data-seesitch");

        $("#"+modal).modal({
            fadeDuration: 500,
            fadeDelay: 0.30,
            escapeClose: false
        });
        // $(".seebox").modal({
        //     // escapeClose: true,
        //     // clickClose: true,
        //     // showClose: false,
        //     // fadeDuration: 500,
        //     // fadeDelay: 0.50
        // });
        // });
        // alert('sss');
    });
    //================= myrequest    end ===============






















    //================= servs and rols    end ===============
    var serv_type;

    $('body').on('click','.submitserv',function(){

        var serv_type = $('#serv').find(":selected").val();
        serv_type =escapeHtml(serv_type);
        var serv=  $('#servinput').val();
        serv =escapeHtml(serv);
        $('#servinput').val(' ');

        if (serv.length<11){
            notif({
                msg:  "طول متن باید بیشتر  از ده کاراکتر باشد  ",
                type: "error"
            });

            return;
        }
        var str = 'type='+ serv_type+'&serv='+serv;
        $.ajax('/admin/servs/submitServs',{
            type:'post',
            data: str,
            success:function (data) {

                notif({
                    msg: "اطلاعات شما ثبت شد" ,
                    type: "success"
                });
                readserv();
            },
            error: function (request, status, error) {
                // alert(error);
            }
        });
    });


    $('body').on('click','.removeserv',function(){
        selfr=$(this);
        var  id=  selfr.data("id");

        var str = 'id='+ id;
        $.ajax('/admin/servs/removeserv',{
            type:'post',
            data: str,
            dataType: 'json',
            success:function (data) {
                selfr.parents('li').remove();
                notif({
                    msg: "خدمات ثبت شده حذف شد" ,
                    type: "success"
                });
            },
            error: function (request, status, error) {
                // alert(error);
            }
        });
    });



    //================= servs and rols    end ===============




















    //================= edit    user info start ===============
    $('body').on('click','#addoffbut',function(){

        var common =$(this).attr('data-common') ;
        common=escapeHtml(common);

        $("#offdialog").modal({
            fadeDuration: 500,
            fadeDelay: 0.30,
            escapeClose: false,

        });
        $("#offinput").keyup(function(){
            var number = $(this).val();
            number= escapeHtml(number);
            $('.amou').text( numberWithCommas(number)+ " تومان ");

        });
        $("#give").click(function(){
            var des =  $('#des').val();
            var off =  $('#offinput').val();
            off=escapeHtml(off);
            des=escapeHtml(des);
            var payway = $('#payway').find(":selected").val();
            payway=escapeHtml(payway);
            if (off<=0   ) {
                notif({
                    msg: "لطفا عدد را وارد کنید " ,
                    type: "error"
                });
                return;
            }
            if (des.length<10 ) {
                notif({
                    msg: "حداقل 10 کاراکتر وارد کنید " ,
                    type: "error"
                });
                return;
            }
            load_animation();


            var str = 'common='+ common+'&payway='+payway + '&off='+off +'&des='+des ;

            $.ajax('/admin/panel/addoff',{
                type:'post',
                data: str,
                dataType: 'json',
                success:function (data) {
                    stop_animation();
                    $.modal.close();
                    notif({
                        msg: "مبلغ شما مورد نظر شما ثبت شد " ,
                        type: "success"
                    });
                    backtopanel();


                },
                error: function (request, status, error) {
                    // alert(error);
                }
            });

        });






    });

    $('body').on('click','#removeuser',function(){
        $("#removedialog").modal({
            fadeDuration: 500,
            fadeDelay: 0.30,
            escapeClose: false,
            clickClose: false,
        });
        var common =$(this).attr('data-common') ;
        common=escapeHtml(common);
        $('body').on('click','#no_delete',function(){
            $.modal.close();
        });

        $('body').on('click','#yes_delete',function(){

            $.modal.close();
            var str = 'common='+ common;
            $.ajax('/admin/panel/removeuser',{
                type:'post',
                data: str,

                success:function (data) {

                    notif({
                        msg: "کاربر با موفقیت حذف شد " ,
                        type: "success"
                    });
                    backtopanel();
                },
                error: function (request, status, error) {
                    // alert(error);
                }
            });
        });
    });
    $('body').on('focus','.datepicker',function(){
        // $(this).datepicker({ dateFormat: 'yy-mm-dd'});
        tooltip();
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+40",
            dateFormat: 'yy-mm-dd'
        });


    });
    function tooltip(){
        $('.tooltip').tooltipster({
            animation: 'fade',
            theme: 'tooltipster-punk',

            trigger: 'hover'
        });
    }
    $('body').on('change','.datepicker',function(){
        var date =$(this).val();
        date =escapeHtml(date);
        m = moment(date, 'YYYY/M/D');
        m=  m.locale('fa').format('YYYY/MM/DD');
        // $(this).val(m);
        $(this).prev().text(m);

        $(this).prop("title", m);


        // $(this).attr("title", m);




    });
    // $('body').on('keyup','.datepicker',function(){
    //     $(this).attr('title', 'your new title');
    //     var m =   moment().locale('fa').format('YYYY/M/D');
    //
    //     alert(m);
    //
    // });
    $('body').on('click','.datepicker',function(){
        // $(this).datepicker({ dateFormat: 'yy-mm-dd'});
        tooltip();
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+40",
            dateFormat: 'yy-mm-dd'
        });
    });
    $('.on').prop('checked', true);

    $('#formparent input').each(function () {
        var a = $(this);
        var b = a.siblings('span');
        a.change(function () {
            var  name=a.val().replace(/.*(\/|\\)/, '');
            b.text(name);
        })
    });










    function scrollbottom(){
        if ( $('.chatbox').length){

            $('.chatbox').scrollTop($('.chatbox')[0].scrollHeight+400);
        }
    }
    // var editor = $("#msg").Editor();
    $("#sendmsg").click(function(){
        // scroolbottom();
        var  message  = escapeHtml( $("#msg").val());

        if (message.length<10){
            notif({
                msg: "طول مسیج باید حداقل 10 کاراکتر باشد" ,
                type: "error"
            });
            return;
        }

        var master = $("#sendmsg").attr("data-master");
        master= escapeHtml(master);
        var common = $("#sendmsg").attr("data-common");
        common= escapeHtml(common);
        $("#msg").val('');
        var str = 'message='+ message+'&master='+master+'&common='+common;
        $.ajax('/admin/panel/mngchat',{
            type:'post',
            data: str,
            cash: false,
            success:function (data) {
                readmsg();
            },
            error: function (request, status, error) {
                // alert(error);
            }
        });

    });
    readmsg();

    setInterval(countmsg,1000);
    function readmsg(){
        var master = $("#sendmsg").attr("data-master");
        // master= escapeHtml(master);
        var common = $("#sendmsg").attr("data-common");
        // common= escapeHtml(common);
        var str = 'master='+ master+ '&common='+ common  ;

        $.ajax('/admin/panel/readuserchat',{
            type:'post',
            data: str,
            cash: false,
            success:function (data) {
                $(".chatbox").html(data);
                scrollbottom();

            },
            error: function (request, status, error) {
                // alert(error);
            }

        });
    }
    var msgnumber = 0 ;
    $('.tooltip').tooltipster({
        animation: 'fade',
        theme: 'tooltipster-punk',

        trigger: 'hover'
    });
    function countmsg(){
        var master = $("#sendmsg").attr("data-master");
        var common = $("#sendmsg").attr("data-common");
        var str = 'common='+ common;
        $.ajax('/admin/panel/countmsg',{
            type:'post',
            data: str,
            cash: false,
            success:function (data) {
                if (msgnumber!=data) {
                    readmsg();
                    msgnumber= data;
                }

            },
            error: function (request, status, error) {
                // alert(error);
            }

        });
    }
    if ($('.chatbox').length){
        updateseenmsg();
    }
    function updateseenmsg(){

        var common = $("#sendmsg").attr("data-common");
        common=escapeHtml(common);
        var str = 'common='+ common;
        $.ajax('/admin/panel/updateseenmsg',{
            type:'post',
            data: str,
            cash: false,
            success:function (data) {

            },
            error: function (request, status, error) {
                // alert(error);
            }

        });
    }

    $("#sendpayamak").click(function(){
        sendsms();

    });

    function sendsms(){
        stop_animation();
        var master = $("#sendmsg").attr("data-master");
        var pm = $("#payamak").val();

        pm  =escapeHtml(pm);
        pm  =pm.trim();
        if (pm.length<5){
            notif({
                msg:  "حداقل 5 کاراکتر وارد کنید",
                type: "error"
            });
            return;
        }
        var str = 'master='+ master + '&pm='+pm;
        $("#payamak").val(' ');
        $.ajax('/admin/panel/sendsms',{
            type:'post',
            data: str,
            cash: false,
            success:function (data) {
                stop_animation();
                readsms();
                notif({
                    msg:  "پیامک ارسال شد",
                    type: "success"
                });
            },
            error: function (request, status, error) {
                // alert(error);
            }

        });
    }
    readsms();
    function readsms(){
        var master = $("#sendmsg").attr("data-master");
        var str = 'master='+ master;

        $.ajax('/admin/panel/readsms',{
            type:'post',
            data: str,
            cash: false,
            success:function (data) {
                $(".payamak").html(data);
                if ( $('.payamak').length){

                    $('.payamak').scrollTop($('.payamak')[0].scrollHeight+400);
                }

            },
            error: function (request, status, error) {
                // alert(error);
            }

        });
    }



    $('body').on('click','#pricechange',function(){

        var common = $(this).attr("data-common");
        if ($('#ser1p').length){
            var s1p=  $('#ser1p').val();s1p =escapeHtml(s1p);
        } else {s1p=0}
        if ($('#ser2p').length){
            var s2p=  $('#ser2p').val();s2p =escapeHtml(s2p);
        } else {s2p=0}
        if ($('#ser3p').length){
            var s3p=  $('#ser3p').val();s3p =escapeHtml(s3p);
        } else {s3p=0}
        if ($('#ser4p').length){
            var s4p=  $('#ser4p').val();s4p =escapeHtml(s4p);
        } else {s4p=0}
        if ($('#europ').length){
            var euro=  $('#europ').val();euro =escapeHtml(euro);
        } else {euro=0}


        var str = 's1p='+ s1p+'&s2p='+s2p+'&s3p='+s3p+'&s4p='+s4p+'&euro='+euro+'&common='+common;


        $.ajax('/admin/panel/changebaseprice',{
            type:'post',
            data: str,
            cash: false,
            success:function (data) {
                notif({
                    msg:  "اطلاعات به روز شد ",
                    type: "success"
                });
                window.location = "/admin/panel/editinfo/"+common;
                changedashboard(option=3);
            },
            error: function (request, status, error) {
                // alert(error);
            }

        });

    });



    //================= edit    end ===============
    //================= financial    start ===============
    $('body').on('click','.changeprice',function(){

        var euro=  $('#euro').val();euro =escapeHtml(euro);
        var str = 'euro='+euro;

        $.ajax('/admin/financial/updateprice',{
            type:'post',
            data: str,
            cash: false,
            success:function (data) {
                notif({
                    msg:  "اطلاعات به روز شد ",
                    type: "success"
                });
                changedashboard(option=3);
            },
            error: function (request, status, error) {
                // alert(error);
            }

        });
    });
    $('body').on('click','.seehistory',function(){
        $("#history").modal({
            fadeDuration: 500,
            fadeDelay: 0.30,
            escapeClose: true,
            clickClose: true,
        });
    });
    $('body').on('click','.seesmshistory',function(){
        $("#smshistory").modal({
            fadeDuration: 500,
            fadeDelay: 0.30,
            escapeClose: true,
            clickClose: true,
        });
    });
    function checktick(){

        $('.accsessoption').each(function(i, obj) {
            alert(3);
            if (!$(this).is(':checked')){
                alert('4');
                return false;

            }else {
                alert('5');
                return true;
            }



        });


    }

    $('body').on('click','#rep3',function(){
        var goal = $('#goal').find(":selected").val();
        var to=  $('.rep3dateto').val(); to=escapeHtml(to);
        var from=  $('.rep3datefrom').val();from=escapeHtml(from);

        if(new Date(from) >= new Date(to))
        {//compare end <=, not >=
            notif({
                msg:  "تاریخ شروع نباید از تاریخ پایان بزرگ تر باشد",
                type: "error"
            });
            return;
        }
        var  str = 'from='+from+'&to='+to+'&goal='+goal;


        $.ajax('/admin/financial/report',{
            type:'post',
            data: str,
            dataType: 'json',
            success:function (data) {
                if (!data){
                    notif({
                        msg:  "اطلاعات به روز شد ",
                        type: "success"
                    });
                }
                $('.report').html(data.htm);
                $('.total-p').text( '  جمع مبلغ ' +  numberWithCommas(data.total) + '  تومان  ');
                $("#report").modal({
                    fadeDuration: 500,
                    fadeDelay: 0.30,
                    escapeClose: true,
                    clickClose: true,
                });
                setTimeout(
                    function()
                    {

                    }, 200);


            },
            error: function (request, status, error) {
                // alert(error);
            }

        });
    });


    $('body').on('click','#rep2',function(){
        var admin = $('#selectadmin').find(":selected").val();
        var to=  $('.rep2dateto').val(); to=escapeHtml(to);
        var from=  $('.rep2datefrom').val();from=escapeHtml(from);

        if(new Date(from) >= new Date(to))
        {//compare end <=, not >=
            notif({
                msg:  "تاریخ شروع نباید از تاریخ پایان بزرگ تر باشد",
                type: "error"
            });
            return;
        }
        var  str = 'from='+from+'&to='+to+'&admin='+admin;

        $.ajax('/admin/financial/report',{
            type:'post',
            data: str,
            dataType: 'json',
            success:function (data) {
                if (!data){
                    notif({
                        msg:  "اطلاعات به روز شد ",
                        type: "success"
                    });
                }
                $('.report').html(data.htm);
                $('.total-p').text( '  جمع مبلغ ' +  numberWithCommas(data.total) + '  تومان  ');
                $("#report").modal({
                    fadeDuration: 500,
                    fadeDelay: 0.30,
                    escapeClose: true,
                    clickClose: true,
                });
                setTimeout(
                    function()
                    {

                    }, 200);


            },
            error: function (request, status, error) {
                // alert(error);
            }

        });
    });




















    $('body').on('click','#rep1',function(){


        var to=  $('.rep1dateto').val(); to=escapeHtml(to);
        var from=  $('.rep1datefrom').val();from=escapeHtml(from);

        if(new Date(from) >= new Date(to))
        {//compare end <=, not >=
            notif({
                msg:  "تاریخ شروع نباید از تاریخ پایان بزرگ تر باشد",
                type: "error"
            });
            return;
        }
        var  str = 'from='+from+'&to='+to+'&way='+1;

        $.ajax('/admin/financial/report',{
            type:'post',
            data: str,
            dataType: 'json',
            success:function (data) {

                $('.report').html(data.htm);
                $('.total-p').text( '  جمع مبلغ ' +  numberWithCommas(data.total) + '  تومان  ');
                $("#report").modal({
                    fadeDuration: 500,
                    fadeDelay: 0.30,
                    escapeClose: true,
                    clickClose: true,
                });
                setTimeout(
                    function()
                    {

                    }, 200);


            },
            error: function (request, status, error) {
                // alert(error);
            }

        });
    });









    $('body').on('change','#goalp',function(){

        get_basic_price();
    });


    $('body').on('click','.changeservp',function(){
        var goal = $('#goalp').find(":selected").val();

        var  s1p  =  $('#serv1p').val(); s1p =escapeHtml(s1p); s1p = $.trim(s1p);
        var  s2p  =  $('#serv2p').val(); s2p =escapeHtml(s2p); s2p = $.trim(s2p);
        var  s3p  =  $('#serv3p').val(); s3p =escapeHtml(s3p); s3p = $.trim(s3p);
        var  s4p  =  $('#serv4p').val(); s4p =escapeHtml(s4p); s4p = $.trim(s4p);
        if (s1p==''){ var s1p = $('#serv1p').attr('placeholder');s1p= $.trim(s1p.replace('تومان','' )); s1p= $.trim(s1p.replace(',','' ));}
        if (s2p==''){ var s2p = $('#serv2p').attr('placeholder');s2p= $.trim(s2p.replace('تومان','' ));s2p= $.trim(s2p.replace(',','' ));}
        if (s3p==''){ var s3p = $('#serv3p').attr('placeholder');s3p= $.trim(s3p.replace('یورو','' ));s3p= $.trim(s3p.replace(',','' ));}
        if (s4p==''){ var s4p = $('#serv4p').attr('placeholder');s4p= $.trim(s4p.replace('یورو','' ));s4p= $.trim(s4p.replace(',','' ));}
        var  str = 's1p='+s1p+'&s2p='+s2p+'&s3p='+s3p+'&s4p='+s4p+'&goal='+goal;

        $.ajax('/admin/financial/updateserprice',{
            type:'post',
            data: str,

            success:function (data) {
                notif({
                    msg:  "اطلاعات به روز شد ",
                    type: "success"
                });
                $("#serv1p").attr("placeholder",numberWithCommas(s1p)+ ' تومان ' ).val("").focus().blur();
                $("#serv2p").attr("placeholder",numberWithCommas(s2p)+ ' تومان ' ).val("").focus().blur();
                $("#serv3p").attr("placeholder",numberWithCommas(s3p)+ ' یورو ' ).val("").focus().blur();
                $("#serv4p").attr("placeholder",numberWithCommas(s4p)+ ' یورو ' ).val("").focus().blur();


            },
            error: function (request, status, error) {
                // alert(error);
            }

        });
    });


    //================= financial    end ===============
    //================= admins    start ===============
    // $('body').on('change','.accsessoption',function(){
    //     alert('1');
    //     if (checktick()){
    //         alert('w');
    //         $('#fill').prop('checked', true);
    //     }
    //
    // });

    $('body').on('change','.accsessoption',function(){
        if (!$(this).is(':checked')){
            $('#fill , .fill').prop('checked', false);
        }
    });
    $('body').on('change','#fill ,.fill',function(){
        var fill = $(this);
        if(fill.is(':checked')){
            $('.accsessoption').each(function(i, obj) {

                $(this).prop('checked', true);
            });
        }else {
            $('.accsessoption').each(function(i, obj) {

                $(this).prop('checked', false);
            });
        }

    });

    $('body').on('click','.close-m',function(){
        $.modal.close();
    });
    var dad;
    $('body').on('click','.seeandedite',function(){
        var see_request ="";
        var edit_request ="";
        var new_request ="";
        var remove_request ="";
        var change_status ="";
        var see_last_request ="";
        var see_last_wait_for_request ="";
        var change_serv_price ="";
        var see_all_sell ="";
        var see_user_sell ="";
        var see_country_sell ="";
        var see_last_sms ="";
        var send_new_sms ="";
        var new_pm ="";
        var see_admins_list ="";
        var see_admins_access ="";
        var edit_admins_access ="";
        var new_admin ="";
        var submit_change_info ="";
        var submit_change_submit_price ="";
        var submit_change_receipt_price ="";
        var change_rols ="";
        var submit_receipt_and_off ="";
        var mobile = $(this).attr("data-mobile");
        dad = "#edit"+mobile;


        $(dad).modal({
            fadeDuration: 500,
            fadeDelay: 0.30,
            escapeClose: true,
            clickClose: true,

        });
        $(dad+ " .situfalse").prop('checked', false);
        $(dad+ " .situtrue").prop('checked', true);
        $(dad+" .submitedit").click(function () {


            see_request = $(dad+" .see_request").is(':checked');
            edit_request = $(dad+" .edit_request").is(':checked');
            new_request = $(dad+" .new_request").is(':checked');
            remove_request = $(dad+" .remove_request").is(':checked');
            change_status = $(dad+" .change_status").is(':checked');
            see_last_request = $(dad+" .see_last_request").is(':checked');
            see_last_wait_for_request = $(dad+" .see_last_wait_for_request").is(':checked');
            change_serv_price = $(dad+" .change_serv_price").is(':checked');
            see_all_sell = $(dad+" .see_all_sell").is(':checked');
            see_user_sell = $(dad+" .see_user_sell").is(':checked');
            see_country_sell = $(dad+" .see_country_sell").is(':checked');
            see_last_sms = $(dad+" .see_last_sms").is(':checked');
            send_new_sms = $(dad+" .send_new_sms").is(':checked');
            new_pm = $(dad+" .new_pm").is(':checked');
            see_admins_list = $(dad+" .see_admins_list").is(':checked');
            see_admins_access = $(dad+" .see_admins_access").is(':checked');
            edit_admins_access = $(dad+" .edit_admins_access").is(':checked');
            new_admin = $(dad+" .new_admin").is(':checked');
            submit_change_info = $(dad+" .submit_change_info").is(':checked');
            submit_change_submit_price = $(dad+" .submit_change_submit_price").is(':checked');
            submit_change_receipt_price = $(dad+" .submit_change_receipt_price").is(':checked');
            change_rols = $(dad+" .change_rols").is(':checked');
            submit_receipt_and_off = $(dad+" .submit_receipt_and_off").is(':checked');
            var superadmin ;
            if ($(dad+' .fill').is(':checked')) {
                superadmin =true;
            }else {
                superadmin =false;
            }

            var str =  'mobile='+mobile+'&see_request='+see_request+'&edit_request='+edit_request+'&new_request='+new_request+'&remove_request='+remove_request+'&change_status='+change_status+'&see_last_request='+see_last_request+'&see_last_wait_for_request='+see_last_wait_for_request+'&change_serv_price='+change_serv_price+'&see_all_sell='+see_all_sell+'&see_user_sell='+see_user_sell+'&see_country_sell='+see_country_sell+'&see_last_sms='+see_last_sms+'&send_new_sms='+send_new_sms+'&new_pm='+new_pm+'&see_admins_list='+see_admins_list+'&see_admins_access='+see_admins_access+'&see_admins_access='+see_admins_access+'&edit_admins_access='+edit_admins_access+'&new_admin='+new_admin+'&submit_change_info='+submit_change_info+'&submit_change_submit_price='+submit_change_submit_price+'&submit_change_receipt_price='+submit_change_receipt_price+'&change_rols='+change_rols+'&submit_receipt_and_off='+submit_receipt_and_off;

            $.ajax('/admin/admins/updateadmin/'+superadmin,{
                type:'post',
                data: str,
                success:function (data) {

                    $.modal.close();
                    notif({
                        msg:  "اطلاعات به روز شد ",
                        type: "success"
                    });
                    window.location = "/admin/panel/panel";
                },
                error: function (request, status, error) {
                    // alert(error);
                }

            });


        })

    });

    $('body').on('click','#addadmin',function(){
        var superadmin ;
        if ($('#fill').is(':checked')) {
            superadmin =true;
        }else {
            superadmin =false;
        }
        var adminname=  $('#adminname').val(); adminname = escapeHtml(adminname);
        var adminusername=  $('#adminusername').val(); adminusername = escapeHtml(adminusername);
        var adminpass=  $('#adminpass').val(); adminpass = escapeHtml(adminpass);
        var adminmobile=  $('#adminmobile').val(); adminmobile = escapeHtml(adminmobile);
        var see_request = $('#see_request').is(':checked');
        var edit_request = $('#edit_request').is(':checked');
        var new_request = $('#new_request').is(':checked');
        var remove_request = $('#remove_request').is(':checked');
        var change_status = $('#change_status').is(':checked');
        var see_last_request = $('#see_last_request').is(':checked');
        var see_last_wait_for_request = $('#see_last_wait_for_request').is(':checked');
        var change_serv_price = $('#change_serv_price').is(':checked');
        var see_all_sell = $('#see_all_sell').is(':checked');
        var see_user_sell = $('#see_user_sell').is(':checked');
        var see_country_sell = $('#see_country_sell').is(':checked');
        var see_last_sms = $('#see_last_sms').is(':checked');
        var send_new_sms = $('#send_new_sms').is(':checked');
        var new_pm = $('#new_pm').is(':checked');
        var see_admins_list = $('#see_admins_list').is(':checked');
        var see_admins_access = $('#see_admins_access').is(':checked');
        var edit_admins_access = $('#edit_admins_access').is(':checked');
        var new_admin = $('#new_admin').is(':checked');
        var submit_change_info = $('#submit_change_info').is(':checked');
        var submit_change_submit_price = $('#submit_change_submit_price').is(':checked');
        var submit_change_receipt_price = $('#submit_change_receipt_price').is(':checked');
        var change_rols = $('#change_rols').is(':checked');
        var submit_receipt_and_off = $('#submit_receipt_and_off').is(':checked');

        var str = 'adminname='+ adminname+'&adminusername='+adminusername+'&adminpass='+adminpass+'&adminmobile='+adminmobile+'&see_request='+see_request+'&edit_request='+edit_request+'&new_request='+new_request+'&remove_request='+remove_request+'&change_status='+change_status+'&see_last_request='+see_last_request+'&see_last_wait_for_request='+see_last_wait_for_request+'&change_serv_price='+change_serv_price+'&see_all_sell='+see_all_sell+'&see_user_sell='+see_user_sell+'&see_country_sell='+see_country_sell+'&see_last_sms='+see_last_sms+'&send_new_sms='+send_new_sms+'&new_pm='+new_pm+'&see_admins_list='+see_admins_list+'&see_admins_access='+see_admins_access+'&see_admins_access='+see_admins_access+'&edit_admins_access='+edit_admins_access+'&new_admin='+new_admin+'&submit_change_info='+submit_change_info+'&submit_change_submit_price='+submit_change_submit_price+'&submit_change_receipt_price='+submit_change_receipt_price+'&change_rols='+change_rols+'&submit_receipt_and_off='+submit_receipt_and_off;

        if (adminname.length<5 ||    adminusername.length<5 || adminpass.length<5 ||adminmobile.length<5  ){
            notif({
                msg:  "برای هر فیلد باید حداقل 5 حرف وارد شود",
                type: "error"
            });
            return
        }
        $.ajax('/admin/admins/addadmin/'+superadmin,{
            type:'post',
            data: str,
            success:function (data) {
                alert(data);
                notif({
                    msg:  "اطلاعات به روز شد ",
                    type: "success"
                });
                window.location = "/admin/panel/panel";
            },
            error: function (request, status, error) {
                // alert(error);
            }

        });
    });

    $('body').on('click','.showremovedialog',function(){
        var mobile = $(this).attr("data-mobile");
        $('#'+mobile).modal({
            fadeDuration: 500,
            fadeDelay: 0.30,
            escapeClose: true,
            clickClose: true,
        });
        $('.yesremove').click(function () {

            var   str ='mobile='+mobile;

            $.ajax('/admin/admins/deactiveadmin',{
                type:'post',
                data: str,
                cash: false,
                success:function (data) {
                    $.modal.close();
                    notif({
                        msg:  "ادمین غیر فعال شد  ",
                        type: "success"
                    });
                    changedashboard(option=4);
                },
                error: function (request, status, error) {
                    // alert(error);
                }

            });
        });

    });
    //================= admins    end ===============

























    // jQuery(document).bind("keyup keydown", function(e){
    //     if(e.ctrlKey && e.keyCode == 80){
    //         return false;
    //     }
    // });



    $( "#print" ).click(function () {

        $("#formparent").print({

// Use Global styles
            globalStyles : true,

// Add link with attrbute media=print
            mediaPrint : false,

//Custom stylesheet
            stylesheet : "http://localhost/order/css/style.css",

//Print in a hidden iframe
            iframe : false,

// Don't print this
            noPrintSelector : ".avoid-this",

// Add this on top
            append : "Free jQuery Plugins<br/>",

// Add this at bottom
            prepend : "<br/>jQueryScript.net",

// Manually add form values
            manuallyCopyFormValues: true,

// resolves after print and restructure the code for better maintainability
            deferred: $.Deferred(),

// timeout
            timeout: 250,

// Custom title
            title: null,

// Custom document type
            doctype: '<!doctype html>'


        });
    });
});
