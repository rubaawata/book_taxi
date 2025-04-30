<!-- info section -->

<section class="info_section layout_padding-top layout_padding2-bottom">
    <div class="container">
        <div class="box">
            <div class="info_form">
                <h4>
                    <?php echo $labels['subscribe_our_newsletter'] ?>
                </h4>
                <form action="">
                    <input id="subscriber_email" type="text" placeholder="<?php echo $labels['enter_your_email'] ?>">
                    <div class="d-flex justify-content-end">
                        <button id="add_subscriber_button" type="button" onclick="addSubscriber()">

                        </button>
                    </div>
                </form>
                <small id="subscriber_email_error" class="error"></small>
            </div>
            <div class="info_links">
                <ul>
                    <li class=" ">
                        <a class="" href="#"><?php echo $labels['home'] ?> <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="">
                        <a class="" href="#about-section"> <?php echo $labels['about'] ?></a>
                    </li>
                    <li class="">
                        <a class="" href="#services-section"> <?php echo $labels['services'] ?> </a>
                    </li>
                    <li class="">
                        <a class="" href="#contact-us-section"><?php echo $labels['contact_us'] ?></a>
                    </li>
                </ul>
            </div>
            <div class="info_social">
                <div>
                    <a href="">
                        <img src="images/fb.png" alt="">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img src="images/twitter.png" alt="">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img src="images/linkedin.png" alt="">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img src="images/instagram.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- end info section -->

<!-- footer section -->
<section class="container-fluid footer_section">
    <div class="container">
        <p>
            &copy; <span id="current-year"></span> <?php echo $labels['all_rights_reserved'] ?>
            <script>
                document.getElementById('current-year').innerHTML = new Date().getFullYear();;
            </script>
        </p>
    </div>
</section>
<!-- footer section -->

<!-- Float Buttons -->
<a class="click-to-call" href="tel:<?php echo $admin_phone?>"><i class="fa-solid fa-phone"></i></a>