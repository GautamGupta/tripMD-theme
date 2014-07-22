<?php
/**
 * The template for displaying Speciality Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tripmd
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <header>
        
        <div class="grid-container">
            
            <h1><?php _e( 'Dental Treatments', 'tripmd' ); ?></h1>

        </div>

    </header>

    <section class="doc">
    
        <div class="grid-container">
            
            <div class="grid-100 dinfo">

                <div class="image fleft">
                    
                    <?php if ( has_post_thumbnail() ) the_post_thumbnail( 'thumbnail' ); ?>

                </div>
                
                <div class="info fleft">

                    <h2><?php the_title(); ?></h2>
                    <?php tmd_doctor_data( array( 'before' => '<h3>', 'after' => '</h3>', 'taxonomy' => 'doctor_degree' ) ); ?>
                    <?php if ( get_post_meta( get_the_ID(), 'location', true ) ) : ?>
                        <h3><?php echo get_post_meta( get_the_ID(), 'location', true ); ?></h3>
                    <?php endif; ?>

                </div>

                <div class="fright score">
                    
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.png" alt="">&nbsp;score: 
                    <h1>97%</h1>

                </div>

                <div class="fright score">
                    
                    <!-- <h1>3.5</h1> -->

                </div>
                
                <div class="clear"></div>

            </div>
            
            <div class="feats">

                <div class="grid-40 push-10">
                    
                    <div class="subtitle"><p><?php _e( 'Specialities', 'tripmd' ); ?></p></div>
                    <?php tmd_doctor_data( array( 'before' => '<h1>', 'after' => '</h1>', 'taxonomy' => 'specialities' ) ); ?>

                </div>

                <div class="grid-50 push-10">
                    
                    <div class="subtitle"><p>International Patients Rating</p></div>
                    <h1><img src="<?php echo get_template_directory_uri(); ?>/img/4-5.png" alt="" style="width: 30%" class="rating"></h1>

                </div>

                <div class="grid-40 push-10">
                    
                    <div class="subtitle"><p>Professional Memberships</p></div>
                    <h1><a href="#">American Dental Association</a></h1>

                </div>

                <?php if ( get_post_meta( get_the_ID(), 'intl_treated', true ) ) : // Annually ?>

                    <div class="grid-50 push-10">
                        <div class="subtitle"><p><?php _e( 'International Patients Treated Annually', 'tripmd' ); ?></p></div>
                        <h1><?php printf( __( '%d+ <a href="%s">(see regionwise split)</a>', 'tripmd' ), number_format_i18n( get_post_meta( get_the_ID(), 'intl_treated', true ) ), '#' ); ?></h1>
                    </div>
                
                <?php endif; ?>

                <div class="grid-40 push-10">
                    
                    <div class="subtitle"><p>Languages Supported</p></div>
                    <h1>English, Hindi, Mandarin</h1>

                </div>

                <div class="grid-50 push-10">
                    
                    <div class="subtitle"><p>Education</p></div>
                    <h1>Dental School, University of California</h1>

                </div>

                <div class="clear"></div>

            </div>

            <div class="link">
                
                <a class="big fat green button" href="/inquiry">Talk to the doctor</a>

            </div>

        </div>

    </section>

    <section class="testimonial doct">
        
       <div class="testimonial grid-container">
            
            <div class="photo">
                
                <img src="http://api.randomuser.me/portraits/med/women/40.jpg" alt="">

            </div>

            <div class="dets grid-100">
                
                <blockquote>I was extremely happy with my dental surgery experience with TripMD. Dr. Batra’s had an amazing clinic and she made me feel comfortable throughout the entire duration of my surgery. The folks at TripMD also helped me throughout the duration of my surgery and took care of everything from my local transportation around Delhi, my accommodations at a beautiful guesthouse and my flights. I’m still in touch with Dr. Batra and will be referring more friends to her and TripMD!</blockquote>

                <p class="name">Brenda</p>
                <p class="origin">Dental Patient &ndash; California, USA</p>

                <div style="text-align: center !important; margin-top: 40px"><a href="#reviews"><span class="hglt blue button" style="text-transform: uppercase; color: #f8f8f8; font-size: 90%">Read More Reviews</span></a></div>

            </div>

    </div>  

    </section>

    <header class="facility">
        
        <div class="grid-container">
            
            <h1>Facility</h1>

            <br /><br />

            <div class="grid-30"><img src="<?php echo get_template_directory_uri(); ?>/img/1.jpg" alt=""></div>
            <div class="grid-30 push-5"><img src="<?php echo get_template_directory_uri(); ?>/img/3.jpg" alt=""></div>
            <div class="grid-30 push-10"><img src="<?php echo get_template_directory_uri(); ?>/img/2.jpg" alt=""></div>
            <div class="grid-100" style="margin-top: 100px; !important"><br><br></div>
            <div class="grid-30 push-"><img src="<?php echo get_template_directory_uri(); ?>/img/3.jpg" alt=""></div>
            <div class="grid-30 push-5"><img src="<?php echo get_template_directory_uri(); ?>/img/5.jpg" alt=""></div>
            <div class="grid-30 push-10"><img src="<?php echo get_template_directory_uri(); ?>/img/4.jpg" alt=""></div>

        </div>

    </header>
    <br /><br /><br />

    <header class="costs">
    
        <div class="grid-container">

            <h1>Costs</h1>
            
            <select name="speciality" id="speciality" class="my-select">
                <option value="dental-crown">Dental Crowns</option>
                <option value="single-implant">Single Implant</option>
                <option value="dentures">Dentures</option>
            </select>
            
            <br><br>
            
            <div class="subtitle"><p>Treatment Cost</p></div>
            <img src="<?php echo get_template_directory_uri(); ?>/img/table4.png" style="width: 100%; outline: thin solid lightgray; box-shadow: 0px 2px 1px 1px rgba(0, 0, 0, 0.1);" alt="">
            
            <br><br>
            <h2>Round trip from California to India would be: $1500</h2>
            <h2>Airbnb accomodation close to the facility would be: $25/night and up</h2>
            <h2>Or, a 5-star hotel close to facility would be: $80/night and up</h2>
            <h2>Duration of the trip: 3 days</h2>
            <h2><b>Total: <span style="color: #7ecd94">$2425 and up</span></b></h2>

        </div>

    </header>

    <br><br>

    <?php
    // If comments are open or we have at least one comment, load up the comment template
    if ( comments_open() || '0' != get_comments_number() ) :
        comments_template( '/comments-doctor-reviews.php' );
    endif; ?>

	<?php /* <div class="content">

		<?php if ( get_post_meta( get_the_ID(), 'specialization', true ) ) : ?>
			<p><strong>Specialization</strong>: <?php echo get_post_meta( get_the_ID(), 'specialization', true ); ?></p>
		<?php endif; ?>

		<?php if ( get_post_meta( get_the_ID(), 'experience', true ) ) : ?>
			<p><strong>Experience</strong>: <?php echo get_post_meta( get_the_ID(), 'experience', true ); ?></p>
		<?php endif; ?>
		<?php if ( get_post_meta( get_the_ID(), 'qualifications', true ) ) : ?>
			<p><strong>Qualifications</strong>: <?php echo get_post_meta( get_the_ID(), 'qualifications', true ); ?></p>
		<?php endif; ?>

		<?php the_content(); ?>

	</div>

    <small class="animated fadeIn">You&rsquo;re nearly done.</small>
    &nbsp;
    <a class="big fat dark-gray button" href="<?php echo site_url( 'profile#appointments' ); ?>">Book Consultation</a>
    &nbsp;
    <small class="animated fadeIn">or</small>
    &nbsp;
    <a class="big fat light-gray button" href="<?php echo get_permalink( $post->post_parent ); ?>">Go Back</a>
    &nbsp;
    <small class="animated fadeIn">to select another doctor.</small> */ ?>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
