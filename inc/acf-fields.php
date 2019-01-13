<?php defined('ABSPATH') or die(); 

function ad_acfgb_add_fields() {

	if( function_exists('acf_add_local_field_group') ) {
		acf_add_local_field_group(array(
			'key' => 'group_5c366c64d4c4a',
			'title' => __('AD ACF Gallery Block', 'ad-acfgb'),
			'fields' => array(
				array(
					'key' => 'field_5c366c64dbb77',
					'label' => __('Number of columns', 'ad-acfgb'),
					'name' => 'columns',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'2cols' => __('2 columns', 'ad-acfgb'),
						'3cols' => __('3 columns', 'ad-acfgb'),
						'4cols' => __('4 columns', 'ad-acfgb'),
						'6cols' => __('6 columns', 'ad-acfgb'),
					),
					'default_value' => array(
						0 => '4cols',
					),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'return_format' => 'value',
					'placeholder' => '',
				),
				array(
					'key' => 'field_5c366ca99e716',
					'label' => __('Choose pictures', 'ad-acfgb'),
					'name' => 'gallery',
					'type' => 'gallery',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'min' => '',
					'max' => '',
					'insert' => 'append',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/ad-gallery',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
	}
}
add_action('acf/init', 'ad_acfgb_add_fields');