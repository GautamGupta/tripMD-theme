<?php
/**
 * Home page
 *
 * @package tripmd
 */

get_header(); ?>


        <div style="display:none" class="fancybox-hidden block">
            <div id="hosp-signup" class="su" style="width:480px; height:420px;">
                <h1>Clinic Signup</h1>

                <form method="post" style="color: black;" action="<?php echo site_url( '/' ); ?>">
                    
                    <div class="name fld">
                        <input type="text"  class="field" name="medical_centre" required="required" placeholder="Name of the Medical Centre" />
                        <i class="fa fa-hospital-o"></i>
                    </div>

                    <div class="country fld">
                        <input type="text"  class="field" name="country" required="required" placeholder="Country" />
                        <i class="fa fa-map-marker"></i>
                    </div>

                    <div class="poc fld">
                        <input type="text"  class="field" name="poc" required="required" placeholder="Point of Contact" />
                        <i class="fa fa-phone"></i>
                    </div>

                    <div class="email fld">
                        <input type="email" class="last field" name="email" required="required" placeholder="Email Address" />
                        <i class="fa fa-envelope-o"></i>
                    </div>

                    <input type="hidden" name="hsign" value="1" />
                    <?php wp_nonce_field( 'tmd_home_register' ); ?>

                    <input type="submit" class="big fat green button submit" value="Sign Up" />

                </form>

            </div>
        </div>

        <div id="slider-with-blocks-1" class="slider royalSlider rsMinW">

            <div class="rsContent slide1">

                <div class="bContainer">

                    <div class="block rsABlock">
                        <div class="centered">
                            <h2><?php _e( 'Get treatment by trusted doctors worldwide', 'tripmd' ); ?></h2>
                            <h3><?php _e( 'Receive quality medical care from a trusted doctor at a world class medical center', 'tripmd' ); ?></h3>
                            <a class="big fat green button" href="#how">See How it Works</a>
                        </div>
                    </div>

                    <!-- <span class="rsABlock txtCent" data-move-effect="none">you can place it on any type of slide</span> -->
                </div>

                <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-1.jpg" />

            </div>

            <div class="rsContent slide2">

                <div class="bContainer">

                    <div class="block rsABlock">
                        <div class="centered">
                            <h2>Tried and trusted by the international community</h2>
                            <h3>Access healthcare options that expatriates and diplomats use in our featured cities.</h3>
                            <a class="big fat green button" href="#how">See How it Works</a>
                        </div>
                    </div>

                    <!-- <span class="rsABlock txtCent" data-move-effect="none">you can place it on any type of slide</span> -->
                </div>

                <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-2.jpg" />

            </div>


            <div class="rsContent slide4">

                <div class="bContainer">

                    <div class="block rsABlock">
                        <div class="centered">
                            <h2>Consultations and follow-ups made easy.</h2>
                            <h3>Stay connected with your doctor no matter where you are in the world.</h3>
                            <a class="big fat green button" href="#how">See How it Works</a>
                        </div>
                    </div>

                    <!-- <span class="rsABlock txtCent" data-move-effect="none">you can place it on any type of slide</span> -->
                </div>

                <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-4.jpg" />

            </div>

            <div class="rsContent slide3">

                <div class="bContainer">

                    <div class="block rsABlock">
                        <div class="centered">
                            <h2>Connect with other patients.</h2>
                            <h3>Get in touch with our community of patients who have undergone surgeries abroad and hear about their experiences.</h3>
                            <a class="big fat green button" href="#how">See How it Works</a>
                        </div>
                    </div>

                    <!-- <span class="rsABlock txtCent" data-move-effect="none">you can place it on any type of slide</span> -->
                </div>

                <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-5.jpg" />

            </div>

            <div class="rsContent slide5">

                <div class="bContainer">

                    <div class="block rsABlock">
                        <div class="centered">
                            <h2>Travel and stay in comfort</h2>
                            <h3>Book travel and accommodation using our easy-to-use web and mobile app, so you can focus on your recovery.</h3>
                            <a class="big fat green button" href="#how">See How it Works</a>
                        </div>
                    </div>

                    <!-- <span class="rsABlock txtCent" data-move-effect="none">you can place it on any type of slide</span> -->
                </div>

                <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-3.jpg" />

            </div>
        </div>

        <section class="how">

            <div class="grid-container">

                <?php if ( defined( 'TMD_DEBUG' ) || isset( $_GET['ta'] ) ) : ?>
                    <div class="tmd-search-container aligncenter grid-100">
                        <input type="text" name="s" id="s" class="tmd-search" placeholder="<?php _e( 'Search for a treatment or hospital...', 'tripmd' ); ?>" autocomplete="off" data-provide="typeahead" />
                    </div>
                <?php endif; ?>


                <span id="how"></span>
                <div class="heading howh grid-100"><h2>Here&rsquo;s how it works.</h2></div>

                <div class="content">

                    <div class="iu grid-100 grid-parent">

                        <div class="grid-80">

                            <h3>Explore treatment options at the top medical centers around the world.</h3>
                            <p>Browse from our extensive list of experienced doctors and prestigious institutions based on the treatment you are seeking.</p>

                        </div>

                        <div class="grid-20">

                            <img src="<?php echo get_template_directory_uri(); ?>/img/home-f1.png" alt="">

                        </div>

                    </div>

                    <div class="iu grid-100 grid-parent">

                        <div class="grid-80 push-20">

                            <h3>Schedule an E-Consultation.</h3>
                            <p>Reserve a date to have a video conversation with the doctor of your choice. We will remind you of your appointment date and give you a location to share your medical files.</p>

                        </div>

                        <div class="grid-20 pull-80">

                            <img src="<?php echo get_template_directory_uri(); ?>/img/home-f2.png" alt="">

                        </div>

                    </div>


                    <div class="iu grid-100 grid-parent">

                        <div class="grid-80">

                            <h3>Arrange your travel and accommodation.</h3>
                            <p>We help you find travel and accommodation for yourself and your companions.  Through our site you can find and book a comfortable spot for you to rest while you focus on your recovery.</p>

                        </div>

                        <div class="grid-20 img" style="background-image: url('');">

                            <img src="<?php echo get_template_directory_uri(); ?>/img/home-f3.png" alt="">

                        </div>

                    </div>

                    <div class="iu grid-100 grid-parent">

                        <div class="grid-80 push-20">

                            <h3>Follow-ups made easy.</h3>
                            <p>After you return home, we make sure that your doctors at home and overseas are keeping in touch to ensure that you are have a smooth recovery.</p>

                        </div>

                        <div class="grid-20 pull-80">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/home-f4.png" alt="">
                        </div>

                        <a class="big fat green button waitlist push-40" href="<?php echo home_url( '/invitation' ); ?>">Get early access</a>

                    </div>

            </div>

        </section>

        <section class="hear">

            <div class="grid-container">

                <div class="heading grid-100"><h2>Hear from patients who have healthcare experience overseas.</h2></div>

                <div class="content">

                    <div id="content-slider-1" class="royalSlider contentSlider rsDefault">

                      <div>
                        <!-- <span class="rsTmb">Patients</span> -->
                        <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-testimonial-patient.jpg" data-rsvideo="http://vimeo.com/95297775" data-rsw="860" data-rsh="484">
                      </div>
                      <?php /*
                      <div>
                        <span class="rsTmb">Doctors</span>
                        <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-testimonial-doctor.jpg" data-rsvideo="https://www.youtube.com/watch?v=kduGimbgEyM" data-rsw="640" data-rsh="425">
                      </div>
                      */ ?>
                    </div>

                </div>

            </div>

        </section>

        <section class="mock">

            <div class="grid-container">

                <div class="heading grid-100"><h2>We&rsquo;re always with you.</h2></div>

                <div class="content">

                    <div class="grid-50 et-custom-list mock-bullets">

                        <ul>
                            <li>Live itinerary that's always up to date.</li>
                            <li>24X7 assistance: Tap-to-call each point of contact.</li>
                            <li>Secure transfer of your health records to and fro from the doctor</li>
                            <li>Post operative followup made easy</li>
                        </ul>

                    </div>

                    <p class="mpar grid-50"><img src="<?php echo get_template_directory_uri(); ?>/img/mockup.png" class="mockup" alt=""></p>

                </div>

                <a class="big fat green button waitlist push-40" href="<?php echo home_url( '/invitation' ); ?>">Get early access</a>

            </div>

        </section>

        <?php if ( ! empty( $_GET['hsign'] ) && $_GET['hsign'] == 'error' ) : ?>
        <hr/>
            <section id="hs" class="center last green">
                <div class="grid-container">
                    <p id="message">
                        Oops! There was an error registering your clinic, please try again. You can also try emailing us at help@tripmd.co.
                    </p>
                </div>
            </section>
        <?php elseif ( ! empty( $_GET['hsign'] ) && $_GET['hsign'] == 'success' ) : ?>
            <section id="hs" class="center last green">
                <div class="grid-container">
                    <p id="message">
                        Thank you for registering. We'll get back to you shortly.
                    </p>
                </div>
            </section>
        <hr/>
        <?php endif; ?>

        <?php /* if ( ! is_user_logged_in() ) : ?>

            <section class="center last green" id="su">

                <div class="grid-container">

                    <?php if ( !empty( $_GET['su'] ) ) : ?>

                        <div class="heading grid-100 suh"><h2>Thanks for registering. We'll keep you updated!</h2></div>

                    <?php else : ?>

                        <div class="heading grid-100 suh"><h2>Join the waiting list for exclusive early access.</h2></div>

                        <div class="content grid-60 push-20">

                            <form method="post" action="wp-login.php">

                                <input type="text"  class="first-name grid-45" name="first_name" placeholder="First" />
                                <input type="text"  class="last-name grid-45 push-10" name="last_name" placeholder="Last" />
                                <input type="email" class="email grid-100" name="user_email" placeholder="name@gmail.com" required="required" />

                                <input type="hidden" name="action"      value="register" />
                                <input type="hidden" name="user-cookie" value="1" />
                                <input type="hidden" name="tmd_home_register" value="1" />
                                <input type="hidden" name="redirect_to" value="<?php echo home_url( '?su=1#su' ); ?>" />

                                <?php wp_nonce_field( 'tmd_home_register' ); ?>

                                <input type="submit" class="email grid-100" value="Signup" />

                            </form>

                        </div>

                    <?php endif; ?>

                </div>

            </section>
        <?php endif; */ ?>
<?php get_footer(); ?>