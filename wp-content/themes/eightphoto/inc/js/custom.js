

/********************************************
*** General Repeater ***
*********************************************/
function media_upload(button_class) {

    jQuery('body').on('click', button_class, function(e) {
        var button_id ='#'+jQuery(this).attr('id');
        var display_field = jQuery(this).parent().children('input:text');
        var _custom_media = true;

        wp.media.editor.send.attachment = function(props, attachment){

            if ( _custom_media  ) {
                if(typeof display_field != 'undefined'){
                    switch(props.size){
                        case 'full':
                        display_field.val(attachment.sizes.full.url);
                        display_field.trigger('change');
                        break;                       
                        default:
                        display_field.val(attachment.url);
                        display_field.trigger('change');
                    }
                }
                _custom_media = false;
            } else {
                return wp.media.editor.send.attachment( button_id, [props, attachment] );
            }
        }
        wp.media.editor.open(button_class);
        window.send_to_editor = function(html) {

        }
        return false;
    });
}

function eightphoto_uniqid(prefix, more_entropy) {

  if (typeof prefix === 'undefined') {
    prefix = '';
}

var retId;
var formatSeed = function(seed, reqWidth) {
    seed = parseInt(seed, 10)
      .toString(16); // to hex str
    if (reqWidth < seed.length) { // so long we split
      return seed.slice(seed.length - reqWidth);
  }
    if (reqWidth > seed.length) { // so short we pad
      return Array(1 + (reqWidth - seed.length))
      .join('0') + seed;
  }
  return seed;
};

  // BEGIN REDUNDANT
  if (!this.php_js) {
    this.php_js = {};
}
  // END REDUNDANT
  if (!this.php_js.uniqidSeed) { // init seed with big random int
    this.php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
}
this.php_js.uniqidSeed++;

  retId = prefix; // start with prefix, add current milliseconds hex string
  retId += formatSeed(parseInt(new Date()
    .getTime() / 1000, 10), 8);
  retId += formatSeed(this.php_js.uniqidSeed, 5); // add seed hex string
  if (more_entropy) {
    // for more entropy we add a float lower to 10
    retId += (Math.random() * 10)
    .toFixed(8)
    .toString();
}

return retId;
}

function eightphoto_refresh_general_control_values(){
    jQuery(".eightphoto_general_control_repeater").each(function(){
        var values = [];
        var th = jQuery(this);
        th.find(".eightphoto_general_control_repeater_container").each(function(){
            var icon_value = jQuery(this).find('.eightphoto_icon_control').val();
            var text = jQuery(this).find(".eightphoto_text_control").val();
            var link = jQuery(this).find(".eightphoto_link_control").val();
            var image_url = jQuery(this).find(".custom_media_url").val();
            var choice = jQuery(this).find(".eightphoto_image_choice").val();
            var title = jQuery(this).find(".eightphoto_title_control").val();
            var subtitle = jQuery(this).find(".eightphoto_subtitle_control").val();
            var id = jQuery(this).find(".eightphoto_box_id").val();
            if( text !='' || image_url!='' || title!='' || subtitle!='' ){
                values.push({
                    "icon_value" : (choice === 'eightphoto_none' ? "" : icon_value) ,
                    "text" : text,
                    "link" : link,
                    "image_url" : (choice === 'eightphoto_none' ? "" : image_url),
                    "choice" : choice,
                    "title" : title,
                    "subtitle" : subtitle,
                    "id" : id
                });
            }

        });

        th.find('.eightphoto_repeater_colector').val(JSON.stringify(values));
        th.find('.eightphoto_repeater_colector').trigger('change');
    });
}

jQuery(document).ready(function($){
    jQuery('#customize-theme-controls').on('click','.parallax-customize-control-title',function(){
        jQuery(this).next().show();
        jQuery(this).addClass('shown');
    });
    
    jQuery('#customize-theme-controls').on('click','.parallax-customize-control-title.shown',function(){
        jQuery(this).next().hide();
        jQuery(this).removeClass('shown');
    });

    jQuery('#customize-theme-controls').on('change','.eightphoto_image_choice',function() {
        if(jQuery(this).val() == 'eightphoto_image'){
            jQuery(this).parent().parent().find('.eightphoto_general_control_icon').hide();
            jQuery(this).parent().parent().find('.eightphoto_image_control').show();
        }
        if(jQuery(this).val() == 'eightphoto_icon'){
            jQuery(this).parent().parent().find('.eightphoto_general_control_icon').show();
            jQuery(this).parent().parent().find('.eightphoto_image_control').hide();
        }
        if(jQuery(this).val() == 'eightphoto_none'){
            jQuery(this).parent().parent().find('.eightphoto_general_control_icon').hide();
            jQuery(this).parent().parent().find('.eightphoto_image_control').hide();
        }
        
        eightphoto_refresh_general_control_values();
        return false;        
    });
    media_upload('.custom_media_button_eightphoto');
    jQuery(".custom_media_url").live('change',function(){
        eightphoto_refresh_general_control_values();
        return false;
    });
    

    jQuery("#customize-theme-controls").on('change', '.eightphoto_icon_control',function(){
        eightphoto_refresh_general_control_values();
        return false; 
    });

    jQuery(".eightphoto_general_control_new_field").on("click",function(){

        var th = jQuery(this).parent();
        var id = 'eightphoto_'+eightphoto_uniqid();
        if(typeof th != 'undefined') {

            var field = th.find(".eightphoto_general_control_repeater_container:first").clone();
            if(typeof field != 'undefined'){
                field.find(".eightphoto_image_choice").val('eightphoto_icon');
                field.find('.eightphoto_general_control_icon').show();
                if(field.find('.eightphoto_general_control_icon').length > 0){
                    field.find('.eightphoto_image_control').hide();
                }
                field.find(".eightphoto_general_control_remove_field").show();
                field.find(".eightphoto_icon_control").val('');
                field.find(".eightphoto_text_control").val('');
                field.find(".eightphoto_link_control").val('');
                field.find(".eightphoto_box_id").val(id);
                field.find(".custom_media_url").val('');
                field.find(".eightphoto_title_control").val('');
                field.find(".eightphoto_subtitle_control").val('');
                th.find(".eightphoto_general_control_repeater_container:first").parent().append(field);
                eightphoto_refresh_general_control_values();
            }
            
        }
        return false;
    });

    jQuery("#customize-theme-controls").on("click", ".eightphoto_general_control_remove_field",function(){
        if( typeof  jQuery(this).parent() != 'undefined'){
            jQuery(this).parent().parent().remove();
            eightphoto_refresh_general_control_values();
        }
        return false;
    });


    jQuery("#customize-theme-controls").on('keyup', '.eightphoto_title_control',function(){
     eightphoto_refresh_general_control_values();
 });

    jQuery("#customize-theme-controls").on('keyup', '.eightphoto_subtitle_control',function(){
     eightphoto_refresh_general_control_values();
 });
    
    jQuery("#customize-theme-controls").on('keyup', '.eightphoto_text_control',function(){
     eightphoto_refresh_general_control_values();
 });
    
    jQuery("#customize-theme-controls").on('keyup', '.eightphoto_link_control',function(){
        eightphoto_refresh_general_control_values();
    });
    
    /*Drag and drop to change icons order*/
    if(jQuery(".eightphoto_general_control_droppable").length>0){
        jQuery(".eightphoto_general_control_droppable").sortable({
            update: function( event, ui ) {
                eightphoto_refresh_general_control_values();
            }
        }); 
    }


    /** Ajax Plugin Installation **/
    $(".install").on('click', function (e) {
        e.preventDefault();
        var el = $(this);

        is_loading = true;
        el.addClass('installing');
        var plugin = $(el).attr('data-slug');
        var plugin_file = $(el).attr('data-file');
        var ajaxurl = eightphotoWelcomeObject.ajaxurl;
        var plhref = $(el).attr('href');
        var newPlhref = plhref.split('&');
        var plNonce = newPlhref[newPlhref.length-1];
        var newPlhref = plNonce.split('=');
        var plNonce = newPlhref[newPlhref.length-1];
        if(plNonce==''){
            var plNonce = eightphotoWelcomeObject.admin_nonce;
        }

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'eightphoto_plugin_installer',
                plugin: plugin,
                plugin_file: plugin_file,
                nonce: plNonce,
            },
            success: function(response) {

                if(response == 'success'){

                    el.attr('class', 'installed button');
                    el.html(eightphotoWelcomeObject.installed_btn);
                    
                }

                el.removeClass('installing');
                is_loading = false;
                //location.reload();
            },
            error: function(xhr, status, error) {
                console.log(status);
                el.removeClass('installing');
                is_loading = false;
            }
        });
    });

    /** Ajax Plugin Installation (Offlines) **/
    $('.install-offline').on('click', function (e) {
        e.preventDefault();
        var el = $(this);

        is_loading = true;
        el.addClass('installing');

        var file_location = el.attr('href');
        var github = $(el).attr('data-github');
        var slug = $(el).attr('data-slug');
        var file = el.attr('data-file');
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'eightphoto_plugin_offline_installer',
                file_location: file_location,
                file: file,
                slug: slug,
                github: github,
                dataType: 'json'
            },
            success: function(response) {

                if(response == 'success'){

                    el.attr('class', 'installed button');
                    el.html(eightphotoWelcomeObject.installed_btn);
                    
                }

                is_loading = false;
                location.reload();
            },
            error: function(xhr, status, error) {
                el.removeClass('installing');
                is_loading = false;
            }
        });
    });

    /** Ajax Plugin Activation **/
    $(".activate").on('click', function (e) {

        var el = $(this);
        var plugin = $(el).attr('data-slug');

        var ajaxurl = eightphotoWelcomeObject.ajaxurl;
        
        
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'eightphoto_plugin_activation',
                plugin: plugin,
                nonce: eightphotoWelcomeObject.activate_nonce,
                dataType: 'json'
            },
            success: function(response) {
                if(response){
                    if(response.status === 'success'){
                        el.attr('class', 'installed button');
                        el.html(eightphotoWelcomeObject.installed_btn);
                    }
                }
                is_loading = false;
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(status);
                is_loading = false;
            }
        });
    });

    /** Ajax Plugin Activation Offline **/
    $('.activate-offline').on('click', function (e) {
        e.preventDefault();
        
        var el = $(this);
        var plugin = $(el).attr('data-slug');

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'eightphoto_plugin_offline_activation',
                plugin: plugin,
                nonce: eightphotoWelcomeObject.activate_nonce,
                dataType: 'json'
            },
            success: function(response) {
                if(response){
                    el.attr('class', 'installed button');
                    el.html(eightphotoWelcomeObject.installed_btn);
                }
                is_loading = false;
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(status);
                is_loading = false;
            }
        });
    });


});

