<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tripmd
 */

get_header(); ?>

        <div id="slider-with-blocks-1" class="slider royalSlider rsMinW">

            <div class="rsContent slide1">

                <div class="bContainer">

                    <div class="block rsABlock">
                        <div class="centered">
                            <h2>Your trusted medical travel companion.</h2>
                            <h3>We help you discover, consult, and book your treatment anywhere in the world.</h3>
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
                            <h2>Access top medical centres in the world</h2>
                            <h3>Find the right doctor and medical centre for your treatment.</h3>
                            <a class="big fat green button" href="#how">See How it Works</a>
                        </div>
                    </div>

                    <!-- <span class="rsABlock txtCent" data-move-effect="none">you can place it on any type of slide</span> -->
                </div>

                <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-2.jpg" />

            </div>

            <div class="rsContent slide3">

                <div class="bContainer">

                    <div class="block rsABlock">
                        <div class="centered">
                            <h2>Travel and stay in comfort.</h2>
                            <h3>Book travel and accommodation using our easy-to-use web and mobile app, so you can focus on your recovery.</h3>
                            <a class="big fat green button" href="#how">See How it Works</a>
                        </div>
                    </div>

                    <!-- <span class="rsABlock txtCent" data-move-effect="none">you can place it on any type of slide</span> -->
                </div>

                <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-3.jpg" />

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

            <div class="rsContent slide5">

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

        </div>

		<section class="how" id="how">

			<div class="grid-container">

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

							<h3>Follow ups made easy.</h3>
							<p>After you return home, we make sure that your doctors at home and overseas are keeping in touch to ensure that you are have a smooth recovery.</p>

						</div>

						<div class="grid-20 pull-80">

							<img src="<?php echo get_template_directory_uri(); ?>/img/home-f4.png" alt="">
						</div>

					</div>

			</div>

		</section>

		<section class="hear">

			<div class="grid-container">

				<div class="heading grid-100"><h2>Hear from other patients and experts.</h2></div>

				<div class="content">

					<div id="content-slider-1" class="royalSlider contentSlider rsDefault">

					  <div>
					    <span class="rsTmb">Patients</span>
					    <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-testimonial-patient.jpg" data-rsvideo="https://www.youtube.com/watch?v=PzInUaLb37o" data-rsw="640" data-rsh="425">

					  </div>

					<div>
					    <span class="rsTmb">Doctors</span>
					    <img class="rsImg" src="<?php echo get_template_directory_uri(); ?>/img/home-testimonial-doctor.jpg" data-rsvideo="https://www.youtube.com/watch?v=kduGimbgEyM" data-rsw="640" data-rsh="425">

					  </div>

					</div>

				</div>

		</section>

		<section class="mock">

			<div class="grid-container">

				<div class="heading grid-100"><h2>We're always with you.</h2></div>

				<div class="content">

					<p class="mpar grid-100"><img src="<?php echo get_template_directory_uri(); ?>/img/mockup.png" class="mockup" alt=""></p>

					<p class="grid-50">
						<ol class="grid-50 pull-25">
							<li>Live itinerary that's always up to date.</li>
							<li>24X7 assistance: Tap-to-call each point of contact.</li>
							<li>Secure transfer of your health records to and fro from the doctor</li>
							<li>Post operative followup made easy</li>
						</ol>
					</p>

				</div>

		</section>

		<section class="center last green" id="su">

			<div class="grid-container">

				<div class="heading grid-100 suh"><h2>Sign up for more updates.</h2></div>

				<div class="content">

					<h4>We&rsquo;ll keep you updated on how we&rsquo;re doing.</h4>

					<input type="text" class="email" placeholder="name@email.com">

				</div>

            </div>

		</section>

<?php get_footer(); ?>
