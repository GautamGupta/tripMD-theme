<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package tripmd
 */
?>
        <?php if ( !is_front_page() ) : ?>

            </div>

		</section>

        <?php endif; ?>

		<footer id="colophon" class="site-footer" role="contentinfo">

			<div class="grid-container block grid-100">

				<div class="centered">

					<div class="grid-100">

						<p>&copy; <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.png" alt="<?php bloginfo( 'name' ); ?>" /></a> <?php echo date( 'Y' ); ?>
						<?php
						if ( defined( 'TMD_DEBUG' ) && TMD_DEBUG == true ) {
							echo '<br />';
							foreach ( array( 'speciality', 'procedure', 'hospital', 'doctor' ) as $key ) {
								echo $key . ' => ' . tripmd()->get_session( $key ) . '; ';
							}
						}
						?></p>

					</div>

				</div>

			</div>

		</footer>

		<?php wp_footer(); ?>

		<script type="text/javascript" src="//use.typekit.net/jlx8kbu.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>


	</body>

</html>