
<?php

/**

 * Template Name: Login Template

 * Template Post Type: post, page

 *

 * @package WordPress

 * @subpackage Twenty_Twenty

 * @since Twenty Twenty 1.0

 */

get_header(); 



if ( is_user_logged_in() ) {



  wp_redirect( site_url('') );



}

?>







<div class="container">

    <div class="row justify-content-around direction-column">

      <div class="col-sm-6 col-12"><img src="<?php echo get_template_directory_uri(); ?>/assets/kids-registration.svg" class="img-fluid" alt="Italian Trulli"></div>

     

      <div class="col-sm-6 col-12 bd-highlight outer-space">

            <form name="login_form" id="login_form" class="login_form">

        <div class="d-flex justify-content-center mb-3 logo"><img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/Reg_Bingos_logo.png" alt="Italian Trulli"></div>

        <div class="d-flex flex-column">

          <h4 class="text-center">Welcome Back</h4>

        <!--  <div class="login_google"><a (click)="socialSignIn('google')"><img src="<?php echo get_template_directory_uri(); ?>/assets/google_icon.png"/>&nbsp;&nbsp;Login with Google</a></div> -->

          <p class="status" style="color:red"></p>

          <div class="mt-4 register">

          

                  <div class="form-group">

                      <label for="inputUserName">User Name</label>

                    

                      <input type="text" name="username" id="username" class="form-control" placeholder="Enter User name"  />

                      <div *ngIf="submitted && f.email.errors" class="invalid-feedback">

                          <div *ngIf="f.email.errors.required">Username is required</div>

                      </div>

                  </div>



                    <div class="form-group">

                        <label for="inputUserPassword">Password</label>

                       
                        <span class="forgot_password"><a href="<?php echo site_url(); ?>/wp-login.php?action=lostpassword">Forgot Password?</a></span> 

                       

                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" [ngClass]="{ 'is-invalid': submitted && f.password.errors }" />

                        <div *ngIf="submitted && f.password.errors" class="invalid-feedback">

                            <div *ngIf="f.password.errors.required">Password is required</div>

                        </div>

                        <span class="fa fa-fw fa-eye field-icon toggle-password"></span>

                    </div>

                    <div class="form-check">

                            <input type="checkbox" class="form-check-input" id="exampleCheck1">

                            <label class="form-check-label" for="exampleCheck1">Remember me</label>

                    </div>

               

               

          </div>

  

          

          <div class="d-flex justify-content-center bd-highlight mb-2 mt-2">

         

              <button  class="btn btn-custom gradient-button">Login</button>

             

              

          </div>

            <p class="text-center">Not a member? <span class="login"><a href="<?php echo site_url('register'); ?>" class="btn btn-link">Register Here.</a></span></p>

        </div>

          <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>

    </form>

      </div>

      

    </div>

  </div>

  <script>



   var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

      $( "#login_form" ).validate( {



        rules: {



          username: "required",          



         password:"required"



        },



        messages: {



          username: "Please enter your Username",         



          password:"Please enter your password"



        },



        errorElement: "div",



        errorPlacement: function ( error, element ) {



          // Add the `help-block` class to the error element



          error.addClass( "invalid-feedback" );







          if ( element.prop( "type" ) === "checkbox" ) {



            error.insertAfter( element.parent( "label" ) );



          } else {



            error.insertAfter( element );



          }



        },



        highlight: function ( element, errorClass, validClass ) {



          $( element ).addClass( "has-error" ).removeClass( "has-success" );



        },



        unhighlight: function (element, errorClass, validClass) {



          $( element ).addClass( "has-success" ).removeClass( "has-error" );



        },



        submitHandler: function(form) {







        $.ajax({



            type: 'POST',



            dataType: 'json',



            url: ajaxurl,



            data: { 



                'action': 'ajax_login_custom', //calls wp_ajax_nopriv_ajaxlogin



                'username': $('form#login_form #username').val(), 



                'password': $('form#login_form #password').val(),                   



                'security': $('form#login_form #security').val() },



            success: function(data){







                



                if (data.loggedin == true){

                  

             swal({







                                    title: "Thanks for Login",







                                    text: '',







                                      type: "success",







                                    timer: 2000,







                                    showCancelButton: false,







                                    showConfirmButton: false







                                  });



                   window.location.href = "<?php echo site_url('story-feed'); ?>";



                }else{



                  $('form#login_form p.status').html(data.message);



                }



            },



             error: function(err){



                $('form#login_form p.status').html(err);



           }







        });



   



      }



      } );

  </script>



<?php get_footer(); ?>

