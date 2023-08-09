<?php
include_once './header.php';

$arr_allTime = [];//Array time all time frames 
$arr_morning = [];//Array time in morning of service
$arr_afternoon = [];//Array time in afternoon of service
$arr_evening = [];//Array time in evening of service

if(isset($_SESSION['cart'])){
    
    $time_start = $_SESSION['cart'][0]['time_start'];
    $time_end = $_SESSION['cart'][0]['time_end'];
    $time_completion = $_SESSION['cart'][0]['time_completion'];

    $startTime = date($time_start);//khởi tạo
    $endTime = date($time_end);//khởi tạo

    $hour = substr($time_completion,0,2);
    $minute = substr($time_completion,3,2);
    $second = substr($time_completion,6,2);

    $cenvertedTime = date('H:i:s',strtotime("+$hour hour +$minute minutes +$second seconds",strtotime($startTime)));

    $last_timeJob = date('H:i:s',strtotime("-$hour hour -$minute minutes -$second seconds",strtotime($endTime)));

    array_push($arr_allTime, $time_start);

    $tempTime;
    for ($i=0; $i < 48; $i++) { 
        $tempTime = date('H:i:s',strtotime("+$hour hour +$minute minutes +$second seconds",strtotime($startTime)));
        $startTime = $tempTime;
        if(strtotime($startTime) >= strtotime($last_timeJob)){
            break;
        }
        array_push($arr_allTime, $tempTime);
    }

    //Add once time in frame
    foreach($arr_allTime as $item){
        if(strtotime($item) <= strtotime("12:00:00")){
            array_push($arr_morning, $item);
        }else if(strtotime($item) > strtotime("12:00:00") && strtotime($item) <= strtotime("17:00:00")){
            array_push($arr_afternoon, $item);
        }else{
            array_push($arr_evening, $item);
        }
    }
}
// if(isset($_SESSION['cart'])){
//     $time_start; 
//     $time_end;
//     $time_completion;
//     foreach($_SESSION['cart'] as $item){
//         $time_start = $item['time_start'];
//         $time_end = $item['time_end'];
//         $time_completion = $item['time_completion'];

//         $hour = substr($time_completion,0,2);
//         $minute = substr($time_completion,3,2);
//         $second = substr($time_completion,6,2);
//     }
    
//     $startTime = date($time_start);//khởi tạo
//     $endTime = date($time_end);//khởi tạo
    
//     $cenvertedTime = date('H:i:s',strtotime("+$hour hour +$minute minutes +$second seconds",strtotime($startTime)));

//     $last_timeJob = date('H:i:s',strtotime("-$hour hour -$minute minutes -$second seconds",strtotime($endTime)));

//     array_push($arr_allTime, $time_start);

//     $tempTime;
//     for ($i=0; $i < 48; $i++) { 
//         $tempTime = date('H:i:s',strtotime("+$hour hour +$minute minutes +$second seconds",strtotime($startTime)));
//         $startTime = $tempTime;
//         if(strtotime($startTime) >= strtotime($last_timeJob)){
//             break;
//         }
//         array_push($arr_allTime, $tempTime);
//     }

//     //Add once time in frame
//     foreach($arr_allTime as $item){
//         if(strtotime($item) <= strtotime("12:00:00")){
//             array_push($arr_morning, $item);
//         }else if(strtotime($item) > strtotime("12:00:00") && strtotime($item) <= strtotime("17:00:00")){
//             array_push($arr_afternoon, $item);
//         }else{
//             array_push($arr_evening, $item);
//         }
//     }
// }

?>
    <!-- Booking start-->
    <section class="booking-nail mb-5 pt-5">
        <div class="container">
            <form action="./step3.php" method="get">
            <?php if(isset($_GET['id'])){ ?>
                <input type="number" id="guest_com" name="id" value="<?=$ID_COM?>" hidden>
            <?php } ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pickup-main">
                            <div class="title">
                                <h5>Select date and time</h5>
                            </div>
                            <div class="list-date mt-3 mb-3">
                                <input onchange="propressTime();" id="myInput" name="date_checked" class="form-control" required/>
                                <div class="row mt-3">
                                    <div class="col-12 p-0 mb-2">
                                        <div class="title-time">
                                            <h5><b>Morning</b></h5>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row text-center list-hour">
                                            <?php foreach($arr_morning as $item){ ?>
                                                <div class="col-lg-3 col-md-6 col-6">
                                                    <input type="radio" name="time_checked" value="<?=substr($item,0,5)?>" hidden>
                                                    <?=substr($item,0,5)?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 p-0 mb-2">
                                        <div class="title-time">
                                            <h5><b>Afternoon</b></h5>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row text-center list-hour">
                                            <?php foreach($arr_afternoon as $item){ ?>
                                                <div class="col-lg-3 col-md-6 col-6">
                                                    <input type="radio" name="time_checked" value="<?=substr($item,0,5)?>" hidden>
                                                    <?=substr($item,0,5)?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 p-0 mb-2">
                                        <div class="title-time">
                                            <h5><b>Evening</b></h5>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row text-center list-hour">
                                            <?php foreach($arr_evening as $item){ ?>
                                                <div class="col-lg-3 col-md-6 col-6">
                                                    <input type="radio" name="time_checked" value="<?=substr($item,0,5)?>" hidden>
                                                    <?=substr($item,0,5)?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-end mt-5">
                                <div class="group-btn">
                                    <a href="index.php?id=<?=$ID_COM?>" class="back">Back</a>
                                    <button type="submit">Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Booking end-->

<?php
include_once './footer.php';
?>