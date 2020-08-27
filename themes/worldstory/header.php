<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title><?php echo get_bloginfo( 'name' ); ?></title>
      <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" />
      <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/styles.css" />
      <link href="<?php echo get_template_directory_uri(); ?>/fonts/all.min.css" rel="stylesheet"> <!--load all styles -->
      <link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>   
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <link href="https://cdn.jsdelivr.net/npm/jvectormap@2.0.4/jquery-jvectormap.css" />   
   
     <link href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" rel="stylesheet"/> 
<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"
    ></script>
   
    <?php wp_head(); 
    if ( is_user_logged_in() ) {
    $logged = true;
} else {
   
    $logged = false;
}
?>

  </head>

 <?php 
$bogy = '';
 if($logged==true)
{ 
  $bogy = 'bg-none spl-header groups-page';
  if(is_front_page())
{
   $bogy = 'spl-header';
}
 }else{
   $bogy = 'bg-none';
if(is_front_page())
{
   $bogy = '';
}
 }

  ?>

<body class="<?php echo $bogy; ?>">



    <?php
    wp_body_open();
    ?>

<?php

    global $current_user;
    wp_get_current_user();
    $profile_img  = @json_decode(get_user_meta( $current_user->ID, 'mm_profile_image', true));
    $profile_img  = !$profile_img ? '' : $profile_img;
    if(!empty($profile_img))
    {
  $profileurl = wp_get_attachment_thumb_url( $profile_img->attachment_id ); 
    } else {
       $profileurl = "https://worldwidestorytellers.com/wp-content/uploads/2020/06/author.png";
    }
  
      ?>
      <div class="container">
    <div  class="spacer pt-60">
        <nav  class="navbar navbar-expand-lg navbar-dark info-color bg-white fixed-top">
            <div  class="overlay"></div>
            <a  class="navbar-brand"  href="<?php echo site_url(''); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/Reg_Bingos_logo.png" /> 				 
            </a>
            <button  aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent-4" data-toggle="collapse" type="button">
                <span  class="navbar-toggler-icon"></span>
            </button>
            <div  class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <div  class="user_pic active d-block d-none d-lg-none" ><a  href="#"><img src="<?= $profileurl; ?>"></a></div>

                <ul  class="d-flex navbar-nav ml-auto">
                    <li  class="nav-item"><a  class="nav-link"  href="<?php echo site_url('home'); ?>">Home</a></li>
                    <li  class="nav-item"><a  class="nav-link " href="<?php echo site_url('story-feed'); ?>">Story Feed</a></li>
                    <?php if($logged==false) { ?>
                   <li  class="login_one nav-item"><a  class="login active" href="<?php echo site_url('login'); ?>">Login</a></li>
                    <li  class="login_one nav-item"><a  class="login active" href="<?php echo site_url('register'); ?>">Register</a></li>
                  
                   <?php }else { ?>
                       <li  class="nav-item"><a  class="nav-link " href="<?php echo site_url('my-stories'); ?>">My Stories</a></li>
                    <li  class="login_one nav-item login-spl"><a  class="login active" href="<?php echo site_url('write-a-story'); ?>">Write a Story</a></li>
                    <li  class="nav-item user-pic"><a href="#" class=""><img src="<?= $profileurl; ?>"></a></li>
                    <li class="nav-item drop-ellipse">
                        <div  class="ellipsis-v-icon navbar-nav ml-auto group-info">
                            <i  class="fas fa-ellipsis-v dropdown-toggle" data-toggle="dropdown"></i>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item"  href="<?php echo site_url('my-profile'); ?>"><i class="profile"></i>My Profile</a>
                                <a class="dropdown-item"  href="<?php echo site_url('my-groups'); ?>"><i class="mygroups"></i>My Groups</a>
                                <a class="dropdown-item"  href="<?php echo wp_logout_url(); ?>"><i class="logout"></i>Log Out</a>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item d-none d-lg-none d-block "><a  class="nav-link" href="<?php echo site_url('my-profile'); ?>">My Profile</a></li>
                    <li class="nav-item d-none d-lg-none d-block "><a  class="nav-link" href="<?php echo site_url('my-groups'); ?>">My Groups</a></li>
                    <li class="nav-item d-none d-lg-none d-block "><a  class="nav-link" href="<?php echo wp_logout_url(); ?>">Logout</a></li>
                  <?php } ?>
                </ul>
            </div>
        </nav>
    </div>
</div>
     