<?php


//send_new_sms('سس','09373699317');
//var_dump(get_sms_ststus('55204442'));
//var_dump(encryptIt('qw'));

?>
<script src="https://www.google.com/recaptcha/api.js?render=6Ldw3KIUAAAAAH8pKWvR-X-_LawyGmVFkWVywWlF"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6Ldw3KIUAAAAAH8pKWvR-X-_LawyGmVFkWVywWlF', {action:'validate_captcha'})
            .then(function(token) {
                document.getElementById('g-recaptcha-response').value = token;
            });
    });
</script>











<div class="rows" id="login">
    <div class="container">
        <div class="row">
             <div class="col-lg-12">
                 <div>
                     <div class="loginbox transition">
                         <div class="mobile_input">
                             <div class="row">
                                 <div class="col-lg-12">
                                     <div>
                                         <form id="log_form" action="#">

                                         <div class="sms_box">
                                             <input type="text" name="username" id="username" class="input" placeholder=" نام کاربری">

                                         </div>
                                         <div class="sms_box">
                                             <input type="password" name="password" id="password" class="input" placeholder=" رمز  ">

                                         </div>
                                         <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                         <input type="hidden" name="action" value="validate_captcha">
                                         </form>
                                         <div class="sms_but">
                                             <span class="  sbtn" id="login_btn">   ورود </span>

                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
                             <div id="html_element"></div>
                         </div>
                     </div>

                 </div>
             </div>
        </div>

    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
</script>



