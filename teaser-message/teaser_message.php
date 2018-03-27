<?php
	/*
	Plugin Name:	Teaser Message
	Plugin URI:	http://soukie.gr
	Description:	Simple Settings Page to display 3 line message in header.
	Version:		1.0
	Author:		Panagiotis Soukiouroglou
	Author URI:	http://soukie.gr
	Licence:		GPL2
	Licence URI:	https://www.gnu.org/licenses/gpl-2.0.html
	Text domain:	teaser
	Domain Path:	/languages
	
	Teaser Message is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 2 of the License, or
	any later version.
	
	Teaser Message is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with Bootstrap Carousel with Shortcode. If not, see https://www.gnu.org/licenses/gpl-2.0.html
	*/
	
	// Activation Hook and callback function
	register_activation_hook(__FILE__, 'activate_teaser_message');
	
	function activate_teaser_message()
	{
		add_admin_menu_item();
		flush_rewrite_rules();
	}
	
	function add_admin_menu_item()
	{
		add_menu_page("Simple Teaser", "Simple Teaser", "manage_options", "simple-teaser", "teaser_setting_page", null, 99);
	}
	add_action('admin_menu', 'add_admin_menu_item');
	
	function teaser_setting_page()
	{
		?>
			<div class="wrap">
				<h1>
					<?php echo __('Teaser Settings Page', 'teaser') ?>
				</h1>
				<form method="post" action="options.php">
					<?php
						settings_fields('section');
						do_settings_sections('teaser-options');
						submit_button();
					?>
				</form>
			</div>
		<?php
	}
	
	// Input Fields
	function display_teaser_first_line()
	{
		?>
			<input size="120" type="text" name="first_line" id="first_line" value="<?php echo get_option('first_line'); ?>">
		<?php
	}
	function display_teaser_second_line()
	{
		?>
			<input size="120" type="text" name="second_line" id="second_line" value="<?php echo get_option('second_line'); ?>">
		<?php
	}
	function display_teaser_third_line()
	{
		?>
			<input size="120" type="text" name="third_line" id="third_line" value="<?php echo get_option('third_line'); ?>">
		<?php
	}
	
	function display_teaser_fields()
	{
		add_settings_section('section', __('Teaser Settings','teaser'), null, 'teaser-options');
		
		add_settings_field('first_line', __('Teaser First Line','teaser'), 'display_teaser_first_line', 'teaser-options', 'section');
		add_settings_field('second_line', __('Teaser Second Line','teaser'), 'display_teaser_second_line', 'teaser-options', 'section');
		add_settings_field('third_line', __('Teaser Third Line','teaser'), 'display_teaser_third_line', 'teaser-options', 'section');
		
		register_setting('section', 'first_line');
		register_setting('section', 'second_line');
		register_setting('section', 'third_line');
	}
	
	add_action('admin_init', 'display_teaser_fields');
	
	// Deactivation hook and callback function
	register_deactivation_hook(__FILE__, 'deactivate_teaser_message');
	
	function deactivate_teaser_message()
	{
		flush_rewrite_rules();
	}