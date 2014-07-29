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

    <!-- Pie Chart -->
    <div style="display:none" class="fancybox-hidden block">
        <div id="breakup" class="su full-width-form" style="width:600px; height:420px;">
            <h1><center><?php _e( 'Regionwise Breakup', 'tripmd' ); ?></center></h1>

            <div id="chart1" style="height:300px; width:500px;"></div>

            <div class="code prettyprint">
                <pre class="code prettyprint brush: js"></pre>
            </div>

        </div>
    </div>

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

                <?php if ( get_post_meta( get_the_ID(), 'rating', true ) ) : ?>
                    <div class="fright score"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.png" alt="">&nbsp;<?php _e( 'rating', 'tripmd' ); ?>: 
                    <?php tmd_rating( get_post_meta( get_the_ID(), 'rating', true ) ); ?></div>
                <?php endif; ?>
                
                <div class="clear"></div>

            </div>
            
            <div class="feats">

                <div class="grid-40 push-10">
                    
                    <div class="subtitle"><p><?php _e( 'Specialities', 'tripmd' ); ?></p></div>
                    <?php tmd_doctor_data( array( 'before' => '<h1>', 'after' => '</h1>', 'taxonomy' => 'specialities', 'sep' => ' &middot; ' ) ); ?>

                </div>

                <?php if ( get_post_meta( get_the_ID(), 'patients_rating', true ) ) : ?><div class="grid-50 push-10">
                    <div class="subtitle"><p><?php _e( 'International Patients Rating', 'tripmd' ); ?></p></div>
                        <h1><?php tmd_rating( get_post_meta( get_the_ID(), 'patients_rating', true ) ); ?></h1>
                    </div>
                <?php endif; ?>

                <div class="grid-40 push-10">
                    <div class="subtitle"><p><?php _e( 'Professional Memberships', 'tripmd' ); ?></p></div>
                    <?php tmd_doctor_data( array( 'before' => '<h1>', 'after' => '</h1>', 'taxonomy' => 'membership' ) ); ?>
                </div>

                <?php if ( get_post_meta( get_the_ID(), 'intl_treated', true ) ) : // Annually ?>

                    <div class="grid-50 push-10">
                        <div class="subtitle"><p><?php _e( 'International Patients Treated Annually', 'tripmd' ); ?></p></div>
                        <h1><?php printf( __( '%1$d+ <a href="%2$s" class="fancybox">(see regionwise split)</a>', 'tripmd' ), number_format_i18n( get_post_meta( get_the_ID(), 'intl_treated', true ) ), '#breakup' ); ?></h1>
                    </div>
                
                <?php endif; ?>

                <div class="grid-40 push-10">
                    
                    <div class="subtitle"><p><?php _e( 'Languages Supported' ); ?></p></div>
                    <?php tmd_doctor_data( array( 'before' => '<h1>', 'after' => '</h1>', 'taxonomy' => 'language', 'sep' => ' &middot; ' ) ); ?>

                </div>

                <div class="grid-50 push-10">
                    
                    <div class="subtitle"><p><?php _e( 'Education', 'tripmd' ); ?></p></div>
                    <?php tmd_doctor_data( array( 'before' => '<h1>', 'after' => '</h1>', 'taxonomy' => 'education' ) ); ?>

                </div>

                <div class="clear"></div>

            </div>

            <div class="link">
                
                <a class="big fat green button" href="/inquiry?tmd_bs_inquiry_for=dental"><?php _e( 'Talk to the doctor', 'tripmd' ); ?></a>

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
            
            <h1><?php _e( 'Facility and Awards', 'tripmd' ); ?></h1>

            <br /><br />

            <div class="grid-30"><a href="<?php echo get_template_directory_uri(); ?>/img/1.jpg" class="fancybox"><img src="<?php echo get_template_directory_uri(); ?>/img/1.jpg" alt=""></a></div>
            <div class="grid-30 push-5"><a href="<?php echo get_template_directory_uri(); ?>/img/3.jpg" class="fancybox"><img src="<?php echo get_template_directory_uri(); ?>/img/3.jpg" alt=""></a></div>
            <div class="grid-30 push-10"><a href="<?php echo get_template_directory_uri(); ?>/img/2.jpg" class="fancybox"><img src="<?php echo get_template_directory_uri(); ?>/img/2.jpg" alt=""></a></div>
            <div class="grid-100" style="margin-top: 100px; !important"><br /><br /></div>
            <div class="grid-30 push-"><a href="<?php echo get_template_directory_uri(); ?>/img/3.jpg" class="fancybox"><img src="<?php echo get_template_directory_uri(); ?>/img/3.jpg" alt=""></a></div>
            <div class="grid-30 push-5"><a href="<?php echo get_template_directory_uri(); ?>/img/5.jpg" class="fancybox"><img src="<?php echo get_template_directory_uri(); ?>/img/5.jpg" alt=""></a></div>
            <div class="grid-30 push-10"><a href="<?php echo get_template_directory_uri(); ?>/img/4.jpg" class="fancybox"><img src="<?php echo get_template_directory_uri(); ?>/img/4.jpg" alt=""></a></div>

        </div>

    </header>
    <br /><br /><br />

    <header class="costs">
    
        <div class="grid-container">

            <h1><?php _e( 'Costs', 'tripmd' ); ?></h1>
            
            <select name="speciality" id="dental" class="specs sub my-select">
                <option disabled>Pick a treatment…</option>
            </select>
            
            <br /><br />
            
            <div class="subtitle"><p>Treatment Cost</p></div>

            <table class="costs-table">
                
                <tr class="loc">
                    <td>Dr. Batra</td>
                    <td>USA</td>
                    <td>Australia</td>
                    <td>Hong Kong</td>
                    <td>Singapore</td>
                    <td>UK</td>
                </tr>
                <tr class="prices">
                    <td class="IN">8,50</td>
                    <td class="US">4,000</td>
                    <td class="AU">3,800</td>
                    <td class="GB">2,500</td>
                    <td class="SG">2,300</td>
                    <td class="UK">4,100</td>
                </tr>
            </table>

            <br><br>
            <h2>Round trip from California to India would be: $1500</h2>
            <h2>Airbnb accomodation close to the facility would be: $25/night and up</h2>
            <h2>Or, a 5-star hotel close to facility would be: $80/night and up</h2>
            <h2>Duration of the trip: 3 days</h2>
            <h2><b>Total: <span style="color: #7ecd94">$2,425 and up</span></b></h2>

        </div>

    </header>

    <br><br>

    <?php
    // If comments are open or we have at least one comment, load up the comment template
    if ( comments_open() || '0' != get_comments_number() ) :
        comments_template( '/comments-doctor-reviews.php' );
    endif; ?>

	<?php /* <div class="content">

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
    
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jqplot.pieRenderer.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jqplot.donutRenderer.min.js"></script>
    <script>
    
    var data = [
        ['North America', 126],['Australia', 140], ['Hong Kong', 95], ['Rest of the World', 50], ['Singapore', 77]
    ];

    var plot1 = jQuery.jqplot ('chart1', [data], 
    { 
      seriesDefaults: {
        // Make this a pie chart.
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: {
            // Put data labels on the pie slices.
            // By default, labels show the percentage of the slice.
            showDataLabels: true,
            show: true,     // wether to render the series.
            lineWidth: 0, // Width of the line in pixels.
            shadow: false,
            sliceMargin: 5,
        }
      }, 
      legend: { show:true, location: 'e' },

      grid: {
        background: 'transparent',      // CSS color spec for background color of grid.
        borderColor: 'transparent',     // CSS color spec for border around grid.
        borderWidth: 0.0,           // pixel width of border around grid.
        shadow: false,               // draw a shadow for grid.
        },

    }
  );</script>

<?php get_footer(); ?>
