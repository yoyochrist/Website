<?php
function university_customize_register($wp_customize){
	$wp_customize->add_section('university_theme_options', array(
        'title'    => __('Theme Options', 'university'),
        'priority' => 125,
    ));
	
	$wp_customize->add_section('social_icons', array(
        'title'    => __('Social Media Icons', 'university'),
        'priority' => 135,
    ));
	
	
	$wp_customize->add_setting(
    'twitter_account',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw',
    )
	);

	$wp_customize->add_control(
    'twitter_account',
    	array(
        	'label' => __('Twitter Account URL', 'university'),
        	'section' => 'social_icons',
        	'type' => 'text',
    	)
	);

	$wp_customize->add_setting(
    	'facebook_account',
    	array(
        	'default' => '',
			'sanitize_callback' => 'esc_url_raw',
    	)
	);

	$wp_customize->add_control(
    	'facebook_account',
    	array(
        	'label' => __('Facebook Account URL', 'university'),
        	'section' => 'social_icons',
        	'type' => 'text',
    	)
	);
	
	$wp_customize->add_setting(
    	'linkedin_account',
    	array(
        	'default' => '',
			'sanitize_callback' => 'esc_url_raw',
    	)
	);

	$wp_customize->add_control(
    	'linkedin_account',
    	array(
        	'label' => __('LinkedIn Account URL', 'university'),
        	'section' => 'social_icons',
        	'type' => 'text',
    	)
	);
	
	$wp_customize->add_setting(
    	'dribble_account',
    	array(
        	'default' => '',
			'sanitize_callback' => 'esc_url_raw',
    	)
	);

	$wp_customize->add_control(
    	'dribble_account',
    	array(
        	'label' => __('Dribble Account URL', 'university'),
        	'section' => 'social_icons',
        	'type' => 'text',
    	)
	);
	
	$wp_customize->add_setting(
    	'pinterest_account',
    	array(
        	'default' => '',
			'sanitize_callback' => 'esc_url_raw',
    	)
	);

	$wp_customize->add_control(
    	'pinterest_account',
    	array(
        	'label' => __('pInterest Account URL', 'university'),
        	'section' => 'social_icons',
        	'type' => 'text',
    	)
	);
	
	$wp_customize->add_setting(
    	'flickr_account',
    	array(
        	'default' => '',
			'sanitize_callback' => 'esc_url_raw',
    	)
	);

	$wp_customize->add_control(
    	'flickr_account',
    	array(
        	'label' => __('Flickr Account URL', 'university'),
        	'section' => 'social_icons',
        	'type' => 'text',
    	)
	);
	
	$wp_customize->add_setting(
    	'vimeo_account',
    	array(
        	'default' => '',
			'sanitize_callback' => 'esc_url_raw',
    	)
	);

	$wp_customize->add_control(
    	'vimeo_account',
    	array(
        	'label' => __('Vimeo Account URL', 'university'),
        	'section' => 'social_icons',
        	'type' => 'text',
    	)
	);
	
	$wp_customize->add_setting(
    	'youtube_account',
    	array(
        	'default' => '',
			'sanitize_callback' => 'esc_url_raw',
    	)
	);

	$wp_customize->add_control(
    	'youtube_account',
    	array(
        	'label' => __('YouTube Account URL', 'university'),
        	'section' => 'social_icons',
        	'type' => 'text',
    	)
	);
	
	$wp_customize->add_setting(
    	'tumblr_account',
    	array(
        	'default' => '',
			'sanitize_callback' => 'esc_url_raw',
    	)
	);

	$wp_customize->add_control(
    	'tumblr_account',
    	array(
        	'label' => __('Tumblr Account URL', 'university'),
        	'section' => 'social_icons',
        	'type' => 'text',
    	)
	);
	
	$wp_customize->add_setting(
    	'instagram_account',
    	array(
        	'default' => '',
			'sanitize_callback' => 'esc_url_raw',
    	)
	);

	$wp_customize->add_control(
    	'instagram_account',
    	array(
        	'label' => __('Instagram Account URL', 'university'),
        	'section' => 'social_icons',
        	'type' => 'text',
    	)
	);
	
	$wp_customize->add_setting(
    	'googleplus_account',
    	array(
        	'default' => '',
			'sanitize_callback' => 'esc_url_raw',
    	)
	);

	$wp_customize->add_control(
    	'googleplus_account',
    	array(
        	'label' => __('Google Plus Account URL', 'university'),
        	'section' => 'social_icons',
        	'type' => 'text',
    	)
	);
	
$wp_customize->add_setting( 'logo_img',
    	array(
			'sanitize_callback' => 'esc_url_raw',
    	)
 );
 
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'logo_img',
        array(
            'label' => __('Upload a Logo Image', 'university'),
            'section' => 'university_theme_options',
            'settings' => 'logo_img'
        )
    )
);
}
add_action('customize_register', 'university_customize_register');