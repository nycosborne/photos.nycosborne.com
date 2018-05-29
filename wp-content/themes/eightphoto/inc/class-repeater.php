<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) return NULL;

class Eightphoto_General_Repeater extends WP_Customize_Control {
    private $options = array();

    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
        $this->options = $args;
    }

    public function render_content() {

        $this_default = json_decode($this->setting->default);
        $values = $this->value();
        $json = json_decode($values);
        if(!is_array($json)) $json = array($values);
        $it = 0;
        $options = $this->options;
        if(!empty($options['image_control'])){
            $image_control = $options['image_control'];
        } else {
            $image_control = false;
        }
        if(!empty($options['icon_control'])){
            $icon_control = $options['icon_control'];
            $icons_array = array( 'No Icon','icon-social-blogger','icon-social-blogger-circle','icon-social-blogger-square');
        } else {
         $icon_control = false;
     }
     if(!empty($options['title_control'])){
        $title_control = $options['title_control'];
    } else {
        $title_control = false;
    }                           
    if(!empty($options['text_control'])){
        $text_control = $options['text_control'];
    } else {
        $text_control = false;
    }
    if(!empty($options['link_control'])){
        $link_control = $options['link_control'];
    } else {
        $link_control = false;
    }
    if(!empty($options['subtitle_control'])){
        $subtitle_control = $options['subtitle_control'];
    } else {
        $subtitle_control = false;
    } 
    ?>

    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <div class="eightphoto_general_control_repeater eightphoto_general_control_droppable">
        <?php if(empty($json)) { ?>
        <div class="eightphoto_general_control_repeater_container">
            <div class="parallax-customize-control-title"><?php esc_html_e('eightphoto','eightphoto')?></div>
            <div class="parallax-box-content-hidden">
                <?php
                if($image_control == true && $icon_control == true){ ?>
                <span class="customize-control-title"><?php esc_html_e('Image type','eightphoto');?></span>
                <select class="eightphoto_image_choice">
                    <option value="eightphoto_icon" selected><?php esc_html_e('Icon','eightphoto'); ?></option>
                    <option value="eightphoto_image"><?php esc_html_e('Image','eightphoto'); ?></option>
                    <option value="eightphoto_none"><?php esc_html_e('None','eightphoto'); ?></option>
                </select>

                <p class="eightphoto_image_control" style="display:none">
                    <span class="customize-control-title"><?php esc_html_e('Image','eightphoto')?></span>
                    <input type="text" class="widefat custom_media_url">
                    <input type="button" class="button button-primary custom_media_button_eightphoto" value="<?php esc_html_e('Upload Image','eightphoto'); ?>" />
                </p>

                <div class="eightphoto_general_control_icon">
                    <span class="customize-control-title"><?php esc_html_e('Icon','eightphoto');?></span>
                    <select class="eightphoto_icon_control">
                        <?php
                        foreach($icons_array as $contact_icon) {
                            echo '<option value="'.esc_attr($contact_icon).'">'.esc_attr($contact_icon).'</option>';
                        }
                        ?>
                    </select>
                </div>
                <?php
            } else {
                if($image_control ==true){	?>
                <span class="customize-control-title"><?php esc_html_e('Image','eightphoto')?></span>
                <p class="eightphoto_image_control">
                    <input type="text" class="widefat custom_media_url">
                    <input type="button" class="button button-primary custom_media_button_eightphoto" value="<?php esc_html_e('Upload Image','eightphoto'); ?>" />
                </p>
                <?php
            }

            if($icon_control ==true){
                ?>
                <span class="customize-control-title"><?php esc_html_e('Icon','eightphoto')?></span>
                <select name="<?php echo esc_attr($this->id); ?>" class="eightphoto_icon_control">
                    <?php
                    foreach($icons_array as $contact_icon) {
                        echo '<option value="'.esc_attr($contact_icon).'">'.esc_attr($contact_icon).'</option>';
                    }
                    ?>
                </select>
                <?php   }
            }

            if($title_control==true){
                ?>
                <span class="customize-control-title"><?php esc_html_e('Title','eightphoto')?></span>
                <input type="text" class="eightphoto_title_control" placeholder="<?php esc_html_e('Title','eightphoto'); ?>"/>
                <?php
            }

            if($text_control==true){?>
            <span class="customize-control-title"><?php esc_html_e('Text','eightphoto')?></span>
            <textarea class="eightphoto_text_control" placeholder="<?php esc_html_e('Text','eightphoto'); ?>"></textarea>
            <?php }

            if($link_control==true){ ?>
            <span class="customize-control-title"><?php esc_html_e('Link','eightphoto')?></span>
            <input type="text" class="eightphoto_link_control" placeholder="<?php esc_html_e('Link','eightphoto'); ?>"/>
            <?php }

            if($subtitle_control==true){
                ?>
                <span class="customize-control-title"><?php esc_html_e('Button Text','eightphoto')?></span>
                <input type="text" class="eightphoto_subtitle_control" placeholder="<?php esc_html_e('Button Text','eightphoto'); ?>"/>
                <?php
            }
            ?>
            <input type="hidden" class="eightphoto_box_id">
            <button type="button" class="eightphoto_general_control_remove_field button" style="display:none;"><?php esc_html_e('Delete field','eightphoto'); ?></button>
        </div>
    </div>
    <?php } else {
        if ( !empty($this_default) && empty($json)) {
            foreach($this_default as $icon){
    ?>
        <div class="eightphoto_general_control_repeater_container eightphoto_draggable">
            <div class="parallax-customize-control-title"><?php esc_html_e('eightphoto','eightphoto')?></div>
            <div class="parallax-box-content-hidden">
                <?php  if($image_control == true && $icon_control == true){ ?>
                    <span class="customize-control-title"><?php esc_html_e('Image type','eightphoto');?></span>
                    <select class="eightphoto_image_choice">
                        <option value="eightphoto_icon" <?php selected($icon->choice,'eightphoto');?>><?php esc_html_e('Icon','eightphoto');?></option>
                        <option value="eightphoto_image" <?php selected($icon->choice,'eightphoto');?>><?php esc_html_e('Image','eightphoto');?></option>
                        <option value="eightphoto_none" <?php selected($icon->choice,'eightphoto');?>><?php esc_html_e('None','eightphoto');?></option>
                    </select>

                    <p class="eightphoto_image_control"  <?php if(!empty($icon->choice) && $icon->choice!='eightphoto_image'){ echo 'style="display:none"';}?>>
                        <span class="customize-control-title"><?php esc_html_e('Image','eightphoto');?></span>
                        <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                        <input type="button" class="button button-primary custom_media_button_eightphoto" value="<?php esc_html_e('Upload Image','eightphoto'); ?>" />
                    </p>

                    <div class="eightphoto_general_control_icon" <?php  if(!empty($icon->choice) && $icon->choice!='eightphoto_icon'){ echo 'style="display:none"';}?>>
                        <span class="customize-control-title"><?php esc_html_e('Icon','eightphoto');?></span>
                        <select name="<?php echo esc_attr($this->id); ?>" class="eightphoto_icon_control">
                            <?php
                                foreach($icons_array as $contact_icon) {
                                    echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                }
                            ?>
                        </select>
                    </div>
                <?php  } else { ?>
                <?php	if($image_control==true){ ?>
                    <span class="customize-control-title"><?php esc_html_e('Image','eightphoto')?></span>
                    <p class="eightphoto_image_control">
                        <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                        <input type="button" class="button button-primary custom_media_button_eightphoto" value="<?php esc_html_e('Upload Image','eightphoto'); ?>" />
                    </p>
                <?php	}  if($icon_control==true){ ?>
                    <span class="customize-control-title"><?php esc_html_e('Icon','eightphoto')?></span>
                    <select name="<?php echo esc_attr($this->id); ?>" class="eightphoto_icon_control">
                        <?php
                            foreach($icons_array as $contact_icon) {
                                echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                            }
                        ?>
                    </select>
                <?php  } }
                    if($title_control==true){
                        ?>
                        <span class="customize-control-title"><?php esc_html_e('Title','eightphoto')?></span>
                        <input type="text" value="<?php if(!empty($icon->title)) echo esc_attr($icon->title); ?>" class="eightphoto_title_control" placeholder="<?php esc_html_e('Title','eightphoto'); ?>"/>
                        <?php
                    }

                    if($text_control==true){ ?>
                        <span class="customize-control-title"><?php esc_html_e('Text','eightphoto')?></span>
                        <textarea placeholder="<?php esc_html_e('Text','eightphoto'); ?>" class="eightphoto_text_control"><?php if(!empty($icon->text)) {echo esc_attr($icon->text);} ?></textarea>
                    <?php	}
                    if($link_control){ ?>
                        <span class="customize-control-title"><?php esc_html_e('Link','eightphoto')?></span>
                        <input type="text" value="<?php if(!empty($icon->link)) echo esc_url($icon->link); ?>" class="eightphoto_link_control" placeholder="<?php esc_html_e('Link','eightphoto'); ?>"/>
                    <?php	}  if($subtitle_control==true){ ?>
                        <span class="customize-control-title"><?php esc_html_e('Button Text','eightphoto')?></span>
                        <input type="text" value="<?php if(!empty($icon->subtitle)) echo esc_attr($icon->subtitle); ?>" class="eightphoto_subtitle_control" placeholder="<?php esc_html_e('Button Text','eightphoto'); ?>"/>
                        <?php  } ?>
                        <input type="hidden" class="eightphoto_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
                        <button type="button" class="eightphoto_general_control_remove_field button" <?php if ($it == 0) echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','eightphoto'); ?></button>
            </div>
        </div>

    <?php
        $it++; }  } else {
        foreach($json as $icon){
    ?>
    <div class="eightphoto_general_control_repeater_container eightphoto_draggable">
        <div class="parallax-customize-control-title"><?php esc_html_e('Advance Slider','eightphoto')?></div>
        <div class="parallax-box-content-hidden">
                <?php if($image_control == true && $icon_control == true){ ?>
                    <span class="customize-control-title"><?php esc_html_e('Image type','eightphoto');?></span>
                    <select class="eightphoto_image_choice">
                        <option value="eightphoto_icon" <?php selected($icon->choice,'eightphoto_icon');?>><?php esc_html_e('Icon','eightphoto');?></option>
                        <option value="eightphoto_image" <?php selected($icon->choice,'eightphoto_image');?>><?php esc_html_e('Image','eightphoto');?></option>
                        <option value="eightphoto_none" <?php selected($icon->choice,'eightphoto_none');?>><?php esc_html_e('None','eightphoto');?></option>
                    </select>

                    <p class="eightphoto_image_control" <?php if(!empty($icon->choice) && $icon->choice!='eightphoto_image'){ echo 'style="display:none"';}?>>
                        <span class="customize-control-title"><?php esc_html_e('Image','eightphoto');?></span>
                        <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                        <input type="button" class="button button-primary custom_media_button_eightphoto" value="<?php esc_html_e('Upload Image','eightphoto'); ?>" />
                    </p>

                    <div class="eightphoto_general_control_icon" <?php  if(!empty($icon->choice) && $icon->choice!='eightphoto_icon'){ echo 'style="display:none"';}?>>
                        <span class="customize-control-title"><?php esc_html_e('Icon','eightphoto');?></span>
                        <select name="<?php echo esc_attr($this->id); ?>" class="eightphoto_icon_control">
                            <?php
                                foreach($icons_array as $contact_icon) {
                                    echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                }
                            ?>
                        </select>
                    </div>
                <?php } else { ?>
                    <?php if($image_control == true){ ?>
                    <span class="customize-control-title"><?php esc_html_e('Image','eightphoto')?></span>
                    <p class="eightphoto_image_control">
                        <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                        <input type="button" class="button button-primary custom_media_button_eightphoto" value="<?php esc_html_e('Upload Image','eightphoto'); ?>" />
                    </p>
                <?php } if($icon_control==true){ ?>
                    <span class="customize-control-title"><?php esc_html_e('Icon','eightphoto')?></span>
                    <select name="<?php echo esc_attr($this->id); ?>" class="eightphoto_icon_control">
                        <?php
                            foreach($icons_array as $contact_icon) {
                                echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                            }
                        ?>
                    </select>
                <?php } }  if($title_control==true){ ?>
                <span class="customize-control-title"><?php esc_html_e('Title','eightphoto')?></span>
                <input type="text" value="<?php if(!empty($icon->title)) echo esc_attr($icon->title); ?>" class="eightphoto_title_control" placeholder="<?php esc_html_e('Title','eightphoto'); ?>"/>
                <?php } if($text_control==true ){?>
                <span class="customize-control-title"><?php esc_html_e('Text','eightphoto')?></span>
                <textarea class="eightphoto_text_control" placeholder="<?php esc_html_e('Text','eightphoto'); ?>"><?php if(!empty($icon->text)) {echo esc_attr($icon->text);} ?></textarea>
                <?php }  if($link_control){ ?>
                <span class="customize-control-title"><?php esc_html_e('Link','eightphoto')?></span>
                <input type="text" value="<?php if(!empty($icon->link)) echo esc_url($icon->link); ?>" class="eightphoto_link_control" placeholder="<?php esc_html_e('Link','eightphoto'); ?>"/>
                <?php } if($subtitle_control==true){  ?>
                    <span class="customize-control-title"><?php esc_html_e('Button Text','eightphoto')?></span>
                    <input type="text" value="<?php if(!empty($icon->subtitle)) echo esc_attr($icon->subtitle); ?>" class="eightphoto_subtitle_control" placeholder="<?php esc_html_e('Button Text','eightphoto'); ?>"/>
                    <?php   }   ?>
                <input type="hidden" class="eightphoto_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
                <button type="button" class="eightphoto_general_control_remove_field button" <?php if ($it == 0) echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','eightphoto'); ?></button>
        </div>
    </div>
    <?php $it++; } } } if ( !empty($this_default) && empty($json)) { ?>
    <input type="hidden" id="eightphoto_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="eightphoto_repeater_colector" value="<?php  echo esc_textarea( json_encode($this_default )); ?>" />
    <?php } else {	?>
    <input type="hidden" id="eightphoto_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="eightphoto_repeater_colector" value="<?php echo esc_textarea( $this->value() ); ?>" />
    <?php } ?>
</div>
<button type="button"   class="button add_field eightphoto_general_control_new_field"><?php esc_html_e('Add new field','eightphoto'); ?></button>
<?php } }