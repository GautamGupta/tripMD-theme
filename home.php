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

		<a href="#sect">

			<div class="go-on grid-100">

				<p><i class="fa fa-angle-down"></i></p>

			</div>

		</a>

		<section class="content" id="sect">

			<div class="grid-container block grid-100">

				<div class="centered">

					<div class="grid-100">

						<h2>Travel and live comfortably, with all of your important necessities.</h2>

						<h3>Explore the tastes, sights, and sounds of your host country.</h3>

					</div>


				</div>

			</div>

		</section>

		<section class="content third" id="sect">

			<div class="grid-container block grid-100">

				<div class="centered">

					<div class="grid-100">

						<h2>Receive world class medical services from our international network of hospitals.</h2>

					</div>

					<div class="grid-33">

						<h3><img src="<?php echo get_template_directory_uri(); ?>/img/doctor.png" alt=""><br>Doctors</h3>

						<p>We have a broad range of doctors for procedures from head&nbsp;to&nbsp;toe.</p>

					</div>

					<div class="grid-33">

						<h3><img src="<?php echo get_template_directory_uri(); ?>/img/consultations.png" alt=""><br>Consultations</h3>

						<p>Discuss your needs with a doctor in the comforts of your own home.</p>

					</div>

					<div class="grid-33">

						<h3><img src="<?php echo get_template_directory_uri(); ?>/img/appointment.png" alt=""><br>Appointments</h3>

						<p>Schedule your medical procedure, sit back and enjoy the flight!</p>

					</div>

				</div>

			</div>

		</section>

<?php get_footer(); ?>
