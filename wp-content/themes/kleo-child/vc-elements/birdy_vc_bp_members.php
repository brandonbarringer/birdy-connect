<?php

/*
Displays a buddypress members grid
Replaces k-elmements 'bp_members_masonry'
*/

// Element Class 
class vc_members extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_members_mapping' ) );
        add_shortcode( 'vc_members', array( $this, 'vc_members_html' ) );
    }

    // Element Mapping
    public function vc_members_mapping() {

    if ( !defined( 'WPB_VC_VERSION' ) ) {
         return;
    }

    /* Get registered member types */
    $kleo_member_types = array("All" => 'all');

    if (function_exists('bp_get_member_types')) {
        $kleo_member_types = $kleo_member_types + bp_get_member_types( array(), 'names' );
    }

    vc_map(
        array(
            "name" => __("Birdy Connect Members"),
            "base" => "vc_members",
            "class" => "",
            "category" => __('BuddyPress'),
            "icon" => "kleo-bp-icon",
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Member Type"),
                    "param_name" => "member_type",
                    "value" => $kleo_member_types,
                    "description" => __("The type of members to display.")
                    ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Filter"),
                    "param_name" => "type",
                    "value" => array(
                        'Active' => 'active',
                        'Newest' => 'newest',
                        'Popular' => 'popular',
                        'Online' => 'online',
                        'Alphabetical' => 'alphabetical',
                        'Random' => 'random'
                        ),
                    "description" => __("Filter the members by.")
                    ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Number of members"),
                    "param_name" => "number",
                    "value" => 12,
                    "description" => __("How many members to get.")
                    ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Avatar type"),
                    "param_name" => "rounded",
                    "value" => array(
                        'Rounded' => 'rounded',
                        'Square' => 'square'
                        ),
                    "description" => __("Rounded or square avatar")
                    ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Online status"),
                    "param_name" => "online",
                    "value" => array(
                        'Show' => 'show',
                        'Hide' => 'noshow'
                        ),
                    "description" => __("Show online status")
                    ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Class"),
                    "param_name" => "class",
                    "value" => '',
                    "description" => __("A class to add to the element for CSS referrences.")
                    ),

                )
            )
        );       

    } 


    // Element HTML
    public function vc_members_html( $atts ) {

        $output = '';

        extract(
            shortcode_atts( array(
                'type' => 'newest',
                'member_type' => 'all',
                'number' => 12,
                'class' => '',
                'rounded' => "rounded",
                'online' => 'show'
                ), $atts ) 
            );

        $params = array(
            'type' => $type,
            'scope' => $member_type,
            'per_page' => $number
        );

        if ($rounded == 'rounded') {
            $rounded = 'rounded';
        }

        if ( function_exists('bp_is_active') ) {
            if ( bp_has_members( $params ) ) {
                ob_start();
                echo '<div class="wpb_wrapper">';
                echo '<div id="members-dir-list" class="members dir-list">';
                echo '<ul id="members-list" class="item-list row kleo-isotope masonry '.$class.'">';
                
                while( bp_members() ) : bp_the_member();

                
                    echo    '<li class="kleo-masonry-item">'.
                            '<div class="member-inner-list animated animate-when-almost-visible bottom-to-top">'.
                            '<div class="item-avatar '.$rounded.'">'.
                            '<a href="'. bp_get_member_permalink().'">'. 
                            bp_get_member_avatar() . kleo_get_img_overlay() . '</a>';

                    if ($online == 'show') {
                        echo kleo_get_online_status(bp_get_member_user_id());
                    }

                    echo    '</div>'.
                            '<div class="item">
                                <div class="item-title">'.
                                    '<a href="'. bp_get_member_permalink().'">'. bp_get_member_name() . '</a>
                                </div>
                                <div class="item-meta"><span class="activity">'.bp_get_member_last_active().'</span></div>';

                    if ( bp_get_member_latest_update() ) {
                        echo '<span class="update"> '. bp_get_member_latest_update().'</span>';
                    }

                    do_action( 'bp_directory_members_item' );

                    echo '</div>';

                    echo '<div class="looking">Looking for <span class="type">' . bp_member_profile_data( 'field=Looking For' ) . '</span>';

                    echo '<div class="industry">';
                            
                            $member_type = bp_get_member_type( bp_get_member_user_id() ); 
                            $member_type_obj = bp_get_member_type_object( $member_type );
                            echo $member_type_obj -> labels['name'];
                                
                    echo '</div>';

                    echo '</div>';


                    echo '<div class="action">';

                    do_action( 'bp_directory_members_actions' );

                    echo  '</div>';

                    echo '</div><!--end member-inner-list-->
                    </li>';
                endwhile;

                echo '</ul>';
                echo '</div>';
                echo '</div>';
                $output = ob_get_clean();
            }

        } 
        else {
            $output = __("This shortcode must have Buddypress installed to work.","k-elements");
        } 

        echo $output;
    } 

} // End Element Class

// Element Class Init
new vc_members();

?>