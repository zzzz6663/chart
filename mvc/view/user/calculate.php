<div id="forms">


                <div class="container">


                  <?php if ($num>0){ for ($i=0; $i<$num; $i++){ ?>
                      <div class="total part_section part<?=$num?>  <?=($i==0)?'':'hide';?>">


                      <div class="row">
                          <div class="col-lg-12 c">
                              <div>
                                  <h1>
                                      وارد کردن داده  ها
                                      صفحه
                                      <span class="sf">
                                          <?=$i+1?>
                                      </span>
                                     <span class="sf">
                                          <?=$num?>
                                      صفحه
                                     </span>


                                      <svg id="Group_5097" data-name="Group 5097" xmlns="http://www.w3.org/2000/svg" width="25" height="6" viewBox="0 0 25 6">
                                          <circle id="Ellipse_9" data-name="Ellipse 9" cx="3" cy="3" r="3" fill="#afb8d1"/>
                                          <ellipse id="Ellipse_10" data-name="Ellipse 10" cx="2.5" cy="3" rx="2.5" ry="3" transform="translate(10)" fill="#afb8d1"/>
                                          <circle id="Ellipse_11" data-name="Ellipse 11" cx="3" cy="3" r="3" transform="translate(19)" fill="#afb8d1"/>
                                      </svg>

                                  </h1>
                              </div>
                          </div>
                      </div>

                      <div class="row ">

                          <div class="col-lg-12 col-md-12 center-block">
                              <div>
                                  <div class="row">
                                      <form action="#" id="info_<?=$i+1?>">
                                          <div class="col-lg-6 col-sm-12">
                                              <div>
                                                  <h2>

                                                      <?=$city1?>
                                                      در سال
                                                      <?=$start+$i?>
                                                  </h2>
                                                  <div class="row">
                                                      <input   type="text" name="year1" hidden value="<?=$start+$i?>">
                                                      <input    type="text" name="city1" hidden value="<?=$city1?>">
                                                      <div class="col-lg-6 col-md-12">
                                                          <div>
                                                              <label for="c1_trade_out<?=$i?>">حجم تجارت بین الملل (صادرات)</label>
                                                              <input autocomplete="off" class="hval gh1 money"         type="text" required id="c1_trade_out<?=$i?>" name="c1_trade_out<?=$i?>" placeholder="برحسب دلار">
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-6 col-md-12">
                                                          <div>
                                                              <label for="c1_trade_in<?=$i?>">حجم تجارت بین الملل(وارادت)</label>
                                                              <input autocomplete="off" class="hval gh2 money"         type="text" required id="c1_trade_in<?=$i?>" name="c1_trade_in<?=$i?>" placeholder="برحسب دلار">
                                                          </div>
                                                      </div>

                                                      <div class="col-lg-6 col-md-12">
                                                          <div>
                                                              <label for="c1_investment_fo<?=$i?>"> سرمایه گذاری مستقیم خارجی</label>
                                                              <input autocomplete="off" class="hval gh3 money"         type="text" required id="c1_investment_fo<?=$i?>" name="c1_investment_fo<?=$i?>" placeholder="برحسب دلار">
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-6 col-md-12">
                                                          <div>
                                                              <label for="c1_tourist_fo<?=$i?>">تعداد گردشگر خارجی </label>
                                                              <input autocomplete="off" class="hval gh4 money"         type="text" required id="c1_tourist_fo<?=$i?>" name="c1_tourist_fo<?=$i?>" placeholder="مثلا 1000 نفر  ">
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-6 col-md-12">
                                                          <div>
                                                              <label for="c1_influence_internet<?=$i?>"> ضریب نفوذ اینترنت</label>
                                                              <input autocomplete="off" class="hval gh5"         type="number" step="any" required id="c1_influence_internet<?=$i?>" name="c1_influence_internet<?=$i?>" placeholder="مثلا 64.22 درصد">
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-6 col-md-12">
                                                          <div>
                                                              <label for="c1_branch_count<?=$i?>">تعداد شعب بانک های خارجی </label>
                                                              <input autocomplete="off" class="hval gh6 money"         type="text" required id="c1_branch_count<?=$i?>" name="c1_branch_count<?=$i?>" placeholder="مثلا 30  شعبه">
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-6 col-md-12">
                                                          <div>
                                                              <label for="c1_company<?=$i?>"> تعداد شرکت های چند ملیتی</label>
                                                              <input autocomplete="off" class="hval gh7 money"         type="text" required id="c1_company<?=$i?>" name="c1_company<?=$i?>" placeholder="مثلا 10 شرکت ">
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-6  col-sm-12">
                                              <div>
                                                  <h2>

                                                      <?=$city2?>
                                                      در سال
                                                      <?=$start+$i?>
                                                  </h2>
                                                  <div class="row">
                                                      <input   type="text" name="year2" hidden value="<?=$start+$i?>">
                                                      <input    type="text" name="city2" hidden value="<?=$city2?>">
                                                          <div class="col-lg-6 col-md-12">
                                                          <div>
                                                              <label for="c2_trade_out<?=$i?>">  حجم تجارت بین الملل (صادرات)</label>
                                                              <input  autocomplete="off" class="hval ch1 money"         type="text" required id="c2_trade_out<?=$i?>" name="c2_trade_out<?=$i?>" placeholder="برحسب دلار">
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-6 col-md-12">
                                                          <div>
                                                              <label for="c2_trade_in<?=$i?>">  حجم تجارت بین الملل(وارادت)</label>
                                                              <input  autocomplete="off" class="hval ch2 money"         type="text" required id="c2_trade_in<?=$i?>" name="c2_trade_in<?=$i?>" placeholder="برحسب دلار">
                                                          </div>
                                                      </div>

                                                      <div class="col-lg-6 col-md-12">
                                                          <div>
                                                              <label for="c2_investment_fo<?=$i?>"> سرمایه گذاری مستقیم خارجی</label>
                                                              <input  autocomplete="off" class="hval ch3 money"         type="text" required id="c2_investment_fo<?=$i?>" name="c2_investment_fo<?=$i?>" placeholder="برحسب دلار">
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-6 col-md-12">
                                                          <div>
                                                              <label for="c2_tourist_fo<?=$i?>">تعداد گردشگر خارجی </label>
                                                              <input  autocomplete="off" class="hval ch4 money"          type="text" required id="c2_tourist_fo<?=$i?>" name="c2_tourist_fo<?=$i?>" placeholder="مثلا 1000 نفر  ">
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-6 col-md-12 ">
                                                          <div>
                                                              <label for="c2_influence_internet<?=$i?>"> ضریب نفوذ اینترنت</label>
                                                              <input  autocomplete="off" class="hval ch5"      step="any"    type="text" required id="c2_influence_internet<?=$i?>" name="c2_influence_internet<?=$i?>" placeholder="مثلا 80.1 درصد">
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-6 col-md-12">
                                                          <div>
                                                              <label for="c2_branch_count<?=$i?>">تعداد شعب بانک های خارجی </label>
                                                              <input  autocomplete="off" class="hval ch6 money"         type="text" required id="c2_branch_count<?=$i?>" name="c2_branch_count<?=$i?>" placeholder="مثلا 30  شعبه">
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-6 col-md-12">
                                                          <div>
                                                              <label for="c2_company<?=$i?>"> تعداد شرکت های چند ملیتی</label>
                                                              <input  autocomplete="off" class="hval ch7 money"         type="text" required id="c2_company<?=$i?>" name="c2_company<?=$i?>" placeholder="مثلا 10 شرکت ">
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                      </div>
                      <?php } } ?>
                        <?php if ($num==1){ ?>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div>
                               <span class="sbtn" id="finish" >نمایش نتیجه
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php } else{  ?>
                            <div class="row" >
                               <div class="col-lg-10 col-md-12 center-block">
                                   <div>
                                       <div class="row">
                                           <div class="col-lg-6 col-md-12">
                                               <div>

                                                   <span id="next" data-num="<?=$num?>" class="sbtn">مرحله بعد </span>
                                                   <span class="sbtn" id="finish" style="display: none">نمایش نتیجه
                                        </span>
                                               </div>
                                           </div>
                                           <div class="col-lg-6 col-md-12">
                                               <div>

                                                   <span id="perv" data-num="<?=$num?>"  class="sbtn back_b hide">رفتن به عقب</span>
                                               </div>
                                           </div>


                                       </div>
                                   </div>
                               </div>
                            </div>
                        <?php  } ?>




                </div>



</div>