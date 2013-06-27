<?php get_header(); ?>

<div id="wrapper">
	<div id="container">
	<div id="content">
		<?php /* Start the Loop */ ?>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-wrap">
				<header class="entry-header">
					<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	        	    <p><?php echo get_the_date(); ?> / <?php printf( __( 'by', 'lenora' )); ?> <?php the_author(); ?> </p>
				</header><!-- END .entry-header -->
        
				<div class="entry-content">
					<?php if ( is_archive() || is_search() ) : ?>
						<?php the_excerpt(); ?>			
					<?php else : ?>
					<?php the_content( __( 'read more &rarr;', 'lenora' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'lenora' ), 'after' => '</div>' )		 ); ?>
				</div><!-- END .entry-content -->

		<footer class="entry-meta">
			<p>
				<?php if ( count( get_the_category() ) ) : ?>
				<?php printf( __( 'Categories: %2$s', 'lenora' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>  
				<?php endif; ?>
				<?php $tags_list = get_the_tag_list( '', ', ' ); 
				if ( $tags_list ): ?>
					| <?php printf( __( 'Tags: %2$s', 'lenora' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?> </p>
				<?php endif; ?>
	    <p>
                <?php printf( __( 'Share on:', 'lenora' ) )?> 
				
                <!-- get clean titles -->
                <?php
					ob_start();
					the_title_attribute();
					$title = ob_get_clean();
				?>                
    	        <!--Twitter -->
        	    <a href="http://twitter.com/home?status=Currently%20reading:<?php echo urlencode(the_title_attribute('echo=0')); ?>%20<?php echo urlencode( get_permalink( $post->ID ) ); ?>" target="_blank"> <?php printf( __( 'Twitter', 'lenora' ) )?></a>, 
            	<!--Facebook-->
	            <a href="https://www.facebook.com/share.php?u=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&amp;t=<?php echo urlencode (the_title_attribute('echo=0')); ?>" target="_blank"><?php printf( __( 'Facebook', 'lenora' ) )?></a>, 
    	        <!--Delicious -->
        	    <a href="http://del.icio.us/post?v=4;url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>" target="_blank"><?php printf( __( 'Delicious', 'lenora' ) )?></a> |
                <!--Permalink-->
       			<a href="<?php echo get_permalink(); ?>"><?php _e( 'Permalink ', 'lenora' ); ?></a>
				<!--Admin Edit-->
				<?php edit_post_link( __( 'Edit &rarr;', 'lenora' ), '| <span class="edit-link">', '</span>' ); ?> 
            </p>					                 
	</footer>
        	<nav id="nav-posts">
				<div class="nav-previous"><?php previous_post_link(); ?></div>
				<div class="nav-next"><?php next_post_link(); ?> </div>                
			</nav> 
            
			<?php endif; ?>
			<div class="clear"></div>
	</div><!-- END .entry-wrap-->            
</article>


			<?php comments_template( '', true ); ?>
		<?php endwhile; // end of the loop. ?>

   		<?php /* Display navigation to next/previous pages when applicable */ ?>
		<?php if (  $wp_query->max_num_pages > 1 ) : ?>
			<nav id="nav-below">
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'lenora' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'lenora' ) ); ?></div>
			</nav><!-- END #nav-below -->
		<?php endif; ?>	

	</div><!-- END #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
