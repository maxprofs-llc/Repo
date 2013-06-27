<?php get_header(); ?>
	<div id="wrapper">
		<div id="container">    
		<div id="content">
		<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

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

<?php endif; ?>
            
			<div class="clear"></div>
	</div><!-- END .entry-wrap-->            
</article>

				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
		</div><!-- END #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>



