<?php
function field_gender(){
    return [
        'man' => __('Man', 'opalbeauty'),
        'women' => __('Women', 'opalbeauty'),
        'other' => __('Other', 'opalbeauty'),
    ];
}

function field_specialist(){
    return [
        'chin' => __('Chin', 'opalbeauty'),
        'chest' => __('Chest', 'opalbeauty'),
        'body' => __('Body', 'opalbeauty'),
        'eyes' => __('Eyes', 'opalbeauty'),
        'nose' => __('Nose', 'opalbeauty'),
        'other' => __('Other', 'opalbeauty'),
    ];
}

function question_category(){
	$default = [
        'all' => [__('All', 'opalbeauty'), 'checked'],
		'doctor' => [__('Doctor', 'opalbeauty'), ''],
		'plastic_surgery' => [__('Plastic surgery', 'opalbeauty'), ''],
		'skin_care' => [__('Skin care', 'opalbeauty'), '']
    ];
	$question_category = get_query_var( 'category' );
	if($question_category){
		$default['all'] = [__('All', 'opalbeauty'), ''];
		foreach($question_category as $key => $value){
			if($default[$value]){
				$default[$value][1] = 'checked';
			}
		}
	}
    return $default;
}


function field_service(){
	$default = [
        'all' => [__('All', 'opalbeauty'), 'checked'],
		'eyes' => [__('Eyes', 'opalbeauty'), ''],
		'nose' => [__('Nose', 'opalbeauty'), ''],
		'mouse' => [__('Mouse', 'opalbeauty'), ''],
		'chin' => [__('Chin', 'opalbeauty'), ''],
		'fat_loss' => [__('Fat loss', 'opalbeauty'), ''],
		'skin' => [__('Skin', 'opalbeauty'), ''],
		'other' => [__('Other', 'opalbeauty'), '']
    ];
	$field_service = get_query_var( 'field_service' );
	if($field_service){
		$default['all'] = [__('All', 'opalbeauty'), ''];
		foreach($field_service as $key => $value){
			if($default[$value]){
				$default[$value][1] = 'checked';
			}
		}
	}
    return $default;
}

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_61ddc1bfb6841',
	'title' => 'User Doctor',
	'fields' => array(
		array(
			'key' => 'field_61ddc1c88795a',
			'label' => 'Study at',
			'name' => 'study_at',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.33',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_61ddc1d58795b',
			'label' => 'Experience',
			'name' => 'experience',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.33',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_61ddc2198795c',
			'label' => 'Surgeries',
			'name' => 'surgeries',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.33',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_61ddc2788795d',
			'label' => 'Specialist',
			'name' => 'specialist',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.33',
				'class' => '',
				'id' => '',
			),
			'choices' => field_Specialist(),
			'default_value' => false,
			'allow_null' => 0,
			'multiple' => 1,
			'ui' => 0,
			'return_format' => 'value',
			'ajax' => 0,
			'placeholder' => '',
		),
		array(
			'key' => 'field_61ddc32679283',
			'label' => 'Work at',
			'name' => 'work_at',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.33',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_61ddc34079284',
			'label' => 'Certificated',
			'name' => 'certificated',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.33',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_61df24d1053a9',
			'label' => 'Moderated',
			'name' => 'moderated',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'user_role',
				'operator' => '==',
				'value' => 'doctor',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
));

acf_add_local_field_group(array(
	'key' => 'group_61ddbd09adc0a',
	'title' => 'User Normal',
	'fields' => array(
		array(
			'key' => 'field_61ddbd0b815db',
			'label' => 'Interested in',
			'name' => 'interested_in',
			'type' => 'checkbox',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => field_Specialist(),
			'allow_custom' => 0,
			'default_value' => array(
			),
			'layout' => 'vertical',
			'toggle' => 0,
			'return_format' => 'value',
			'save_custom' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'user_role',
				'operator' => '==',
				'value' => 'normal',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
));

acf_add_local_field_group(array(
	'key' => 'group_61ddb8bff3a9a',
	'title' => 'User Normal & Doctor',
	'fields' => array(
		array(
			'key' => 'field_61ddb8cdae17d',
			'label' => 'User Avatar',
			'name' => 'user_avatar',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.33',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_61ddbb6bae17f',
			'label' => 'User Gender',
			'name' => 'user_gender',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.33',
				'class' => '',
				'id' => '',
			),
			'choices' => field_gender(),
			'default_value' => false,
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'return_format' => 'value',
			'ajax' => 0,
			'placeholder' => '',
		),
		array(
			'key' => 'field_61ddbc34ae180',
			'label' => 'User Age',
			'name' => 'user_age',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33.33',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_6213459d95976',
			'label' => 'User Notification',
			'name' => 'user_notification',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 1,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'user_role',
				'operator' => '==',
				'value' => 'normal',
			),
		),
		array(
			array(
				'param' => 'user_role',
				'operator' => '==',
				'value' => 'doctor',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
));

endif;		