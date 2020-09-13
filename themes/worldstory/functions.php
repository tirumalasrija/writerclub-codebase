<?php
/**
 * Twenty Twenty functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentytwenty_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'twentytwenty-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Twenty, use a find and replace
	 * to change 'twentytwenty' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwenty' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	

}

add_action( 'after_setup_theme', 'twentytwenty_theme_support' );


add_action('wp_ajax_register_user_front_end', 'register_user_front_end', 0);

add_action('wp_ajax_nopriv_register_user_front_end', 'register_user_front_end');

function register_user_front_end() {

     // Verify nonce

  if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'vb_new_user' ) )

    die( 'Ooops, something went wrong, please try again later.' );



      $new_user_name = stripcslashes($_POST['new_user_name']);

      $new_user_email = stripcslashes($_POST['new_user_email']);

      $new_user_password = $_POST['new_user_password'];

      $user_nice_name = strtolower($_POST['new_user_email']);

       $user_mobile = strtolower($_POST['mobile_number']);
       $contry_code = strtolower($_POST['contry_code']);


      if(!empty( $new_user_name)&&!empty($new_user_email)&&!empty($new_user_password)){

      $user_data = array(

          'user_login' => $new_user_name,

          'user_email' => $new_user_email,

          'user_pass' => $new_user_password,

          'user_nicename' => $new_user_name,

          'display_name' => $new_user_name,

          'role' => 'subscriber'

        );

      $user_id = wp_insert_user($user_data);



        if (!is_wp_error($user_id)) {

          //   um_fetch_user( $user_id );
            // UM()->user()->email_pending();
            // UM()->user()->approve();

        add_user_meta( $user_id, 'mm_user_mobilenumber', $user_mobile );
         add_user_meta( $user_id, 'mm_user_country_code', $contry_code );
        

    /*test

        $user_info = get_userdata($user_id);

    // create md5 code to verify later

    $code = md5(time());

    // make it into a code to send it to user via email

    $string = array('id'=>$user_id, 'code'=>$code);

    // create the activation code and activation status

    update_user_meta($user_id, 'account_activated', 0);

    update_user_meta($user_id, 'activation_code', $code);

    // create the url

    $url = get_site_url(). '/education-dashboard/?act=' .base64_encode( serialize($string));

    // basically we will edit here to make this nicer

    $html = 'Please click the following links <br/><br/> <a href="'.$url.'">'.$url.'</a>';

    // send an email out to user

    wp_mail( $user_info->user_email, __('Email Subject','text-domain') , $html);

        */



         echo json_encode( array( 'register'=>true, 'message'=>__('Register successful' )));

        } else {

            if (isset($user_id->errors['empty_user_login'])) {

              $message = 'User Name and Email are mandatory';

              

            } elseif (isset($user_id->errors['existing_user_login'])) {

              $message = 'User name already exixts.';

            } else {

               $message = 'Error Occured please fill up the sign up form carefully.';

            }



             echo json_encode( array( 'register'=>false,'message'=>$message));

        }

    }else{

         $message = 'User Name , Email and Password are mandatory';

         echo json_encode( array( 'register'=>false,'message'=>$message));

    }

    die;

}

add_action( 'init', 'ajax_login_init' );

    function ajax_login_init() {



      





        // Enable the user with no privileges to run ajax_login() in AJAX

        add_action( 'wp_ajax_nopriv_ajax_login_custom', 'ajax_login_custom' );

    }



    // Check if users input information is valid

    function ajax_login_custom() {

        // First check the nonce, if it fails the function will break

        check_ajax_referer( 'ajax-login-nonce', 'security' );



    //Nonce is checked, get the POST data and sign user on

    $info = array();

        $info['user_login'] = $_POST['username'];

        $info['user_password'] = $_POST['password'];

        $info['remember'] = true;



    $user_signon = wp_signon( $info,  is_ssl()  );



    if ( is_wp_error( $user_signon )) {
    	
    	  echo json_encode( array( 'loggedin'=>false,'message'=>$user_signon->get_error_message()));

       // echo json_encode( array( 'loggedin'=>false,'message'=>__( 'Wrong username or password!' )));

    } else {
       wp_set_current_user($user_signon->ID);
     wp_set_auth_cookie($user_signon->ID);

            $msg = '';

    

        echo json_encode( array( 'loggedin'=>true,'course'=>$msg, 'message'=>__('Login successful, redirecting...' )));

    }



    die();

}


add_action('wp_ajax_file_upload',  'dg_file_upload_handler'  );

add_action( 'wp_ajax_nopriv_file_upload', 'dg_file_upload_handler' );

function dg_file_upload_handler()

{


    //Get the file

    $_FILES[$f] = $_FILES[0];

    

    $user = new WP_User(get_current_user_id());

    $json['status'] = 'error';

  

    //Check if the file is available && the user is logged in

    if (!empty($_FILES[$f]) && $user->ID > 0) {

      

        $json = array();

        require_once(ABSPATH . 'wp-admin/includes/image.php');

        require_once(ABSPATH . 'wp-admin/includes/file.php');

        require_once(ABSPATH . 'wp-admin/includes/media.php');

       

        //Handle the media upload using WordPress helper functions

        $attachment_id = media_handle_upload($f, 0);

        $json['aid']   = $attachment_id;

        

        //If error

        if (is_wp_error($attachment_id)) {

            $json['error'] = "Error.";

        } else {

            //delete current

            $profile_image = get_user_meta($user->ID, 'profile_image', true);

            if ($profile_image) {

                $profile_image = json_decode($profile_image);

                if (isset($profile_image->attachment_id)) {

                    wp_delete_attachment($profile_image->attachment_id, true);

                }

            }

            

            //Generate attachment in the media library

            $attachment_file_path = get_attached_file($attachment_id);

            $data                 = wp_generate_attachment_metadata($attachment_id, $attachment_file_path);

            

            //Get the attachment entry in media library

            $image_full_attributes  = wp_get_attachment_image_src($attachment_id, 'full');

            $image_thumb_attributes = wp_get_attachment_image_src($attachment_id, 'smallthumb');

              $url = wp_get_attachment_thumb_url( $attachment_id );

            $arr = array(

                'attachment_id' => $attachment_id,

                'url' => $image_full_attributes[0],

                'thumb' =>  $url

            );

            

            //Save the image in the user metadata

            update_user_meta($user->ID, 'mm_profile_image', json_encode($arr));

            

            $json['src']    = $arr['thumb'];

            $json['status'] = 'ok';

        }

    }

    //Output the json

    die(json_encode($json));

}

add_action('wp_ajax_update_user_front_end', 'update_user_front_end');

add_action('wp_ajax_nopriv_update_user_front_end', 'update_user_front_end');

function update_user_front_end() {

     // Verify nonce

  if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'vb_update_user' ) )

    die( 'Ooops, something went wrong, please try again later.' );



      $new_user_name = stripcslashes($_POST['username']);

      $new_user_email = stripcslashes($_POST['useremail']);    

       $user_mobile = strtolower($_POST['mobile_number']);



      if(!empty( $new_user_name)&&!empty($new_user_email)&&!empty($user_mobile)){

           $user = new WP_User(get_current_user_id());

      $user_data = array(   

        'ID' => $user->ID,

         

          'user_email' => $new_user_email,         

          'user_nicename' => $new_user_name,

          'display_name' => $new_user_name,        

        );

      $user_id = wp_update_user($user_data);



        if (!is_wp_error($user_id)) {

        update_user_meta( $user->ID, 'mm_user_mobilenumber', $user_mobile );

         echo json_encode( array( 'register'=>true, 'message'=>__('Profile Updated successful' )));

        } else {

           

               $message = 'Error Occured please fill up the update form carefully.';

            



             echo json_encode( array( 'register'=>false,'message'=>$message));

        }

    }else{

         $message = 'Profile Name , Email and Mobile Number are mandatory';

         echo json_encode( array( 'register'=>false,'message'=>$message));

    }

    die();

}
add_filter( 'big_image_size_threshold', '__return_false' ); 
if ( current_user_can('subscriber') && !current_user_can('upload_files') )
    add_action('admin_init', 'allow_contributor_uploads');
function allow_contributor_uploads() {
    $contributor = get_role('subscriber');
    $contributor->add_cap('upload_files');
}


add_action('wp_ajax_update_user_member_emails', 'update_user_member_emails');

add_action('wp_ajax_nopriv_update_user_member_emails', 'update_user_member_emails');

function update_user_member_emails() {

     // Verify nonce

  if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'vb_update_user' ) )

    die( 'Ooops, something went wrong, please try again later.' );

      $invite = stripcslashes($_POST['invite']); 

      if(!empty( $invite)){

           $user = new WP_User(get_current_user_id());

    // get array of already saved ID´s

    $saved_ids = get_user_meta($user->ID, 'mm_user_emails', true);



    if (in_array($invite, $saved_ids)) {

     echo json_encode( array( 'invite'=>true, 'message'=>__('Invite Updated successful' )));
     die();

    } else {

         //if list is empty, initialize it as an empty array

        if ($saved_ids == '') {

            $saved_ids = array();

        }

        // push the new ID inside the array

        array_push($saved_ids, $invite);



        if (update_user_meta($user->ID, 'mm_user_emails', $saved_ids)) {          
//

         echo json_encode( array( 'invite'=>true, 'message'=>__('Invite Updated successful' ),'value'=>$invite));
         die();

        } else {          

               $message = 'Error Occured please fill up the update form carefully.';

             echo json_encode( array( 'invite'=>false,'message'=>"eror"));
             die();
        }

    }

  }else{

         $message = 'Email are mandatory';

         echo json_encode( array( 'invite'=>false,'message'=>"empty"));
        die();
    }

   

}



add_action('init', 'mm_custom_post_custom_education');



// The custom function to register a custom Country,Universities and courses post type



function mm_custom_post_custom_education()

{









   



// Set the labels, this variable is used in the $args array



    $labels = array(

'name'               => __('User Group'),

'singular_name'      => __('User Group'),

'add_new'            => __('Add New User Group'),

'add_new_item'       => __('Add New User Group'),

'edit_item'          => __('Edit User Group'),

'new_item'           => __('New User Group'),

'all_items'          => __('All User Groups'),

'view_item'          => __('View User Groups'),

'search_items'       => __('Search User Groups'),



);



    // The arguments for our post type, to be entered as parameter 2 of register_post_type()



    $args = array(

'labels'            => $labels,

'description'       => '',

'public'            => true,



'show_ui'            => true,


 'menu_position' => 10,


'supports'          => array( 'title', 'editor', 'thumbnail','custom-fields' ),

'has_archive'       => true,

'show_in_admin_bar' => true,

'show_in_nav_menus' => true,

'query_var'         => true,

);



    register_post_type('usergroups', $args);
    
    $labels = array(

      'name'               => __('Blogs'),
      
      'singular_name'      => __('Blog'),
      
      'add_new'            => __('Add New Blog'),
      
      'add_new_item'       => __('Add New Blog'),
      
      'edit_item'          => __('Edit Blog'),
      
      'new_item'           => __('New Blog'),
      
      'all_items'          => __('All Blog'),
      
      'view_item'          => __('View Blogs'),
      
      'search_items'       => __('Search Blogs'),
      
      
      
      );
      
      
      
          // The arguments for our post type, to be entered as parameter 2 of register_post_type()
      
      
      
          $args = array(
      
      'labels'            => $labels,
      
      'description'       => '',
      
      'public'            => true,
      
      
      
      'show_ui'            => true,
      
      
       'menu_position' => 10,
      
      
      'supports'          => array( 'title', 'editor', 'thumbnail','custom-fields' ),
      
      'has_archive'       => true,
      
      'show_in_admin_bar' => true,
      
      'show_in_nav_menus' => true,
      'show_in_rest' => true,

      'query_var'         => true,
      
      );
      
      
      
          register_post_type('blogs', $args);
}
add_action('wp_ajax_update_group_writers', 'update_group_writers');

add_action('wp_ajax_nopriv_update_group_writers', 'update_group_writers');

function update_group_writers() {
    
  if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'vb_update_edit' ) )

  die( 'Ooops, something went wrong, please try again later.' );  

     $recipientname = stripcslashes($_POST['recipientname']); 

     $searchIDs = json_decode(stripslashes($_POST['searchIDs'])); 
  $groupId = stripcslashes($_POST['groupid']);
 
   
      if($groupId)
      {
            update_post_meta( $groupId, 'email_gourp_members',  $searchIDs ); 
          // Update post 37
            $my_post = array(
                'ID'           => $groupId,
                'post_title'   => $recipientname,               
            );

            // Update the post into the database
            wp_update_post( $my_post );
     

       echo json_encode( array( 'create'=>true,'message'=>"User group Updated"));
       die();
     }else{

      echo json_encode( array( 'create'=>false,'message'=>"fail"));
       die();
        
     }
}

add_action('wp_ajax_create_group_writers', 'create_group_writers');

add_action('wp_ajax_nopriv_create_group_writers', 'create_group_writers');

function create_group_writers() {

     // Verify nonce


  if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'vb_update_create' ) )

    die( 'Ooops, something went wrong, please try again later.' );  

       $recipientname = stripcslashes($_POST['recipientname']); 

       $searchIDs = json_decode(stripslashes($_POST['searchIDs'])); 
    
     
       $new_post = array(
      'post_title'     => $recipientname,        
      'post_type'      => 'usergroups',  
      'post_status' =>'publish' 
         );
        $new_post_id = wp_insert_post($new_post, true);
        if($new_post_id)
        {
         add_post_meta( $new_post_id, 'email_gourp_members', $searchIDs, true ); 

         echo json_encode( array( 'create'=>true,'message'=>"User group created"));
         die();
       }else{

        echo json_encode( array( 'create'=>false,'message'=>"fail"));
         die();
          
       }
    

   

}


function sendEmailbyGroupId($groupid,$postId)
{

$emailsall = get_post_meta($groupid, 'email_gourp_members', true );
if(!empty($emailsall)) 
{

  foreach ($emailsall as $email ) {
    $current_user = wp_get_current_user();
    $username = $current_user->user_login;

        $subject = 'A New Story from '.$username.'..is here!';
        // Email body
        $emailto ="pvenkateshnaidu@gmail.com";
        $my_postid = $postId;//This is page id or post id
        $content_post = get_post($my_postid);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        $content.= get_the_post_thumbnail( $postId, 'large', array( 'class' => 'aligncenter' ) );
        $headers = array('Content-Type: text/html; charset=UTF-8');
         wp_mail( $email, $subject, $content ,$headers); 

  
  }
}



}




 
add_action('wp_ajax_shared_post_group', 'shared_post_group');

add_action('wp_ajax_nopriv_shared_post_group', 'shared_post_group');

function shared_post_group() {

     // Verify nonce
//sendEmailbyGroupId(243,206);

  if( !isset( $_POST['sharenonce'] ) || !wp_verify_nonce( $_POST['sharenonce'], 'vb_share_user' ) )
  {
     echo json_encode( array( 'shared'=>false,'message'=>"Ooops, something went wrong, please try again later."));
         die();
  }

  

       $gourpIds = $_POST['gourpIds']; 

       $postId = $_POST['postId']; 
      
      if(!empty($gourpIds) &&!empty($postId))
      {
        if(count($gourpIds)>1)
        {
          foreach ($gourpIds as $value) {

              sendEmailbyGroupId($value,$postId);
          }
          echo json_encode( array( 'shared'=>true,'message'=>"two group Shared"));
            die();
        }else{
           sendEmailbyGroupId($gourpIds[0],$postId);
           echo json_encode( array( 'shared'=>true,'message'=>"one groups Shared"));
            die();
        }
        
        
       }else{

        echo json_encode( array( 'shared'=>false,'message'=>"fail"));
         die();
          
       }
    

   

}
add_action('wp_ajax_delete_group_writers', 'delete_group_writers');

add_action('wp_ajax_nopriv_delete_group_writersp', 'delete_group_writers');

function delete_group_writers() {

     // Verify nonce
//sendEmailbyGroupId(243,206);
  

    
      if(isset($_POST['groupid']) &&!empty($_POST['groupid']))
      {

       wp_delete_post($_POST['groupid'], true);

           echo json_encode( array( 'delete'=>true,'message'=>$result));
            die();      
        
        
       }else{

        echo json_encode( array( 'delete'=>false,'message'=>"Group deleted Fail"));
         die();
          
       }
    

   

}

function themeblvd_disable_admin_bar() { 
    if ( ! current_user_can('edit_posts') ) {
        add_filter('show_admin_bar', '__return_false'); 
    }
}
add_action( 'after_setup_theme', 'themeblvd_disable_admin_bar' );
 
/**
 * Redirect back to homepage and not allow access to 
 * WP admin for Subscribers.
 */
function themeblvd_redirect_admin(){
    if ( ! defined('DOING_AJAX') && ! current_user_can('edit_posts') ) {
        wp_redirect( site_url() );
        exit;       
    }
}
add_action( 'admin_init', 'themeblvd_redirect_admin' );
function soi_login_redirect($redirect_to, $request, $user)
{
   return (is_array($user->roles) && ((in_array('editor', $user->roles))||(in_array('administrator', $user->roles)))) ? admin_url() : home_url('story-feed');
} 
add_filter('login_redirect', 'soi_login_redirect', 10, 3);
// Function to change email address



function custom_redirects() {
 
    if ( is_page('login') ||  is_page('register') ) {
      if(is_user_logged_in()){
        wp_redirect( home_url( '' ) );
          die;
      }
      
    }
 
}
add_action( 'template_redirect', 'custom_redirects' );
add_action('wp_logout','ps_redirect_after_logout');
function ps_redirect_after_logout(){
         wp_redirect( site_url('') );
         exit();
}
function res_fromemail($email) {
    $wpfrom = get_option('admin_email');
    return $wpfrom;
}
 
function res_fromname($email){
    $wpfrom = get_option('blogname');
    return $wpfrom;
}

//add_filter('wp_mail_from', 'res_fromemail');
add_filter('wp_mail_from_name', 'res_fromname');
function my_custom_logo() { ?>
     <style type="text/css">
         #login h1 a, .login h1 a {
             background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/Reg_Bingos_logo.png);
             height:100px;
             width:100px;
             background-size: 100px 100px;
             background-repeat: no-repeat;
             margin-bottom: 10px;
         }
         #login #nav{
          display: none;
         }
         
     </style>
 <?php } 
add_action( 'login_enqueue_scripts', 'my_custom_logo' );

/* show images only for particuklar user 
add_action('pre_get_posts','users_own_attachments');
function users_own_attachments( $wp_query_obj ) {

    global $current_user, $pagenow;

    $is_attachment_request = ($wp_query_obj->get('post_type')=='attachment');

    if( !$is_attachment_request )
        return;

    if( !is_a( $current_user, 'WP_User') )
        return;

    if( !in_array( $pagenow, array( 'upload.php', 'admin-ajax.php' ) ) )
        return;

    if( !current_user_can('delete_pages') )
        $wp_query_obj->set('author', $current_user->ID );

    return;
}
 */
 
 /**
 * Add Bootstrap form styling to WooCommerce fields
 *
 * @since  1.0
 * @refer  http://bit.ly/2zWFMiq
 */
add_filter('woocommerce_form_field_args',  'wc_form_field_args',10,3);
function wc_form_field_args($args, $key, $value) {
  $args['input_class'] = array( 'form-control' );
  $args['class'] = array( 'form-group' );
  return $args;
} 
add_filter('woocommerce_billing_fields','wpb_custom_billing_fields');
// remove some fields from billing form
// ref - https://docs.woothemes.com/document/tutorial-customising-checkout-fields-using-actions-and-filters/
function wpb_custom_billing_fields( $fields = array() ) {

	unset($fields['billing_company']);
	unset($fields['billing_address_1']);
	unset($fields['billing_address_2']);
	//unset($fields['billing_state']);
	//unset($fields['billing_city']);
	unset($fields['billing_phone']);
	unset($fields['billing_postcode']);
	unset($fields['billing_country']);

	return $fields;
}
add_filter('woocommerce_get_price', 'woocommerce_change_price_by_addition', 10, 2);

function woocommerce_change_price_by_addition($price, $product) {
	
	//global post object & post id
     global $post;
	 $post_id = $post->ID;
	 
	 //get the product 
    $product = wc_get_product( $post_id );
   
   // change the price by adding the 35 
    $price = ($price + 35);
	
	//return the new price
    return  $price;
}