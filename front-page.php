<?php
/**
 * Home page
 *
 * @package tripmd
 */

get_header(); ?>

        <!-- Clinic signup form -->
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
        </div><!-- /Clinic signup form -->

        <!-- User login -->
        <div style="display:none" class="fancybox-hidden block">
            <div id="user-login" class="su" style="width:480px; height:330px;">
                <h1><?php _e( 'Login', 'tripmd' ); ?></h1>

                <form method="post" id="loginform" name="loginform" style="color: black;" action="<?php echo site_url( '/login' ); ?>">
                    
                    <div class="email fld">
                        <input type="text" class="field" required="required" placeholder="<?php _e( 'Email Address', 'tripmd' ); ?>" name="log" id="user_login" value="" />
                        <i class="fa fa-user"></i>
                    </div>

                    <div class="password fld">
                        <input type="password" class="last field" required="required" placeholder="<?php _e( 'Password', 'tripmd' ); ?>" name="pwd" id="user_pass" value="" />
                        <i class="fa fa-lock"></i>
                    </div>

                    <?php do_action( 'login_form' ); ?>

                    <!-- <p class="forgetmenot">
                        <input name="rememberme" type="checkbox" id="rememberme" value="forever" />
                        <label for="rememberme"><?php esc_attr_e( 'Remember Me' ); ?></label>
                    </p> -->

                    <input type="hidden" name="redirect_to" value="<?php echo site_url( '/' ); ?>" />
                    <input type="hidden" name="instance"    value="" />
                    <input type="hidden" name="action"      value="login" />

                    <input type="submit" class="big fat green button submit" name="wp-submit" id="wp-submit" value="<?php esc_attr_e( 'Login' ); ?>" />

                </form>

            </div>
        </div><!-- /User login -->

        <div id="slider-with-blocks-1" class="slider royalSlider rsMinW">

            <div class="rsContent slide1">

                <div class="bContainer">

                    <div class="block rsABlock">
                        <div class="centered">
                            <h2><?php _e( 'Get quality healthcare without expensive bills and wait times.', 'tripmd' ); ?></h2>
                            <h3><?php _e( 'Receive medical care by reliable doctors as trusted by the international community living in New Delhi', 'tripmd' ); ?></h3>
                            <?php /* <a class="big fat green button link-how" href="#how"><?php _e( 'How does it work?', 'tripmd' ); ?></a> */ ?>
                            <a class="big fat green button<?php /* link-invitation */ ?>" href="#how"><?php _e( 'See if it\'s for you', 'tripmd' ); ?></a>
                        </div>
                    </div>

                    <!-- <span class="rsABlock txtCent" data-move-effect="none">you can place it on any type of slide</span> -->
                </div>

                <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-1.jpg" />

            </div>

            <?php /*

            <div class="rsContent slide2">

                <div class="bContainer">

                    <div class="block rsABlock">
                        <div class="centered">
                            <h2>Tried and trusted by the international community</h2>
                            <h3>Access healthcare options that expatriates and diplomats use in our featured cities.</h3>
                            <a class="big fat green button link-how" href="#how"><?php _e( 'How does it work?', 'tripmd' ); ?></a>
                            <a class="big fat green button link-invitation" href="/invitation"><?php _e( 'See if it\'s for you', 'tripmd' ); ?></a>
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
                            <a class="big fat green button link-how" href="#how"><?php _e( 'How does it work?', 'tripmd' ); ?></a>
                            <a class="big fat green button link-invitation" href="/invitation"><?php _e( 'See if it\'s for you', 'tripmd' ); ?></a>
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
                            <a class="big fat green button link-how" href="#how"><?php _e( 'How does it work?', 'tripmd' ); ?></a>
                            <a class="big fat green button link-invitation" href="/invitation"><?php _e( 'See if it\'s for you', 'tripmd' ); ?></a>
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
                            <a class="big fat green button link-how" href="#how"><?php _e( 'How does it work?', 'tripmd' ); ?></a>
                            <a class="big fat green button link-invitation" href="/invitation"><?php _e( 'See if it\'s for you', 'tripmd' ); ?></a>
                        </div>
                    </div>

                    <!-- <span class="rsABlock txtCent" data-move-effect="none">you can place it on any type of slide</span> -->
                </div>

                <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-3.jpg" />

            </div> */ ?>
        </div>

        <section class="aff">
            
            <div class="grid-container">

                <div class="heading howh grid-100"><h2 >We&rsquo;re affordable.</h2></div>
                
                <div class="grid-30">
                    
                    <div class="subtitle"><p>Treatment Required</p></div>

                    <select name="speciality" id="speciality" class="my-select">
                        
                        <option value="" selected disabled>Pick a speciality&hellip;</option>
                        <option value="dental">Dental</option>
                        <option value="orthopaedic">Orthopaedic</option>
                        <option value="cardiac">Cardiac</option>

                    </select>

                    <br><br>

                    <select name="dental" id="dental" class="sub my-select">
                        
                        <option value="" selected disabled>Pick a treatment&hellip;</option>
                        <option value="dental-crown">Dental Crowns</option>
                        <option value="single-implant">Single Implant</option>
                        <option value="dentures">Dentures</option>

                    </select>

 <!--                    <select name="orthopaedic" id="orthopaedic" class="sub my-select">
                        
                        <option value="" selected disabled>Pick a treatment&hellip;</option>
                        <option value="hip-replacement">Hip Replacement</option>
                        <option value="knee-replacement">Knee Replacement</option>

                    </select>

                    <select name="opthalmology" id="ophthalmology" class="sub my-select">
                        
                        <option value="" selected disabled>Pick a treatment&hellip;</option>
                        <option value="lasik">Lasik</option>
                        <option value="cataract">Cataract</option>

                    </select>

                    <select name="cardiac" id="cardiac" class="sub my-select">
                        
                        <option value="" selected disabled>Pick a treatment&hellip;</option>
                        <option value="cab">Coronary Artery Bypass</option>
                        <option value="angioplasty">Angiplasty</option>

                    </select> -->

                </div>

                <div class="grid-60 pred">
                    
                    <div class="subtitle"><p>Savings</p></div>
                    <p>Originally, $30,000 in California.<br>We can reduce your bill by 50%.</p>

                </div>

                <div class="int"><a class="big fat green button<?php /* link-invitation */ ?>" href="#how">I&rsquo;m interested!</a></div>

            </div>

        </section>

        <section class="hear">

            <div class="grid-container">

                <div class="heading grid-100"><h2><?php _e( 'See what our patients have to say.', 'tripmd' ); ?></h2></div>


                <span class="arrow left"><i class="fa fa-chevron-left"></i></span>
                <span class="arrow right"><i class="fa fa-chevron-right"></i></span>

                <div class="content">

                    <div id="content-slider-1" class="slider contentSlider royalSlider rsMinW">


                        <div class="rsContent slide1">

                            <div class="bContainer">

                                <div class="testimonial grid-container">
                                    
                                    <div class="photo">
                                        
                                        <img src="http://api.randomuser.me/portraits/med/women/40.jpg" alt="">

                                    </div>                  

                                    <div class="dets grid-100">
                                        
                                        <blockquote>I was extremely happy with my dental surgery experience with TripMD. Dr. Batra’s had an amazing clinic and she made me feel comfortable throughout the entire duration of my surgery. The folks at TripMD also helped me throughout the duration of my surgery and took care of everything from my local transportation around Delhi, my accommodations at a beautiful guesthouse and my flights. I’m still in touch with Dr. Batra and will be referring more friends to her and TripMD!</blockquote>

                                        <p class="name">Brenda</p>
                                        <p class="origin">Dental Patient &ndash; California, USA</p>

                                    </div>


                            </div>  
                                <!-- <span class="rsABlock txtCent" data-move-effect="none">you can place it on any type of slide</span> -->
                            </div>

                        </div>
                                 

                        <div class="rsContent slide2">

                            <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-testimonial-patient.jpg" data-rsvideo="http://vimeo.com/95297775" data-rsw="860" data-rsh="484" />

                        </div>

                        <div class="rsContent slide3">
                       
                            <div class="bContainer">

                                <div class="testimonial grid-container">
                                    
                                    <div class="photo">
                                        
                                        <img src="http://api.randomuser.me/portraits/med/men/79.jpg" alt="">

                                    </div>                  

                                    <div class="dets grid-100">
                                        
                                        <blockquote>I’ve seen doctors in different corners of the world, but I can say hands down that I have had my best experiences with Dr. Batra. She is an amazing communicator and the quality of her care is second to none. I’m really happy to see her on the TripMD platform so that people all around the world can easily access this amazing dentist in Delhi.</blockquote>

                                        <p class="name">Stewart</p>
                                        <p class="origin">Dental Patient &ndash; New York, USA</p>

                                    </div>


                                 </div>  
                                <!-- <span class="rsABlock txtCent" data-move-effect="none">you can place it on any type of slide</span> -->
                            </div>

                        </div>

                                    <div class="rsContent slide4">
                       
                            <div class="bContainer">

                                <div class="testimonial grid-container">
                                    
                                    <div class="photo">
                                        
                                        <img src="http://api.randomuser.me/portraits/med/men/17.jpg" alt="">

                                    </div>                  

                                    <div class="dets grid-100">
                                        
                                        <blockquote>Being a freelancer without dental coverage, I decided that it would be best if I looked for options overseas for my dental procedure (too expensive at home). When I found TripMD and Dr. Batra, it was reassuring to know that locally based Americans and Canadians have been seeing her for years. Travelling with TripMD was great because it let me focus on my recovery and enjoying Delhi instead of worrying about my travel and accommodation logistics.</blockquote>

                                        <p class="name">Alexander</p>
                                        <p class="origin">Dental Patient &ndash; Connecticut, USA</p>

                                    </div>


                                 </div>  
                                <!-- <span class="rsABlock txtCent" data-move-effect="none">you can place it on any type of slide</span> -->
                            </div>

                        </div>

                    </div>


       <!--              <div id="content-slider-1" class="royalSlider contentSlider rsDefault">

                      <div>
                        <span class="rsTmb">Patients</span>
                        <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-testimonial-patient.jpg" data-rsvideo="http://vimeo.com/95297775" data-rsw="860" data-rsh="484">
                      </div>
     -->                  <?php /*
                      <div>
                        <span class="rsTmb">Doctors</span>
                        <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-testimonial-doctor.jpg" data-rsvideo="https://www.youtube.com/watch?v=kduGimbgEyM" data-rsw="640" data-rsh="425">
                      </div>
                      */ ?>
                    </div>

                </div>

            </div>

        </section>

        <section class="how">

            <div class="grid-container">

                <?php if ( defined( 'TMD_DEBUG' ) || isset( $_GET['ta'] ) ) : ?>
                    <div class="tmd-search-container aligncenter grid-100" style="margin-top: 50px;">
                        <input type="text" name="s" id="s" class="tmd-search" placeholder="<?php _e( 'Search for a treatment or hospital...', 'tripmd' ); ?>" autocomplete="off" data-provide="typeahead" />
                    </div>
                <?php endif; ?>


                <span id="how"></span>
                <div class="heading howh grid-100"><h2>Here&rsquo;s how it works.</h2></div>

                <div class="content">

                    <div class="timeline">

                        <section id="cd-timeline" class="cd-container">
                            <div class="cd-timeline-block">
                                <div class="cd-timeline-img cd-picture">
                                    <i class="fa fa-list"></i>
                                </div> <!-- cd-timeline-img -->

                                <div class="cd-timeline-content">
                                    <h2>Learn about your options by talking to TripMD medical experts for free</h2>
                                    <p>Our medical experts are happy to do a video chat with you and discuss your options based on your query and any other questions. We would like you to be satiesfied before moving forward to make an informed choice about your doctor and clinic.</p>
                                    <?php /* <a href="#0" class="cd-read-more">Read more</a> */ ?>
                                </div> <!-- cd-timeline-content -->
                            </div> <!-- cd-timeline-block -->

                            <div class="cd-timeline-block">
                                <div class="cd-timeline-img cd-movie">
                                    <i class="fa fa-user-md"></i>
                                </div> <!-- cd-timeline-img -->

                                <div class="cd-timeline-content">
                                    <h2>Talk to your doctor and reserve your surgical appointment</h2>
                                    <p>Video chat with your chosen doctor and discuss your case in more detail to confirm your surgical appointment.</p>
                                </div> <!-- cd-timeline-content -->
                            </div> <!-- cd-timeline-block -->

                            <div class="cd-timeline-block">
                                <div class="cd-timeline-img cd-picture">
                                    <i class="fa fa-plane"></i>
                                </div> <!-- cd-timeline-img -->

                                <div class="cd-timeline-content">
                                    <h2>Travel and stay in comfort with our partners</h2>
                                    <p>Fly with your preferred airlines at special rates via Expedia, stay at a hotel or Airbnb approved guest house near the hospital, and travel locally via Uber. An ettendant speaking your preferred language will be with you throughout your time in the destination city.</p>
                                </div> <!-- cd-timeline-content -->
                            </div> <!-- cd-timeline-block -->

                            <div class="cd-timeline-block">
                                <div class="cd-timeline-img cd-location">
                                    <i class="fa fa-stethoscope"></i>
                                </div> <!-- cd-timeline-img -->

                                <div class="cd-timeline-content">
                                    <h2>Recover with homecare nursing and follow-up seamlessly on return home</h2>
                                    <p>Depending on the procedure, the doctor will clear you for travel back within 3-14 days. Your TripMD account will have all of your medical records in US standard format and will allow you to seamlessly perform post-operative followup with your doctor.</p>
                                </div> <!-- cd-timeline-content -->
                            </div> <!-- cd-timeline-block -->
                        </section> <!-- cd-timeline -->

                    </div>

                    <?php /*

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

                        <a class="big fat green button waitlist" href="<?php echo home_url( '/invitation' ); ?>"><?php _e( 'Get early access', 'tripmd' ); ?></a>
                        <p class="ohho"><?php _e( 'to our trusted network of doctors', 'tripmd' ); ?></p>

                    </div>

                    */ ?>

                    <div class="iu grid-100 grid-parent">

                        <div class="grid-100 aligncenter">
                            <h3>
                                <?php printf( __( '%s is always with you, at every step.', 'tripmd' ), get_bloginfo( 'name' ) /* '<img src="' . get_template_directory_uri() . '/img/logo-black.png" alt="' . get_bloginfo( 'name' ) . '" />' */ ); ?>
                                <a class="big fat green button firststep" href="<?php echo site_url( '/inquiry' ); ?>"><?php _e( 'Take the first step', 'tripmd' ); ?></a>
                            </h3>
                            
                        </div>

                    </div>

            </div>

        </section>

        <section class="mock">

            <div class="grid-container">

                <div class="heading grid-100"><h2><img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.png" alt="<?php bloginfo( 'name' ); ?>" /></h2></div>

                <div class="content">

                    <div class="aligncenter">

                        <h3><?php _e( 'We\'re on a mission to make quality healthcare accessible to everyone without expensive medical bills and surgical wait times.', 'tripmd' ); ?></h3>

                        <a class="big fat green button waitlist" href="<?php echo site_url( '/inquiry' ); ?>"><?php _e( 'Get started', 'tripmd' ); ?></a>

                    </div>

                </div>

                <?php /*

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

                <a class="big fat green button waitlist" href="<?php echo home_url( '/invitation' ); ?>"><?php _e( 'Get early access', 'tripmd' ); ?></a>
                <p class="ohho"><?php _e( 'to our trusted network of doctors', 'tripmd' ); ?></p>

                */ ?>

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