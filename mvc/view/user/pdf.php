<!DOCTYPE html>
<html lang="fa">
<head>

    <meta charset="UTF-8">
    <title>Document</title>

    <style>
        body{
            font-family: mitra!important;
            text-align: right;
            direction: rtl;
        }
        body *{
            text-align: right;
        }
    </style>
    <link rel="stylesheet" href="/chart/css/style2.css">

</head>
<body style="font-family: mitra!important;">
<?php

?>

<?php


?>
<div id="final" class="rows">
    <div class="contaiwner">

        <script>
            var fruits=[];
        </script>


        <div class="row ">
            <?php
            $total=$_SESSION['total'];
            if ($total){
                foreach ($total as $t_k1=>$to1){
                    $full_years[]=$to1['c1']['year'];
                }
                $indexy=0;
                $indexy1=1;
                foreach ($total as $t_k=>$to){

                    $years[]=$to['c1']['year'];
                    $city[0]=$to['c1']['city'];
                    $city[1]=$to['c2']['city'];
                    $sum_glob=$to['c1']['globalization ']+$to['c2']['globalization '];
                    $total[$t_k]['c1']['per_glob']=floor(($to['c1']['globalization ']*100)/$sum_glob);
                    $total[$t_k]['c2']['per_glob']=floor(($to['c2']['globalization ']*100)/$sum_glob);
                    $global1[]=$total[$t_k]['c1']['per_glob'];

                    $global2[]=$total[$t_k]['c2']['per_glob'];
                    $t_g[$indexy][0]['name']=$to['c1']['city'];
                    $t_g[$indexy][0]['data']=$global1;
                    $t_g[$indexy][1]['name']=$to['c2']['city'];
                    $t_g[$indexy][1]['data']=$global2;


//            var_dump($t_g);

                    ?>





                    <script>
                        var words = <?php echo json_encode($years) ?>;// don't use quotes
                        var ser = <?php echo json_encode($t_g[$indexy]) ?>;// don't use quotes
                        fruits.push(<?php echo json_encode($t_g[$indexy]) ?>)

                    </script>

                    <div class="col-lg-6 col-md-12 cls<?=ceil($indexy1%2)?> ">
                        <div>

                            <div id="gg<?=$indexy?>"></div>
                            <script>
                                var options = {
                                    title: {
                                        text: 'نمدار درصد جهانی شدن در سال <?=$to['c1']['year'];?>',
                                        align: 'center'
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

                                // chart.render();
                            </script>

                            <div class="tab">
                                <h1> جدول اطلاعات سنجش مقایسه ای جهانی شدن فضای جغراقیای
                                    (cmGGs)
                                    دو شهر
                                    <?=$city[0]?>و<?=$city[1]?>
                                    در سال
                                    <?=$to['c1']['year'];?>
                                </h1>
                                <table>
                                    <thead>
                                    <tr>
                                        <th>مولفه </th>
                                        <th> <?=$city[0]?> شهر</th>
                                        <th> <?=$city[1]?> شهر</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>integration</td>
                                        <td><?=$to['c1']['integration']?></td>
                                        <td><?=$to['c2']['integration']?></td>
                                    </tr>
                                    <tr>
                                        <td>connectivity</td>
                                        <td><?=$to['c1']['connectivity']?></td>
                                        <td><?=$to['c2']['connectivity']?></td>
                                    </tr>
                                    <tr>
                                        <td>space of flow</td>
                                        <td><?=$to['c1']['space_of_flow']?></td>
                                        <td><?=$to['c2']['space_of_flow']?></td>
                                    </tr>
                                    <tr>
                                        <td>globalization </td>
                                        <td><?=$to['c1']['globalization ']?>  (<?=$total[$t_k]['c1']['per_glob']?>%)</td>
                                        <td><?=$to['c2']['globalization ']?> (<?=$total[$t_k]['c2']['per_glob']?>%)</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

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
    </div>
</div>

<?php
$arr=array();
$arr[]['name']=$city[0];
$arr[]['name']=$city[1];


//var_dump($city);
$i1=0;

foreach ($full_t_g as $fk=>$fv){
    foreach ($fv as $kk=>$va){
        $arr[0]['data'][]=(int)$va[0]['data'][0];
        $arr[1]['data'][]=(int)$va[1]['data'][0];
    }
}
var_dump( $arr);
?>


<script>
    console.log(fruits);

    // var words = '[{"name":"shiraz","data":[50]},{"name":"shiraz","data":[50]},{"name":"shiraz","data":[50]}]';// don't use quotes
    var ser = <?php echo json_encode($arr) ?>;// don't use quotes
    var words = <?php echo json_encode($full_years) ?>;// don't use quotes

</script>

<div class="col-lg-12 col-md-12">
    <div>
        <div id="full"></div>

        <script>
            var options = {
                title: {
                    text: '    نمدار درصد جهانی شدن از سال <?=current($full_years);?>  تا   سال <?=end($full_years);?> ',
                    align: 'center'
                },
                chart: {
                    type: 'bar'
                },
                series: ser ,
                xaxis: {
                    categories: words
                }
            };

            var chart = new ApexCharts(document.querySelector("#full"), options);

            // chart.render();
        </script>

    </div>
</div>

<div class="col-lg-6 col-md-12">
    <div>
        <div id="full2"></div>

        <script>
            var options = {
                title: {
                    text: '    نمدار درصد جهانی شدن از سال <?=current($full_years);?>  تا   سال <?=end($full_years);?> ',
                    align: 'center'
                },
                chart: {
                    type: 'line'
                },
                series: ser ,
                xaxis: {
                    categories: words
                }
            };

            var chart = new ApexCharts(document.querySelector("#full2"), options);

            // chart.render();
        </script>

    </div>
</div>




</body>
</html>