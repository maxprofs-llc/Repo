<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-wrap">
		<header class="entry-header">
				<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        	    <p><?php echo get_the_date(); ?> | <?php if ( count( get_the_category() ) ) : printf( get_the_category_list( ', ' ) );  endif; ?> | <a href="<?php echo get_permalink(); ?>"><?php _e( 'Permalink ', 'lenora' ); ?></a> </p>
		</header><!-- END .entry-header -->
        
		<div class="entry-content">
			<?php if ( is_archive() || is_search() ) : ?>
				<?php the_excerpt(); ?>			
			<?php else : ?>
				<?php if ( has_post_thumbnail() ): ?>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full', 'thumbnail'); ?></a>
				<?php endif; ?>            
				<?php the_content( __( 'read more &rarr;', 'lenora' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'lenora' ), 'after' => '</div>' )		 ); ?>
			</div><!-- END .entry-content -->

			<?php endif; ?>
			<div class="clear"></div>
	</div><!-- END .entry-wrap-->            
</article>
