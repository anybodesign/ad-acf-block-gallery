<?php
/*
Plugin Name: AD ACF Gallery Block
Description: Add an alternate gallery block for your pages and posts. 
Plugin URI: https://github.com/anybodesign/ad-acf-block-gallery
Version: 1.0
Author: Thomas Villain - Anybodesign
Author URI: https://anybodesign.com/
License: GPL2

Text Domain: ad-acfgb
Domain Path: /languages/

	
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined('ABSPATH') or die(); 


/* ------------------------------------------
// Some constants ---------------------------
--------------------------------------------- */


define('ACFGB_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('ACFGB_NAME', 'AD ACF Gallery Block');
define('ACFGB_VERSION', '1.0');


// i18n

load_plugin_textdomain( 'ad-acfgb', false, basename( dirname( __FILE__ ) ) . '/languages/' );


/* ------------------------------------------
// Activation Alert -------------------------
--------------------------------------------- */

register_activation_hook( __FILE__, 'acfgb_admin_notice_activation_hook' );

function acfgb_admin_notice_activation_hook() {
	set_transient( 'acfgb-admin-notice-transient', true, 5 );
}

function acfgb_admin_notice(){

	if( get_transient( 'acfgb-admin-notice-transient' ) ){
		?>
		<div class="notice notice-info is-dismissible">
			<p><?php _e( 'Remember, AD ACF Block Gallery needs ACF Pro 5.8 or greater to be installed and activated!', 'ad-acfgb' ); ?></p>
		</div>
		<?php
		delete_transient( 'acfgb-admin-notice-transient' );
	}
}
add_action( 'admin_notices', 'acfgb_admin_notice' );


/* ------------------------------------------
// ACF Block --------------------------------
--------------------------------------------- */


// Fields

require_once('inc/acf-fields.php');


// Block

add_action('acf/init', 'ad_acfgb_acf_init');
function ad_acfgb_acf_init() {
	
	if( function_exists('acf_register_block') ) {
		
		acf_register_block(array(
			'name'				=> 'ad-gallery',
			'title'				=> __('ACF Gallery'),
			'description'		=> __('An alternate gallery block.'),
			'render_callback'	=> 'ad_acfgb_render_callback',
			'category'			=> 'common',
			'icon'				=> 'images-alt2',
			'keywords'			=> array( 'gallery', 'galerie' ),
		));
	}
}


// Rendering

function ad_acfgb_render_callback( $block ) {
	
	
		$id = 'gallery-' . $block['id'];
		$align_class = $block['align'] ? 'align' . $block['align'] : '';
		
		$cols = get_field('columns');
		$images = get_field('gallery');
	?>

	<div class="ad-acf-block ad-acf-block-gallery <?php echo $align_class; ?>" id="<?php echo $id; ?>">
		<div class="ad-acf-block-container">

			<?php if( $images ): ?>
			<div class="acf-block-gallery-pictures gallery-<?php echo $cols; ?>">
				
		        <?php foreach( $images as $image ): ?>
		        <div class="acf-block-gallery-item">
			        
			        <figure class="acf-block-gallery-figure"<?php if ( $image['caption'] ) { echo ' role="group"'; } ?>>
			            <a href="<?php echo $image['url']; ?>" title="<?php _e('Enlarge picture', 'le-chep'); ?>" data-fancybox="images">
				            <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>">
							<?php if ( $image['caption'] ) { ?>
							<figcaption class="acf-block-gallery-caption">
								<span class="acf-block-gallery-caption-title"><?php echo $image['caption']; ?></span>
							</figcaption>
							<?php } ?>
				        </a>
				    </figure>
				    
		        </div>
		        <?php endforeach; ?>
		        
			</div>
			<?php endif; ?>
		
		</div>
	</div>

	<?php // Styles
		
		wp_enqueue_style( 
			'ad-acf-gallery-block', 
			ACFGB_PATH . '/css/ad-acfgb.css',
			array(), 
			false, 
			'screen' 
		);						

}


/* ------------------------------------------
// Updater ----------------------------------
--------------------------------------------- */


require 'inc/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/anybodesign/ad-acf-block-gallery',
	__FILE__,
	'ad-acf-block-gallery'
);
$myUpdateChecker->setBranch('master');


