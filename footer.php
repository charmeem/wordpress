
</div><!-- #content -->

<footer>
	<h2 class="screen-reader-text">Footer Information:</h2>
		<aside class="general left two-thirds">
			<?php if ( is_active_sidebar( 'footer-left-widget-area' ) ) : ?>
				<?php dynamic_sidebar( 'footer-left-widget-area' ); ?>
			<?php endif; ?>
		</aside>
		<aside class="navigate right third">
			<h3>Navigate:</h3>
			<?php if ( is_active_sidebar( 'footer-right-widget-area' ) ) : ?>
				<?php dynamic_sidebar( 'footer-right-widget-area' ); ?>
			<?php endif; ?>
		</aside>

</footer>

</div><!-- #page -->

</div><!-- .site-content-contain -->

<?php wp_footer(); ?> <!--hook for plugin supports-->
</body>
</html>