<?php
/**
 * eightphoto functions and definitions
 *
 * @package eightphoto
 */
 
add_action('add_meta_boxes', 'eightphoto_layout_box');  
function eightphoto_layout_box()
{   
    add_meta_box(
                 'eightphoto_gallery_single_page', // $id
                 __( 'Gallery Page Layout', 'eightphoto' ), // $title
                 'eightphoto_gallery_page_callback', // $callback
                 'post', // $pagef
                 'normal', // $context
                 'high'); // $priority

    add_meta_box(
                 'eightphoto_settings', // $id
                 __( 'Post Sidebar Layout', 'eightphoto' ), // $title
                 'eightphoto_page_settings_callback', // $callback
                 'post', // $page
                 'normal', // $context
                 'high'); // $priority

    add_meta_box(
                 'eightphoto_settings', // $id
                 __( 'Page Sidebar Layout', 'eightphoto' ), // $title
                 'eightphoto_page_settings_callback', // $callback
                 'page', // $page
                 'normal', // $context
                 'high'); // $priority

    
}


// Page Layout Meta Box Functionality

$eightphoto_page_layouts = array(
       
        'leftsidebar' => array(
                        'value'     => 'leftsidebar',
                        'label'     => __( 'Left Sidebar', 'eightphoto' ),
                        'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png',
                    ), 
        'nosidebar' => array(
                        'value' => 'nosidebar',
                        'label' => __( 'No sidebar(Default)', 'eightphoto' ),
                        'thumbnail' => get_template_directory_uri() . '/images/no-sidebar.png',
                    ),
       
        'rightsidebar' => array(
                        'value'     => 'rightsidebar',
                        'label'     => __( 'Right Sidebar', 'eightphoto' ),
                        'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png',
                    ) 
    );

/*---------Function for Page layout meta box----------------------------*/
function eightphoto_page_settings_callback()
{
    global $post, $eightphoto_page_layouts ;
    wp_nonce_field( basename( __FILE__ ), 'eightphoto_settings_nonce' );
?>
    <table class="form-table">
        <tr>
        <td>
        <?php
            $i = 0;  
           foreach ($eightphoto_page_layouts as $field) {  
           $eightphoto_page_metalayouts = get_post_meta( $post->ID, 'eightphoto_page_layouts', true ); 
         ?>            
            <div class="radio-image-wrapper slidercat" id="slider-<?php echo $i; ?>" style="float:left; margin-right:30px;">
            <label class="description">
                <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" /></span></br>
            <input type="radio" name="eightphoto_page_layouts" value="<?php echo esc_attr($field['value']); ?>" <?php checked( $field['value'], 
                        $eightphoto_page_metalayouts ); 
                        if(empty($eightphoto_page_metalayouts) && 
                            $field['value']=='rightsidebar')
                        { 
                            echo "checked='checked'"; 
                        } ?>/>
                &nbsp;<?php echo $field['label']; ?>
            </label>
            </div>
            <?php 
            $i++;
                } // end foreach 
            ?>
        </td>
        </tr>            
    </table>
<?php
}
/**
 * save the custom metabox data
 * @hooked to save_page hook
 */
/*-------------------Save function for Page Setting-------------------------*/

function eightphoto_save_page_settings( $post_id ) { 
    global $eightphoto_page_layouts, $post; 
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'eightphoto_settings_nonce' ] ) || !wp_verify_nonce( $_POST[ 'eightphoto_settings_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }
    
    foreach ($eightphoto_page_layouts as $field) {  
        //Execute this saving function
        $old = get_post_meta( $post_id, 'eightphoto_page_layouts', true); 
        $new = sanitize_text_field($_POST['eightphoto_page_layouts']);
        if ($new && $new != $old) {  
            update_post_meta($post_id, 'eightphoto_page_layouts', $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id,'eightphoto_page_layouts', $old);  
        } 
     } // end foreach    
}
add_action('save_post', 'eightphoto_save_page_settings');


/**
 * Gallery Layout Metabox 
**/
$eightphoto_gallery_layouts = array(
       
        'sly' => array(
                        'value'     => 'sly',
                        'label'     => __( 'Sly Layout(Default)', 'eightphoto' ),
                        'thumbnail' => get_template_directory_uri() . '/images/sly.png',
                    ), 
        'classic' => array(
                        'value' => 'classic',
                        'label' => __( 'Classic Layout', 'eightphoto' ),
                        'thumbnail' => get_template_directory_uri() . '/images/classical.png',
                    ),
       
        'folio' => array(
                        'value'     => 'folio',
                        'label'     => __( 'Folio Layout', 'eightphoto' ),
                        'thumbnail' => get_template_directory_uri() . '/images/folio.png',
                    ) 
    );
function eightphoto_gallery_page_callback()
{
    global $post, $eightphoto_gallery_layouts ;
    wp_nonce_field( basename( __FILE__ ), 'eightphoto_settings_gallery_nonce' );
?>
    <table class="form-table">
        <tr>
        <td>
        <?php
            $i = 0;  
           foreach ($eightphoto_gallery_layouts as $field) {  
           $eightphoto_gallery_metalayouts = get_post_meta( $post->ID, 'eightphoto_gallery_layouts', true ); 
         ?>            
            <div class="radio-image-wrapper slidercat" id="slider-<?php echo $i; ?>" style="float:left; margin-right:30px;">
            <label class="description">
                <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" /></span></br>
            <input type="radio" name="eightphoto_gallery_layouts" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], 
                        $eightphoto_gallery_metalayouts ); 
                        if(empty($eightphoto_gallery_metalayouts) && 
                            $field['value']=='sly')
                        { 
                            echo "checked='checked'"; 
                        } ?>/>
                &nbsp;<?php echo $field['label']; ?>
            </label>
            </div>
            <?php 
            $i++;
                } // end foreach 
            ?>
        </td>
        </tr>            
    </table>
<?php
}

/*-------------------Save function for Gallery Setting-------------------------*/

function eightphoto_save_gallery_settings( $post_id ) { 
    global $eightphoto_gallery_layouts, $post; 
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'eightphoto_settings_gallery_nonce' ] ) || !wp_verify_nonce( $_POST[ 'eightphoto_settings_gallery_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }
    
    foreach ($eightphoto_gallery_layouts as $field) {  
        //Execute this saving function
        $old = get_post_meta( $post_id, 'eightphoto_gallery_layouts', true); 
        $new = sanitize_text_field($_POST['eightphoto_gallery_layouts']);
        if ($new && $new != $old) {  
            update_post_meta($post_id, 'eightphoto_gallery_layouts', $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id,'eightphoto_gallery_layouts', $old);  
        } 
     } // end foreach    
}
add_action('save_post', 'eightphoto_save_gallery_settings');