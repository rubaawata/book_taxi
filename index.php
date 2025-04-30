<?php include 'back/data.php' ?>
<?php include 'back/constants.php' ?>
<?php
    session_start();

    $lang = 'du';
    if(isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'du']))
        $lang = $_GET['lang'];
        
    $_SESSION['lang'] = $lang;

    include 'lang/' . $_SESSION['lang']  . '.php';
?>
<!DOCTYPE html>
<html>
   

<?php include 'sections/head.php' ?>

<body>

    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="#">
                        <img class="logo" src="images/header_logo.jpg">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
                            <ul class="navbar-nav  ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#"><?php echo $labels['home'] ?> <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#about-section"> <?php echo $labels['about'] ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#services-section"> <?php echo $labels['services'] ?> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#contact-us-section"><?php echo $labels['contact_us'] ?></a>
                                </li>
                                <li class="nav-item">
                                    <?php if($_SESSION['lang'] == 'du') {?>
                                        <a class="nav-link" href="?lang=en">
                                            <img class="change-lang-icon" src="images/English.png">
                                        </a>
                                    <?php } else {?>
                                        <a class="nav-link" href="?lang=du">
                                            <img class="change-lang-icon" src="images/Dutch.png">
                                        </a>
                                    <?php }?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
        <!-- slider section -->
        <section class=" slider_section ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7 ">
                        <div class="box">
                            <div class="detail-box">
                                <h4>
                                    <?php echo $labels['welcome_to'] ?>
                                </h4>
                                <h1>
                                    Taxi Rotterdam RTN
                                </h1>
                            </div>
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">

                                        <div class="img-box">
                                            <img src="images/hero-1.png" alt="">
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="img-box">
                                            <img src="images/hero-2.png" alt="">
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="img-box">
                                            <img src="images/hero-3.png" alt="">
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="img-box">
                                            <img src="images/hero-4.png" alt="">
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="img-box">
                                            <img src="images/hero-5.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 " id="book-section">
                        <div class="slider_form">
                            <h4>
                                <?php echo $labels['get_taxi']?>
                            </h4>
                            <div class="custom-input-div">
                                <select class="custom-input" id="service_type">
                                    <option value="" disabled selected><?php echo $labels['service_type'] ?></option>
                                    <?php foreach($service_types as $service_type) {?>
                                        <option value="<?php echo $service_type['id'] ?>">
                                            <?php 
                                            if($lang == "en")
                                             echo $service_type['name_en'];
                                             else{
                                                echo $service_type['name_du'];
                                             } 
                                             ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <small id="service_type_error" class="error"></small>
                            </div>
                            <div class="custom-input-div">
                                <input class="custom-input" id="start_location" type="text" placeholder="<?php echo $labels['pick_up_location'] ?>">
                                <small id="start_location_error" class="error"></small>
                            </div>
                            <div class="custom-input-div">
                                <input class="custom-input" id="end_location" type="text" placeholder="<?php echo $labels['drop_location'] ?>">
                                <small id="end_location_error" class="error"></small>
                            </div>
                            <div class="custom-input-div">
                                <input class="custom-input datetime" id="date"  placeholder="<?php echo $labels['date'] ?>">
                                <small id="date_error" class="error"></small>
                            </div>
                            <div class="btm_input">
                                <button class="primary_btn" type="button" onclick="openFareModal()"><?php echo $labels['book_now'] ?></button>
                            </div>
                            <h4>
                                <?php echo $labels['or'] ?>
                            </h4>
                            <div class="book-form__call-us-buttons">
                                <div class="book-form__call-us-buttons-item">
                                    <a href="tel:<?php echo $admin_phone?>"><i class="fa-solid fa-phone"></i></a>
                                </div>
                                <div class="book-form__call-us-buttons-item">
                                    <a href="mailto:<?php echo $admin_email?>"><i class="fa-solid fa-envelope"></i></a>
                                </div>
                                <div class="book-form__call-us-buttons-item">
                                    <a href="whatsapp://send?abid=<?php echo $admin_whatsapp?>"><i class="fab fa-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- end slider section -->
    </div>

    <!-- about section -->

    <section class="about_section layout_padding" id="about-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-5 offset-lg-2 offset-md-1">
                    <div class="detail-box">
                        <h2>
                            <?php echo $labels['about'] ?> <br>
                            Taxi Rotterdam RTN <?php echo $labels['company'] ?>
                        </h2>
                        <p>
                            <?php echo $labels['about_description'] ?>
                        </p>
                        <a href="#book-section">
                            <?php echo $labels['try_it'] ?>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="images/about-img.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end about section -->

    <!-- service section -->

    <section class="service_section layout_padding" id="services-section">
        <div class="container">
            <div class="heading_container">
                <h2>
                    <?php echo $labels['our'] ?> <br>
                    <?php echo $labels['taxi_services'] ?>
                </h2>
            </div>
            <div class="service_container">
                <div class="box">
                    <div class="img-box">
                        <img src="images/delivery-man.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            <?php echo $labels['private_driver'] ?>
                        </h5>
                        <p>
                            <?php echo $labels['private_driver_description'] ?>
                        </p>
                        <a href="#book-section">
                            <?php echo $labels['try_it'] ?>
                        </a>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="images/airplane.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            <?php echo $labels['airport_transfer'] ?>
                        </h5>
                        <p>
                            <?php echo $labels['airport_transfer_description'] ?>
                        </p>
                        <a href="#book-section">
                            <?php echo $labels['try_it'] ?>
                        </a>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="images/backpack.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            <?php echo $labels['luggage_transfer'] ?>
                        </h5>
                        <p>
                            <?php echo $labels['luggage_transfer_description'] ?>
                        </p>
                        <a href="#book-section">
                            <?php echo $labels['try_it'] ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end service section -->

    <!-- news section -->

    <section class="news_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    <?php echo $labels['our'] ?> <br>
                    <?php echo $labels['service_types'] ?>
                </h2>
            </div>
            <div class="news_container">
                <div class="box">
                    <div class="img-box">
                        <img src="images/business_class_halfprofile_right.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h6>
                            <?php echo $labels['service_type_1'] ?>
                        </h6>
                        <div class="service-type__counts">
                            <div class="service-type__counts-item">
                                <i class="fa-solid fa-user"></i><span><?php echo $labels['max'] ?>. 4</span>
                            </div>
                            <div class="service-type__counts-item">
                                <i class="fa-solid fa-suitcase"></i><span><?php echo $labels['max'] ?>. 3</span>
                            </div>
                        </div>
                        <p>
                            <?php echo $labels['service_type_1_description'] ?>
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="images/van_halfprofile_right.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h6>
                            <?php echo $labels['service_type_2'] ?>
                        </h6>
                        <div class="service-type__counts">
                            <div class="service-type__counts-item">
                                <i class="fa-solid fa-user"></i><span><?php echo $labels['max'] ?>. 8</span>
                            </div>
                            <div class="service-type__counts-item">
                                <i class="fa-solid fa-suitcase"></i><span><?php echo $labels['max'] ?>. 6</span>
                            </div>
                        </div>
                        <p>
                            <?php echo $labels['service_type_2_description'] ?>
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="images/first_class_halfprofile_right.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h6>
                            <?php echo $labels['service_type_3'] ?>
                        </h6>
                        <div class="service-type__counts">
                            <div class="service-type__counts-item">
                                <i class="fa-solid fa-user"></i><span><?php echo $labels['max'] ?>. 4</span>
                            </div>
                            <div class="service-type__counts-item">
                                <i class="fa-solid fa-suitcase"></i><span><?php echo $labels['max'] ?>. 3</span>
                            </div>
                        </div>
                        <p>
                            <?php echo $labels['service_type_3_description'] ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end news section -->

    <!-- client section -->

    <section class="client_section layout_padding-bottom" id="clients-section">
        <div class="container">
            <div class="heading_container">
                <h2>
                    <?php echo $labels['what'] ?> <br>
                    <?php echo $labels['client'] ?> <br>
                    <?php echo $labels['says'] ?>
                </h2>
            </div>
            <div class="client_container">
                <div class="carousel-wrap ">
                    <div class="owl-carousel">
                        <div class="item">
                            <div class="box">
                                <div class="img-box">
                                    <img src="images/client-1.png" alt="">
                                </div>
                                <div class="detail-box">
                                    <h3>
                                        Sarah
                                    </h3>
                                    <p>
                                        <?php echo $labels['client_1_description'] ?>
                                    </p>
                                    <img src="images/quote.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="box">
                                <div class="img-box">
                                    <img src="images/client-2.png" alt="">
                                </div>
                                <div class="detail-box">
                                    <h3>
                                        Gaby
                                    </h3>
                                    <p>
                                        <?php echo $labels['client_2_description'] ?>
                                    </p>
                                    <img src="images/quote.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end client section -->

    <!-- contact section -->

    <section class="contact_section layout_padding-bottom" id="contact-us-section">
        <div class="container">
            <div class="heading_container">
                <h2>
                    <?php echo $labels['any_problems'] ?> <br>
                    <?php echo $labels['any_questions'] ?>
                </h2>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5  offset-md-1">
                    <div class="contact_form">
                        <h4>
                            <?php echo $labels['get_in_touch'] ?>
                        </h4>
                        <form action="">
                            <div class="custom-input-div">
                                <input class="mb-0" id="message_name" type="text" placeholder="<?php echo $labels['name'] ?>">
                                <small id="message_name_error" class="error"></small>
                            </div>
                            <div class="custom-input-div">
                                <input class="mb-0" id="message_phone"  type="text" placeholder="<?php echo $labels['phone_number'] ?>">
                                <small id="message_phone_error" class="error"></small>
                            </div>
                            <div class="custom-input-div">
                                <input id="message_message"  type="text" placeholder="<?php echo $labels['message'] ?>" class="message_input mb-0">
                                <small id="message_message_error" class="error"></small>
                            </div>
                            <button id="send_button" type="button" onclick="addMessage()"><?php echo $labels['send'] ?></button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div class="img-box">
                        <img src="images/contact-img.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact section -->

    <!-- why section -->

    <section class="why_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    <?php echo $labels['why'] ?> <br>
                    <?php echo $labels['choose_us'] ?>
                </h2>
            </div>
            <div class="why_container">
                <div class="box">
                    <div class="img-box">
                        <img src="images/delivery-man-white.png" alt="" class="img-1">
                        <img src="images/delivery-man-black.png" alt="" class="img-2">
                    </div>
                    <div class="detail-box">
                        <h5>
                            <?php echo $labels['best_drivers'] ?>
                        </h5>
                        <p>
                            <?php echo $labels['best_drivers_description'] ?>
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="images/shield-white.png" alt="" class="img-1">
                        <img src="images/shield-black.png" alt="" class="img-2">
                    </div>
                    <div class="detail-box">
                        <h5>
                            <?php echo $labels['safe_and_secure'] ?>
                        </h5>
                        <p>
                            <?php echo $labels['safe_and_secure_description'] ?>
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="images/repairing-service-white.png" alt="" class="img-1">
                        <img src="images/repairing-service-black.png" alt="" class="img-2">
                    </div>
                    <div class="detail-box">
                        <h5>
                            <?php echo $labels['24x7_support'] ?>
                        </h5>
                        <p>
                            <?php echo $labels['24x7_support_description'] ?>
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="images/price-white.png" alt="" class="img-1">
                        <img src="images/price-black.png" alt="" class="img-2">
                    </div>
                    <div class="detail-box">
                        <h5>
                            <?php echo $labels['affordable_price'] ?>
                        </h5>
                        <p>
                            <?php echo $labels['affordable_price_description'] ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end why section -->

    <?php include 'sections/footer.php' ?>

    <!---------- Reserve Modal ------------>
    <div class="modal reservation-modal" tabindex="-1" role="dialog" id="reservation_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="reservation-fare">
                        <h2 class="m-0">
                            <span class="reservation-fare__label"><?php echo $labels['fare'] ?>:</span>
                            <span class="reservation-fare__value" id="fare_value"></span><span class="reservation-fare__value">€</span>
                        </h2>
                    </div>
                    <div class="custom-input-div">
                        <input class="custom-input" id="user_name" type="text" placeholder="<?php echo $labels['your_name'] ?>">
                        <small id="user_name_error" class="error"></small>
                    </div>
                    <div class="custom-input-div">
                        <input class="custom-input" id="user_phone" type="text" placeholder="<?php echo $labels['your_phone'] ?>">
                        <small id="user_phone_error" class="error"></small>
                    </div>
                    <div class="custom-input-div">
                        <input class="custom-input" id="user_email" type="text" placeholder="<?php echo $labels['your_email'] ?>">
                        <small id="user_email_error" class="error"></small>
                    </div>
                    <div class="custom-input-div">
                        <input class="custom-input" id="user_notes" type="text" placeholder="<?php echo $labels['note_for_driver'] ?>">
                        <small id="user_notes_error" class="error"></small>
                    </div>
                    <div class="modal-buttons">
                        <button type="button" class="primary_btn" onclick="addReserve()" id="pay_button"><?php echo $labels['pay'] ?></button>
                        <button type="button" class="secondary_btn" data-dismiss="modal"><?php echo $labels['cancel'] ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'sections/alerts.php' ?>

    <?php include 'sections/scripts.php' ?>

    <script>
        var jsLabels = <?php echo json_encode( $labels ) ?>;

        function initialize() {
            var start_location_input = document.getElementById('start_location');
            new google.maps.places.Autocomplete(start_location_input);
            var end_location_input = document.getElementById('end_location');
            new google.maps.places.Autocomplete(end_location_input);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <script>
        // Target the input element by using jQuery and then call the kendoDatePicker() method.
        $("#date").datetimepicker({
            // Add some basic configuration.
            value: new Date(2022, 0, 3)
        });
    </script>
</body>

</html>