

<?php

/**

 * Template Name: share Template

 * Template Post Type: post, page

 */

get_header(); 

if ( !is_user_logged_in() ) {

wp_redirect( site_url('login') );
}

?>
<div class="my-custom-class">
  <div class="container share_story_container pt-60">
        <div class="row bg-white">
      <div class="d-flex flex-column mb-2 mt-2 col-lg-12">
            <div class="share_story">
                <b class="story_feed"><a href="#" onclick="goBack()"><i class="fas fa-arrow-left"></i></a>&nbsp;share story</b>
            </div>
            <p class="mt-3 pl-4">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.</p>
        </div> 
        
        <div class="col-lg-12">

        <div class="row">
          <div class="col-lg-4 mb-5" data-toggle="modal" data-target="#newgroup">
            <div class="position-relative" (click)="openModal()">
              <div class="img_align d-flex">
               <div class="circlebg rounded-circle">
                    <div class="circle">+</div>
               </div>
               <div class="newgroup">Create New Group</div></div>
               
            </div>
          </div> 


<?php 

$args = array(
            'post_type' => 'usergroups',
            'author'        =>  $current_user->ID,
            'orderby'       =>  'post_date',
            'order'         =>  'DSC',
            'posts_per_page' => -1,
           
);
$groups  = get_posts( $args );
if($groups){
foreach($groups as $group ) {
 $emailsall = get_post_meta($group->ID, 'email_gourp_members', true ); 

?>

          <!--main-group start-->
          <div class="col-lg-4 mb-5">
            <div class="custom-control custom-checkbox">
              <!-- <input type="checkbox" class="custom-control-input" id="customCheck1" checked=""> -->
              <input type="checkbox" name="sharestory"  class="custom-control-input sharestorycheck" value="<?php echo $group->ID; ?>">
              <label class="custom-control-label" for="customCheck1"></label>
            </div>
               
            <div class="position-relative" (click)="openModal()">
              <div class="img_align d-flex">
               <div class="circlebg rounded-circle">
                    <div class="circle">
                      <img src="https://universitiesconnect.com/bongoswriters/images/nature.jpg" alt="bg-img">
                    </div>
               </div>
               <div class="newgroup list"><?php echo $group->post_title; ?></div>
          
               <div class="group">
                <?php if($emailsall){  foreach($emailsall as $emailsigle) { ?>
                <a title="<?= $emailsigle ?>"> <img src="https://universitiesconnect.com/worldstory/wp-content/uploads/2020/06/default_avatar.jpg" alt="member"></a>
              <?php } } ?>
               </div>
               
              </div>
               
            </div>
          </div> 
      <?php } } ?>   
          
          
           
        </div>

            <div class="d-flex justify-content-between col-lg-12 mt-5 mb-5 mfdc">
              <button type="button" class="btn btn-warning invite-button" data-target="#invitemember" data-toggle="modal">Invite New Member</button>
  <?php wp_nonce_field('vb_share_user','vb_share_user_nonce', true, true ); ?>
              <button type="button" class="btn btn-warning share-story-button sharestory-btn">Share</button>

            </div> 

        
        </div>
    </div>
</div>


<!-- <button class="btn btn-warning" data-toggle="modal" data-target="#editGroup">Edit Group</button>
<button class="btn btn-warning" data-toggle="modal" data-target="#mapmodal">Select Country</button> -->
<!--create New Group-->
<div class="modal fade newgroup" id="newgroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="allgroupname" id="allgroupname">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Group Name <sup>*</sup></label>
            <input type="text" class="form-control" name="recipientname" id="recipientname" placeholder="Enter Group Name">
          </div>

          <div class="form-group members-select">
            <label for="selectmembers" class="col-form-label">Add Members <sup>*</sup></label>
            <div class="dropdown members" id="selectmembers">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
              Select Members
              </button>
              <div class="dropdown-menu dropdownemails" multiple aria-labelledby="dropdownMenuButton" >
                    <?php 
            $single = true;
            $user_id = get_current_user_id();
            $key = 'mm_user_emails';
            $user_eamils = get_user_meta($user_id, $key, $single);
            if($user_eamils) {
            foreach($user_eamils as $value) {
            ?>

                <div class="dropdown-item">
                  <div class="form-check">
                    <input class="form-check-input find-table" name="groupmembers" type="checkbox" id="find-table" value="<?= $value ?>">
                    <label class="form-check-label" for="saisudhakar">
                      <figure class="user-info group">
                      <img src="https://universitiesconnect.com/worldstory/wp-content/uploads/2020/06/default_avatar.jpg" alt="user"/>
                      <figcaption ><?= $value ?></figcaption>
                      </figure>
                    </label>
                  </div>
                </div>
                <?php } 
              }
                ?>
                             
              </div>
            </div>
          </div>

         <!--   <div class="added-members">
              <div class="member">
                <figure class="user-info group">
              <img src="https://universitiesconnect.com/worldstory/wp-content/uploads/2020/06/default_avatar.jpg" alt="user"/>
                  <figcaption >Balakarishana</figcaption>
                  <button class="close" type="button">&times;</button>
                </figure>
              </div>
            </div> -->
             <?php wp_nonce_field('vb_update_create','vb_update_create_nonce', true, true ); ?>
         <div class="modal-footer justify-content-between">
        
          <div class="mr-2 cancel" data-dismiss="modal">Cancel</div>
          <div class="update"><button type="submit" class="btn btn-warning gradient-button create-group">Create</button></div>
        
      </div>
        </form>
      </div>

    

    </div>
  </div>
</div>

<!--update new Group-->
<div class="modal fade newgroup" id="editGroup" tabindex="-1" role="dialog" aria-labelledby="updateGroup" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateGroup">Update Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="allgroupname" id="allgroupname">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Group Name <sup>*</sup></label>
            <input type="text" class="form-control" name="recipientname" id="recipientname" placeholder="Enter Group Name">
          </div>

          <div class="form-group members-select">
            <label for="selectmembers" class="col-form-label">Add Members <sup>*</sup></label>
            <div class="dropdown members" id="selectmembers">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
              Select Members
              </button>
              <div class="dropdown-menu dropdownemails" multiple aria-labelledby="dropdownMenuButton" >
                    <?php 
            $single = true;
            $user_id = get_current_user_id();
            $key = 'mm_user_emails';
            $user_eamils = get_user_meta($user_id, $key, $single);
            if($user_eamils) {
            foreach($user_eamils as $value) {
            ?>

                <div class="dropdown-item">
                  <div class="form-check">
                    <input class="form-check-input find-table" name="groupmembers" type="checkbox" id="find-table" value="<?= $value ?>">
                    <label class="form-check-label" for="saisudhakar">
                      <figure class="user-info group">
                      <img src="https://universitiesconnect.com/worldstory/wp-content/uploads/2020/06/default_avatar.jpg" alt="user"/>
                      <figcaption ><?= $value ?></figcaption>
                      </figure>
                    </label>
                  </div>
                </div>
                <?php } 
              }
                ?>
                             
              </div>
            </div>
          </div>

         <!--   <div class="added-members">
              <div class="member">
                <figure class="user-info group">
              <img src="https://universitiesconnect.com/worldstory/wp-content/uploads/2020/06/default_avatar.jpg" alt="user"/>
                  <figcaption >Balakarishana</figcaption>
                  <button class="close" type="button">&times;</button>
                </figure>
              </div>
            </div> -->
             <?php wp_nonce_field('vb_update_create','vb_update_create_nonce', true, true ); ?>
         <div class="modal-footer justify-content-between">
        
          <div class="mr-2 cancel" data-dismiss="modal">Cancel</div>
          <div class="update"><button type="submit" class="btn btn-warning gradient-button create-group">Create</button></div>
        
      </div>
        </form>
      </div>

    

    </div>
  </div>
</div>

<!--invite New member-->
<div class="modal fade newgroup" id="invitemember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Member Email Id</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      

        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email Address <sup>*</sup></label>
            <div class="form-control space">
         
            <div class="added-members email-invites-cross">
                        <?php 
            $single = true;
            $user_id = get_current_user_id();
            $key = 'mm_user_emails';
            $user_eamils = get_user_meta($user_id, $key, $single);
            if($user_eamils){
            foreach($user_eamils as $value) {
            ?>
            <div class="member">

            <figure class="user-info group ">

            <figcaption ><?= $value ?></figcaption>
            <button class="close" type="button">&times;</button>                 


            </figure>     

            </div>
                <?php } } ?>
            </div>
          
            <input type="text" class="input-control" id="recipient-email" placeholder="Enter Email">
              <?php wp_nonce_field('vb_update_user','vb_update_user_nonce', true, true ); ?>

            </div>
          </div>
          <div class="modal-footer justify-content-between">
      <div class="mr-2 cancel" data-dismiss="modal">Cancel</div>
          <div class="update"><button class="btn btn-warning gradient-button invitemeber">Invite</button></div>
      </div>
       
      </div>
      
    </div>
  </div>
</div>


<div class="modal fade newgroup" id="mapmodal" tabindex="-1" role="dialog" aria-labelledby="mapLocation" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mapLocation">Select Country</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="vmap" style="width:100%; height: 400px;"></div>
      </div>
    </div>
  </div>
</div>

<!--select map-->

  
    <script>
function goBack() {
  window.history.back();
}
var shareId = "<?php echo (isset($_GET['share']))?($_GET['share']):''; ?>";

      $(document).ready(function () {


        $('.sharestory-btn').click(function()
        {
 var shareg_nonce = $('#vb_share_user_nonce').val();
            var searchIDs =  $('.sharestorycheck:checkbox:checked').map(function(){
                                return this.value;
                            }).toArray();
            if(searchIDs.length)
            {
              if(shareId)
              {

                         swal({
                    title: "Are you sure?",
                    text: "Your will share storty to select groups",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Yes, Share Story",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                  },
                  function(){

                       jQuery.ajax({
                        type:"POST",
                        dataType: 'json',
                        url:ajaxurl,
                        data: {
                          action: "shared_post_group",                         
                             sharenonce: shareg_nonce,
                         gourpIds : searchIDs,    
                          postId : shareId,                      

                        },
                        success: function(results){
                          console.log(results);
                          if(results.shared==true)
                          {
                             swal("Shared!", results.message, "success");     
                             window.location.replace("<?php echo site_url('story-feed'); ?>");           
                           //  location.reload();                         
                         }else{
                       swal("Failed!", results.message, "warning");   

                          }   
                        },
                        error: function(results) {
                     swal("Failed!", "Your Story has been Shared failed.", "warning");   
                        }
                      }); 

                   

                  });


                     }else{
                      alert("please select story to share");
                     }
            }else{
                           swal({                             
                title: "Choose a Group",
                text: "please select atleast one Group to share",
                type: "warning",
                showCancelButton: false,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "ok",
                closeOnConfirm: false
              });
            }
        
        });

        $('#vmap').vectorMap({
          map: 'world_en',
          backgroundColor: '#fff',
          color: '#ffffff',
          hoverOpacity: 0.7,
          selectedColor: '#666666',
          enableZoom: false,
          showTooltip: true,
          scaleColors: ['#C8EEFF', '#006491'],
          values: sample_data,
          normalizeFunction: 'polynomial'
        });
      });
    </script>


<script>
  
   var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
   $(".create-group").click(function()
   {
     $( "#allgroupname" ).validate();

   })

   $( "#allgroupname" ).validate( {

        rules: {

          recipientname: "required",

        
          "groupmembers[]": {
            required: true,
            minlength: 1
          },
        

        },
        messages: {

          recipientname: "Please enter Group Name",  
          "groupmembers[]" : "Please select atleast one member"

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
            $('.create-group').prop('disabled', true);
           var reg_nonce = $('#vb_update_create_nonce').val();
          var recipientname = $("#recipientname").val();
      
         var searchIDs =  $('.find-table:checkbox:checked').map(function(){
                                return this.value;
                            }).toArray();

             jQuery.ajax({

                        type:"POST",

                        dataType: 'json',

                        url:ajaxurl,

                        data: {

                          action: "create_group_writers",                         
                            nonce: reg_nonce,
                         recipientname : recipientname,    
                          searchIDs : searchIDs,                      

                        },

                        success: function(results){

                          console.log(results);

                          if(results.create==true)

                          {
                             swal({

                                        title: results.message,

                                        text: 'Group Creted',

                                          type: "success",

                                        timer: 1000,

                                        showCancelButton: false,

                                        showConfirmButton: false

                                      });                         
                             location.reload();
                         
                          //  $('form#login_form p.status').text(results.message);

                          }else{

                       alert("error");

                          }   

                        },

                        error: function(results) {

                        }

                      }); 
      
         
      }

    });

  $(".invitemeber").click(function()
  {
    var invite = $("#recipient-email").val();
    var html =   '<div class="member"><figure class="user-info group email-invites-cross"><figcaption >'+invite+'</figcaption><button class="close" type="button">&times;</button></figure></div>';

     var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if (testEmail.test(invite)) 
    {
      $('.invitemeber').prop('disabled', true);
      $('.email-invites-cross').append(html);
      $("#recipient-email").val('');
        var reg_nonce = $('#vb_update_user_nonce').val();

             jQuery.ajax({

                        type:"POST",

                        dataType: 'json',

                        url:ajaxurl,

                        data: {

                          action: "update_user_member_emails",

                          nonce: reg_nonce,

                         invite : invite,                        

                        },

                        success: function(results){

                          console.log(results);

                          if(results.invite==true)

                          {
                            $('.invitemeber').prop('disabled', false);
                            $(".dropdownemails").append('<div class="dropdown-item"><div class="form-check"><input class="form-check-input find-table" name="groupmembers" type="checkbox" id="find-table" value="'+results.value+'"><label class="form-check-label" for="saisudhakar"><figure class="user-info group"><img src="https://universitiesconnect.com/worldstory/wp-content/uploads/2020/06/default_avatar.jpg" alt="user"/><figcaption >'+results.value+'</figcaption></figure></label></div></div>');
                             swal({

                                        title: results.message,

                                        text: 'Email added',

                                          type: "success",

                                        timer: 1000,

                                        showCancelButton: false,

                                        showConfirmButton: false

                                      });                         

                         
                          //  $('form#login_form p.status').text(results.message);

                          }else{

                       alert("error");

                          }   

                        },

                        error: function(results) {

                        }

                      }); 
     
    }
    else{
        alert('failed');
    } 

  });

$(document).mouseup(function (e){

var container = $(".dropdown.members");

if (!container.is(e.target) && container.has(e.target).length === 0){

  container.find('.dropdown-menu').removeClass('show');
  
}
});

$('.dropdown-toggle').on('click',function(){
  $(this).closest('.members-select').find('.dropdown.members .dropdown-menu').toggleClass('show');
});


$('.members-select .dropdown-item').each(function(){
  $(this).on('click',function(){
    var obj = $(this).find('.form-check-label').html();
   // console.log(obj)
   // $('.added-members').append($(this).html())
  })  
});

</script>


<?php get_footer(); ?>

