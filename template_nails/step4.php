<?php
include_once './header.php';
if(isset($_SESSION['user-book'])){
    $userbook = $_SESSION['user-book'];
}
if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
}
?>

    <!-- Booking start-->
    <section class="booking-nail mb-5 pt-4">
        <div class="success-section container">
            <div class="row">
                <div class="col-12">
                    <div class="success-content">
                        <!-- <div class="circle">
                            <div class="checkmark draw"></div>
                        </div> -->
                        <div class="d-flex justify-content-center">
                            <lottie-player src="./img/8785-blue-checkmark.json" background="transparent"  speed="1"  style="width: 200px; height: 200px;" loop  autoplay></lottie-player>
                        </div>
                        <!-- <img style="background: transparent;" src="./img/lf20_szzN8j.gif" alt=""> -->
                        <p><b>Thank you!</b></p>
                        <p>Your appointment has been sent to the owner but you need to wait for their confirmation.</p>
                        <!-- <img src="./img/image 1.png" class="img-fluid" alt=""> -->
                        <div class="drive-line"></div>

                        <div class="history-card">
                            <div class="title">Info your appointment:</div>
                            <div class="owner">
                                <div class="name"><?php if(isset($userbook)){echo $userbook[0];} ?></div>
                                <div class="phone"><?php if(isset($userbook)){echo $userbook[1];} ?></div>
                            </div>
                            <div class="lists">
                                <ul>
                                    <?php
                                        if(isset($cart)){
                                            foreach($cart as $item){ ?>
                                                <li><b><?=$item['name_service']?></b> by <b><?=$item['user_name']?></b> in 
                                                <b><?php
                                                $english_date = date('F j, Y', strtotime($item['date_duration']));
                                                echo $english_date . ' at ' . $item['time_duration'];
                                                ?></b>
                                            </li>
                                    <?php } }?>
                                </ul>
                            </div>
                        </div>

                        <div class="drive-line"></div>

                    <a class="btn btn-booking" style="text-transform: capitalize;" href="unset_session.php?id=<?=$ID_COM?>">Book another appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Booking end-->

<?php
include_once './footer.php';
?>