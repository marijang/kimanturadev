<?php

/**
 * The template for displaying cookie group popup on front
 *
 * You can overwrite this template by copying it to yourtheme/ct-ultimate-gdpr folder
 *
 * @version 1.0
 *
 */

if (!defined('ABSPATH')) {
    exit;
}
// class for number of groups
$number_of_groups = 0;
$number_of_groups = (!empty($options['cookie_group_popup_hide_level_1'])) ? ++$number_of_groups : $number_of_groups;
$number_of_groups = (!empty($options['cookie_group_popup_hide_level_2'])) ? ++$number_of_groups : $number_of_groups;
$number_of_groups = (!empty($options['cookie_group_popup_hide_level_3'])) ? ++$number_of_groups : $number_of_groups;
$number_of_groups = (!empty($options['cookie_group_popup_hide_level_4'])) ? ++$number_of_groups : $number_of_groups;
$number_of_groups = (!empty($options['cookie_group_popup_hide_level_5'])) ? ++$number_of_groups : $number_of_groups;

$group_class = 'ct-ultimate-gdpr--Groups-' . (5 - $number_of_groups);
$group_class = (empty($options['cookie_group_popup_hide_level_1'])) ? $group_class : $group_class . ' ct-ultimate-gdpr--NoBlockGroup';

/** @var array $options */

$distance = isset($options['cookie_position_distance']) ? $options['cookie_position_distance'] : 0;
if (isset ($options['cookie_trigger_modal_bg_shape'])) :
    if ($options['cookie_trigger_modal_bg_shape'] == 'round'):
        $cookie_trigger_modal_bg_shape = 'ct-ultimate-gdpr-trigger-modal-round';
    elseif ($options['cookie_trigger_modal_bg_shape'] == 'rounded') :
        $cookie_trigger_modal_bg_shape = 'ct-ultimate-gdpr-trigger-modal-rounded';
    elseif ($options['cookie_trigger_modal_bg_shape'] == 'squared') :
        $cookie_trigger_modal_bg_shape = 'ct-ultimate-gdpr-trigger-modal-squared';
    endif;
else :
    $cookie_trigger_modal_bg_shape = '';
endif;

if ($options['cookie_box_style'] == 'modern') :
    $cookie_box_style = esc_attr('ct-ultimate-gdpr-cookie-style-modern');
else :
    $cookie_box_style = esc_attr('ct-ultimate-gdpr-cookie-style-classic');
endif;

/*Modal Skin*/
if ($options['cookie_modal_skin'] == 'style-one') :
    $cookie_modal_skin = esc_attr('ct-ultimate-gdpr-cookie-skin-one');
    $block_icon = ct_ultimate_gdpr_url() . '/assets/css/images/block-all.svg';
    $ess_icon = ct_ultimate_gdpr_url() . '/assets/css/images/essential.svg';
    $func_icon = ct_ultimate_gdpr_url() . '/assets/css/images/skin1-func.svg';
    $ana_icon = ct_ultimate_gdpr_url() . '/assets/css/images/skin1-ana.svg';
    $adv_icon = ct_ultimate_gdpr_url() . '/assets/css/images/skin1-adv.svg';
elseif ($options['cookie_modal_skin'] == 'style-two') :
    $cookie_modal_skin = esc_attr('ct-ultimate-gdpr-cookie-skin-two');
    $block_icon = ct_ultimate_gdpr_url() . '/assets/css/images/block-all.svg';
    $ess_icon = ct_ultimate_gdpr_url() . '/assets/css/images/skin2-ess.svg';
    $func_icon = ct_ultimate_gdpr_url() . '/assets/css/images/skin2-func.svg';
    $ana_icon = ct_ultimate_gdpr_url() . '/assets/css/images/skin2-ana.svg';
    $adv_icon = ct_ultimate_gdpr_url() . '/assets/css/images/skin2-adv.svg';
elseif ($options['cookie_modal_skin'] == 'default') :
    $cookie_modal_skin = "";
    $block_icon = ct_ultimate_gdpr_url() . '/assets/css/images/block-all.svg';
    $ess_icon = ct_ultimate_gdpr_url() . '/assets/css/images/essential.svg';
    $func_icon =  ct_ultimate_gdpr_url() . '/assets/css/images/functionality.svg';
    $ana_icon = ct_ultimate_gdpr_url() . '/assets/css/images/statistics.svg';
    $adv_icon = ct_ultimate_gdpr_url() . '/assets/css/images/targeting.svg';
endif;

$cookie_modal_type_user_choice = $options['cookie_modal_skin'];/* DATA FROM USER */
$cookie_modal_type = '';
if ( $cookie_modal_type_user_choice == 'compact-green' ) {
    $cookie_modal_type = ' ' . 'ct-ultimate-gdpr-cookie-modal-compact ct-ultimate-gdpr-cookie-modal-compact-green';
} elseif ( $cookie_modal_type_user_choice == 'compact-light-blue' ) {
    $cookie_modal_type = ' ' . 'ct-ultimate-gdpr-cookie-modal-compact ct-ultimate-gdpr-cookie-modal-compact-light-blue';
} elseif ( $cookie_modal_type_user_choice == 'compact-dark-blue' ) {
    $cookie_modal_type = ' ' . 'ct-ultimate-gdpr-cookie-modal-compact ct-ultimate-gdpr-cookie-modal-compact-dark-blue';
}
$attachment_image = wp_get_attachment_image_src($options['cookie_background_image'],'full');
if( $attachment_image ) {
    $attachment_url = esc_url( $attachment_image[0] );
} else {
    $attachment_url = '';
}
$cookie_box_bg= 'background-image:url('. $attachment_url .'); background-size:cover; background-position: 100%;';
if ($options['cookie_box_style'] == 'classic_blue') :
    $cookie_box_bg= 'background-image:url('.ct_ultimate_gdpr_url() . '/assets/css/images/Cookie-pop-up-bg.jpg ); background-position: 107% -21%; background-color:#262626 !important; background-repeat: no-repeat; color:#fff;';
elseif ($options['cookie_box_style'] == 'classic_light') :
    $cookie_box_bg= 'background-color:#ffffff !important; color:#333;';
endif;
?>

<!-- SHORTCODE -->
<?php if (!empty($options['content'])) : ?>
    <a href="#" class="ct-ultimate-triggler-modal-sc"><?php echo esc_html($options['content']); ?></a>
<?php endif; ?>

<?php if (empty($options['cookie_modal_always_visible'])): ?>

    <div id="ct-ultimate-gdpr-cookie-popup" class="
    <?php
    if (isset($options['cookie_position'])) :
        if ($options['cookie_position'] == 'top_panel_') :
            echo esc_attr('ct-ultimate-gdpr-cookie-topPanel ');
        endif;

        if ($options['cookie_position'] == 'bottom_panel_') :
            echo esc_attr('ct-ultimate-gdpr-cookie-bottomPanel ');
        endif;
    endif;

    if (isset($options['cookie_box_style'])) :
        if ($options['cookie_box_style'] == 'modern') :
            echo esc_attr(' ct-ultimate-gdpr-cookie-popup-modern ');
        endif;
    endif;
    if (isset($options['cookie_box_style'])) :
        if ($options['cookie_box_style'] == 'classic_blue') :
            echo esc_attr('ct-ultimate-gdpr-cookie-classic-blue ct-ultimate-gdpr-cookie-popup-classic ');
        endif;
    endif;
    if (isset($options['cookie_box_style'])) :
        if ($options['cookie_box_style'] == 'classic_light') :
            echo esc_attr('ct-ultimate-gdpr-cookie-classic-light ct-ultimate-gdpr-cookie-popup-classic ');
        endif;
    endif;
    if (isset($options['cookie_box_style'])) :
        if ($options['cookie_box_style'] == 'classic') :
            echo esc_attr(' ct-ultimate-gdpr-cookie-popup-classic ');
        endif;
    endif;

    if (isset($options['cookie_box_shape'])) :
        if ($options['cookie_box_shape'] == 'squared') :
            echo esc_attr(' ct-ultimate-gdpr-cookie-popup-squared ');
        endif;
    endif;

    if (isset($options['cookie_button_shape'])) :
        if ($options['cookie_button_shape'] == 'rounded') :
            echo esc_attr(' ct-ultimate-gdpr-cookie-popup-button-rounded ');
        endif;
    endif;

    if (isset($options['cookie_button_size'])) :
        if ($options['cookie_button_size'] == 'large') :
            echo esc_attr(' ct-ultimate-gdpr-cookie-popup-button-large');
        endif;
    endif;

    if (isset ($options['cookie_trigger_modal_bg_shape'])) :
        if ($options['cookie_trigger_modal_bg_shape'] == 'round'):
            $cookie_trigger_modal_bg_shape = 'ct-ultimate-gdpr-trigger-modal-round';
        elseif ($options['cookie_trigger_modal_bg_shape'] == 'rounded') :
            $cookie_trigger_modal_bg_shape = 'ct-ultimate-gdpr-trigger-modal-rounded';
        elseif ($options['cookie_trigger_modal_bg_shape'] == 'squared') :
            $cookie_trigger_modal_bg_shape = 'ct-ultimate-gdpr-trigger-modal-squared';
        endif;
    else :
        $cookie_trigger_modal_bg_shape = '';
    endif;
    ?>"

         style="<?php echo $cookie_box_bg?> background-color: <?php echo esc_attr($options['cookie_background_color']); ?>;
                 color: <?php if (($options['cookie_box_style'] != 'classic_blue' )&& ($options['cookie_box_style'] != 'classic_light')) :  echo esc_attr($options['cookie_text_color']);endif; ?>;
         <?php
         if (isset($options['cookie_position'])) :
             if ($options['cookie_position'] == 'top_panel_') :
                 echo esc_attr("top: 0; width: 100%; border-radius: 0;");
             elseif ($options['cookie_position'] == 'bottom_panel_') :
                 echo esc_attr("bottom: 0; width: 100%; border-radius: 0;");
             else :
                 echo str_replace('_', ": " . (int)$distance . "px; ", esc_attr($options['cookie_position']));
             endif;
         endif; ?>">

        <?php if (isset($options['cookie_position'])) :
            if ($options['cookie_position'] == 'top_panel_') :
                echo "<div class='ct-container ct-ultimate-gdpr-cookie-popup-topPanel'>";
            endif;

            if ($options['cookie_position'] == 'bottom_panel_') :
                echo "<div class='ct-container ct-ultimate-gdpr-cookie-popup-bottomPanel'>";
            endif;
        endif; ?>

        <div id="ct-ultimate-gdpr-cookie-content">
            <?php
            if ($options['cookie_box_style'] == 'classic_light') :
                echo "<div class='style-light-icon'><img src='".ct_ultimate_gdpr_url() . "/assets/css/images/cookie-icon-image.jpg'></div>";
            endif;
            echo wp_kses_post($options['cookie_content']); ?>
        </div>

        <?php
        if (isset($options['cookie_box_style'])) :
            if ($options['cookie_box_style'] == 'modern') :
                echo "<div class='ct-ultimate-gdpr-cookie-buttons clearfix'>";
            endif;
        endif;
        ?>

        <div id="ct-ultimate-gdpr-cookie-accept"
             style="border-color: <?php echo esc_attr($options['cookie_button_border_color']); ?>;
                     background-color: <?php
             if (isset($options['cookie_box_style'])) :
                 if (($options['cookie_box_style'] == 'modern' && $options['cookie_position'] == 'top_panel_') || ($options['cookie_box_style'] == 'modern' && $options['cookie_position'] == 'bottom_panel_')) :
                     echo esc_attr($options['cookie_button_bg_color']);
                 else :
                     echo esc_attr($options['cookie_button_bg_color']);
                 endif;
             endif;
             ?>;
                     color: <?php echo esc_attr($options['cookie_button_text_color']); ?>;">
            <?php
            if (($options['cookie_button_settings'] == 'text_icon_')||($options['cookie_box_style'] == 'classic_blue')||($options['cookie_box_style'] == 'classic_light')) :
                echo " <span class='fa fa-check ct-ultimate-gdpr-button-icon-left'></span>";
                echo esc_html(ct_ultimate_gdpr_get_value('cookie_popup_label_accept', $options, esc_html__('Accept', 'ct-ultimate-gdpr'), false));
            else:
                echo esc_html(ct_ultimate_gdpr_get_value('cookie_popup_label_accept', $options, esc_html__('Accept', 'ct-ultimate-gdpr'), false));

            endif;
            ?>

        </div>
        <div id="ct-ultimate-gdpr-cookie-read-more"
             style="border-color: <?php echo esc_attr($options['cookie_button_border_color']); ?>;
                     background-color: <?php
             if (isset($options['cookie_box_style'])) :
                 if (($options['cookie_box_style'] == 'modern' && $options['cookie_position'] == 'top_panel_') || ($options['cookie_box_style'] == 'modern' && $options['cookie_position'] == 'bottom_panel_')) :
                     echo esc_attr($options['cookie_button_bg_color']);
                 else :
                     echo esc_attr($options['cookie_button_bg_color']);
                 endif;
             endif;
             ?>;
                     color: <?php echo esc_attr($options['cookie_button_text_color']); ?>;">

            <?php
            if (($options['cookie_button_settings'] == 'text_icon_')||($options['cookie_box_style'] == 'classic_blue')||($options['cookie_box_style'] == 'classic_light')) :
                echo esc_html(ct_ultimate_gdpr_get_value('cookie_popup_label_read_more', $options, esc_html__('Read more', 'ct-ultimate-gdpr'), false));
                echo " <span class='fa fa-arrow-right ct-ultimate-gdpr-button-icon-right'></span>";
            else:
                echo esc_html(ct_ultimate_gdpr_get_value('cookie_popup_label_read_more', $options, esc_html__('Read more', 'ct-ultimate-gdpr'), false));

            endif;
            ?>
        </div>
        <div id="ct-ultimate-gdpr-cookie-change-settings"
             style="border-color: <?php echo esc_attr($options['cookie_button_border_color']); ?>;
                     background-color: <?php
             if (isset($options['cookie_box_style'])) :
                 if (($options['cookie_box_style'] == 'modern' && $options['cookie_position'] == 'top_panel_') || ($options['cookie_box_style'] == 'modern' && $options['cookie_position'] == 'bottom_panel_')) :
                     echo esc_attr($options['cookie_button_bg_color']);
                 else :
                     echo esc_attr($options['cookie_button_bg_color']);
                 endif;
             endif;
             ?>;
                     color: <?php echo esc_attr($options['cookie_button_text_color']); ?>;">
            <?php
            if ($options['cookie_button_settings'] == 'text_only_') :
                echo esc_html(ct_ultimate_gdpr_get_value('cookie_popup_label_settings', $options, esc_html__('Change Settings', 'ct-ultimate-gdpr'), false));
            else:
                echo esc_html(ct_ultimate_gdpr_get_value('cookie_popup_label_settings', $options, esc_html__('Change Settings', 'ct-ultimate-gdpr'), false));
                echo " <span class='fa fa-cog ct-ultimate-gdpr-button-icon-right'></span>";
            endif;
            ?>
        </div>
        <?php
        if (isset($options['cookie_box_style'])) :
            if ($options['cookie_box_style'] == 'modern') :
                echo "</div>";
            endif;
        endif;
        ?>

        <div class="clearfix"></div>

        <?php if (isset($options['cookie_position'])) :
            if ($options['cookie_position'] == 'top_panel_' || $options['cookie_position'] == 'bottom_panel_') :
                echo "</div>";
            endif;
        endif; ?>

    </div>

    <div id="ct-ultimate-gdpr-cookie-open"
         class="<?php echo esc_attr($cookie_trigger_modal_bg_shape); ?>"
         style="background-color: <?php echo(isset($options['cookie_trigger_modal_bg']) ? esc_attr($options['cookie_trigger_modal_bg']) : ''); ?>;color: <?php echo esc_attr($options['cookie_gear_icon_color']); ?>;
         <?php
         if (isset($options['cookie_gear_icon_position'])) :
             if ($options['cookie_gear_icon_position'] == 'top_center_') :
                 echo esc_attr("top: " . (int)$distance . "px; left: 50%; right: auto; bottom: auto;");
             elseif ($options['cookie_gear_icon_position'] == 'top_left_') :
                 echo esc_attr("top: " . (int)$distance . "px; left:" . (int)$distance . "px;bottom: auto; right: auto;");
             elseif ($options['cookie_gear_icon_position'] == 'top_right_') :
                 echo esc_attr("top: " . (int)$distance . "px; right:" . (int)$distance . "px; bottom: auto; left: auto;");
             elseif ($options['cookie_gear_icon_position'] == 'bottom_center_') :
                 echo esc_attr("bottom: " . (int)$distance . "px; left: 50%; right: auto; top: auto;");
             elseif ($options['cookie_gear_icon_position'] == 'bottom_left_') :
                 echo esc_attr("bottom: " . (int)$distance . "px; left: " . (int)$distance . "px;right: auto; top: auto;");
             elseif ($options['cookie_gear_icon_position'] == 'bottom_right_') :
                 echo esc_attr("bottom: " . (int)$distance . "px; right: " . (int)$distance . "px; top: auto; left: auto;");
             elseif ($options['cookie_gear_icon_position'] == 'center_left_') :
                 echo esc_attr("top: 50%; left: " . (int)$distance . "px; right: auto; bottom: auto;");
             elseif ($options['cookie_gear_icon_position'] == 'center_right_') :
                 echo esc_attr("top: 50%; right: " . (int)$distance . "px; bottom: auto; left: auto;");
             else :
                 echo str_replace('_', ": " . (int)$distance . "px; ", esc_attr($options['cookie_gear_icon_position']));
             endif;
         endif;
         ?>">
        <?php
        if (isset($options['cookie_settings_trigger'])) :
            if ($options['cookie_settings_trigger'] == 'icon_only_' || $options['cookie_settings_trigger'] == 'text_icon_') : ?>
                <span class="<?php echo esc_attr($options['cookie_trigger_modal_icon']); ?>" aria-hidden="true"></span>
                <span class="sr-only"><?php esc_html_e('Cookie Box Settings', 'ct-ultimate-gdpr'); ?></span>
            <?php endif;
            if ($options['cookie_settings_trigger'] == 'text_only_' || $options['cookie_settings_trigger'] == 'text_icon_') :
                if (!empty($options['cookie_trigger_modal_text'])) :
                    echo esc_html($options['cookie_trigger_modal_text']);
                else :
                    echo esc_html__('Trigger', 'ct-ultimate-gdpr');
                endif;
            endif;
        else : ?>
            <span class="<?php echo esc_attr($options['cookie_trigger_modal_icon']); ?>" aria-hidden="true"></span>
            <span class="sr-only"><?php esc_html_e('Cookie Box Settings', 'ct-ultimate-gdpr'); ?></span>
        <?php endif; ?>
    </div>
    <div id="ct-ultimate-gdpr-cookie-open"
         class="<?php echo esc_attr($cookie_trigger_modal_bg_shape); ?>"
         style="background-color: <?php echo(isset($options['cookie_trigger_modal_bg']) ? esc_attr($options['cookie_trigger_modal_bg']) : ''); ?>;color: <?php echo esc_attr($options['cookie_gear_icon_color']); ?>;
         <?php
         if (isset($options['cookie_gear_icon_position'])) :
             if ($options['cookie_gear_icon_position'] == 'top_center_') :
                 echo esc_attr("top: " . (int)$distance . "px; left: 50%; right: auto; bottom: auto;");
             elseif ($options['cookie_gear_icon_position'] == 'top_left_') :
                 echo esc_attr("top: " . (int)$distance . "px; left:" . (int)$distance . "px;bottom: auto; right: auto;");
             elseif ($options['cookie_gear_icon_position'] == 'top_right_') :
                 echo esc_attr("top: " . (int)$distance . "px; right:" . (int)$distance . "px; bottom: auto; left: auto;");
             elseif ($options['cookie_gear_icon_position'] == 'bottom_center_') :
                 echo esc_attr("bottom: " . (int)$distance . "px; left: 50%; right: auto; top: auto;");
             elseif ($options['cookie_gear_icon_position'] == 'bottom_left_') :
                 echo esc_attr("bottom: " . (int)$distance . "px; left: " . (int)$distance . "px;right: auto; top: auto;");
             elseif ($options['cookie_gear_icon_position'] == 'bottom_right_') :
                 echo esc_attr("bottom: " . (int)$distance . "px; right: " . (int)$distance . "px; top: auto; left: auto;");
             elseif ($options['cookie_gear_icon_position'] == 'center_left_') :
                 echo esc_attr("top: 50%; left: " . (int)$distance . "px; right: auto; bottom: auto;");
             elseif ($options['cookie_gear_icon_position'] == 'center_right_') :
                 echo esc_attr("top: 50%; right: " . (int)$distance . "px; bottom: auto; left: auto;");
             else :
                 echo str_replace('_', ": " . (int)$distance . "px; ", esc_attr($options['cookie_gear_icon_position']));
             endif;
         endif;
         ?>">
        <?php
        if (isset($options['cookie_settings_trigger'])) :
            if ($options['cookie_settings_trigger'] == 'icon_only_' || $options['cookie_settings_trigger'] == 'text_icon_') : ?>
                <span class="<?php echo esc_attr($options['cookie_trigger_modal_icon']); ?>" aria-hidden="true"></span>
                <span class="sr-only"><?php esc_html_e('Cookie Box Settings', 'ct-ultimate-gdpr'); ?></span>
            <?php endif;
            if ($options['cookie_settings_trigger'] == 'text_only_' || $options['cookie_settings_trigger'] == 'text_icon_') :
                if (!empty($options['cookie_trigger_modal_text'])) :
                    echo esc_html($options['cookie_trigger_modal_text']);
                else :
                    echo esc_html__('Trigger', 'ct-ultimate-gdpr');
                endif;
            endif;
        else : ?>
            <span class="<?php echo esc_attr($options['cookie_trigger_modal_icon']); ?>" aria-hidden="true"></span>
            <span class="sr-only"><?php esc_html_e('Cookie Box Settings', 'ct-ultimate-gdpr'); ?></span>
        <?php endif; ?>
    </div>

<?php endif; ?>
<div id="ct-ultimate-gdpr-cookie-modal" class="<?php echo esc_attr($group_class) . esc_attr( $cookie_modal_type ); ?>">

    <!-- Modal content -->
    <div class="ct-ultimate-gdpr-cookie-modal-content <?php echo esc_attr($cookie_modal_skin); ?>">
        <?php
        if (
            ! $cookie_modal_type == ' ct-ultimate-gdpr-cookie-modal-compact ct-ultimate-gdpr-cookie-modal-compact-light-blue'
            || ! $cookie_modal_type == ' ct-ultimate-gdpr-cookie-modal-compact ct-ultimate-gdpr-cookie-modal-compact-dark-blue'
            || ! $cookie_modal_type == ' ct-ultimate-gdpr-cookie-modal-compact ct-ultimate-gdpr-cookie-modal-compact-green'
        ) :
            ?>
            <div id="ct-ultimate-gdpr-cookie-modal-close"></div>
        <?php endif; ?>
        <div id="ct-ultimate-gdpr-cookie-modal-body"
             class="<?php echo (CT_Ultimate_GDPR_Model_Group::LEVEL_BLOCK_ALL == apply_filters('ct_ultimate_gdpr_controller_cookie_group_level', 0)) ? 'ct-ultimate-gdpr-slider-block' : 'ct-ultimate-gdpr-slider-not-block'; ?>">

            <?php
            if (
                $cookie_modal_type == ' ct-ultimate-gdpr-cookie-modal-compact ct-ultimate-gdpr-cookie-modal-compact-green'
                || $cookie_modal_type == ' ct-ultimate-gdpr-cookie-modal-compact ct-ultimate-gdpr-cookie-modal-compact-light-blue'
                || $cookie_modal_type == ' ct-ultimate-gdpr-cookie-modal-compact ct-ultimate-gdpr-cookie-modal-compact-dark-blue'
            ) :
                ?>
                <div id="ct-ultimate-gdpr-cookie-modal-compact-close"></div>
            <?php endif; ?>

            <?php
            if (!empty($options['cookie_group_popup_header_content'])) : ?>
                <div style="color: <?php echo esc_attr($options['cookie_modal_header_color']); ?>"> <?php echo wp_kses_post($options['cookie_group_popup_header_content']); ?> </div>

            <?php
            else:
                ct_ultimate_gdpr_locate_template('cookie-group-popup-header-content', true, $options);
            endif; ?>
            <form action="#" id="ct-ultimate-gdpr-cookie-modal-slider-form">
                <div class="ct-ultimate-gdpr-slider"></div>
                <ul class="ct-ultimate-gdpr-cookie-modal-slider">
                    <?php $group_counter = 0; ?>
                    <?php if (empty($options['cookie_group_popup_hide_level_1'])) : ?>
                        <?php ++$group_counter; ?>
                        <li id="ct-ultimate-gdpr-cookie-modal-slider-item-block"
                            class="ct-ultimate-gdpr-cookie-modal-slider-item <?php echo (CT_Ultimate_GDPR_Model_Group::LEVEL_BLOCK_ALL == apply_filters('ct_ultimate_gdpr_controller_cookie_group_level', 0)) ? 'ct-ultimate-gdpr-cookie-modal-slider-item--active' : ''; ?>"
                            data-count="<?php echo esc_attr($group_counter); ?>">
                            <div>
                                <img class="ct-svg"
                                     src="<?php echo esc_url( $block_icon )?>"
                                     alt="Block all">
                            </div>
                            <input type="radio" id="cookie0"
                                   name="radio-group" <?php echo (CT_Ultimate_GDPR_Model_Group::LEVEL_BLOCK_ALL == apply_filters('ct_ultimate_gdpr_controller_cookie_group_level', 0)) ? 'checked' : ''; ?>
                                   class="ct-ultimate-gdpr-cookie-modal-slider-radio"
                                   value="<?php echo CT_Ultimate_GDPR_Model_Group::LEVEL_BLOCK_ALL; ?>"
                                   data-count="<?php echo esc_attr($group_counter); ?>">
                            <label for="cookie0"
                                   style="color: <?php echo esc_attr($options['cookie_modal_header_color']); ?>;">
                                <?php echo esc_html(CT_Ultimate_GDPR_Model_Group::get_label(CT_Ultimate_GDPR_Model_Group::LEVEL_BLOCK_ALL)); ?>
                            </label>
                        </li>

                    <?php endif; ?>

                    <?php if (empty($options['cookie_group_popup_hide_level_2'])) : ?>
                        <?php ++$group_counter; ?>
                        <li class="ct-ultimate-gdpr-cookie-modal-slider-item <?php echo (CT_Ultimate_GDPR_Model_Group::LEVEL_NECESSARY == apply_filters('ct_ultimate_gdpr_controller_cookie_group_level', 0)) ? 'ct-ultimate-gdpr-cookie-modal-slider-item--active' : ''; ?>">
                            <div>
                                <img class="ct-svg"
                                     src="<?php echo esc_url($ess_icon) ?>"
                                     alt="Essential">
                            </div>
                            <input data-count="<?php echo esc_attr($group_counter); ?>" type="radio" id="cookie1"
                                   name="radio-group" <?php echo (CT_Ultimate_GDPR_Model_Group::LEVEL_NECESSARY == apply_filters('ct_ultimate_gdpr_controller_cookie_group_level', 0)) ? 'checked' : ''; ?>
                                   class="ct-ultimate-gdpr-cookie-modal-slider-radio"
                                   value="<?php echo CT_Ultimate_GDPR_Model_Group::LEVEL_NECESSARY; ?>">
                            <label for="cookie1"
                                   style="color: <?php echo esc_attr($options['cookie_modal_header_color']); ?>;">
                                <?php echo esc_html(CT_Ultimate_GDPR_Model_Group::get_label(CT_Ultimate_GDPR_Model_Group::LEVEL_NECESSARY)); ?>
                            </label>
                        </li>

                    <?php endif; ?>

                    <?php if (empty($options['cookie_group_popup_hide_level_3'])) : ?>
                        <?php ++$group_counter; ?>
                        <li class="ct-ultimate-gdpr-cookie-modal-slider-item <?php echo (CT_Ultimate_GDPR_Model_Group::LEVEL_CONVENIENCE == apply_filters('ct_ultimate_gdpr_controller_cookie_group_level', 0)) ? 'ct-ultimate-gdpr-cookie-modal-slider-item--active' : ''; ?>"
                            data-count="<?php echo esc_attr($group_counter); ?>">
                            <div>
                                <img class="ct-svg"
                                     src="<?php echo esc_url( $func_icon)?>"
                                     alt="Functionality">
                            </div>
                            <input data-count="<?php echo esc_attr($group_counter); ?>" type="radio" id="cookie2"
                                   name="radio-group" <?php echo (CT_Ultimate_GDPR_Model_Group::LEVEL_CONVENIENCE == apply_filters('ct_ultimate_gdpr_controller_cookie_group_level', 0)) ? 'checked' : ''; ?>
                                   class="ct-ultimate-gdpr-cookie-modal-slider-radio"
                                   value="<?php echo CT_Ultimate_GDPR_Model_Group::LEVEL_CONVENIENCE; ?>">
                            <label for="cookie2"
                                   style="color: <?php echo esc_attr($options['cookie_modal_header_color']); ?>;">
                                <?php echo esc_html(CT_Ultimate_GDPR_Model_Group::get_label(CT_Ultimate_GDPR_Model_Group::LEVEL_CONVENIENCE)); ?>
                            </label>
                        </li>

                    <?php endif; ?>

                    <?php if (empty($options['cookie_group_popup_hide_level_4'])) : ?>
                        <?php ++$group_counter; ?>
                        <li class="ct-ultimate-gdpr-cookie-modal-slider-item <?php echo (CT_Ultimate_GDPR_Model_Group::LEVEL_STATISTICS == apply_filters('ct_ultimate_gdpr_controller_cookie_group_level', 0)) ? 'ct-ultimate-gdpr-cookie-modal-slider-item--active' : ''; ?>"
                            data-count="<?php echo esc_attr($group_counter); ?>">
                            <div>
                                <img class="ct-svg"
                                     src="<?php echo esc_url( $ana_icon )?>"
                                     alt="Analytics">
                            </div>
                            <input data-count="<?php echo esc_attr($group_counter); ?>" type="radio" id="cookie3"
                                   name="radio-group" <?php echo (CT_Ultimate_GDPR_Model_Group::LEVEL_STATISTICS == apply_filters('ct_ultimate_gdpr_controller_cookie_group_level', 0)) ? 'checked' : ''; ?>
                                   class="ct-ultimate-gdpr-cookie-modal-slider-radio"
                                   value="<?php echo CT_Ultimate_GDPR_Model_Group::LEVEL_STATISTICS; ?>">
                            <label for="cookie3"
                                   style="color: <?php echo esc_attr($options['cookie_modal_header_color']); ?>;">
                                <?php echo esc_html(CT_Ultimate_GDPR_Model_Group::get_label(CT_Ultimate_GDPR_Model_Group::LEVEL_STATISTICS)); ?>
                            </label>
                        </li>

                    <?php endif; ?>

                    <?php if (empty($options['cookie_group_popup_hide_level_5'])) : ?>
                        <?php ++$group_counter; ?>
                        <li class="ct-ultimate-gdpr-cookie-modal-slider-item <?php echo (CT_Ultimate_GDPR_Model_Group::LEVEL_TARGETTING == apply_filters('ct_ultimate_gdpr_controller_cookie_group_level', 0)) ? 'ct-ultimate-gdpr-cookie-modal-slider-item--active' : ''; ?>">
                            <div>
                                <img class="ct-svg"
                                     src="<?php echo esc_url( $adv_icon ) ?>"
                                     alt="Advertising">
                            </div>
                            <input data-count="<?php echo esc_attr($group_counter); ?>" type="radio" id="cookie4"
                                   name="radio-group" <?php echo (CT_Ultimate_GDPR_Model_Group::LEVEL_TARGETTING == apply_filters('ct_ultimate_gdpr_controller_cookie_group_level', 0)) ? 'checked' : ''; ?>
                                   class="ct-ultimate-gdpr-cookie-modal-slider-radio"
                                   value="<?php echo CT_Ultimate_GDPR_Model_Group::LEVEL_TARGETTING; ?>">
                            <label for="cookie4"
                                   style="color: <?php echo esc_attr($options['cookie_modal_header_color']); ?>;">
                                <?php echo esc_html(CT_Ultimate_GDPR_Model_Group::get_label(CT_Ultimate_GDPR_Model_Group::LEVEL_TARGETTING)); ?>
                            </label>
                        </li>
                    <?php endif; ?>
                    <?php if ( strlen( $cookie_modal_type ) > 0 ) : ?>
                        <li class="hide-btn-wrapper">
                            <div class="hide-btn">
                                <?php echo esc_html__( 'Hide details', 'ct-ultimate-gdpr' ); ?> <span class="fa fa-chevron-up"></span>
                            </div>
                        </li>
                    <?php endif; ?>

                    <?php
                    if (
                        $cookie_modal_type == ' ct-ultimate-gdpr-cookie-modal-compact ct-ultimate-gdpr-cookie-modal-compact-dark-blue'
                        || $cookie_modal_type == ' ct-ultimate-gdpr-cookie-modal-compact ct-ultimate-gdpr-cookie-modal-compact-light-blue'
                        || $cookie_modal_type == ' ct-ultimate-gdpr-cookie-modal-compact ct-ultimate-gdpr-cookie-modal-compact-green'
                    ) :
                        ?>
                        <li class="ct-ultimate-gdpr-cookie-modal-btn save compact">
                            <a href="#">
                                <?php
                                echo esc_html(
                                    ct_ultimate_gdpr_get_value(
                                        'cookie_group_popup_label_save',
                                        $options,
                                        esc_html__('OK', 'ct-ultimate-gdpr'),
                                        false
                                    )
                                );
                                ?>
                            </a>
                        </li>
                    <?php endif; ?>

                </ul>

            </form>
            <?php if ( $group_counter ) : ?>
            <div class="ct-ultimate-gdpr-cookie-modal-slider-wrap">
                <?php if ( strlen( $cookie_modal_type ) > 0 ) : ?>
                    <ul class="cookie-modal-tab-wrapper">
                        <?php if (empty($options['cookie_group_popup_hide_level_1'])) : ?>
                            <li class="tab cookie0" style="height:calc(135px/<?php echo esc_attr( $group_counter ); ?>);">
                        <span>
                            <?php echo esc_html( CT_Ultimate_GDPR_Model_Group::get_label( CT_Ultimate_GDPR_Model_Group::LEVEL_BLOCK_ALL ) ); ?>
                        </span>
                            </li>
                        <?php endif; ?>
                        <?php if (empty($options['cookie_group_popup_hide_level_2'])) : ?>
                            <li class="tab cookie1" style="height:calc(135px/<?php echo esc_attr( $group_counter ); ?>);">
                        <span>
                            <?php echo esc_html( CT_Ultimate_GDPR_Model_Group::get_label( CT_Ultimate_GDPR_Model_Group::LEVEL_NECESSARY ) ); ?>
                        </span>
                            </li>
                        <?php endif; ?>
                        <?php if (empty($options['cookie_group_popup_hide_level_3'])) : ?>
                            <li class="tab cookie2" style="height:calc(135px/<?php echo esc_attr( $group_counter ); ?>);">
                        <span>
                            <?php echo esc_html( CT_Ultimate_GDPR_Model_Group::get_label( CT_Ultimate_GDPR_Model_Group::LEVEL_CONVENIENCE ) ); ?>
                        </span>
                            </li>
                        <?php endif; ?>
                        <?php if (empty($options['cookie_group_popup_hide_level_4'])) : ?>
                            <li class="tab cookie3" style="height:calc(135px/<?php echo esc_attr( $group_counter ); ?>);">
                        <span>
                            <?php echo esc_html( CT_Ultimate_GDPR_Model_Group::get_label( CT_Ultimate_GDPR_Model_Group::LEVEL_STATISTICS ) ); ?>
                        </span>
                            </li>
                        <?php endif; ?>
                        <?php if (empty($options['cookie_group_popup_hide_level_5'])) : ?>
                            <li class="tab cookie4" style="height:calc(135px/<?php echo esc_attr( $group_counter ); ?>);">
                        <span>
                            <?php echo esc_html( CT_Ultimate_GDPR_Model_Group::get_label( CT_Ultimate_GDPR_Model_Group::LEVEL_TARGETTING ) ); ?>
                        </span>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>

                <div class="ct-ultimate-gdpr-cookie-modal-slider-inner-wrap">
                    <div class="ct-ultimate-gdpr-cookie-modal-slider-info cookie1">
                        <div class="ct-ultimate-gdpr-cookie-modal-slider-desc">
                            <h4 style="color: <?php echo esc_attr($options['cookie_modal_header_color']); ?>;"><?php echo esc_html(ct_ultimate_gdpr_get_value("cookie_group_popup_label_will", $options, __('This website will:', 'ct-ultimate-gdpr'))); ?></h4>
                            <ul class="ct-ultimate-gdpr-cookie-modal-slider-able"
                                style="color: <?php echo esc_attr($options['cookie_modal_text_color']); ?>;">

                                <?php

                                $option_string = ct_ultimate_gdpr_get_value("cookie_group_popup_features_available_group_2", $options, "Essential: Remember your cookie permission setting; Essential: Allow session cookies; Essential: Gather information you input into a contact forms, newsletter and other forms across all pages; Essential: Keep track of what you input in a shopping cart; Essential: Authenticate that you are logged into your user account; Essential: Remember language version you selected;");
                                $features = array_filter(array_map('trim', explode(';', $option_string)));

                                foreach ($features as $feature) :

                                    echo "<li>" . esc_html($feature) . "</li>";

                                endforeach;

                                ?>

                            </ul>
                        </div>
                        <div class="ct-ultimate-gdpr-cookie-modal-slider-desc">
                            <h4 style="color: <?php echo esc_attr($options['cookie_modal_header_color']); ?>;"><?php echo esc_html(ct_ultimate_gdpr_get_value("cookie_group_popup_label_wont", $options, __("This website wont't:", 'ct-ultimate-gdpr'))); ?></h4>
                            <ul class="ct-ultimate-gdpr-cookie-modal-slider-not-able"
                                style="color: <?php echo esc_attr($options['cookie_modal_text_color']); ?>;">


                                <?php

                                $option_string = ct_ultimate_gdpr_get_value("cookie_group_popup_features_nonavailable_group_2", $options, "Remember your login details; Functionality: Remember social media settings; Functionality: Remember selected region and country; Analytics: Keep track of your visited pages and interaction taken; Analytics: Keep track about your location and region based on your IP number; Analytics: Keep track of the time spent on each page; Analytics: Increase the data quality of the statistics functions; Advertising: Tailor information and advertising to your interests based on e.g. the content you have visited before. (Currently we do not use targeting or targeting cookies.; Advertising: Gather personally identifiable information such as name and location;");
                                $features = array_filter(array_map('trim', explode(';', $option_string)));

                                foreach ($features as $feature) :

                                    echo "<li>" . esc_html($feature) . "</li>";

                                endforeach;

                                ?>

                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="ct-ultimate-gdpr-cookie-modal-slider-info cookie2">
                        <div class="ct-ultimate-gdpr-cookie-modal-slider-desc">
                            <h4 style="color: <?php echo esc_attr($options['cookie_modal_header_color']); ?>;"><?php echo esc_html(ct_ultimate_gdpr_get_value("cookie_group_popup_label_will", $options, __('This website will:', 'ct-ultimate-gdpr'))); ?></h4>
                            <ul class="ct-ultimate-gdpr-cookie-modal-slider-able"
                                style="color: <?php echo esc_attr($options['cookie_modal_text_color']); ?>;">

                                <?php

                                $option_string = ct_ultimate_gdpr_get_value("cookie_group_popup_features_available_group_3", $options, "Essential: Remember your cookie permission setting; Essential: Allow session cookies; Essential: Gather information you input into a contact forms, newsletter and other forms across all pages; Essential: Keep track of what you input in a shopping cart; Essential: Authenticate that you are logged into your user account; Essential: Remember language version you selected; Functionality: Remember social media settings; Functionality: Remember selected region and country;");
                                $features = array_filter(array_map('trim', explode(';', $option_string)));

                                foreach ($features as $feature) :

                                    echo "<li>" . esc_html($feature) . "</li>";

                                endforeach;

                                ?>

                            </ul>
                        </div>
                        <div class="ct-ultimate-gdpr-cookie-modal-slider-desc">
                            <h4 style="color: <?php echo esc_attr($options['cookie_modal_header_color']); ?>;"><?php echo esc_html(ct_ultimate_gdpr_get_value("cookie_group_popup_label_wont", $options, __('This website will:', 'ct-ultimate-gdpr'))); ?></h4>
                            <ul class="ct-ultimate-gdpr-cookie-modal-slider-not-able"
                                style="color: <?php echo esc_attr($options['cookie_modal_text_color']); ?>;">

                                <?php

                                $option_string = ct_ultimate_gdpr_get_value("cookie_group_popup_features_nonavailable_group_3", $options, "Remember your login details; Analytics: Keep track of your visited pages and interaction taken; Analytics: Keep track about your location and region based on your IP number; Analytics: Keep track of the time spent on each page; Analytics: Increase the data quality of the statistics functions; Advertising: Tailor information and advertising to your interests based on e.g. the content you have visited before. (Currently we do not use targeting or targeting cookies.; Advertising: Gather personally identifiable information such as name and location;");
                                $features = array_filter(array_map('trim', explode(';', $option_string)));

                                foreach ($features as $feature) :

                                    echo "<li>" . esc_html($feature) . "</li>";

                                endforeach;

                                ?>

                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="ct-ultimate-gdpr-cookie-modal-slider-info cookie3">
                        <div class="ct-ultimate-gdpr-cookie-modal-slider-desc">
                            <h4 style="color: <?php echo esc_attr($options['cookie_modal_header_color']); ?>;"><?php echo esc_html(ct_ultimate_gdpr_get_value("cookie_group_popup_label_will", $options, __('This website will:', 'ct-ultimate-gdpr'))); ?></h4>
                            <ul class="ct-ultimate-gdpr-cookie-modal-slider-able"
                                style="color: <?php echo esc_attr($options['cookie_modal_text_color']); ?>;">

                                <?php

                                $option_string = ct_ultimate_gdpr_get_value("cookie_group_popup_features_available_group_4", $options, "Essential: Remember your cookie permission setting; Essential: Allow session cookies; Essential: Gather information you input into a contact forms, newsletter and other forms across all pages; Essential: Keep track of what you input in a shopping cart; Essential: Authenticate that you are logged into your user account; Essential: Remember language version you selected; Functionality: Remember social media settingsl Functionality: Remember selected region and country; Analytics: Keep track of your visited pages and interaction taken; Analytics: Keep track about your location and region based on your IP number; Analytics: Keep track of the time spent on each page; Analytics: Increase the data quality of the statistics functions;");
                                $features = array_filter(array_map('trim', explode(';', $option_string)));

                                foreach ($features as $feature) :

                                    echo "<li>" . esc_html($feature) . "</li>";

                                endforeach;

                                ?>

                            </ul>
                        </div>
                        <div class="ct-ultimate-gdpr-cookie-modal-slider-desc">
                            <h4 style="color: <?php echo esc_attr($options['cookie_modal_header_color']); ?>;"><?php echo esc_html(ct_ultimate_gdpr_get_value("cookie_group_popup_label_wont", $options, __("This website wont't:", 'ct-ultimate-gdpr'))); ?></h4>
                            <ul class="ct-ultimate-gdpr-cookie-modal-slider-not-able"
                                style="color: <?php echo esc_attr($options['cookie_modal_text_color']); ?>;">

                                <?php

                                $option_string = ct_ultimate_gdpr_get_value("cookie_group_popup_features_nonavailable_group_4", $options, "Remember your login details; Advertising: Use information for tailored advertising with third parties; Advertising: Allow you to connect to social sites; Advertising: Identify device you are using; Advertising: Gather personally identifiable information such as name and location");
                                $features = array_filter(array_map('trim', explode(';', $option_string)));

                                foreach ($features as $feature) :

                                    echo "<li>" . esc_html($feature) . "</li>";

                                endforeach;

                                ?>

                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="ct-ultimate-gdpr-cookie-modal-slider-info cookie4">
                        <div class="ct-ultimate-gdpr-cookie-modal-slider-desc">
                            <h4 style="color: <?php echo esc_attr($options['cookie_modal_header_color']); ?>;"><?php echo esc_html(ct_ultimate_gdpr_get_value("cookie_group_popup_label_will", $options, __('This website will:', 'ct-ultimate-gdpr'))); ?></h4>
                            <ul class="ct-ultimate-gdpr-cookie-modal-slider-able"
                                style="color: <?php echo esc_attr($options['cookie_modal_text_color']); ?>;">

                                <?php

                                $option_string = ct_ultimate_gdpr_get_value("cookie_group_popup_features_available_group_5", $options, "Essential: Remember your cookie permission setting; Essential: Allow session cookies; Essential: Gather information you input into a contact forms, newsletter and other forms across all pages; Essential: Keep track of what you input in a shopping cart; Essential: Authenticate that you are logged into your user account; Essential: Remember language version you selected; Functionality: Remember social media settingsl Functionality: Remember selected region and country; Analytics: Keep track of your visited pages and interaction taken; Analytics: Keep track about your location and region based on your IP number; Analytics: Keep track of the time spent on each page; Analytics: Increase the data quality of the statistics functions; Advertising: Use information for tailored advertising with third parties; Advertising: Allow you to connect to social sitesl Advertising: Identify device you are using; Advertising: Gather personally identifiable information such as name and location");
                                $features = array_filter(array_map('trim', explode(';', $option_string)));

                                foreach ($features as $feature) :

                                    echo "<li>" . esc_html($feature) . "</li>";

                                endforeach;

                                ?>

                            </ul>
                        </div>
                        <div class="ct-ultimate-gdpr-cookie-modal-slider-desc">
                            <h4 style="color: <?php echo esc_attr($options['cookie_modal_header_color']); ?>;"><?php echo esc_html(ct_ultimate_gdpr_get_value("cookie_group_popup_label_wont", $options, __("This website wont't:", 'ct-ultimate-gdpr'))); ?></h4>
                            <ul class="ct-ultimate-gdpr-cookie-modal-slider-not-able"
                                style="color: <?php echo esc_attr($options['cookie_modal_text_color']); ?>;">

                                <?php

                                $option_string = ct_ultimate_gdpr_get_value("cookie_group_popup_features_nonavailable_group_5", $options, "Remember your login details");
                                $features = array_filter(array_map('trim', explode(';', $option_string)));

                                foreach ($features as $feature) :

                                    echo "<li>" . esc_html($feature) . "</li>";

                                endforeach;

                                ?>

                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="ct-ultimate-gdpr-cookie-modal-btn save">
                <a href="#"><?php echo esc_html(ct_ultimate_gdpr_get_value('cookie_group_popup_label_save', $options, esc_html__('Save & Close', 'ct-ultimate-gdpr'), false)); ?></a>
            </div>
        </div>
    </div>
</div>