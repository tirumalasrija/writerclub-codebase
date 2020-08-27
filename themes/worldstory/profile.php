

<?php

/**

 * Template Name: myprofile Template

 * Template Post Type: post, page

 *

 * @package WordPress

 * @subpackage Twenty_Twenty

 * @since Twenty Twenty 1.0

 */

get_header();


if ( !is_user_logged_in() ) {



  wp_redirect( site_url('login') );



}


  
    $profile_img  = @json_decode(get_user_meta( $current_user->ID, 'mm_profile_image', true));
    $profile_img  = !$profile_img ? '' : $profile_img;
    if(!empty($profile_img))
    {
  $profileurl = wp_get_attachment_thumb_url( $profile_img->attachment_id ); 
    } else {
       $profileurl = "https://worldwidestorytellers.com/wp-content/uploads/2020/06/default_avatar.jpg";
    }
 ?>


<style>



.upload-thumb.cover {

  width: 500px;

}



.file-upload {

  position: relative;

  overflow: hidden;

}



.file-upload input.upload {

 

  top: 0;

  right: 0;

  margin: 0;

  padding: 0;

  font-size: 20px;

  cursor: pointer;

 

}

</style>

<div class="my-custom-class">
    <div class="container share_story_container">
    	
        <form  name="update_user"  id="update_user">
            <div class="row bg-white">
                <div class="d-flex flex-column mb-5 mt-5 col-lg-12">
                    <div class="share_story">
                        <b class="story_feed"><a href="<?php echo site_url('story-feed'); ?>"><i class="fas fa-arrow-left"></i></a>&nbsp;My Profile</b>
                    </div>
                </div>
                <div class="col-lg-8 fdm">
                  
                    <div class="mb-4 col-lg-12">  
                      <div class="upload-thumb profile_image">     
                        <img src="<?php echo $profileurl; ?>" class="avatar img-circle  mb-2 profile-pic" height="200">   
                        </div>         
                          <div class="profile-picture">   

                                <div class="file- button">

                                 <span class="attach"><i class="fas fa-paperclip mr-2"></i>Change Profile pic</span> 
                                   <label class="image-upload-container btn btn-bwm">  
                                  <input data-type="image" type="file" data-ajaxed="Y" data-cont=".profile_image" name="image" id="images" class="upload" />
                                </label>
                                  <input type="hidden" name="image_aid" value="" />

                                </div>

                            </div>
                       
                    </div>

                    <div class="d-flex flex-column mb-5">

                        
                        <div class="myprofile">
                        
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="inputName">Name*</label>
                                    
                                    <input type="text" formControlName="name" class="form-control" name="name"  id="username" value="<?php echo $current_user->display_name; ?>"
                                        title="enter your first name if any.">
                                    </div>
                                    <div class="form-group col-md-6">
                                            <label for="inputLastnickname">Mobile Number*</label>
                                            <input type="text" formControlName="mobile_number"  class="form-control" name="mobile" id="mobile_number" value="<?php echo  get_user_meta( $current_user->ID, 'mm_user_mobilenumber' , true ); ?>"
                                            title="enter your mobile number if any.">
                                        </div>
                                </div>
                
                            
                
                                <div class="form-group">
                                    <label for="inputEmail4">Email Address</label>
                                <input type="email" formControlName="email"   class="form-control" name="email" type="email" id="useremail"  value="<?php echo $current_user->user_email; ?>"       title="enter your email.">
                                </div>
                                  <?php wp_nonce_field('vb_update_user','vb_update_user_nonce', true, true ); ?>
                
                                <div class="d-flex justify-content-between mt-5">
                                        <div class="mr-2 cancel">Cancel</div>
                                        <div class="update">
                                        	 <input type="submit" class="btn btn-warning gradient-button savechanges" value="Save Changes">
                                        	</div>
                                </div>
                                
                            
                        </div>
                
                        
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> 

<script>
   var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	(function($){



  $('input[type=file][data-ajaxed=Y]').on('change', function(event) {
      
     var file = this.files[0];
var fileType = file["type"];
var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
if ($.inArray(fileType, validImageTypes) < 0) {
     swal("Only Accepted  Image Format Jpg , Png and Gif");
    return false;
}
           
       
 var maxSizeKB = 3073; //Size in KB
  var maxSize = maxSizeKB * 1024; //File size is returned in Bytes
 if (this.files[0].size > maxSize) {
    $(this).val("");
  swal("Max size exceeded! Only Accepted below 3MB");
    return false;
  }
  
    files = event.target.files;

    var cont = $(this).attr('data-cont');

    var name = $(this).attr('name');



    var data = new FormData();

    $.each(files, function(key, value)

    {

      data.append(key, value);

    });



  

    data.append('type', $(this).data('type'));



    $(cont).html('Uploading....');


$('#images').prop('disabled', true);

    $.ajax({

      url: ajaxurl+'?action=file_upload&fname='+name, // Url to which the request is send

      type: "POST",             // Type of request to be send, called as method

      data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)

      

      dataType: 'json',

      contentType: false,       // The content type used when sending data to the server.

      cache: false,             // To unable request pages to be cached

      processData:false,        // To send DOMDocument or non processed data file it is set to false

      success: function(data)   // A function to be called if request succeeds

      {

        console.log(data);

        if(data.error)

        {
            
             $(cont).html('Try Again');

         // alert(data.error);

        }

        else

        {

          $(cont).html('<img src="'+data.src+'" style="max-width:100%;" />');

          $('.user-pic').html('<img src="'+data.src+'" style="max-width:100%;" />');

          $('[name='+name+'_aid]').val(data.aid);

        }
        $('#images').prop('disabled', false);

      },

      error: function(jqXHR, textStatus, errorThrown)

      {
          $('#images').prop('disabled', false);

        // Handle errors here

      //  console.log('ERRORS: ' + textStatus);

      //  alert('Toa ERRORS: ' + textStatus);

        $(cont).html('Try Again');
        

        // STOP LOADING SPINNER

      }

    });  

  });

})(jQuery);

  $("#update_user").submit(function(e){


        e.preventDefault();

         var newUserName = jQuery('#username').val();

             var newUserEmail = jQuery('#useremail').val();         

           var reg_nonce = $('#vb_update_user_nonce').val();

         var mobile_number =jQuery("#mobile_number").val();

                      jQuery.ajax({

                        type:"POST",

                        dataType: 'json',

                        url:ajaxurl,

                        data: {

                          action: "update_user_front_end",

                            nonce: reg_nonce,

                         username : newUserName,

                          useremail : newUserEmail,                          

                             mobile_number : mobile_number



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

                         

                          location.reload();

                          //  $('form#login_form p.status').text(results.message);

                          }else{

                          jQuery('.register-message').text(results.message).show();

                          }

                         

                         

                        },

                        error: function(results) {



                        }

                      });           

    });
</script>
<?php get_footer(); ?>