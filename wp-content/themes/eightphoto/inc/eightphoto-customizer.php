<?php 
// Blog Themes Optins 
function eightphoto_basic_setting($wp_customize)
{
    // Start Basic Settings Themes Options
  $wp_customize->add_panel('eightphoto_basic_settings', array(
    'title'         => esc_html__('Basic Settings','eightphoto'),
    'description'   => '',
    'capability'    => 'edit_theme_options',
    'priority'      => 10,
    'theme_supports'=>'',
    ));

  $wp_customize->get_section('title_tagline' )->panel = 'eightphoto_basic_settings';

        // Web Page Layout
  $wp_customize->add_section('eightphoto_webpage_layout', array(
    'title'     => esc_html__('Webpage Layout','eightphoto'),
    'description' => '',
    'capability' => 'edit_theme_options',
    'priority' => 12,
    'panel'     => 'eightphoto_basic_settings',
    ));

  $wp_customize->add_setting( 'eightphoto_webpage_layout', array(
    'default' => 'fullwidth',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'eightphoto_radio_sanitize_webpagelayout',              
    ));
  
  $wp_customize->add_control('eightphoto_webpage_layout', array(
    'type' => 'radio',
    'label' => esc_html__('Choose the layout that you want', 'eightphoto'),
    'section' => 'eightphoto_webpage_layout',
    'setting' => 'eightphoto_webpage_layout',
    'choices' => array(
     'fullwidth' => esc_html__('Full Width', 'eightphoto'),
     'boxed' => esc_html__('Boxed', 'eightphoto')
     )
    ));
  

        //Logo Settings
  $wp_customize->get_section('header_image')->title = esc_html__( 'Header Image','eightphoto' );
  $wp_customize->get_section('header_image')->priority = 40;
  $wp_customize->get_section('header_image')->panel = 'eightphoto_basic_settings';

        //Color Settings
  $wp_customize->get_section('colors')->title = esc_html__( 'Themes Colors', 'eightphoto' );
  $wp_customize->get_section('colors')->priority = 50;
  $wp_customize->get_section('colors')->panel = 'eightphoto_basic_settings';

        //Background Settings
  $wp_customize->get_section('background_image')->title = esc_html__( 'Background Image', 'eightphoto' );
  $wp_customize->get_section('background_image')->priority = 60;
  $wp_customize->get_section('background_image')->panel = 'eightphoto_basic_settings'; 
        // static frontpage
  $wp_customize->get_section('static_front_page')->panel = 'eightphoto_basic_settings'; 

        //Footer Copy Right Text
  $wp_customize->add_section('eightphoto_footer_copyright', array(
    'priority' => 70,
    'title' => esc_html__('Footer Copyright', 'eightphoto'),
    'panel' => 'eightphoto_basic_settings'
    )
  );

  $wp_customize->add_setting('eightphoto_copyright', array(
    'default' => '',
    'sanitize_callback' => 'eightphoto_sanitize_text',
    )
  );
  
  $wp_customize->add_control('eightphoto_copyright',array(
    'type' => 'textarea',
    'label' => esc_html__('Copyright', 'eightphoto'),
    'section' => 'eightphoto_footer_copyright',
    'setting' => 'eightphoto_copyright',
    )
  );  
    // Header setting panel
  $wp_customize->add_panel('eightphoto_header_settings',array(
    'title'       =>  esc_html__('Header Settings','eightphoto'),
    'capability'  =>  'edit_theme_options',
    'priority'    =>  15,
    )
  );
  $wp_customize->add_section('eightphoto_header_settings_search',array(
    'priority'  =>  10,
    'title'     =>  esc_html__('Search Settings','eightphoto'),
    'panel'     =>  esc_html__('eightphoto_header_settings','eightphoto')
    )
  );
  $wp_customize->add_setting('eightphoto_header_settings_search_option',array(
    'default'           =>  'disable',
    'sanitize_callback' =>  'eightphoto_radio_sanitize_enabledisable',
    )
  );
  $wp_customize->add_control('eightphoto_header_settings_search_option',array(
    'description' =>  esc_html__('Choose Enable to show search option in header','eightphoto'),
    'section'     =>  'eightphoto_header_settings_search',
    'type'        =>  'radio',
    'choices'     =>  array(
      'enable'  =>  esc_html__('Enable','eightphoto'),
      'disable' =>  esc_html__('Disable','eightphoto')
      )
    )
  );          

    // Panel HomePage  Settings Themes Options
  $wp_customize->add_panel('eightphoto_homepage_settings', array(
    'title'         => esc_html__('Homepage Section','eightphoto'),
    'description'   => '',
    'capability'    => 'edit_theme_options',
    'priority'      => 20,
    'theme_supports'=>'',
    )
  );

        // HomePage Slider Settings 

  $wp_customize->add_section('eightphoto_homepage_slider_setting', array(
    'priority' => 10,
    'title' => esc_html__('Home Slider Settings', 'eightphoto'),
    'panel' => 'eightphoto_homepage_settings',
    )
  );
  
  $wp_customize->add_setting('eightphoto_homepage_slider_setting_option', array(
    'default' => 'disable',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'eightphoto_radio_sanitize_enabledisable',
    'transport'         =>  'postMessage'
    )
  );

  $wp_customize->add_control('eightphoto_homepage_slider_setting_option', array(
    'type' => 'radio',
    'label' => esc_html__('Enable Disable Slider', 'eightphoto'),
    'section' => 'eightphoto_homepage_slider_setting',
    'setting' => 'eightphoto_homepage_slider_setting_option',
    'choices' => array(
     'enable' => esc_html__('Enable', 'eightphoto'),
     'disable' => esc_html__('Disable', 'eightphoto'),
     )
    )
  );
  
           //select category for slider
  $categories = get_categories();
  $cats = array();
  $cats[] = 'Select Category';
  foreach($categories as $category){
    $cats[$category->slug] = $category->name;
  }
  
            // Main Slider Section

  $wp_customize->add_setting( 'eightphoto_homepage_advance_slider', array(
    'sanitize_callback' => 'eightphoto_sanitize_text',
    'default' => '',
    )
  );

  $wp_customize->add_control( new Eightphoto_General_Repeater( $wp_customize, 'eightphoto_homepage_advance_slider', array(
    'label'   => esc_html__('Main Slider Section','eightphoto'),
    'section' => 'eightphoto_homepage_slider_setting',
    'description' => esc_html__('Upload Slider Image With Slider Title, Description, Link & Button Text','eightphoto'),
    'image_control' => true,
    'title_control' => true,               
    'text_control' => true,
    'link_control' => true,
    'subtitle_control' => true
    )
  )
  );

            // End Advance Slider Type 
  
  
            //slider pager
  $wp_customize->add_setting('eightphoto_homepage_slider_show_pager', array(
   'default' => 'no',
   'capability' => 'edit_theme_options',
   'sanitize_callback' => 'eightphoto_radio_sanitize_yesno',
   )
  );

  $wp_customize->add_control('eightphoto_homepage_slider_show_pager', array(
    'type' => 'radio',
    'label' => esc_html__('Show Pager', 'eightphoto'),
    'section' => 'eightphoto_homepage_slider_setting',
    'setting' => 'eightphoto_homepage_slider_show_pager',
    'choices' => array(
      'yes' => esc_html__('Yes', 'eightphoto'),
      'no' => esc_html__('No', 'eightphoto'),
      )
    )
  );
  
            //slider controls
  $wp_customize->add_setting('eightphoto_homepage_slider_show_controls', array(
   'default' => 'no',
   'capability' => 'edit_theme_options',
   'sanitize_callback' => 'eightphoto_radio_sanitize_yesno',
   )
  );

  $wp_customize->add_control('eightphoto_homepage_slider_show_controls', array(
    'type' => 'radio',
    'label' => esc_html__('Show Controls', 'eightphoto'),
    'section' => 'eightphoto_homepage_slider_setting',
    'setting' => 'eightphoto_homepage_slider_show_controls',
    'choices' => array(
      'yes' => esc_html__('Yes', 'eightphoto'),
      'no' => esc_html__('No', 'eightphoto'),
      )
    )
  );
  
            //slider caption
  $wp_customize->add_setting('eightphoto_homepage_slider_show_caption', array(
   'default' => 'no',
   'capability' => 'edit_theme_options',
   'sanitize_callback' => 'eightphoto_radio_sanitize_yesno',
   ));

  $wp_customize->add_control('eightphoto_homepage_slider_show_caption', array(
   'type' => 'radio',
   'label' => esc_html__('Show Caption', 'eightphoto'),
   'section' => 'eightphoto_homepage_slider_setting',
   'setting' => 'eightphoto_homepage_slider_show_caption',
   'choices' => array(
    'yes' => esc_html__('Yes', 'eightphoto'),
    'no' => esc_html__('No', 'eightphoto'),
    )
   ));
  
            //slider auto
  $wp_customize->add_setting('eightphoto_homepage_slider_auto', array(
   'default' => 'no',
   'capability' => 'edit_theme_options',
   'sanitize_callback' => 'eightphoto_radio_sanitize_yesno',
   ));

  $wp_customize->add_control('eightphoto_homepage_slider_auto', array(
   'type' => 'radio',
   'label' => esc_html__('Transition Auto', 'eightphoto'),
   'section' => 'eightphoto_homepage_slider_setting',
   'setting' => 'eightphoto_homepage_slider_auto',
   'choices' => array(
    'yes' => esc_html__('Yes', 'eightphoto'),
    'no' => esc_html__('No', 'eightphoto'),
    )
   ));
  
            //slider mode
  $wp_customize->add_setting('eightphoto_homepage_slider_mode', array(
   'default' => 'fade',
   'capability' => 'edit_theme_options',
   'sanitize_callback' => 'eightphoto_radio_sanitize_transitiontype',
   ));

  $wp_customize->add_control('eightphoto_homepage_slider_mode', array(
   'type' => 'radio',
   'label' => esc_html__('Transition Mode', 'eightphoto'),
   'section' => 'eightphoto_homepage_slider_setting',
   'setting' => 'eightphoto_homepage_slider_mode',
   'choices' => array(
         'fade' => esc_html__('Fade', 'eightphoto'),
          'horizontal' => esc_html__('Slide Horizontal', 'eightphoto'),
          'vertical' => esc_html__('Slide Vertical', 'eightphoto'),
    )
   ));
  
  
            //slider speed
  $wp_customize->add_setting('eightphoto_homepage_settings_slider_speed', array(
   'default' => '3500',
   'capability' => 'edit_theme_options',
   'sanitize_callback' => 'eightphoto_sanitize_number',
   )
  );

  $wp_customize->add_control('eightphoto_homepage_settings_slider_speed', array(
    'type' => 'number',
    'label' => esc_html__('Transition Speed', 'eightphoto'),
    'section' => 'eightphoto_homepage_slider_setting',
    'setting' => 'eightphoto_homepage_settings_slider_speed',
    )
  );
  
            //slider pause
  $wp_customize->add_setting('eightphoto_homepage_settings_slider_pause', array(
   'default' => '3500',
   'capability' => 'edit_theme_options',
   'sanitize_callback' => 'eightphoto_sanitize_number',
   ));

  $wp_customize->add_control('eightphoto_homepage_settings_slider_pause', array(
   'type' => 'number',
   'label' => esc_html__('Transition Pause', 'eightphoto'),
   'section' => 'eightphoto_homepage_slider_setting',
   'setting' => 'eightphoto_homepage_settings_slider_pause',
   ));
  
        // HomePage Layout Settings --------------------priority 60---------------------------
  $wp_customize->add_section('eightphoto_homepage_gallery', array(
    'title'     => esc_html__('Gallery Section','eightphoto'),
    'description' => '',
    'capability' => 'edit_theme_options',
    'priority' => 60,
    'panel'     => 'eightphoto_homepage_settings',
    ));

  $wp_customize->add_setting('eightphoto_homepage_gallery_option', array(
    'default' => 'disable',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'eightphoto_radio_sanitize_enabledisable',
    'transport' => 'postMessage'
    ));

  $wp_customize->add_control('eightphoto_homepage_gallery_option', array(
    'type' => 'radio',
    'label' => esc_html__('Enable/Disable Gallery Section', 'eightphoto'),
    'section' => 'eightphoto_homepage_gallery',
    'setting' => 'eightphoto_homepage_gallery_option',
    'choices' => array(
     'enable' => esc_html__('Enable', 'eightphoto'),
     'disable' => esc_html__('Disable', 'eightphoto'),
     )
    ));
  $wp_customize->add_setting('eightphoto_homepage_gallery_main_title', array(
    'default' => esc_html__('Gallery','eightphoto'),
    'sanitize_callback' => 'eightphoto_sanitize_text',
    'transport' => 'postMessage'
    ));
  
  $wp_customize->add_control('eightphoto_homepage_gallery_main_title',array(
    'type' => 'text',
    'label' => esc_html__('Gallery Title', 'eightphoto'),
    'section' => 'eightphoto_homepage_gallery',
    'setting' => 'eightphoto_homepage_gallery_main_title',
    ));

  

            // HomePage Post Display Category Settings

  
  
  $wp_customize->add_setting( 'eightphoto_cstmzr_categories' , array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field',
    ) );
  
  $wp_customize->add_control(
    new Eightphoto_Category_Checkboxes_Control(
      $wp_customize,
      'eightphoto_cstmzr_categories',
      array(
        'label' => esc_html__('Select Gallery Category','eightphoto'),
        'section' => 'eightphoto_homepage_gallery',
        'settings' => 'eightphoto_cstmzr_categories'
        )
      )
    );

  
            // Counter Section starts  --------------Priority 50---------------
  $wp_customize->add_section('eightphoto_homepage_counter_section', array(
    'priority' => 50,
    'title' => esc_html__('Counter Section', 'eightphoto'),
    'panel' => 'eightphoto_homepage_settings',
    ));

  $wp_customize->add_setting('eightphoto_homepage_about_count_option', array(
    'default' => 'disable',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'eightphoto_radio_sanitize_enabledisable',
    'transport' => 'postMessage'
    ));

  $wp_customize->add_control('eightphoto_homepage_about_count_option', array(
    'type' => 'radio',
    'label' => esc_html__('Enable/Disable About Count Section', 'eightphoto'),
    'section' => 'eightphoto_homepage_counter_section',
    'setting' => 'eightphoto_homepage_about_count_option',
    'choices' => array(
     'enable' => esc_html__('Enable', 'eightphoto'),
     'disable' => esc_html__('Disable', 'eightphoto'),
     )
    ));

  $wp_customize->add_setting('eightphoto_homepage_about_counter_one', array(
    'default' => '100',
    'sanitize_callback' => 'eightphoto_sanitize_number',
    'transport' => 'postMessage'
    ));
  
  $wp_customize->add_control('eightphoto_homepage_about_counter_one',array(
    'type' => 'number',
    'label' => esc_html__('Counter One', 'eightphoto'),
    'section' => 'eightphoto_homepage_counter_section',
    'setting' => 'eightphoto_homepage_about_counter_one',
    ));

  $wp_customize->add_setting('eightphoto_homepage_about_title_one', array(
    'default' => esc_html__('Videos Captured','eightphoto'),
    'sanitize_callback' => 'eightphoto_sanitize_text',
    'transport' => 'postMessage'
    ));
  
  $wp_customize->add_control('eightphoto_homepage_about_title_one',array(
    'type' => 'text',
    'label' => esc_html__('Title One', 'eightphoto'),
    'section' => 'eightphoto_homepage_counter_section',
    'setting' => 'eightphoto_homepage_about_title_one',
    ));

  $wp_customize->add_setting('eightphoto_homepage_about_icon_one', array(
    'default' => 'fa-video-camera',
    'sanitize_callback' => 'eightphoto_sanitize_text',
    'transport' => 'postMessage'
    ));
  
  $wp_customize->add_control('eightphoto_homepage_about_icon_one',array(
    'type' => 'text',
    'description' => esc_html__( 'Example: <strong>fa-video-camera</strong>. Full list of icons is here <strong>Font Awesome Link</strong>', 'eightphoto' ),
    'label' => esc_html__('Icon One', 'eightphoto'),
    'section' => 'eightphoto_homepage_counter_section',
    'setting' => 'eightphoto_homepage_about_icon_one',
    ));


  $wp_customize->add_setting('eightphoto_homepage_about_counter_two', array(
    'default' => '500',
    'sanitize_callback' => 'eightphoto_sanitize_number',
    'transport' => 'postMessage'
    ));
  
  $wp_customize->add_control('eightphoto_homepage_about_counter_two',array(
    'type' => 'number',
    'label' => esc_html__('Counter Two', 'eightphoto'),
    'section' => 'eightphoto_homepage_counter_section',
    'setting' => 'eightphoto_homepage_about_counter_two',
    ));

  $wp_customize->add_setting('eightphoto_homepage_about_title_two', array(
    'default' => esc_html__('PHOTOS CLICKED','eightphoto'),
    'sanitize_callback' => 'eightphoto_sanitize_text',
    'transport' => 'postMessage'
    ));
  
  $wp_customize->add_control('eightphoto_homepage_about_title_two',array(
    'type' => 'text',
    'label' => esc_html__('Title Two', 'eightphoto'),
    'section' => 'eightphoto_homepage_counter_section',
    'setting' => 'eightphoto_homepage_about_title_two',
    ));

  $wp_customize->add_setting('eightphoto_homepage_about_icon_two', array(
    'default' => 'fa-picture-o',
    'sanitize_callback' => 'eightphoto_sanitize_text',
    'transport' => 'postMessage'
    ));
  
  $wp_customize->add_control('eightphoto_homepage_about_icon_two',array(
    'type' => 'text',
    'description' => esc_html__( 'Example: <strong>fa-picture-o</strong>. Full list of icons is here <strong>Font Awesome Link</strong>', 'eightphoto' ),
    'label' => esc_html__('Icon Two', 'eightphoto'),
    'section' => 'eightphoto_homepage_counter_section',
    'setting' => 'eightphoto_homepage_about_icon_two',
    ));


  $wp_customize->add_setting('eightphoto_homepage_about_counter_three', array(
    'default' => '150',
    'sanitize_callback' => 'eightphoto_sanitize_number',
    'transport' => 'postMessage'
    ));
  
  $wp_customize->add_control('eightphoto_homepage_about_counter_three',array(
    'type' => 'number',
    'label' => esc_html__('Counter Three', 'eightphoto'),
    'section' => 'eightphoto_homepage_counter_section',
    'setting' => 'eightphoto_homepage_about_counter_three',
    ));

  $wp_customize->add_setting('eightphoto_homepage_about_title_three', array(
    'default' => esc_html__('PLACES VISITED','eightphoto'),
    'sanitize_callback' => 'eightphoto_sanitize_text',
    'transport' => 'postMessage'
    ));
  
  $wp_customize->add_control('eightphoto_homepage_about_title_three',array(
    'type' => 'text',
    'label' => esc_html__('Title Three', 'eightphoto'),
    'section' => 'eightphoto_homepage_counter_section',
    'setting' => 'eightphoto_homepage_about_title_three',
    ));

  $wp_customize->add_setting('eightphoto_homepage_about_icon_three', array(
    'default' => 'fa-university',
    'sanitize_callback' => 'eightphoto_sanitize_text',
    'transport' => 'postMessage'
    ));
  
  $wp_customize->add_control('eightphoto_homepage_about_icon_three',array(
    'type' => 'text',
    'description' => esc_html__( 'Example: <strong>fa-university</strong>. Full list of icons is here <strong>Font Awesome Link</strong>', 'eightphoto' ),
    'label' => esc_html__('Icon Three', 'eightphoto'),
    'section' => 'eightphoto_homepage_counter_section',
    'setting' => 'eightphoto_homepage_about_icon_three',
    ));

  $wp_customize->add_setting('eightphoto_homepage_about_counter_four', array(
    'default' => '50',
    'sanitize_callback' => 'eightphoto_sanitize_number',
    'transport' => 'postMessage'
    ));
  
  $wp_customize->add_control('eightphoto_homepage_about_counter_four',array(
    'type' => 'number',
    'label' => esc_html__('Counter Four', 'eightphoto'),
    'section' => 'eightphoto_homepage_counter_section',
    'setting' => 'eightphoto_homepage_about_counter_four',
    ));

  $wp_customize->add_setting('eightphoto_homepage_about_title_four', array(
    'default' => esc_html__('AWARDS WON','eightphoto'),
    'sanitize_callback' => 'eightphoto_sanitize_text',
    'transport' => 'postMessage'
    ));
  
  $wp_customize->add_control('eightphoto_homepage_about_title_four',array(
    'type' => 'text',
    'label' => esc_html__('Title Four', 'eightphoto'),
    'section' => 'eightphoto_homepage_counter_section',
    'setting' => 'eightphoto_homepage_about_title_four',
    ));

  $wp_customize->add_setting('eightphoto_homepage_about_icon_four', array(
    'default' => 'fa-trophy',
    'sanitize_callback' => 'eightphoto_sanitize_text',
    'transport' => 'postMessage'
    ));
  
  $wp_customize->add_control('eightphoto_homepage_about_icon_four',array(
    'type' => 'text',
    'description' => esc_html__( 'Example: <strong>fa-trophy</strong>. Full list of icons is here <strong>Font Awesome Link</strong>', 'eightphoto' ),
    'label' => esc_html__('Icon Four', 'eightphoto'),
    'section' => 'eightphoto_homepage_counter_section',
    'setting' => 'eightphoto_homepage_about_icon_four',
    ));
           // Counter ends ----------prirority 50--------------------- 

        // HomePage About Section Settings   -----------------priority 20 ----------------------
  $wp_customize->add_section('eightphoto_homepage_about', array(
    'priority' => 20,
    'title' => esc_html__('About Section', 'eightphoto'),
    'panel' => 'eightphoto_homepage_settings',
    ));
  
  $wp_customize->add_setting('eightphoto_homepage_about_option', array(
    'default' => 'disable',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'eightphoto_radio_sanitize_enabledisable',
    'transport' => 'postMessage'
    ));

  $wp_customize->add_control('eightphoto_homepage_about_option', array(
    'type' => 'radio',
    'label' => esc_html__('Enable/Disable About Section', 'eightphoto'),
    'section' => 'eightphoto_homepage_about',
    'setting' => 'eightphoto_homepage_about_option',
    'choices' => array(
     'enable' => esc_html__('Enable', 'eightphoto'),
     'disable' => esc_html__('Disable', 'eightphoto'),
     )
    ));  

          // for page dropdown
  $pages = get_pages();
  $ed_pages = array();
  $ed_pages[0] = 'Select Page';
  foreach ( $pages as $page ) {
   $ed_pages[$page->ID] = $page->post_title;     
 }   

 $wp_customize->add_setting('eightphoto_homepage_about_page', array(
  'default'        => '',
  'sanitize_callback' => 'eightphoto_category',
  ));
 $wp_customize->add_control( 'eightphoto_homepage_about_page', array(
  'settings' => 'eightphoto_homepage_about_page',
  'label'   => esc_html__('Select Page For About Section','eightphoto'),
  'section'  => 'eightphoto_homepage_about',
  'type'    => 'select',
  'choices' => $ed_pages,
  ));    
        // HomePage About Section Settings  ends  -----------------priority 20 ----------------------


        // HomePage Blogs Section starts -----------------priority 80 ----------------------
 $wp_customize->add_section('eightphoto_homepage_blog_section', array(
  'priority' => 80,
  'title' => esc_html__('Blogs Section', 'eightphoto'),
  'panel' => 'eightphoto_homepage_settings',
  ));
 
 $wp_customize->add_setting('eightphoto_homepage_blogs_option', array(
  'default' => 'disable',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_radio_sanitize_enabledisable',
  'transport' => 'postMessage'
  ));

 $wp_customize->add_control('eightphoto_homepage_blogs_option', array(
  'type' => 'radio',
  'label' => esc_html__('Enable Disable Blogs Section', 'eightphoto'),
  'section' => 'eightphoto_homepage_blog_section',
  'setting' => 'eightphoto_homepage_blogs_option',
  'choices' => array(
   'enable' => esc_html__('Enable', 'eightphoto'),
   'disable' => esc_html__('Disable', 'eightphoto'),
   )
  ));

 $wp_customize->add_setting('eightphoto_homepage_blogs_title', array(
  'default' => esc_html__('Blog','eightphoto'),
  'sanitize_callback' => 'eightphoto_sanitize_text',
  'transport' => 'postMessage'
  ));
 
 $wp_customize->add_control('eightphoto_homepage_blogs_title',array(
  'type' => 'text',
  'label' => esc_html__('Enter Blogs Title', 'eightphoto'),
  'section' => 'eightphoto_homepage_blog_section',
  'setting' => 'eightphoto_homepage_blogs_title',
  ));

 $wp_customize->add_setting('eightphoto_homepage_blog_cat', array(
  'default'        => 0,
  'sanitize_callback' => 'eightphoto_category',
  ));
 $wp_customize->add_control( 'eightphoto_homepage_blog_cat', array(
  'settings' => 'eightphoto_homepage_blog_cat',
  'label'   => esc_html__('Select a Category for Blogs','eightphoto'),
  'section'  => 'eightphoto_homepage_blog_section',
  'type'    => 'select',
  'choices' => $cats,
  ));

         // HomePage Blogs Section ends -----------------priority 80 ----------------------   

        // HomePage Our Services Settings    start -----------------priority 30 ----------------------  
 $wp_customize->add_section('eightphoto_homepage_our_services', array(
  'priority' => 30,
  'title' => esc_html__('Our Services Section', 'eightphoto'),
  'panel' => 'eightphoto_homepage_settings',
  ));
 
 $wp_customize->add_setting('eightphoto_homepage_our_service_option', array(
  'default' => 'disable',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_radio_sanitize_enabledisable',
  'transport' => 'postMessage'
  ));

 $wp_customize->add_control('eightphoto_homepage_our_service_option', array(
  'type' => 'radio',
  'label' => esc_html__('Enable Disable Services Section', 'eightphoto'),
  'section' => 'eightphoto_homepage_our_services',
  'setting' => 'eightphoto_homepage_our_service_option',
  'choices' => array(
   'enable' => esc_html__('Enable', 'eightphoto'),
   'disable' => esc_html__('Disable', 'eightphoto'),
   )
  ));

 $wp_customize->add_setting('eightphoto_homepage_our_service_title', array(
  'default' => esc_html__('SERVICES','eightphoto'),
  'sanitize_callback' => 'eightphoto_sanitize_text',
  'transport' => 'postMessage'
  ));
 
 $wp_customize->add_control('eightphoto_homepage_our_service_title',array(
  'type' => 'text',
  'label' => esc_html__('Our Services Title', 'eightphoto'),
  'section' => 'eightphoto_homepage_our_services',
  'setting' => 'eightphoto_homepage_our_service_title',
  ));
 
 $wp_customize->add_setting('eightphoto_homepage_services_page_one', array(
  'default'        => '0',
  'sanitize_callback' => 'eightphoto_category',
  ));
 $wp_customize->add_control( 'eightphoto_homepage_services_page_one', array(
  'settings' => 'eightphoto_homepage_services_page_one',
  'label'   => esc_html__('Select Page For Services Area One','eightphoto'),
  'section'  => 'eightphoto_homepage_our_services',
  'type'    => 'select',
  'choices' => $ed_pages,
  ));

 $wp_customize->add_setting('eightphoto_homepage_services_page_two', array(
  'default'        => '0',
  'sanitize_callback' => 'eightphoto_category',
  ));
 $wp_customize->add_control( 'eightphoto_homepage_services_page_two', array(
  'settings' => 'eightphoto_homepage_services_page_two',
  'label'   => esc_html__('Select Page For Services Area Two','eightphoto'),
  'section'  => 'eightphoto_homepage_our_services',
  'type'    => 'select',
  'choices' => $ed_pages,
  ));

 $wp_customize->add_setting('eightphoto_homepage_services_page_three', array(
  'default'        => '0',
  'sanitize_callback' => 'eightphoto_category',
  ));
 $wp_customize->add_control( 'eightphoto_homepage_services_page_three', array(
  'settings' => 'eightphoto_homepage_services_page_three',
  'label'   => esc_html__('Select Page For Services Area Three','eightphoto'),
  'section'  => 'eightphoto_homepage_our_services',
  'type'    => 'select',
  'choices' => $ed_pages,
  ));
        // HomePage Call To Action Settings  -------------------- priority 70 --------------------
 $wp_customize->add_section('eightphoto_homepage_call_action', array(
  'priority' => 70,
  'title' => esc_html__('Call to Action Section', 'eightphoto'),
  'panel' => 'eightphoto_homepage_settings',
  ));
 
 $wp_customize->add_setting('eightphoto_homepage_call_action_option', array(
  'default' => 'disable',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_radio_sanitize_enabledisable',
  'transport' => 'postMessage'
  ));

 $wp_customize->add_control('eightphoto_homepage_call_action_option', array(
  'type' => 'radio',
  'label' => esc_html__('Enable/Disable Quick Section', 'eightphoto'),
  'section' => 'eightphoto_homepage_call_action',
  'setting' => 'eightphoto_homepage_call_action_option',
  'choices' => array(
   'enable' => esc_html__('Enable', 'eightphoto'),
   'disable' => esc_html__('Disable', 'eightphoto'),
   )
  ));

 $wp_customize->add_setting('eightphoto_homepage_call_action_image', array(
  'default' => '',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'esc_url_raw'
  ));

 $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'eightphoto_homepage_call_action_image', array(
  'label' => esc_html__('BackGround Image', 'eightphoto'),
  'section' => 'eightphoto_homepage_call_action',
  'setting' => 'eightphoto_homepage_call_action_image',
  )));

 $wp_customize->add_setting('eightphoto_homepage_call_action_title', array(
  'default' => esc_html__('WANT A PHOTOGRAPHER?','eightphoto'),
  'sanitize_callback' => 'eightphoto_sanitize_text',
  'transport' => 'postMessage'
  ));
 
 $wp_customize->add_control('eightphoto_homepage_call_action_title',array(
  'type' => 'text',
  'label' => esc_html__('Call To Action Title', 'eightphoto'),
  'section' => 'eightphoto_homepage_call_action',
  'setting' => 'eightphoto_homepage_call_action_title',
  ));

 $wp_customize->add_setting('eightphoto_homepage_call_action_sub_title', array(
  'default' => esc_html__('Contact us if you want a photographer for photography.','eightphoto'),
  'sanitize_callback' => 'eightphoto_sanitize_text',
  'transport' => 'postMessage'
  ));
 
 $wp_customize->add_control('eightphoto_homepage_call_action_sub_title',array(
  'type' => 'textarea',
  'label' => esc_html__('Call To Action Description', 'eightphoto'),
  'section' => 'eightphoto_homepage_call_action',
  'setting' => 'eightphoto_homepage_call_action_sub_title',
  ));

 $wp_customize->add_setting('eightphoto_homepage_call_action_button_link', array(
  'default' => '#',
  'sanitize_callback' => 'esc_url',
  ));
 
 $wp_customize->add_control('eightphoto_homepage_call_action_button_link',array(
  'type' => 'text',
  'label' => esc_html__('Call To Action Button Link', 'eightphoto'),
  'section' => 'eightphoto_homepage_call_action',
  'setting' => 'eightphoto_homepage_call_action_button_link',
  ));

 $wp_customize->add_setting('eightphoto_homepage_call_action_button_name', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  'transport' => 'postMessage'
  ));
 
 $wp_customize->add_control('eightphoto_homepage_call_action_button_name',array(
  'type' => 'text',
  'label' => esc_html__('Call To Action Button Name', 'eightphoto'),
  'section' => 'eightphoto_homepage_call_action',
  'setting' => 'eightphoto_homepage_call_action_button_name',
  ));

            // HomePage Call To Action Settings ends -------------------- priority 70 --------------------
 
        // HomePage Call To Action Settings  starts --------------------priority 90---------------------- 
 $wp_customize->add_section('eightphoto_homepage_quick_contact', array(
  'priority' => 90,
  'title' => esc_html__('Quick Contact Info', 'eightphoto'),
  'panel' => 'eightphoto_homepage_settings',
  ));
 
 $wp_customize->add_setting('eightphoto_homepage_quick_contact_info', array(
  'default' => 'disable',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_radio_sanitize_enabledisable',
  'transport' => 'postMessage'
  ));

 $wp_customize->add_control('eightphoto_homepage_quick_contact_info', array(
  'type' => 'radio',
  'label' => esc_html__('Enable/Disable Call Action Section', 'eightphoto'),
  'section' => 'eightphoto_homepage_quick_contact',
  'setting' => 'eightphoto_homepage_quick_contact_info',
  'choices' => array(
   'enable' => esc_html__('Enable', 'eightphoto'),
   'disable' => esc_html__('Disable', 'eightphoto'),
   )
  ));


 $wp_customize->add_setting('eightphoto_homepage_quick_email_icon', array(
  'default' => 'fa-envelope',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  'transport' => 'postMessage'
  ));
 
 $wp_customize->add_control('eightphoto_homepage_quick_email_icon',array(
  'type' => 'text',
  'description' => esc_html__( 'Example: <strong>fa-envelope</strong>. Full list of icons is here <strong>Font Awesome Link</strong>', 'eightphoto' ),
  'label' => esc_html__('Email Icon', 'eightphoto'),
  'section' => 'eightphoto_homepage_quick_contact',
  'setting' => 'eightphoto_homepage_quick_email_icon',
  ));

 $wp_customize->add_setting('eightphoto_homepage_quick_email', array(
  'default' => 'info@8degreethemes.com',
  'sanitize_callback' => 'sanitize_email',
  'transport' => 'postMessage'
  ));
 
 $wp_customize->add_control('eightphoto_homepage_quick_email',array(
  'type' => 'text',
  'label' => esc_html__('Email Address', 'eightphoto'),
  'section' => 'eightphoto_homepage_quick_contact',
  'setting' => 'eightphoto_homepage_quick_email',
  ));


 $wp_customize->add_setting('eightphoto_homepage_quick_twitter_icon', array(
  'default' => 'fa-twitter',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  'transport' => 'postMessage'
  ));
 
 $wp_customize->add_control('eightphoto_homepage_quick_twitter_icon',array(
  'type' => 'text',
  'description' => esc_html__( 'Example: <strong>fa-twitter</strong>. Full list of icons is here <strong>Font Awesome Link</strong>', 'eightphoto' ),
  'label' => esc_html__('Twitter Icon', 'eightphoto'),
  'section' => 'eightphoto_homepage_quick_contact',
  'setting' => 'eightphoto_homepage_quick_twitter_icon',
  ));

 $wp_customize->add_setting('eightphoto_homepage_quick_twitter', array(
  'default' => '8DegreeThemes',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  'transport' => 'postMessage'
  ));
 
 $wp_customize->add_control('eightphoto_homepage_quick_twitter',array(
  'type' => 'text',
  'label' => esc_html__('Twitter UserName', 'eightphoto'),
  'section' => 'eightphoto_homepage_quick_contact',
  'setting' => 'eightphoto_homepage_quick_twitter',
  ));


 $wp_customize->add_setting('eightphoto_homepage_quick_phone_icon', array(
  'default' => 'fa-phone-square',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  'transport' => 'postMessage'
  ));
 
 $wp_customize->add_control('eightphoto_homepage_quick_phone_icon',array(
  'type' => 'text',
  'description' => esc_html__( 'Example: <strong>fa-phone-square</strong>. Full list of icons is here <strong>Font Awesome Link</strong>', 'eightphoto' ),
  'label' => esc_html__('Phone Icon', 'eightphoto'),
  'section' => 'eightphoto_homepage_quick_contact',
  'setting' => 'eightphoto_homepage_quick_phone_icon',
  ));

 $wp_customize->add_setting('eightphoto_homepage_quick_phone', array(
  'default' => '+977-1-4671980',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  'transport' => 'postMessage'
  ));
 
 $wp_customize->add_control('eightphoto_homepage_quick_phone',array(
  'type' => 'text',
  'label' => esc_html__('Phone Number', 'eightphoto'),
  'section' => 'eightphoto_homepage_quick_contact',
  'setting' => 'eightphoto_homepage_quick_phone',
  ));

        // homepage quick info ends --------------------priority 90---------------------- 


        // Gallery Page Section starts -------------priority 60----------------

 $wp_customize->add_section('eightphoto_gallery_section', array(
  'priority' => 60,
  'title' => esc_html__('Gallery Page Settings', 'eightphoto'),
  ));

 $wp_customize->add_setting( 'eightphoto_gallery_page_section', array(
  'default' => 'gridview',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_radio_sanitize_gallery_layout',
  ));
 
 $wp_customize->add_control('eightphoto_gallery_page_section', array(
  'type' => 'radio',
  'label' => esc_html__('Choose the Gallery Page Layout', 'eightphoto'),
  'section' => 'eightphoto_gallery_section',
  'setting' => 'eightphoto_gallery_page_section',
  'choices' => array(
   'gridview' => esc_html__('Grid View', 'eightphoto'),
   'sortable' => esc_html__('Sortable Thumb View', 'eightphoto'),         
   'mediumthumbslistview' => esc_html__('Thumbs List View', 'eightphoto'),
   'largethumbslistview' => esc_html__('Large Thumbs List View', 'eightphoto'),         
   )
  ));

 $wp_customize->add_setting( 'eightphoto_cstmzr_categories_gallery', array(
   'default' => '',
   'sanitize_callback' => 'sanitize_text_field',
   )  );
 
 $wp_customize->add_control(
   new Eightphoto_Category_Checkboxes_Control(
     $wp_customize,
     'eightphoto_cstmzr_categories_gallery',
     array(
       'label' => esc_html__('Select the Categories for Gallery Page','eightphoto'),
       'section' => 'eightphoto_gallery_section',
       'settings' => 'eightphoto_cstmzr_categories_gallery'
       )
     )
   );   

 
 $wp_customize->add_setting('eightphoto_gallery_author_section', array(
  'default' => 'yes',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_radio_sanitize_yesno',
  ));

 $wp_customize->add_control('eightphoto_gallery_author_section', array(
  'type' => 'radio',
  'label' => esc_html__('Show Author', 'eightphoto'),
  'section' => 'eightphoto_gallery_section',
  'setting' => 'eightphoto_gallery_author_section',
  'choices' => array(
   'yes' => esc_html__('Yes', 'eightphoto'),
   'no' => esc_html__('No', 'eightphoto'),
   )
  ));

 $wp_customize->add_setting('eightphoto_gallery_postdate_section', array(
  'default' => 'yes',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_radio_sanitize_yesno',
  ));

 $wp_customize->add_control('eightphoto_gallery_postdate_section', array(
  'type' => 'radio',
  'label' => esc_html__('Show Post Date', 'eightphoto'),
  'section' => 'eightphoto_gallery_section',
  'setting' => 'eightphoto_gallery_postdate_section',
  'choices' => array(
   'yes' => esc_html__('Yes', 'eightphoto'),
   'no' => esc_html__('No', 'eightphoto'),
   )
  ));

 $wp_customize->add_setting('eightphoto_gallery_meta_category_section', array(
  'default' => 'yes',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_radio_sanitize_yesno',
  ));

 $wp_customize->add_control('eightphoto_gallery_meta_category_section', array(
  'type' => 'radio',
  'label' => esc_html__('Show Category', 'eightphoto'),
  'section' => 'eightphoto_gallery_section',
  'setting' => 'eightphoto_gallery_meta_category_section',
  'choices' => array(
   'yes' => esc_html__('Yes', 'eightphoto'),
   'no' => esc_html__('No', 'eightphoto'),
   )
  ));

 $wp_customize->add_setting('eightphoto_gallelry_desc_section', array(
  'default' => '50',
  'sanitize_callback' => 'eightphoto_sanitize_number',
  ));

 $wp_customize->add_control('eightphoto_gallelry_desc_section', array(
  'type' => 'number',
  'label' => esc_html__('Description Word Limit', 'eightphoto'),
  'section' => 'eightphoto_gallery_section',
  'setting' => 'eightphoto_gallelry_desc_section',
  )); 
 
    //Archive page
 $wp_customize->add_panel('eightphoto_archive_page_setting',
  array(
    'priority'  => 70,
    'title'     =>  esc_html__('Archive Page Setting','eightphoto'),
    )
  );  
        // Team Settings section

 $wp_customize->add_section('eightphoto_team_archive_section', array(
  'priority' => 20,
  'title' => esc_html__('Team Settings', 'eightphoto'),
  'panel' =>  'eightphoto_archive_page_setting'
  ));
 $wp_customize->add_setting( 'eightphoto_team_archive_section_select', array(
      'default' => "0",
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'eightphoto_category',
  ) );

  $wp_customize->add_control( 'eightphoto_team_archive_section_select', array(
      'settings' => 'eightphoto_team_archive_section_select',
      'label'   => esc_html__('Select category for team page','eightphoto'),
      'section'  => 'eightphoto_team_archive_section',
      'type'    => 'select',
      'choices' => $cats,
  ));
 
 $wp_customize->add_setting( 'eightphoto_team_archive_section_layout', array(
  'default' => "grid",
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_sanitize_grid_list',
  ));
 
 $wp_customize->add_control( 'eightphoto_team_archive_section_layout', array(
  'settings' => 'eightphoto_team_archive_section_layout',
  'label'   => esc_html__('Choose Layout for Team page','eightphoto'),
  'section'  => 'eightphoto_team_archive_section',
  'type'    => 'radio',
  'choices' => array(
    'grid'    =>  esc_html__('Grid View','eightphoto'),
    'list'    =>  esc_html__('List View','eightphoto')
    ),
  ));

        // Testimonial Settings section

 $wp_customize->add_section('eightphoto_testimonial_archive_section', array(
  'priority' => 30,
  'title' => esc_html__('Testimonial Settings', 'eightphoto'),
  'panel' =>  'eightphoto_archive_page_setting'
  ));
 $wp_customize->add_setting( 'eightphoto_testimonial_archive_section_select', array(
    'default' => "0",
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'eightphoto_category',
) );

$wp_customize->add_control( 'eightphoto_testimonial_archive_section_select', array(
    'settings' => 'eightphoto_testimonial_archive_section_select',
    'label'   => esc_html__('Select category for testimonial page','eightphoto'),
    'section'  => 'eightphoto_testimonial_archive_section',
    'type'    => 'select',
    'choices' => $cats,
)); 

 
 $wp_customize->add_setting( 'eightphoto_testimonial_archive_section_layout', array(
  'default' => "grid",
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_sanitize_grid_list',
  ));
 
 $wp_customize->add_control( 'eightphoto_testimonial_archive_section_layout', array(
  'settings' => 'eightphoto_testimonial_archive_section_layout',
  'label'   => esc_html__('Choose Layout for Testimonial page','eightphoto'),
  'section'  => 'eightphoto_testimonial_archive_section',
  'type'    => 'radio',
  'choices' => array(
    'grid'    =>  esc_html__('Grid View','eightphoto'),
    'list'    =>  esc_html__('List View','eightphoto')
    ),
  ));


        // Archive Page Settings section
 $wp_customize->add_section('eightphoto_archive_archive_section', array(
  'priority' => 30,
  'title' => esc_html__('Archive Page Settings', 'eightphoto'),
  'panel' =>  'eightphoto_archive_page_setting'
  ));
 $wp_customize->add_setting( 'eightphoto_archive_archive_section_layout', array(
  'default' => "grid",
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_sanitize_grid_list',
  ));

 
 $wp_customize->add_control( 'eightphoto_archive_archive_section_layout', array(
  'settings' => 'eightphoto_archive_archive_section_layout',
  'label'   => esc_html__('Choose Layout for Archive page','eightphoto'),
  'description'=>__('This setting is for other archive pages.','eightphoto'),
  'section'  => 'eightphoto_archive_archive_section',
  'type'    => 'radio',
  'choices' => array(
    'grid'    =>  esc_html__('Grid View','eightphoto'),
    'list'    =>  esc_html__('List View','eightphoto')
    ),
  ));

 $wp_customize->add_setting(
  'eightphoto_archive_page_layout',
  array(
    'default' =>  'rightsidebar',
    'sanitize_callback' =>  'eightphoto_radio_sanitize_sidebar'
    )
  );  

 $wp_customize->add_control(
  'eightphoto_archive_page_layout',
  array(
    'description' => esc_html__('Choose the Page Layout for all Archive pages.(Note: This sidebar setting is for Blog, Team ,Testimonial and other archive pages.)','eightphoto'),
    'section' => 'eightphoto_archive_archive_section',
    'type'    =>  'radio',
    'choices' =>  array(
      'leftsidebar' =>  esc_html__('Left Sidebar','eightphoto'),
      'rightsidebar' =>  esc_html__('Right Sidebar','eightphoto'),
      'nosidebar' =>  esc_html__('No Sidebar','eightphoto'),
      )
    )
  );
 
        // Blogs Settings section

 $wp_customize->add_section('eightphoto_blog_archive_section', array(
  'priority' => 10,
  'title' => esc_html__('Blogs Page Layout Settings', 'eightphoto'),
  'panel' =>  'eightphoto_archive_page_setting'
  ));

 
 $wp_customize->add_setting( 'eightphoto_blog_page_archive_section', array(
  'default' => 'largeimagelistview',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_radio_sanitize_archive_layout',
  ));
 
 $wp_customize->add_control('eightphoto_blog_page_archive_section', array(
  'type' => 'radio',
  'label' => esc_html__('Choose the Blogs Page Layout', 'eightphoto'),
  'section' => 'eightphoto_blog_archive_section',
  'setting' => 'eightphoto_blog_page_archive_section',
  'choices' => array(            
   'alternateimagelistview' => esc_html__('Alternate Image List View', 'eightphoto'),
   'largeimagelistview' => esc_html__('Large Image List View', 'eightphoto')
   )
  ));
 
 $wp_customize->add_setting('eightphoto_blog_author_archive_section', array(
  'default' => 'yes',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_radio_sanitize_yesno',
  ));

 $wp_customize->add_control('eightphoto_blog_author_archive_section', array(
  'type' => 'radio',
  'label' => esc_html__('Show Author', 'eightphoto'),
  'section' => 'eightphoto_blog_archive_section',
  'setting' => 'eightphoto_blog_author_archive_section',
  'choices' => array(
   'yes' => esc_html__('Yes', 'eightphoto'),
   'no' => esc_html__('No', 'eightphoto'),
   )
  ));

 $wp_customize->add_setting('eightphoto_blog_postdate_archive_section', array(
  'default' => 'yes',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_radio_sanitize_yesno',
  ));

 $wp_customize->add_control('eightphoto_blog_postdate_archive_section', array(
  'type' => 'radio',
  'label' => esc_html__('Show Date Posted', 'eightphoto'),
  'section' => 'eightphoto_blog_archive_section',
  'setting' => 'eightphoto_blog_postdate_archive_section',
  'choices' => array(
   'yes' => esc_html__('Yes', 'eightphoto'),
   'no' => esc_html__('No', 'eightphoto'),
   )
  ));

 $wp_customize->add_setting('eightphoto_blog_metacategory_archive_section', array(
  'default' => 'yes',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_radio_sanitize_yesno',
  ));

 $wp_customize->add_control('eightphoto_blog_metacategory_archive_section', array(
  'type' => 'radio',
  'label' => esc_html__('Show Meta Category', 'eightphoto'),
  'section' => 'eightphoto_blog_archive_section',
  'setting' => 'eightphoto_blog_metacategory_archive_section',
  'choices' => array(
   'yes' => esc_html__('Yes', 'eightphoto'),
   'no' => esc_html__('No', 'eightphoto'),
   )
  ));
 

 $wp_customize->add_setting('eightphoto_blog_description_archive_section', array(
  'default' => '50',
  'sanitize_callback' => 'eightphoto_sanitize_number',
  ));

 $wp_customize->add_control('eightphoto_blog_description_archive_section', array(
  'type' => 'number',
  'label' => esc_html__('Blog Description Excerpt Limit', 'eightphoto'),
  'section' => 'eightphoto_blog_archive_section',
  'setting' => 'eightphoto_blog_description_archive_section',
  ));

    //Social Settings panel
 $wp_customize->add_panel('eightphoto_social_setting', array(
  'capabitity' => 'edit_theme_options',
  'priority' => 80,
  'title' => esc_html__('Social Settings', 'eightphoto')
  ));
 
        //social Settings section
 $wp_customize->add_section('eightphoto_social_setting', array(
   'priority' => 10,
   'title' => esc_html__('Social Section', 'eightphoto'),
   'panel' => 'eightphoto_social_setting',
   ));
 
            //socail setting in header
 $wp_customize->add_setting('eightphoto_social_setting_option_header', array(
   'default' => 'disable',
   'capability' => 'edit_theme_options',
   'sanitize_callback' => 'eightphoto_radio_sanitize_enabledisable',
   ));

 $wp_customize->add_control('eightphoto_social_setting_option_header', array(
   'type' => 'radio',
   'label' => esc_html__('Enable Disable Social Icons in Header', 'eightphoto'),
   'section' => 'eightphoto_social_setting',
   'setting' => 'eightphoto_social_setting_option_header',
   'choices' => array(
    'enable' => esc_html__('Enable', 'eightphoto'),
    'disable' => esc_html__('Disable', 'eightphoto'),
    )
   ));
 
 $wp_customize->add_setting('eightphoto_social_setting_option_footer', array(
  'default' => 'disable',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'eightphoto_radio_sanitize_enabledisable',
  ));

 $wp_customize->add_control('eightphoto_social_setting_option_footer', array(
  'type' => 'radio',
  'label' => esc_html__('Enable Disable Social Icons in Footer', 'eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_setting_option_footer',
  'choices' => array(
   'enable' => esc_html__('Enable', 'eightphoto'),
   'disable' => esc_html__('Disable', 'eightphoto'),
   )
  ));
            //social facebook link
 $wp_customize->add_setting('eightphoto_social_facebook', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_facebook',array(
  'type' => 'text',
  'label' => esc_html__('Facebook','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_facebook'
  )
 );
 
            //social twitter link
 $wp_customize->add_setting('eightphoto_social_twitter', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_twitter',array(
  'type' => 'text',
  'label' => esc_html__('Twitter','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_twitter'
  )
 );
 
            //social googleplus link
 $wp_customize->add_setting('eightphoto_social_googleplus', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_googleplus',array(
  'type' => 'text',
  'label' => esc_html__('Google Plus','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_googleplus'
  )
 );
 
             //social youtube link
 $wp_customize->add_setting('eightphoto_social_youtube', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_youtube',array(
  'type' => 'text',
  'label' => esc_html__('YouTube','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_youtube'
  )
 );
 
             //social pinterest link
 $wp_customize->add_setting('eightphoto_social_pinterest', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_pinterest',array(
  'type' => 'text',
  'label' => esc_html__('Pinterest','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_pinterest'
  )
 );
 
            //social linkedin link
 $wp_customize->add_setting('eightphoto_social_linkedin', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_linkedin',array(
  'type' => 'text',
  'label' => esc_html__('Linkedin','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_linkedin'
  )
 );
 
            //social flicker link
 $wp_customize->add_setting('eightphoto_social_flicker', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_flicker',array(
  'type' => 'text',
  'label' => esc_html__('Flicker','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_flicker'
  ) 
 );
 
 
            //social vimeo link
 $wp_customize->add_setting('eightphoto_social_vimeo', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_vimeo',array(
  'type' => 'text',
  'label' => esc_html__('Vimeo','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_vimeo'
  )
 );
 
            //social stumbleupon link
 $wp_customize->add_setting('eightphoto_social_stumbleupon', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_flicker',array(
  'type' => 'text',
  'label' => esc_html__('Stumbleupon','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_stumbleupon'
  )
 );
 
            //social instagram link
 $wp_customize->add_setting('eightphoto_social_instagram', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_instagram',array(
  'type' => 'text',
  'label' => esc_html__('Instagram','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_instagram'
  )
 );
 
            //social soundcloud link
 $wp_customize->add_setting('eightphoto_social_soundcloud', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_soundcloud',array(
  'type' => 'text',
  'label' => esc_html__('Sound Cloud','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_soundcloud'
  )
 );
 
            //social github link
 $wp_customize->add_setting('eightphoto_social_github', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_github',array(
  'type' => 'text',
  'label' => esc_html__('Git Hub','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_github'
  )
 );
 
            //social tumbler link
 $wp_customize->add_setting('eightphoto_social_tumbler', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_tumbler',array(
  'type' => 'text',
  'label' => esc_html__('Tumbler','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_tumbler'
  )
 );
 
            //social skype link
 $wp_customize->add_setting('eightphoto_social_skype', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_skype',array(
  'type' => 'text',
  'label' => esc_html__('Skype','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_skype'
  )
 );
 
            //social Rss link
 $wp_customize->add_setting('eightphoto_social_rss', array(
  'default' => '',
  'sanitize_callback' => 'eightphoto_sanitize_text',
  )
 );
 
 $wp_customize->add_control('eightphoto_social_rss',array(
  'type' => 'text',
  'label' => esc_html__('RSS','eightphoto'),
  'section' => 'eightphoto_social_setting',
  'setting' => 'eightphoto_social_rss'
  )
 );

// Text
 function eightphoto_sanitize_text( $input ) {
  return wp_kses_post( force_balance_tags( $input ) );
}

// Number
function eightphoto_sanitize_number( $input ) {
  $output = intval($input);
  return $output;
} 

// Category   

function eightphoto_category( $input, $setting ) {
  global $wp_customize;
  
  $control = $wp_customize->get_control( $setting->id );
  
  if ( array_key_exists( $input, $control->choices ) ) {
    return $input;
  } else {
    return $setting->default;
  }
}

// Page Layout
function eightphoto_radio_sanitize_webpagelayout($input) {
  $valid_keys = array(
   'fullwidth' => esc_html__('Full Width', 'eightphoto'),
   'boxed' => esc_html__('Boxed', 'eightphoto')
   );
  if ( array_key_exists( $input, $valid_keys ) ) {
   return $input;
 } else {
   return '';
 }
}
function eightphoto_sanitize_grid_list($input) {
  $valid_keys = array(
   'grid' => esc_html__('Grid View', 'eightphoto'),
   'list' => esc_html__('list View', 'eightphoto')
   );
  if ( array_key_exists( $input, $valid_keys ) ) {
   return $input;
 } else {
   return '';
 }
} 

function eightphoto_radio_sanitize_archive_layout($input) {
  $valid_keys = array(
   'alternateimagelistview' => esc_html__('Alternate Image List View', 'eightphoto'),
   'largeimagelistview' => esc_html__('Large Image List View', 'eightphoto')
   );
  if ( array_key_exists( $input, $valid_keys ) ) {
   return $input;
 } else {
   return '';
 }
}

function eightphoto_radio_sanitize_sidebar($input) {
  $valid_keys = array(
    'leftsidebar' =>  esc_html__('Left Sidebar','eightphoto'),
    'rightsidebar' =>  esc_html__('Right Sidebar','eightphoto'),
    'nosidebar' =>  esc_html__('No Sidebar','eightphoto'),
    );
  if ( array_key_exists( $input, $valid_keys ) ) {
   return $input;
 } else {
   return '';
 }
}


function eightphoto_radio_sanitize_gallery_layout($input) {
  $valid_keys = array(
   'gridview' => esc_html__('Grid View', 'eightphoto'),
   'sortable' => esc_html__('Sortable Thumb View', 'eightphoto'),         
   'mediumthumbslistview' => esc_html__('Thumbs List View', 'eightphoto'),
   'largethumbslistview' => esc_html__('Large Thumbs List View', 'eightphoto')
   );
  if ( array_key_exists( $input, $valid_keys ) ) {
   return $input;
 } else {
   return '';
 }
}


function eightphoto_radio_sanitize_enabledisable($input) {
  $valid_keys = array(
    'enable'=> esc_html__('Enable', 'eightphoto'),
    'disable'=> esc_html__('Disable', 'eightphoto')
    );
  if ( array_key_exists( $input, $valid_keys ) ) {
   return $input;
 } else {
   return '';
 }
}

function eightphoto_radio_sanitize_yesno($input) {
  $valid_keys = array(
    'yes'=> esc_html__('Yes', 'eightphoto'),
    'no'=> esc_html__('No', 'eightphoto')
    );
  if ( array_key_exists( $input, $valid_keys ) ) {
   return $input;
 } else {
   return '';
 }
}

}
add_action('customize_register','eightphoto_basic_setting');

function eightphoto_radio_sanitize_transitiontype($input) {
      $valid_keys = array(
         'fade' => esc_html__('Fade', 'eightphoto'),
          'horizontal' => esc_html__('Slide Horizontal', 'eightphoto'),
          'vertical' => esc_html__('Slide Vertical', 'eightphoto'),
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
    }
?>
