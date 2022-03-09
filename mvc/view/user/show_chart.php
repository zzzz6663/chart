
<script>
    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
</script>
<div id="final" class="rows">

    <span class="reload"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
  <path id="Path_50453" data-name="Path 50453" d="M18.537,19.567A9.982,9.982,0,1,1,20.19,17.74L17,12h3a8,8,0,1,0-2.46,5.772Z" transform="translate(-2 -2)" fill="#fff"/>
</svg>
</span>
    <div class="container">
        <h1>
            نمایش خروجی آماری

            <svg id="Group_5097" data-name="Group 5097" xmlns="http://www.w3.org/2000/svg" width="25" height="6" viewBox="0 0 25 6">
                <circle id="Ellipse_9" data-name="Ellipse 9" cx="3" cy="3" r="3" fill="#afb8d1"/>
                <ellipse id="Ellipse_10" data-name="Ellipse 10" cx="2.5" cy="3" rx="2.5" ry="3" transform="translate(10)" fill="#afb8d1"/>
                <circle id="Ellipse_11" data-name="Ellipse 11" cx="3" cy="3" r="3" transform="translate(19)" fill="#afb8d1"/>
            </svg>
          <span class="ex">
                <span class="sv">

<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
  <path id="Path_50451" data-name="Path 50451" d="M6,14h8v4H6Zm9.6,2.4v-4H4.4v4H2.8a.8.8,0,0,1-.8-.8v-8a.8.8,0,0,1,.8-.8H17.2a.8.8,0,0,1,.8.8v8a.8.8,0,0,1-.8.8ZM4.4,8.4V10H6.8V8.4ZM6,2h8a.8.8,0,0,1,.8.8V5.2H5.2V2.8A.8.8,0,0,1,6,2Z" transform="translate(-2 -2)" fill="#545868"/>
</svg>
                </span>
<!--              <span class="pdf">-->
<!--                  PDF-->
<!--              </span>-->
<!--                <i  class="fas export pointer fa-file-image"></i>-->
          </span>

        </h1>

        <script>
            var fruits=[];
        </script>


<div class="row ">
    
    <?php    if ($total){
        $_SESSION['total']=$total;
    foreach ($total as $t_k1=>$to1){
        $full_years[]=$to1['c1']['year'];
        $full_years2[]=$to1['c1']['year'];
    }

        $indexy=0;
        $indexy1=1;
         foreach ($total as $t_k=>$to){
             
            $years[]=$to['c1']['year'];
            $city[0]=$to['c1']['city'];
            $city[1]=$to['c2']['city'];
            $sum_glob=$to['c1']['globalization ']+$to['c2']['globalization '];
            $total[$t_k]['c1']['per_glob']=$to['c1']['globalization '];
            $total[$t_k]['c2']['per_glob']=$to['c2']['globalization '];
//            $total[$t_k]['c1']['per_glob']=floor(($to['c1']['globalization ']*100)/$sum_glob);
//            $total[$t_k]['c2']['per_glob']=ceil(($to['c2']['globalization ']*100)/$sum_glob);
            $global1[]=$total[$t_k]['c1']['per_glob'];

            $global2[]=$total[$t_k]['c2']['per_glob'];
            $t_g[$indexy][0]['name']=$to['c1']['city'];
            $t_g[$indexy][0]['data']=$global1;
            $t_g[$indexy][1]['name']=$to['c2']['city'];
            $t_g[$indexy][1]['data']=$global2;


//            var_dump($t_g);

    ?>





    <script>
        var words=null;
        var ser=null;
          words = <?php echo json_encode($years) ?>;// don't use quotes
          ser = <?php echo json_encode($t_g[$indexy]) ?>;// don't use quotes
        fruits.push(<?php echo json_encode($t_g[$indexy]) ?>)

    </script>

    <div class="col-lg-6 col-md-12 cls<?=ceil($indexy1%2)?> ">
        <div>


            <div class="tab">
                <h1>
                    <i >
                    جدول شماره
                        <i   class="editable" data-url="<?=baseUrl()?>/login/ch"><?=$indexy1?></i>
                        امتیازات مولفه های  سنجش   جهانی شدن فضای جغرافیایی
                    (CMGGS)

                    <?=$city[0]?>  نسبت به  <?=$city[1]?>
                    در سال
                    <?=$to['c1']['year'];?>
                        </i>
                    <span>
                        <svg id="Group_16945" data-name="Group 16945" xmlns="http://www.w3.org/2000/svg" width="21" height="5" viewBox="0 0 21 5">
  <circle id="Ellipse_9" data-name="Ellipse 9" cx="2.5" cy="2.5" r="2.5" fill="#1c2136"/>
  <circle id="Ellipse_10" data-name="Ellipse 10" cx="2.5" cy="2.5" r="2.5" transform="translate(8)" fill="#1c2136"/>
  <circle id="Ellipse_11" data-name="Ellipse 11" cx="2.5" cy="2.5" r="2.5" transform="translate(16)" fill="#1c2136"/>
</svg>

                    </span>
                </h1>

                <div id="t1_<?=$indexy?>">


                <table >
                    <thead>
                        <tr>
                            <th>مولفه </th>
                            <th> <?=$city[0]?>  </th>
                            <th> <?=$city[1]?>  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border_bottom border_left">
                            <td>integration</td>
                            <td><?=number_format($to['c1']['integration'])?></td>
                            <td><?=number_format($to['c2']['integration'])?></td>
                        </tr>
                        <tr class="border_bottom border_left">
                            <td>connectivity</td>
                            <td><?=number_format($to['c1']['connectivity'])?></td>
                            <td><?=number_format($to['c2']['connectivity'])?></td>
                        </tr>
                        <tr class="border_bottom border_left">
                            <td>space of flow</td>
                            <td><?=number_format($to['c1']['space_of_flow'])?></td>
                            <td><?=number_format($to['c2']['space_of_flow'])?></td>
                        </tr>
                        <tr class="border_left border_bottom ">
                            <td>globalization of geographical space  </td>
<!--                            (--><?//=$total[$t_k]['c1']['per_glob']?><!--%)-->
                            <td><?=number_format($to['c1']['globalization '])?>  </td>
                            <td><?=number_format($to['c2']['globalization '])?>  </td>
                        </tr>

                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="border_right"> نسبت  اختلاف  میزان جهانی شدن  فضای جغرافیایی </td>
                        <td>  <?php
                            $num=bcdiv($to['c2']['globalization '],$to['c1']['globalization '],1);
                            if ( $to['c1']['globalization ']>$to['c2']['globalization ']){
                                $num = bcdiv($to['c1']['globalization '],$to['c2']['globalization '],1);
                            }
                            echo $num;
                            ?></td>
                    </tr>
                    </tfoot>
                </table>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>

            <div class="chs">
                    <h1>
                        <i  >
                        نمودار
                            شماره
                            <i   class="editable" data-url="<?=baseUrl()?>/login/ch"><?=$indexy1?></i>
                            امتیازات

                            میزان جهانی شدن  فضای جغرافیایی    <?=$city[0]?>  نسبت به    <?=$city[1]?> در سال <?=$to['c1']['year'];?>
                            </i>
                        <span>
                        <svg id="Group_16945" data-name="Group 16945" xmlns="http://www.w3.org/2000/svg" width="21" height="5" viewBox="0 0 21 5">
  <circle id="Ellipse_9" data-name="Ellipse 9" cx="2.5" cy="2.5" r="2.5" fill="#1c2136"/>
  <circle id="Ellipse_10" data-name="Ellipse 10" cx="2.5" cy="2.5" r="2.5" transform="translate(8)" fill="#1c2136"/>
  <circle id="Ellipse_11" data-name="Ellipse 11" cx="2.5" cy="2.5" r="2.5" transform="translate(16)" fill="#1c2136"/>
</svg>

                    </span>
                    </h1>
                <div id="gg<?=$indexy?>" class="ch_0"></div>
            </div>
            <script>
                var options = {
                    title: {
                        text: '    ',
                        align: 'center'
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return  addCommas(value ) ;
                            }
                        },
                    },
                    chart: {
                        type: 'bar'
                    },
                    series: ser ,
                
                    xaxis: {
                        categories: words
                    }
                }

                var chart = new ApexCharts(document.querySelector("#gg<?=$indexy?>"), options);

                chart.render();
            </script>
            <br>
            <br><br>
            <br>
            <br>
            <br><br>
            <br><br>
            <br>

        </div>
    </div>







<?php
            $indexy++;
            $indexy1++;
$full_t_g[]=  $t_g;

$t_g=array();
$global1=array();
$global2=array();
  $years=array();
        }
    }
    $city=array_unique($city);
    ?>
</div>


<?php
$arr2=array();
$arr=array();
$arr[]['name']=$city[0];
$arr[]['name']=$city[1];
$arr2[]['name']='نسبت';



//var_dump($city);
$i1=0;

foreach ($full_t_g as $fk=>$fv){
    foreach ($fv as $kk=>$va){
//        debugVar($va);
//        debugVar($kk);
        $arr[0]['data'][]=$va[0]['data'][0];
        $arr[1]['data'][]=$va[1]['data'][0];
        if ($va[0]['data'][0]>$va[1]['data'][0]){
            $num=bcdiv($va[0]['data'][0],$va[1]['data'][0],1);
        }else{
            $num= bcdiv($va[1]['data'][0],$va[0]['data'][0],1);
        }
//        debugVar($num);
        $arr2[0]['data'][]=($num);
    }
}
//debugVar( $arr);
//echo '--------------';
//debugVar( $arr2);
//echo '--------------';
//debugVar($full_years);

?>


<script>

    var words=null;
    var ser=null;
    // var words = '[{"name":"shiraz","data":[50]},{"name":"shiraz","data":[50]},{"name":"shiraz","data":[50]}]';// don't use quotes
      ser = <?php echo json_encode($arr) ?>;// don't use quotes
      words = <?php echo json_encode($full_years) ?>;// don't use quotes

</script>
<br>
<br>
<br>
<br>
<br>
        <br>
        <br>
        <br><br>
        <br>
        <br>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div>
            <div class="chs">
                <h1 class="sp">
                    <i  >


                        نمودار
                        شماره
                        <i   class="editable" data-url="<?=baseUrl()?>/login/ch"> ---</i>
                        امتیازات
                        میزان جهانی شدن  فضای جغرافیایی   <?=$city[0]?>   نسبت به   <?=$city[1]?> از سال <?=current($full_years);?>  تا   سال <?=end($full_years);?>
                    </i>

                </h1>
            </div>
            <div id="full"></div>

            <script>
                var options = {
                    title: {
                        text:'',
                        align: 'center'
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return  addCommas(value ) ;
                            }
                        },
                    },
                    chart: {
                        type: 'bar',
                        height: 400
                    },
                    series: ser ,

                    xaxis: {
                        categories: words
                    }
                };

                var chart = new ApexCharts(document.querySelector("#full"), options);

                chart.render();
            </script>

        </div>
    </div>
</div>
<br>
<br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div>
                    <div class="chs">
                        <h1 class="sp">
                            <i class="editable" data-url="<?=baseUrl()?>/login/ch">

                                نمودار
                                شماره
                                <i   class="editable" data-url="<?=baseUrl()?>/login/ch"> ---</i>
                                امتیازات
                                میزان جهانی شدن  فضای جغرافیایی   <?=$city[0]?>  نسبت به   <?=$city[1]?> از سال <?=$full_years[0];?>  تا   سال <?=end($full_years);?>

                            </i>
                        </h1>

                    </div>
                    <div id="full2"></div>

                    <script>
                        var options2 = {
                            title: {
                                text:'',
                                align: 'center'
                            },
                            yaxis: {
                                labels: {
                                    formatter: function (value) {
                                        return  addCommas(value ) ;
                                    }
                                },
                            },
                            chart: {
                                type: 'area',
                                height: 400
                            },
                            series: ser ,
                            xaxis: {
                                categories: words
                            }
                        };

                        var chart2 = new ApexCharts(document.querySelector("#full2"), options2);

                        chart2.render();
                    </script>

                </div>
            </div>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br><br>
        <br>
        <br>
        <br>
        <br><br>
        <br>
        <br>    <br><br>
        <br>
        <br>
        <br>
        <br><br>
        <br>
        <br>
        <br>
        <script>

            // var words=null;
            var ser=null;
            // var words = '[{"name":"shiraz","data":[50]},{"name":"shiraz","data":[50]},{"name":"shiraz","data":[50]}]';// don't use quotes
            ser = <?php echo json_encode($arr2) ?>;// don't use quotes
            //words = <?php //echo json_encode($full_years) ?>//;// don't use quotes
            console.log(words)

        </script>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div>
                    <div class="chs">
                        <h1 class="sp">
                            <i class="editable" data-url="<?=baseUrl()?>/login/ch">

                                نمودار
                                شماره
                                <i   class="editable" data-url="<?=baseUrl()?>/login/ch"> ---</i>
                                نسبت  اختلاف میزان جهانی شدن  فضای جغرافیایی

                                <?=$city[0]?>  و     <?=$city[1]?> از سال <?=$full_years[0]?>  تا   سال <?=end($full_years);?>


                            </i>
                        </h1>

                    </div>
                    <div id="full3"></div>

                    <script>
                        var options3 = {
                            title: {
                                text:'',
                                align: 'center'
                            },

                            chart: {
                                type: 'area',
                                height: 400
                            },
                            series: ser ,
                            xaxis: {
                                categories: words
                            }
                        };

                        var chart3 = new ApexCharts(document.querySelector("#full3"), options3);

                        chart3.render();
                    </script>

                </div>
            </div>
        </div>




    </div>
</div>
