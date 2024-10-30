<?php
/**
 * Plugin Name: Bubbles Name
 * Plugin URI: http://aasthasolutions.com/about-us/
 * Description: Animates your name. When you move your mouse over your name, bubbles will scatter away and then reassemble.
 * Version: 1.0.2
 * Author: Aastha Solutions
 * Author URI: http://aasthasolutions.com/
 * Requires at least: 4.4
 * Tested up to: 6.0.3
 * License: GPL2 or later
 * Text Domain: bubbles-name
 *
 * @package Bubbles Name
 * @category Core
 * @author Aasthasolutions
 */
/*This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class BN_Shortcoder{

  // Constructor
    function __construct() {
		add_action('wp_enqueue_scripts',array( $this, 'bn_scripts' ) );
		add_shortcode( 'bubblesname', array($this, 'bn_name_display' ) );
	}


	/**
	 * Shortcode for add name and display name.
	 *
	 * Shortcode atts
	 * Name   : display Bubble name
	 * Height : height of canvas image
	 * Width  : width of canvas image
	 * Name Full attribute  : width of canvas image
	 */

	function bn_name_display( $atts ) {
	    $name = shortcode_atts( array(
	        'name' => 'Your Name',
	        'height' => 500,
	        'width' => 1000,

	    ), $atts );
	    wp_enqueue_script( 'bn-main' );
	    wp_enqueue_script( 'bn-bubbles' );

	    wp_localize_script( 'bn-main', 'full', $name );
	    wp_localize_script( 'bn-bubbles', 'full', $name );
	    echo '<canvas id="bn_name"></canvas>';
	}
	
	/**
	 * Insert all js for bubbles name.
	 */
	function bn_scripts() {

	    wp_enqueue_script('bn-alphabet', plugins_url( 'assets/js/alphabet.js', __FILE__ ), array( 'jquery' ),'',true);
	    wp_enqueue_script('bn-bubbles', plugins_url( 'assets/js/bubbles.js', __FILE__ ), array( 'jquery' ),'',true);
	    wp_enqueue_script('bn-main', plugins_url( 'assets/js/bubbles-main.js', __FILE__ ), array( 'jquery' ),'',true);
	}
	


}

new BN_Shortcoder();
?>