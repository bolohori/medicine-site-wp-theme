<?php

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_left-navigation-menu',
        'title' => 'Left Navigation Menu',
        'fields' => array (
            array (
                'key' => 'field_52e04d925f72e',
                'label' => 'Title',
                'name' => 'left_nav_menu_title',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_52e7f22d0203f',
                'label' => 'Hide?',
                'name' => 'hide_in_left_nav',
                'type' => 'true_false',
                'message' => '',
                'default_value' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'acf_after_title',
            'layout' => 'default',
            'hide_on_screen' => array (
                0 => 'custom_fields',
                1 => 'discussion',
                2 => 'comments',
                3 => 'format',
                4 => 'send-trackbacks',
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_right-sidebars',
        'title' => 'Right Sidebars',
        'fields' => array (
            array (
                'key' => 'field_5273d86c7161b',
                'label' => 'Right Sidebars',
                'name' => 'sidebars',
                'type' => 'flexible_content',
                'layouts' => array (
                    array (
                        'label' => 'List of Links',
                        'name' => 'links',
                        'display' => 'row',
                        'sub_fields' => array (
                            array (
                                'key' => 'field_5273d9187161c',
                                'label' => 'Sidebar Title',
                                'name' => 'title',
                                'type' => 'text',
                                'column_width' => '',
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'formatting' => 'html',
                                'maxlength' => '',
                            ),
                            array (
                                'key' => 'field_5273d9887161d',
                                'label' => 'Links',
                                'name' => 'links',
                                'type' => 'repeater',
                                'column_width' => '',
                                'sub_fields' => array (
                                    array (
                                        'key' => 'field_5273d9c17161e',
                                        'label' => 'Link Text',
                                        'name' => 'link_text',
                                        'type' => 'text',
                                        'column_width' => '',
                                        'default_value' => '',
                                        'placeholder' => '',
                                        'prepend' => '',
                                        'append' => '',
                                        'formatting' => 'html',
                                        'maxlength' => '',
                                    ),
                                    array (
                                        'key' => 'field_5273d9d67161f',
                                        'label' => 'URL',
                                        'name' => 'url',
                                        'type' => 'text',
                                        'column_width' => '',
                                        'default_value' => '',
                                        'placeholder' => '',
                                        'prepend' => '',
                                        'append' => '',
                                        'formatting' => 'none',
                                        'maxlength' => '',
                                    ),
                                    array (
                                        'key' => 'field_5273da3271620',
                                        'label' => 'Open in Current Window',
                                        'name' => 'open_in_current_window',
                                        'type' => 'true_false',
                                        'column_width' => '',
                                        'message' => '',
                                        'default_value' => 0,
                                    ),
                                ),
                                'row_min' => '',
                                'row_limit' => '',
                                'layout' => 'row',
                                'button_label' => 'Add Link',
                            ),
                        ),
                    ),
                ),
                'button_label' => 'Add Sidebar',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 1,
    ));
}
