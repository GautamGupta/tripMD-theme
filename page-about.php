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
		
		<h1><?php _e( 'Our Mission', 'tripmd' ); ?></h1>
		<h1 class="su"><?php _e( 'to make high quality healthcare accessible worldwide.', 'tripmd' ); ?></h1>

	</div>

</header>

<section class="about">
	
   <div class="grid-container">
   	
		<h2><i class="fa fa-building"></i><?php _e( 'About tripMD', 'tripmd' ); ?></h2>
		<p>At tripMD we are focused on bringing trust and transparency to trusted healthcare options overseas. Patients currently suffer from a lack of familiarity and don’t have a viable resource where they can discover and connect with world-class doctors abroad.</p>

		<p>We solve this problem by providing patients with access to an exclusive network of well-reputed healthcare providers. tripMD Doctors are highly regarded medical professionals who are trusted by local diplomats and expatriates.</p>

   </div>
</section>

<section class="team">
	
	<h1 class="team"><i class="fa fa-users"></i><?php _e( 'Team tripMD', 'tripmd' ); ?></h1>

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

		<div class="person grid-50 push-5">

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

	<div class="clearfix"></div>

	<div class="mentors grid-container">
		
		<h3><?php _e( 'Mentors &amp; Advisors', 'tripmd' ); ?></h3>

		<div class="card-person grid-30">
			
			<div class="pic" style='background-image: url(<?php echo get_template_directory_uri(); ?>/img/about/mentors/rajesh.jpg);"'></div>

			<div class="dets">
				<h4>Rajesh Sawhney</h4>
				<h5>Founder, GSF India</h5>
			</div>

		</div>

		<div class="card-person grid-30 push-5">
			
			<div class="pic" style='background-image: url(<?php echo get_template_directory_uri(); ?>/img/about/mentors/rishab.jpg);"'></div>

			<div class="dets">
				<h4>Rishab Malik</h4>
				<h5>Operating Partner, GSF India</h5>
			</div>

		</div>

		<div class="card-person grid-30 push-10">
			
			<div class="pic" style='background-image: url(<?php echo get_template_directory_uri(); ?>/img/about/mentors/brij.png);"'></div>

			<div class="dets">
				<h4>Brij Bhasin</h4>
				<h5>Operating Partner, GSF India</h5>
			</div>

		</div>

		<div class="card-person grid-30">
			
			<div class="pic" style='background-image: url(<?php echo get_template_directory_uri(); ?>/img/about/mentors/samiksha.png);"'></div>

			<div class="dets">
				<h4>Samiksha Gupta</h4>
				<h5>EiR, GSF India</h5>
			</div>

		</div>

		<div class="card-person grid-30 push-5">
			
			<div class="pic" style='background-image: url(<?php echo get_template_directory_uri(); ?>/img/about/mentors/swati.png);"'></div>

			<div class="dets">
				<h4>Swati Bhargava</h4>
				<h5>EiR, GSF India</h5>
			</div>

		</div>
	
	</div>

</section>

<?php get_footer(); ?>