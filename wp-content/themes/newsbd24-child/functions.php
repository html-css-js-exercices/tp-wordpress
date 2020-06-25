<?php
/**
 * Specific functions to adjust theme capabilities to client requests
 *
 * @package 1.1.0
 * @author Vincent ESTEVES
 *
 */



/**
 * Enqueue CSS style
 * @package  1.1.0
 * @link https://developer.wordpress.org/themes/advanced-topics/child-themes/ Wordpress Codex
 */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}


/**
 * Remove useless parent theme actions
 * @package  1.1.0
 * @link https://stackoverflow.com/questions/41794175/remove-parent-theme-action-in-child-theme
 */
function child_custom_actions() {
	remove_action( 'newsbd24_header_container', 'newsbd24_header_part_2nd', 11 );
	remove_action( 'newsbd24_header_container', 'newsbd24_header_part_3rd', 12 );
	// wp_dequeue_style( 'news_magazine_and_blog_elements');
}
add_action( 'init' , 'child_custom_actions' );


/**
 * Set new actions of hook removed above
 * @package  1.1.0
 * @link https://developer.wordpress.org/themes/advanced-topics/child-themes/ Wordpress Codex
 */
if( !function_exists('newsbd24_header_part_2nd_child') ){
	/**
	* Add Header 2nd part ( Logo & Ad ).
	*
	* @since 1.1.0
	*/
	function newsbd24_header_part_2nd_child(){
		?>
		<div class="header-section">
			<div class="container">
				<div class="row">
					<div class="col-4 col-sm-4 p-2">

						<?php
						/**
						* Hook - sorna_action_top_bar.
						*
						* @hooked sorna_action_top_bar - 10
						*/
						do_action( 'newsbd24_site_branding' );
						?>
					</div>
					<div class="col-8 col-sm-8 p-2">

		                <nav class="navbar navbar-light navbar-toggleable-md pull-right">
		                    <div class="collapse navbar-collapse justify-content-end" id="matildamenu" role="main-menu">

								<?php
		                        wp_nav_menu( array(
		                            'theme_location'    => 'primary',
		                            'depth'             => 3,
		                            'container'       => false,
		                            'menu_class'        => 'navbar-nav',
									'items_wrap'		=> '<ul id="%1$s" class="%2$s" role="menubar" aria-hidden="false">%3$s</ul>',
		                            'fallback_cb'       => 'newsbd24_bootstrap_navwalker::fallback',
		                            'walker'            => new newsbd24_bootstrap_navwalker())
		                        );
		                        ?>

		                    </div>
		                     <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#matildamenu" aria-controls="matildamenu" aria-expanded="false" aria-label="Toggle navigation">
		                        <span class="navbar-toggler-icon"></span>
		                    </button>

		                </nav>
					</div>
					<?php if ( is_active_sidebar( 'header_ad' ) ) : ?>
						<?php dynamic_sidebar( 'header_ad' ); ?>
					<?php endif ?>

				</div><!-- end row -->
			</div><!-- end header-logo -->
		</div><!-- end header -->
		<?php
	}
}

add_action( 'newsbd24_header_container', 'newsbd24_header_part_2nd_child', 11 );

/**
 * Bugfix plugin
 *
 * @package  1.1.0
 * @see  wp-content/plugins/news-magazine-and-blog-elements/inc/enqueue.php
 * It was an extra 'js' folder in path
 * @todo  check when plugin got update
 * @version  plugin bug 1.3
 *
 */
wp_enqueue_script('jquery-advanced-news-ticker', ATA_VAR_URL.'vendors/jquery-advanced-news-ticker/jquery.newsTicker.min.js',0,'1.0.11',true);
