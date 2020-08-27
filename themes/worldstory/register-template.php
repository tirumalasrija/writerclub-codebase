

<?php

/**

 * Template Name: Register Template

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



        <div class=" justify-content-around row direction-column">

            <div class="col-sm-6 col-12"><img src="<?php echo get_template_directory_uri(); ?>/assets/kids-registration.svg" class="img-fluid"

                    alt="Italian Trulli"></div>

            <div class="col-lg-5  bd-highlight mt-5">

                

                <form name="register-formedu" id="register-formedu" class="register_form">

                    <div class="d-flex justify-content-center mb-3 logo">

                        <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/Reg_Bingos_logo.png" alt="Italian Trulli">

                    </div>

                    <div class="d-flex flex-column">

                        <h4 class="text-center">Register</h4>
                         <p class="register-message status" style="color:red"></p>

                        <div class="mt-4 register">



                        <div class="form-row">

                            <div class="form-group col-md-6">

                                <label for="inputName">User Name*</label>

                                <input type="text"   id="new_user_name" name="new_user_name" class="form-control"

                                    placeholder="Enter User Name *"

                                    [ngClass]="{ 'is-invalid': submitted && f.name.errors }" />

                               

                            </div>
                             <div class="form-group col-md-6">

                                <label for="inputState">Location</label>

                               

                                <input id="autocomplete"

             placeholder="Enter your address" class="form-control" 

             onFocus="geolocate()" name="autocomplete"

             type="text"/>

             <input type="hidden" name="country_code" id="country_code">

                               

                            </div>


                        </div>



                        <div class="form-row">

                            <div class="form-group col-md-6">

                                <label for="inputdate">Date of Birth</label>

                                

                                <input type="date" name="dob" id="dob" class="form-control"

                                    placeholder="Date of Birth *" bsDatepicker

                                    

                                    [ngClass]="{ 'is-invalid': submitted && f.dob.errors }" />

                                <div *ngIf="submitted && f.dob.errors" class="invalid-feedback">

                                    <div *ngIf="f.dob.errors.required">Date of Birth is required</div>

                                </div>

                              



                            </div>

                            <div class="form-group col-md-6">

                                <label for="gender">Gender*</label>

                                <select formControlName="gender"   class="form-control" >

                                    <option value="">Select Gender</option>                                      

                                      <option value="m" >Male</option>

                                      <option value="f" >Female</option>

                                </select>

                                <div *ngIf="submitted && f.gender.errors" class="invalid-feedback">

                                        <div *ngIf="f.gender.errors.required">Gender is required</div>

                                    </div>

                              

                            </div>
                           

                        </div>



                        <div class="form-group">

                            <label for="inputEmail4">Email Address</label>

                            <input type="email" id="new_user_email" name="new_user_email" class="form-control"

                                placeholder="Enter Email Address *"
                                />

                            <div *ngIf="submitted && f.email.errors" class="invalid-feedback">

                                <div *ngIf="f.email.errors.required">Email is required</div>

                                <div *ngIf="f.email.errors.email">Email must be a valid email address</div>

                            </div>



                        </div>

                        <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="inputEmail4">Mobile Number</label>

                        <!--    <international-phone-number  placeholder="Enter phone number" 

                                formControlName="mobile_number"

                             [maxlength]="20" [defaultCountry]="'us'" 

                             [required]="true"  name="phone_number"

                              [allowedCountries]="['in', 'ca', 'us']">

                            </international-phone-number> -->

                          <input type="text" id="mobile_number" name="mobile_number" class="form-control"

                                placeholder="Enter Mobile Number *"

                                [ngClass]="{ 'is-invalid': submitted && f.mobile_number.errors }" /> 

                                <div *ngIf="submitted && f.mobile_number.errors" class="invalid-feedback">

                                    <div *ngIf="f.mobile_number.errors.required">Mobile Number is required</div>

                                    <div *ngIf="f.mobile_number.errors.minlength">Password must be at least 10 numbers

                                    </div>

                                </div>

                                

                            



                        </div>

                        <div class="form-group col-md-6">
                              <label for="inputPassword4">Password</label>



                                <input type="password" name="new_user_password" class="form-control" id="new_user_password"

                                    placeholder="Enter Password" />
                        </div>
                        
                      </div>



                    </div>



                    <div class="d-flex justify-content-center bd-highlight mt-3 mb-2">

                        <button type="submit" class="btn btn-custom register-btn gradient-button">Register</button>

                       

              

                    </div>

                    <p class="text-center">Already a member ? <span class="login"><a href="<?php echo site_url('login'); ?>" >Login here.</a></span></p>

                </div>

                 <?php wp_nonce_field('vb_new_user','vb_new_user_nonce', true, true ); ?>

            </form>



            </div>



        </div>

    

</div>

<script>

	 var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

	    $("#register-formedu").validate( {

        rules: {
          new_user_name : {
            required: true,
        },     
autocomplete : {
            required: true,
        },     
          new_user_email :  {
          required: true,
          email: true       
          }, 
             mobile_number : {
               required: true,
               number: true,
                minlength: 10
             },              
         new_user_password:{
            required: true,
            minlength: 5
                    },
        },
        messages: {
        new_user_name: {
          required: "Please enter your User Name",  

        },
        autocomplete :  {
          required: "Please enter your Country",
        }, 
        new_user_email :  {
          required: "Please enter your Email",
          email:"Please enter valid Email"
        }, 
        mobile_number :  {
            required:"Please enter your Mobile Number",
            number: "Please enter Only Digits",
            minlength: "Please enter valid Mobile Number "
        },     
        new_user_password:{
          required: "Please enter your Password",
          minlength: "password shoulb be min length 5 "
        }
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
$('.register-btn').prop('disabled', true);
          var newUserName = jQuery('#new_user_name').val();
             var newUserEmail = jQuery('#new_user_email').val();
            var newUserPassword = jQuery('#new_user_password').val();
           var reg_nonce = jQuery('#vb_new_user_nonce').val();
         var mobile_number =jQuery("#mobile_number").val();
                  var countrycode =jQuery("#country_code").val();
                      jQuery.ajax({
                        type:"POST",
                        dataType: 'json',
                        url:ajaxurl,
                        data: {
                          action: "register_user_front_end",
                            nonce: reg_nonce,
                          new_user_name : newUserName,
                          new_user_email : newUserEmail,
                          new_user_password : newUserPassword,
                             mobile_number : mobile_number,
                                                       contry_code : countrycode

                        },



                        success: function(results){







                          console.log(results);



                          if(results.register==true)
                          {
                                swal({
                                        title: results.message,
                                        text: 'Good Job',
                                          type: "success",
                                                 timer: 2000,
                                        showCancelButton: false,
                                        showConfirmButton: false
                                      });
                       

                                  window.setTimeout(function(){ 

                                  window.location.href = '<?php echo site_url("login"); ?>'; //Will take you to Google

                                  } ,2000);      

                          //  $('form#login_form p.status').text(results.message);

                          }else{
                            $('.register-btn').prop('disabled', false);
                         jQuery('.register-message').html(results.message).show();
                          }
                        },

                        error: function(results) {
  $('.register-btn').prop('disabled', false);
                        }

                      });



            }



      } );



// This sample uses the Autocomplete widget to help the user select a

// place, then it retrieves the address components associated with that

// place, and then it populates the form fields with those details.

// This sample requires the Places library. Include the libraries=places

// parameter when you first load the API. For example:

// <script

// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">



var placeSearch, autocomplete;



var componentForm = {

  street_number: 'short_name',

  route: 'long_name',

  locality: 'long_name',

  administrative_area_level_1: 'short_name',

  country: 'long_name',

  postal_code: 'short_name'

};



function initAutocomplete() {

  // Create the autocomplete object, restricting the search predictions to

  // geographical location types.

  autocomplete = new google.maps.places.Autocomplete(

      document.getElementById('autocomplete'), {types: ['geocode']});



  // Avoid paying for data that you don't need by restricting the set of

  // place fields that are returned to just the address components.

  autocomplete.setFields(['address_component']);



  // When the user selects an address from the drop-down, populate the

  // address fields in the form.

  autocomplete.addListener('place_changed', fillInAddress);

}



function fillInAddress() {

  // Get the place details from the autocomplete object.

  var place = autocomplete.getPlace();

  console.log(place)



  // Get each component of the address from the place details

  // and fill the corresponding field on the form.

  for (var i = 0; i < place.address_components.length; i++) {

    var addressType = place.address_components[i].types[0];

    if (componentForm[addressType]) {

      var val = place.address_components[i][componentForm[addressType]];

    //  document.getElementById(addressType).value = val;

    }

    // for the country, get the country code (the "short name") also

    if (addressType == "country") {

   $("#country_code").val(place.address_components[i].short_name);



    }

  }



}



// Bias the autocomplete object to the user's geographical location,

// as supplied by the browser's 'navigator.geolocation' object.

function geolocate() {

  if (navigator.geolocation) {

    navigator.geolocation.getCurrentPosition(function(position) {

      var geolocation = {

        lat: position.coords.latitude,

        lng: position.coords.longitude

      };

      var circle = new google.maps.Circle(

          {center: geolocation, radius: position.coords.accuracy});

      autocomplete.setBounds(circle.getBounds());

    });

  }

}

  

</script>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-nPun2h9EIDT7eT1tdZhHuhxw2jAsZfE&libraries=places&callback=initAutocomplete"

        async defer></script>

<?php get_footer(); ?>

