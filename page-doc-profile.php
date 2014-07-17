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
	
	<div class="grid-container">
		
		<h1>Dental Treatments</h1>

	</div>

</header>

<section class="doc">
	
	<div class="grid-container">
		
		<div class="grid-100 dinfo">

			<div class="image fleft">
				
				<img src="<?php echo get_template_directory_uri(); ?>/img/batra.jpg" alt="">

			</div>
			
			<div class="info fleft">

				<h2>Dr. Poonam Batra</h2>
				<h3>MD, PHD</h3>
				<h3>Dentist, New Delhi, India</h3>

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
				
				<div class="subtitle"><p>Specialities</p></div>
				<h1><a href="#">Dentist &middot; Cosmetic Dentist</a></h1>

			</div>

			<div class="grid-50 push-10">
				
				<div class="subtitle"><p>International Patients Rating</p></div>
				<h1><img src="<?php echo get_template_directory_uri(); ?>/img/4-5.png" alt="" style="width: 30%" class="rating"></h1>

			</div>		

			<div class="grid-40 push-10">
				
				<div class="subtitle"><p>Professional Memberships</p></div>
				<h1><a href="#">American Dental Association</a></h1>

			</div>

			<div class="grid-50 push-10">
				
				<div class="subtitle"><p>International Patients Treated Annually</p></div>
				<h1>488 <a href="#">(see regionwise split)</a></h1>

			</div>

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
			
			<a class="big fat green button" href="#how">Talk to the doctor</a>

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

		<br><br>

		<div class="grid-30"><img src="<?php echo get_template_directory_uri(); ?>/img/1.jpg" alt=""></div>
		<div class="grid-30 push-5"><img src="<?php echo get_template_directory_uri(); ?>/img/3.jpg" alt=""></div>
		<div class="grid-30 push-10"><img src="<?php echo get_template_directory_uri(); ?>/img/2.jpg" alt=""></div>
		<div class="grid-100" style="margin-top: 100px; !important"><br><br></div>
		<div class="grid-30 push-"><img src="<?php echo get_template_directory_uri(); ?>/img/3.jpg" alt=""></div>
		<div class="grid-30 push-5"><img src="<?php echo get_template_directory_uri(); ?>/img/5.jpg" alt=""></div>
		<div class="grid-30 push-10"><img src="<?php echo get_template_directory_uri(); ?>/img/4.jpg" alt=""></div>

	</div>

</header>
<br><br><br>
<header class="costs">
	
	<div class="grid-container">

		<h1>Costs</h1>
		
        <select name="speciality" id="speciality" class="my-select">
            
            <option value="" selected disabled>Implants</option>
            <option value="dental">Dental</option>
            <option value="orthopaedic">Orthopaedic</option>
            <option value="cardiac">Cardiac</option>

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
<header class="reviews" id="reviews">
	
	<div class="grid-container">

		<h1 style="margin-bottom: 0">Reviews</h1>

		<div class="grid-100" style="margin-left: 145px; padding-top: 30px;">
			
			<div class="grid-100"><h2><b>Sean T.</b><span style="color: #999; -webkit-transform: scale(0.8); font-size: 90%; margin-left: 10px">(verified patient)</span><span style="margin-left: 190px; opacity: 0.25">July 7, 2014</span></h2></div>

			<div class="grid-20">
				
				<div class="subtitle"><p>Overall</p></div>
				<img src="<?php echo get_template_directory_uri(); ?>/img/5.png" alt="" class="rating">

			</div>

			<div class="grid-20">
				
				<div class="subtitle"><p>Communication</p></div>
				<img src="<?php echo get_template_directory_uri(); ?>/img/3-5.png" alt="" class="rating">

			</div>

			<div class="grid-20 push-5">
				
				<div class="subtitle"><p>Friendliness</p></div>
				<img src="<?php echo get_template_directory_uri(); ?>/img/4.png" alt="" class="rating">

			</div>

			<p class="grid-70">Dr. Batra has done a reassuringly superb job as our dentist. She has always been prompt and attentive, and has often worked us into her schedule at the last minute. She has a light, gentle touch and is well versed in the most up-to-date Western dental techniques. We have been pleased with the quality of dental care received.</p>

		</div>

		<div class="grid-100" style="margin-left: 145px; padding-top: 30px;">
			
			<div class="grid-100"><h2><b>Graham B.</b><span style="color: #999; -webkit-transform: scale(0.8); font-size: 90%; margin-left: 10px">(verified patient)</span><span style="margin-left: 150px; opacity: 0.25">July 3, 2014</span></h2></div>

			<div class="grid-20">
				
				<div class="subtitle"><p>Overall</p></div>
				<img src="<?php echo get_template_directory_uri(); ?>/img/4.png" alt="" class="rating">

			</div>

			<div class="grid-20">
				
				<div class="subtitle"><p>Communication</p></div>
				<img src="<?php echo get_template_directory_uri(); ?>/img/5.png" alt="" class="rating">

			</div>

			<div class="grid-20 push-5">
				
				<div class="subtitle"><p>Friendliness</p></div>
				<img src="<?php echo get_template_directory_uri(); ?>/img/3-5.png" alt="" class="rating">

			</div>

			<p class="grid-70">While her professional skills are commendable, we certainly did not expect to find a dentist who would offer such warmth, affection and personal touches, sentiments that we have tried to reciprocate. We have truly appreciated that pre-appointment reminder call, but more important the followup calls from you and your team. Even if sometimes things got a little uncomfortable, your hand on the shoulder provided the reassurance and even the courage to get through the treatment. And of course, the results were always worth it.</p>

		</div>

	</div>

</header>

<?php get_footer(); ?>