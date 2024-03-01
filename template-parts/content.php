<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri-modern
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
		
	<?php

	if ( is_single() && ! uri_modern_get_field( 'pagetitle' ) ) {

		?>
		<div class="architecture">
		<?php

		$args = array(
			'orderby'  => 'parent',
			'order'    => 'ASC'
		);

		$post_architecture = get_terms( 'architecture', $args );

		foreach ( $post_architecture as $p ) {
			if ( ! empty( $p ) ) {
				echo '<p class="architecture-department">' . $p->name . '</p>';
			}
		}

		?>
		
		</div>

		<?php

		the_title( '<h1 class="entry-title">', '</h1>' );

	}

	if ( ! is_single() ) {

		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

	}

	if ( is_single() && 'post' === get_post_type() ) :
	?>
		
		<div class="entry-meta">
			<?php the_date( '', '<span class="meta-date">', '</span>' ); ?>
		</div><!-- .entry-meta -->
		
	<?php endif; ?>
	
	</header><!-- .entry-header -->
	
	<?php
	if ( ! is_single() || ( ! uri_modern_get_field( 'uri_modern_hide_featured_image' ) && ! has_post_format( 'video' ) ) ) {
		get_template_part( 'template-parts/featured-image' );
	}
	?>

	<div class="entry-content">

		<?php

		$continue = sprintf(
			/* translators: %s: Name of current post. */
						wp_kses( __( '<span class="continue-reading">Continue reading %s <span class="meta-nav">&rarr;</span></span>', 'uri' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		);

		if ( ! is_single() && ! is_page() && $excerpt = get_the_excerpt() ) {
			the_excerpt();
			echo '<a class="continue-reading-link" href="' . get_permalink() . '">' . $continue . '</a>';
		} else {
			the_content( $continue );

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uri' ),
					'after'  => '</div>',
				)
			);
		}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php uri_modern_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
