<?php
/**
 * Plugin Name: AutomateWoo Order Rule - Order Note Content
 * Description: Adds a custom AutomateWoo rule to check if an order has an order note which includes a given content.
 * Version: 1.0
 * Author: WP Special Projects
 * Text Domain: automatewoo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_filter(
	'automatewoo/rules/includes',
	function( $rules ) {
		include plugin_dir_path( __FILE__ ) . 'class-automatewoo-rule-order-note-content.php';

		$rules['order_note_content'] = 'AutomateWoo_Rule_Order_Note_Content';

		return $rules;
	}
);

