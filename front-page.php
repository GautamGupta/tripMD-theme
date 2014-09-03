<?php
/**
 * Home page
 *
 * @package tripmd
 */

get_header(); ?>

        <!-- Clinic register form -->
        <div style="display:none" class="fancybox-hidden block">
            <div id="clinic-register" class="su full-width-form" style="width:480px; height:480px;">
                <h1><?php printf( __( 'Register your clinic with %s.', 'tripmd' ), get_bloginfo( 'name' ) ); ?></h1>

                <form method="post" style="color: black;" action="<?php echo site_url( '/' ); ?>">
                    
                    <div class="name fld">
                        <input type="text"  class="field" name="tmd_cr_name" required="required" placeholder="<?php _e( 'Name of the Medical Centre', 'tripmd' ); ?>" />
                        <i class="fa fa-hospital-o"></i>
                    </div>

                    <div class="country fld">
                        <input type="text"  class="field" name="tmd_cr_location" required="required" placeholder="<?php _e( 'City & Country', 'tripmd' ); ?>" />
                        <i class="fa fa-map-marker"></i>
                    </div>

                    <div class="poc fld">
                        <input type="tel" class="field" name="tmd_cr_phone" required="required" placeholder="<?php _e( 'Phone Number of Representative', 'tripmd' ); ?>" />
                        <i class="fa fa-phone"></i>
                    </div>

                    <div class="email fld">
                        <input type="email" class="last field" name="tmd_cr_email" required="required" placeholder="<?php _e( 'Email Address', 'tripmd' ); ?>" />
                        <i class="fa fa-envelope-o"></i>
                    </div>

                    <input type="hidden" name="action" value="clinic_register" />
                    <?php wp_nonce_field( 'tmd_clinic_register_nonce' ); ?>

                    <input type="submit" class="big fat green button submit" value="<?php _e( 'Register', 'tripmd' ); ?>" />

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

        <span class="dp-screenshot"><img src="<?php echo get_template_directory_uri(); ?>/img/search.png" alt=""></span>

        <div id="slider-with-blocks-1" class="slider royalSlider rsMinW">


            <div class="rsContent slide1">

                <div class="bContainer">

                    <div class="block rsABlock">
                        <div class="centered grid-container">
                            <?php if ( 'IN' == tripmd()->location->get_location() ) : ?>
                                <h2 class="in"><?php _e( 'Receive medical care by reliable doctors as trusted by the international community living in your city.', 'tripmd' ); ?></h2>
                                <a class="big fat green button" href="/inquiry"><?php _e( 'Schedule Appointment', 'tripmd' ); ?></a>
                            <?php else : ?>
                                <h2><?php _e( 'The world is exotic.', 'tripmd' ); ?></h2>
                                <h3><?php _e( 'Healthcare overseas doesn&rsquo;t have to be.', 'tripmd' ); ?></h3>
                                <?php /* <a class="big fat green button link-how" href="#how"><?php _e( 'How does it work?', 'tripmd' ); ?></a> */ ?>
                                <a class="big fat green button<?php /* link-invitation */ ?>" href="#aff"><?php _e( 'Get Early Access', 'tripmd' ); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- <span class="rsABlock txtCent" data-move-effect="none">you can place it on any type of slide</span> -->
                </div>

                <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/udaipur.jpg" alt="" />

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

        <section class="hear see">

            <div class="bg"><img src="<?php echo get_template_directory_uri(); ?>/img/doctor.png" alt=""></div>

            <div class="grid-container">

                <div class="heading grid-100"><h2><?php _e( 'See a trusted doctor.', 'tripmd' ); ?></h2><h3>Make an appointment inquiry with the most trusted physicians in the tripMD network.</h3></div>

                <div class="grid-45 grid-parent specs">
                    
                    <div class="grid-50"><a href="#" class="card"><img src="<?php echo get_template_directory_uri(); ?>/img/dental.png" alt="">Dental</a></div>
                    <div class="grid-50"><a href="#" class="card"><img src="<?php echo get_template_directory_uri(); ?>/img/cardiac.png" alt="">Cardiac</a></div>
                    <div class="grid-50"><a href="#" class="card"><img class="ophth" src="<?php echo get_template_directory_uri(); ?>/img/ophthal.png" alt="">Opthalmology</a></div>
                    <div class="grid-50"><a href="#" class="card"><img src="<?php echo get_template_directory_uri(); ?>/img/orthopaedic.png" alt="">Orthopaedic</a></div>

                </div>
                
                <div class="clearfix"></div>

                <div class="grid-60">
                    
                    <div class="subtitle grid-100 currently"><p>Currently serving in:</p></div>

                    <div class="grid-100 serving grid-parent">
                        
                        <div class="grid-20 city"><img src="<?php echo get_template_directory_uri(); ?>/img/delhi.jpg" alt=""><p>New Delhi</p></div>
                        <div class="grid-20 gray city"><img src="<?php echo get_template_directory_uri(); ?>/img/mumbai.jpg" alt=""><p>Mumbai</p></div>
                        <div class="grid-20 gray city"><img src="<?php echo get_template_directory_uri(); ?>/img/singapore.jpg" alt=""><p>Singapore</p></div>
                        <div class="grid-20 gray city"><img src="<?php echo get_template_directory_uri(); ?>/img/johannesburg.jpg" alt=""><p>Johannesburg</p></div>

                    </div>

                </div>   

            </div>

        </section>

        <section class="how">

            <div class="grid-container">

                <?php if ( defined( 'TMD_DEBUG' ) || isset( $_GET['dbg'] ) ) : ?>
                    <div class="tmd-search-container aligncenter grid-100" style="margin-top: 50px;">
                        <input type="text" name="s" id="s" class="tmd-search" placeholder="<?php _e( 'Search for a treatment or hospital...', 'tripmd' ); ?>" autocomplete="off" data-provide="typeahead" />
                    </div>
                <?php endif; ?>


                <span id="how"></span>
                <div class="heading howh grid-100"><h2>Here&rsquo;s how we make healthcare simple.</h2><h3>From booking your appointment to following up after, we are there to make receiving your healthcare seamless.</h3></div>
                
                <div class="grid-100 grid-parent howwe">
                    

                    <div class="grid-33">
                        
                        <div class="grid-100 num"><span>1<div class="connector">&nbsp;</div></span></div>                        
                        
                        <div class="grid-100">
                            <h3>Browse Our Network</h3>
                            <h4>Take a look at the highly reputed doctors in the tripMD network.</h4>
                        </div>
                    
                    </div>
                    
                    <div class="grid-33">
                        
                        <div class="grid-100 num"><span>2</span></div> 
                        <div class="grid-100">
                               <h3>Inquire with the physician.</h3>
                               <h4>Send an appointment inquiry to the doctor.</h4>
                           </div>   

                    </div>

                    <div class="grid-33">
                        
                        <div class="grid-100 num"><span>3</span></div>    
                        
                        <div class="grid-100">
                            <h3>Follow ups made easy.</h3>
                            <h4>We make sure you and your doctor continue communicating after the treatment.</h4>
                        </div>
                    
                    </div>

                </div>

        </section>

  <!--       <section class="media">

            <div class="grid-container">

                <span id="media"></span>
                <div class="heading howh grid-100"><h2>Our Story.</h2></div>
                
                <div class="grid-100 grid-parent team">
                        <div class="grid-100 people">
    
                        <div class="person grid-50">

                            <div class="pic grid-33 mobile-grid-25"><img src="<?php echo get_template_directory_uri(); ?>/img/about/team/dev.jpg" /></div>

                            <div class="dets grid-66 mobile-grid-75">   

                                <h2>Devashish Sharma</h2>
                                <p class="post"><?php _e( 'Co-Founder', 'tripmd' ); ?></p>

                                <p class="story">Dev grew up in Delhi and is a Computer Engineering graduate from the University of Waterloo. He has work experience in multiple countries and speaks 5 different languages.</p>

                                <p class="social">
                                    
                                    <a href="https://twitter.com/devashish751" class="twitter" title="Twitter"><i class="fa fa-twitter-square"></i></a>
                                    <a href="https://www.linkedin.com/in/devashishsharma" class="linkedin" title="LinkedIn"><i class="fa fa-linkedin-square"></i></a>
                                    <a href="mailto:devashish@tripmd.com" class="email" title="Email"><i class="fa fa-envelope-square"></i></a>

                                </p>

                            </div>

                        </div>

                        <div class="person grid-50">

                            <div class="pic grid-33 mobile-grid-25"><img src="<?php echo get_template_directory_uri(); ?>/img/about/team/matt.jpg"></div>

                            <div class="dets grid-66 mobile-grid-75">   

                                <h2>Matt Beck</h2>
                                <p class="post"><?php _e( 'Co-Founder', 'tripmd' ); ?></p>

                                <p class="story">Matt grew up in south-east Asia and has visited over 20 different countries. He tries his best to fit in abroad by picking up the local language, food and sport.</p>

                                <p class="social">
                                    
                                    <a href="https://twitter.com/mattbeck222" class="twitter" title="Twitter"><i class="fa fa-twitter-square"></i></a>
                                    <a href="https://www.linkedin.com/profile/view?id=229438706" class="linkedin" title="LinkedIn"><i class="fa fa-linkedin-square"></i></a>
                                    <a href="mailto:matt@tripmd.com" class="email" title="Email"><i class="fa fa-envelope-square"></i></a>

                                </p>
                            
                            </div>

                        </div>
                </div>

        </section> -->

        <section class="signup">

            <div class="grid-container">

                <span id="media"></span>
                <div class="heading howh grid-100"><h2>Sign up for early access.</h2></div>
                <br>
                <div class="grid-35 f-inp">
                    
                    <input type="text" name="name" placeholder="Name">

                </div>

                <div class="grid-35 push-0">
                    
                    <input type="text" name="email" placeholder="Email">


                </div>
                
                <div class="grid-30">
                
                    <input type="submit" class="big fat green button" id="s-up" value="Sign me up!">

                </div>

        </section>

        <?php if ( 'IN' != tripmd()->location->get_location() ) : ?>

        <?php endif; ?>

        <section class="mock">

            <div class="grid-container">
                
                <div class="heading grid-100"><h2><img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.png" alt="<?php bloginfo( 'name' ); ?>" /></h2></div>

                <div class="content">

                    <div class="aligncenter">

                        <?php if ( 'IN' == tripmd()->location->get_location() ) : ?>
                            <h3><?php _e( 'We&rsquo;re on a mission to make high quality healthcare accessible worldwide.', 'tripmd' ); ?></h3>
                        <?php else : ?>
                            <h3><?php _e( 'We&rsquo;re on a mission to make quality healthcare accessible to everyone without the expensive medical bills and surgical wait times.', 'tripmd' ); ?></h3>
                        <?php endif; ?>
                        
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

        <?php if ( ! empty( $_GET['clin_reg'] ) && $_GET['clin_reg'] == 'error' ) : ?>
        
            <section id="clin-reg-msg" class="center last">
                <div class="grid-container">
                    <p class="error message">
                        <i class="fa fa-times"></i>
                        <?php _e( 'Oops! There was an error registering your clinic, please try again. You can also try emailing us at support@tripmd.com.', 'tripmd' ); ?>
                    </p>
                </div>
            </section>
        <?php elseif ( ! empty( $_GET['clin_reg'] ) && $_GET['clin_reg'] == 'success' ) : ?>
            <section id="clin-reg-msg" class="center last">
                <div class="grid-container">
                    <p class="success message">
                        <i class="fa fa-check"></i>
                        <?php _e( 'Thank you for registering. We&rsquo;ll get back to you shortly.', 'tripmd' ); ?>
                    </p>
                </div>
            </section>
        <!-- <hr/> -->
        <?php endif; ?>

<?php get_footer(); ?>