<?php
/**
* The template for displaying the home page.
*
* @package GSF
* @since GSF 1.0
*/
get_header();
?>

<header>
	
	<div class="grid-container mission">
		
		<h1>Our Mission</h1>
		<h1 class="su">to make high quality healthcare accessible worldwide.</h1>

	</div>

</header>

<section class="about">
	
   <div class="grid-container">
   	
		<h2><i class="fa fa-building"></i>About tripMD</h2>
		<p>At tripMD we are focused on bringing trust and transparency to medical travel. Patients currently suffer from a lack of familiarity with quality healthcare options overseas and don’t have a viable resource where they can discover and connect with world-class doctors abroad.</p>

		<p>We solve this problem by providing patients with access to an exclusive network of well-reputed healthcare providers. tripMD Doctors are highly regarded medical professionals who are trusted by local diplomats and expatriates, and through our top-of-the-line concierge services, you can reach our doctors anxiety-free for your important medical procedures.</p>

   </div>
</section>

<?php if ( defined( 'TMD_DEBUG' ) || isset( $_GET['dbg'] ) ) : ?>

<section class="team">
	
	<!-- <div class="grid-container"> -->
		
		<h1 class="team"><i class="fa fa-users"></i>Team tripMD</h1>
		</div>

		<div class="grid-80 push-10 people">
		<div class="person grid-50">

			<div class="pic grid-25 mobile-grid-25"><img src="<?php echo get_template_directory_uri(); ?>/img/about/team/dev.jpg" alt=""></div>

			<div class="dets grid-75 mobile-grid-75">	

				<h2>Devashish Sharma</h2>
				<p class="post">Co-Founder</p>

				<p class="story">Dev grew up in Delhi and went to the University of Waterloo to study Computer Engineering. He speaks 5 different languages fluently.</p>

				<p class="story"><span class="sub">Countries treated in:</span> USA, Canada, India</p>
			
			</div>

		</div>

		<div class="person grid-50">

			<div class="pic grid-25 mobile-grid-25"><img src="<?php echo get_template_directory_uri(); ?>/img/about/team/matt.jpg" alt=""></div>

			<div class="dets grid-75 mobile-grid-75">	

				<h2>Matt Beck</h2>
				<p class="post">Co-Founder</p>

				<p class="story">Matt grew and has visited over 20 different countries. He tries his best to fit in abroad by picking up the local language, food and sport.

				<p class="story"><span class="sub">Countries treated in:</span> USA, Canada, India, China</p>
			
			</div>

		</div>

		</div>

		<div class="clearfix"></div>



		<div class="mentors grid-container">
			
			<h3>Mentors</h3>

			<div class="card-person grid-30">
				
				<div class="pic" style='background-image: url(<?php echo get_template_directory_uri(); ?>/img/about/mentors/rajesh.jpg);"' alt=""></div>

				<div class="dets">
					<h4>Rajesh Sawhney</h4>
					<h5>Founder, GSF India</h5>
				</div>

			</div>

			<div class="card-person grid-30 push-5">
				
				<div class="pic" style='background-image: url(<?php echo get_template_directory_uri(); ?>/img/about/mentors/rishab.jpg);"' alt=""></div>

				<div class="dets">
					<h4>Rishab Malik</h4>
					<h5>EiR, GSF India</h5>
				</div>

			</div>

			<div class="card-person grid-30 push-10">
				
				<div class="pic" style='background-image: url(<?php echo get_template_directory_uri(); ?>/img/about/mentors/brij.png);"' alt=""></div>

				<div class="dets">
					<h4>Brij Bhasin</h4>
					<h5>EiR, GSF India</h5>
				</div>

			</div>
		

		</div>
	<!-- </div> -->

</section>

<?php endif; ?>

<?php get_footer(); ?>