<?php
?>

<div id="setting">
    <div class="row">
        <div class="col-lg-6">
            <div>
                <div id="uploadDivId"></div>
                <?php 
                
//                var_dump(root2('file'));
                ?>
                <a target="_blank"  href="<?=root('file').$data['file']['value']?>"><i style="font-size: 40px" class="fas pointer fa-download"></i></a>
            </div>
        </div>
        <div class="col-lg-6">
            <div>
                <label for="ex1">  مشخصات ورود</label>
                <br>
                <label for="username">نام کاربری</label>
                <input type="text" id="username" placeholder="<?=$data['username']['value']?>">
                <br>
                <label for="password">رمز عبور</label>
                <input type="text" id="password" placeholder="<?=decryptIt($data['password']['value'])?>">
                 <br>
                 <br>
                <span class="sbtn update_sec">ثبت</span>
            </div>
        </div>
        <div class="col-lg-6">
            <div>  
                 <div>
                     <span class="title">آمار نتیجه </span>
                     <span class="cont"><?=$amar2['value']?></span>
                 </div>
                <div>
                     <span class="title">آمار بازدید صفحه </span>
                     <span class="cont"><?=$amar['value']?></span>
                 </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div>
                <span class="sbtn reset_amar">صفر کردن </span>
            </div>
        </div>
    </div>
</div>