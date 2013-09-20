<?php
/*
Template Name: List
*/
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Snowberry
 * @subpackage Template
 * @since Snowberry 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

			<?php include($_SERVER['DOCUMENT_ROOT']."/wp.php"); customTemplate($pagename); ?>

			</div><!-- #content -->
		</div><!-- #primary -->
<?php get_footer(); ?>
