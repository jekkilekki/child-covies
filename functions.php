<?php
/*
 * Enqueue Child Theme Styles
 */
function covies_enqueue_styles() {
	wp_enqueue_style( 'parent-theme-css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'covies_enqueue_styles' );

/**
 * Featured image slider, displayed on front page for static page and blog
 */
if ( ! function_exists( 'covies_featured_slider' ) ) :
function covies_featured_slider() {
  if ( ( is_home() || is_front_page() ) && get_theme_mod( 'activello_featured_hide' ) == 1 ) {
		
		wp_enqueue_style( 'flexslider-css' );
		wp_enqueue_script( 'flexslider-js' );
		
    echo '<div class="flexslider">';
      echo '<ul class="slides">';

        $count = 12;
        $slidecat = get_theme_mod( 'activello_featured_cat' );

        $query = new WP_Query( array( 'cat' => $slidecat,'posts_per_page' => $count ) );
        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();
                
            if ( (function_exists( 'has_post_thumbnail' )) && ( has_post_thumbnail() ) ) :

                echo '<li>';
                      echo get_the_post_thumbnail( get_the_ID(), 'activello-slider' );

                    echo '<div class="flex-caption">';
                      // echo get_the_category_list();
                        // if ( get_the_title() != '' ) echo '<a href="' . get_permalink() . '"><h2 class="entry-title">'. get_the_title().'</h2></a>';
                        // echo '<div class="read-more"><a href="' . get_permalink() . '">' . __( 'Read More', 'activello' ) .'</a></div>';
                    echo '</div>';

                echo '</li>';
            endif;

        endwhile; 
        wp_reset_query();
        endif;

      echo '</ul>';
    echo ' </div>';
  }
}
endif;

/**
 * function to show the footer info, copyright information
 */
function covies_footer_info() {
	global $activello_footer_info;

	$blogname = get_bloginfo();
	echo "&copy; " . date( 'Y' ) . " $blogname<br>";
  	printf( esc_html__( 'Child Theme by %1$s Based on %2$s by %3$s', 'activello' ) , '<a href="http://aaronsnowberger.com/">Aaron Snowberger</a>', '<strong>Activello</strong>', '<a href="http://colorlib.com/" target="_blank">Colorlib</a><br>' );
  	printf( esc_html__( 'Powered by %1$s', 'covies' ), '<a href="http://wordpress.org/" target="_blank">WordPress</a>' );
}
