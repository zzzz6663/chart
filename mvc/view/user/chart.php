<?php


?>

<!--<div id="can">-->
<!---->
<!--</div>-->
<!---->
<!--<div id="capture" style="padding: 10px; background: #f5da55;width: 400px; height: 300px">-->
<!--    <h4 style="color: #000; ">Hello world!</h4>-->
<!--</div>-->
<div class="wrapper" >

    <div class="rows" id="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-1s2">
                    <div>
                        <h1>
                            ویجت محاسبه
                            <svg id="Group_5097" data-name="Group 5097" xmlns="http://www.w3.org/2000/svg" width="25" height="6" viewBox="0 0 25 6">
                                <circle id="Ellipse_9" data-name="Ellipse 9" cx="3" cy="3" r="3" fill="#afb8d1"/>
                                <ellipse id="Ellipse_10" data-name="Ellipse 10" cx="2.5" cy="3" rx="2.5" ry="3" transform="translate(10)" fill="#afb8d1"/>
                                <circle id="Ellipse_11" data-name="Ellipse 11" cx="3" cy="3" r="3" transform="translate(19)" fill="#afb8d1"/>
                            </svg>

                        </h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <p> </p>
                    </div>
                </div> 
                <div class="col-lg-6 col-md-12">
                    <div>
                       <div id="logo">
                           <img src="<?=baseUrl().'/images/logo.jpeg'?>" alt="">
                           <br>
                           <span      >
                               فن اوران برنامه ریزی شهری
                           </span>
                       </div>
                    </div>
                </div>
            </div>
           <div class="row bboxp">
               <div class="col-lg-8 bbox  col-md-12 center-block">
                   <div>
                       <div class="row">
                           <div class="col-lg-6 col-sm-12">
                               <div>
                                   <label for="city1">شهر یا استان یا کشور اول  را بنویسید </label>
                                   <br>
                                   <input autocomplete="off" type="text"   name="city1" id="city1" placeholder="مثلا تهران">
                                   <br>
                               </div>
                           </div>
                           <div class="col-lg-6 col-sm-12">
                               <div>
                                   <label for="city2"> شهر یا  استان یا کشور دوم  را بنویسید  </label>
                                   <br>
                                   <input autocomplete="off" type="text"   name="city2" id="city2" placeholder="مثلا نیویورک">
                                   <br>
                               </div>

                           </div>
                           <div class="col-lg-6 col-sm-12">
                               <div>
                                   <label for="start_year">سال شروع</label>
                                   <input autocomplete="off" type="number"   id="start_year" class="select mask"   name="start_year" placeholder="   مثلا 2000 میلادی">
                               </div>
                           </div>
                           <div class="col-lg-6 col-sm-12">
                               <div>
                                   <label for="end_year">سال پایان</label>
                                   <input autocomplete="off" type="number"   id="end_year"  class="select"   name="end_year" placeholder="مثلا 2005 میلادی">
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-lg-6 col-md-12 center-block">
                               <div>
                                 <div class="role">
                                     <label for="role">
                                           <span>
                                         من

                                     <a target="_blank"  href="<?=root('file').$data['file']['value']?>">راهنما</a>
                                   را مطالعه کردم
                                   </span>
                                     </label>
                                     <input type="checkbox" id="role">
                                 </div>


                               </div>
                           </div>

                       </div>
                       <div class="row">
                           <div class="col-lg-12">
                               <div>
                                    <div class="sbtn_p">
                                         <span class="sbtn" id="cal">شروع
                                            </span>
                                    </div>

                                    <div style="text-align: center">
                                        <br>
                                         <span>
                                       توسعه توسط
                                       <a  href="https://t.me/Na3r9317" style=" font-weight: bold;color: red">Naser</a>
                                   </span>
                                    </div>
                               </div>
                           </div>

                       </div>

                   </div>
               </div>
           </div>
        </div>
    </div>
    <div class="rows" id="forms_s">

        <div id="show_forms" class="rosw">

        </div>
        <div id="show_forms2" class="rsow">

        </div>

    </div>
</div>