<?php

/**

 * Template Name: Mygroup Template

 * Template Post Type: post, page

 */

get_header(); 


?>
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.12.2/semantic.min.css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.12.2/semantic.min.js"></script>

<div class="feed_bg">
<div class="my-custom-class">
  <div class="container share_story_container pt-60">
  <div class="row bg-white">
      <div class="d-flex flex-column col-lg-12 mb-5">
            <div class="share_story d-flex justify-content-between">
                <b class="story_feed"><a href="<?php echo site_url('story-feed'); ?>"><i class="fas fa-arrow-left"></i></a>&nbsp;My Groups</b>
            <div class="">
            <div class="col-lg-12 mb-5" data-toggle="modal" data-target="#newgroup">
            <div class="createGroupmodal" (click)="openModal()">
              <div class="img_align align-items-center d-flex">
              
               <div class="">Create New Group</div>
               <div class="circlebg rounded-circle">
                    <div class="circle">+</div>
               </div></div>
               
            </div>
          </div> 
             <!-- <button type="button" class="btn btn-warning gradient-button" data-target="#invitemember" data-toggle="modal">Invite New Member</button> -->
            </div></div>
            
        </div> 
        
        <div class="col-lg-12">

        <div class="row">
         


<?php 

$args = array(
            'post_type' => 'usergroups',
            'author'        =>  $current_user->ID,
            'orderby'       =>  'post_date',
            'order'         =>  'ASC',
            'posts_per_page' => -1,
           
);
$groups  = get_posts( $args );
if($groups){
foreach($groups as $group ) {
 $emailsall = get_post_meta($group->ID, 'email_gourp_members', true ); 
 $finalemails = json_encode($emailsall);

?>

          <!--main-group start-->
          <div class="col-lg-4 mb-5 mailscontainer " >
            <div class="position-relative" (click)="openModal()">
              <div class="img_align d-flex">
               <div class="circlebg rounded-circle">
                    <div class="circle">
                      <img src="https://universitiesconnect.com/bongoswriters/images/nature.jpg" alt="bg-img">
                    </div>
               </div>
               <div class="newgroup list"><?php echo $group->post_title; ?></div>
                  <div class="dropdown group-info ">
                  <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                   <a class="editopopup dropdown-item" href="#" data-id="<?php echo $group->ID; ?>" data-name="<?php echo $group->post_title; ?>" data-value='<?php echo $finalemails ?>' data-toggle="modal" data-target="#editGroup">
                      <i class="edit"></i>
                      Edit Group
                    </a> 
                    <a class="dropdown-item group-delete" data-id="<?= $group->ID ?>" href="#"><i class="delete-info"></i>Delete Group</a>
                  </div>
                </div>
               <div class="group editopopup" data-id="<?php echo $group->ID; ?>" data-name="<?php echo $group->post_title; ?>" data-value='<?php echo $finalemails ?>' data-toggle="modal" data-target="#editGroup">
                <?php if($emailsall){  foreach($emailsall as $emailsigle) { ?>
                <a title="<?= $emailsigle ?>"> <img src="https://universitiesconnect.com/worldstory/wp-content/uploads/2020/06/default_avatar.jpg" alt="member"></a>
              <?php } } ?>
               </div>
               
              </div>
               
            </div>
          </div> 
      <?php } } ?>   

          
          
           
        </div>

             

        
        </div>
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
            <input type="text" class="form-control" required name="recipientname" id="recipientname" placeholder="Enter Group Name">
			   <span style="color:red" class="errorsgroup"></span>
          </div>
        <?php       
        $single = true;
        $user_id = get_current_user_id();
        $key = 'mm_user_emails';
        $user_eamils = get_user_meta($user_id, $key, $single);
        $emails= "'".implode('", "', $user_eamils)."'";
          ?>
					<div class="form-group">
						<h4 for='example_emailSUI'>Add Members email addresses</h4>
						<input type='text' id='find-table' name='groupmembers' placeholder="example@mail.com" name="groupmembers" type="checkbox" id="find-table"  class='form-control' value=''>
						 <span style="color:red" class="errorsgroupemail"></span>
					</div>				
			
             <?php wp_nonce_field('vb_update_create','vb_update_create_nonce', true, true ); ?>
         <div class="modal-footer justify-content-between">
        
          <div class="mr-2 cancel" data-dismiss="modal">Cancel</div>
          <div class="update"><button type="button" class="btn btn-warning gradient-button create-group">Create</button></div>
        
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
        <form name="allgroupname1" id="allgroupname1">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Group Name  <sup>*</sup></label>
            <input type="text" class="form-control" name="recipientname1" id="recipientname1" >
            <input type="hidden" class="form-control" name="groupidedit" id="groupidedit" >
             <span style="color:red" class="errorsgroup"></span>
          </div>
        	<div class="form-group">
						<h4 for='example_emailSUI1'>Update Members email addresses</h4>
						<input type='text' id='find-table1' name='groupmembers1' placeholder="example@mail.com"  type="checkbox" id="find-table1"  class='form-control' value=''>
				 <span style="color:red" class="errorsgroupemail"></span>
					</div>	
    
             <?php wp_nonce_field('vb_update_edit','vb_update_edit_nonce', true, true ); ?>
         <div class="modal-footer justify-content-between">
        
          <div class="mr-2 cancel" data-dismiss="modal">Cancel</div>
          <div class="update"><button type="button" class="btn btn-warning gradient-button update-group-sub">Update</button></div>
        
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



<script>
  
   var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';



   $(".group-delete").click(function()
   {

$groupId = $(this).attr("data-id");
      swal({
        title: "Are you sure?",
        text: "Submit to delete this group",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true
      }, function () {    

           jQuery.ajax({
                        type:"POST",
                        dataType: 'json',
                        url:ajaxurl,
                        data: {
                          action: "delete_group_writers", 
                         groupid : $groupId,                                           

                        },
                        success: function(results){
                          console.log(results);
                          if(results.delete==true)
                          {
                               swal("Deleted!", results.message, "success");                        
                             location.reload();                         
                          //  $('form#login_form p.status').text(results.message);
                          }else{
                        swal("Failed!", results.message, "warning");     
                          }   
                        },
                        error: function(results) {
                            swal("Faild!", results.message, "warning");     
                        }
                      }); 
       
      });

   });
   $(".update-group-sub").click(function(event)
   {
    event.preventDefault();
    $( "#allgroupname1" ).validate();
  
     var searchIDs1 =  $('#find-table1').val();
	 
	   if($("#recipientname1").val()=='' || searchIDs1 =='[]')
		   {
			   if($("#recipientname1").val()=='')
			   $(".errorsgroup").html("Group Name cannot be empty");
			    if(searchIDs1 =='[]')
			   $(".errorsgroupemail").html("Add atleast one Email Id in Group");
			   return false
		   }
	     $('.update-group-sub').prop('disabled', true);
           var reg_nonce1 = $('#vb_update_edit_nonce').val();
          var recipientname1 = $("#recipientname1").val();
      var groupid = $("#groupidedit").val();
       

             jQuery.ajax({

                        type:"POST",

                        dataType: 'json',

                        url:ajaxurl,

                        data: {

                          action: "update_group_writers",                         
                            nonce: reg_nonce1,
                            groupid : groupid,
                         recipientname : recipientname1,    
                          searchIDs : searchIDs1,                      

                        },

                        success: function(results){

                          console.log(results);

                          if(results.create==true)

                          {
                             swal({

                                        title: results.message,

                                        text: 'Group Updated',

                                          type: "success",

                                        timer: 1000,

                                        showCancelButton: false,

                                        showConfirmButton: false

                                      });                       
                             location.reload();
                         
                           $('form#login_form p.status').text(results.message);

                          }else{

                       alert("error");

                          }   

                        },

                        error: function(results) {

                        }

                      }); 

   });
   
   $(".create-group").click(function(event)
   {
	    $( "#allgroupname" ).validate();
	   
    event.preventDefault();
	      var searchIDs =  $('#find-table').val();
	 
	   if($("#recipientname").val()=='' || searchIDs =='[]')
		   {
			   if($("#recipientname").val()=='')
			   $(".errorsgroup").html("Group Name cannot be empty");
			    if(searchIDs =='[]')
			   $(".errorsgroupemail").html("Add atleast one Email Id in Group");
			   return false
		   }
	   
	   
	 
	//  console.log($('#find-table').multiple_emails());
	  // return false;
    
     $('.create-group').prop('disabled', true);
           var reg_nonce = $('#vb_update_create_nonce').val();
          var recipientname = $("#recipientname").val();
      
        

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
                         
                           $('form#login_form p.status').text(results.message);

                          }else{

                       alert("error");

                          }   

                        },

                        error: function(results) {

                        }

                      }); 
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
$(function() {
			//To render the input device to multiple email input using SemanticUI icon
		//	$('#find-table').multiple_emails({theme: "SemanticUI"});
    //  $('#find-table1').multiple_emails({theme: "SemanticUI"});
			//Shows the value of the input device, which is in JSON format
			$('#find-table').text($('#v').val());
      $('#find-table1').text($('#v').val());
			$('#find-table').change( function(){
				$('#current_emailsSUI').text($(this).val());
			});
      $('#find-table1').change( function(){
				$('#current_emailsSUI1').text($(this).val());
			});
      $(".multiple_emails-input").attr("placeholder", "Enter Email Id");
   
		});
    $(document).on("click", ".createGroupmodal", function () {
		$(".multiple_emails-container").remove();
      $('#find-table').multiple_emails({theme: "SemanticUI"});
      $(".multiple_emails-input").attr("placeholder", "Enter Email Id");
    });
    
    $(document).on("click", ".editopopup", function () {
      $("#find-table1").val('');
      $(".multiple_emails-container").remove();
datavalue = $(this).attr("data-value");
dataname = $(this).attr("data-name");
dataid = $(this).attr("data-id");
$("#recipientname1").val(dataname);
$("#groupidedit").val(dataid);
$("#find-table1").val(datavalue);
$('#find-table1').multiple_emails({theme: "SemanticUI"});

    });
    
    (function( $ ){

$.fn.multiple_emails = function(options) {

    // Default options
    var defaults = {
        checkDupEmail: true,
        theme: "Bootstrap",
        position: "top"
    };

    // Merge send options with defaults
    var settings = $.extend( {}, defaults, options );

    var deleteIconHTML = "";
    if (settings.theme.toLowerCase() == "Bootstrap".toLowerCase())
    {
        deleteIconHTML = '<a href="#" class="multiple_emails-close" title="Remove"><span class="glyphicon glyphicon-remove"></span></a>';
    }
    else if (settings.theme.toLowerCase() == "SemanticUI".toLowerCase() || settings.theme.toLowerCase() == "Semantic-UI".toLowerCase() || settings.theme.toLowerCase() == "Semantic UI".toLowerCase()) {
        deleteIconHTML = '<a href="#" class="multiple_emails-close" title="Remove"><i class="remove icon"></i></a>';
    }
    else if (settings.theme.toLowerCase() == "Basic".toLowerCase()) {
        //Default which you should use if you don't use Bootstrap, SemanticUI, or other CSS frameworks
        deleteIconHTML = '<a href="#" class="multiple_emails-close" title="Remove"><i class="basicdeleteicon">Remove</i></a>';
    }

    return this.each(function() {
        //$orig refers to the input HTML node
        var $orig = $(this);
        var $list = $('<ul class="multiple_emails-ul" />'); // create html elements - list of email addresses as unordered list

        if ($(this).val() != '' && IsJsonString($(this).val())) {
            $.each(jQuery.parseJSON($(this).val()), function( index, val ) {
                $list.append($('<li class="multiple_emails-email"><span class="email_name" data-email="' + val.toLowerCase() + '">' + val + '</span></li>')
                  .prepend($(deleteIconHTML)
                       .click(function(e) { $(this).parent().remove(); refresh_emails(); e.preventDefault(); })
                  )
                );
            });
        }

        var $input = $('<input type="text" class="multiple_emails-input text-left" placeholder="Friend\'s Email" />').on('keyup', function(e) { // input
            $(this).removeClass('multiple_emails-error');
            var input_length = $(this).val().length;

            var keynum;
            if(window.event){ // IE
                keynum = e.keyCode;
            }
            else if(e.which){ // Netscape/Firefox/Opera
                keynum = e.which;
            }

            //if(event.which == 8 && input_length == 0) { $list.find('li').last().remove(); } //Removes last item on backspace with no input

            // Supported key press is tab, enter, space or comma, there is no support for semi-colon since the keyCode differs in various browsers
            if(keynum == 9 || keynum == 32 || keynum == 188) {
                display_email($(this), settings.checkDupEmail);
            }
            else if (keynum == 13) {
                display_email($(this), settings.checkDupEmail);
                //Prevents enter key default
                //This is to prevent the form from submitting with  the submit button
                //when you press enter in the email textbox
                e.preventDefault();
            }

        }).on('blur', function(event){
            if ($(this).val() != '') { display_email($(this), settings.checkDupEmail); }
        });

        var $container = $('<div class="multiple_emails-container" />').click(function() { $input.focus(); } ); // container div

        // insert elements into DOM
        if (settings.position.toLowerCase() === "top")
            $container.append($list).append($input).insertAfter($(this));
        else
            $container.append($input).append($list).insertBefore($(this));

        /*
        t is the text input device.
        Value of the input could be a long line of copy-pasted emails, not just a single email.
        As such, the string is tokenized, with each token validated individually.

        If the dupEmailCheck variable is set to true, scans for duplicate emails, and invalidates input if found.
        Otherwise allows emails to have duplicated values if false.
        */
        function display_email(t, dupEmailCheck) {

            //Remove space, comma and semi-colon from beginning and end of string
            //Does not remove inside the string as the email will need to be tokenized using space, comma and semi-colon
            var arr = t.val().trim().replace(/^,|,$/g , '').replace(/^;|;$/g , '');
            //Remove the double quote
            arr = arr.replace(/"/g,"");
            //Split the string into an array, with the space, comma, and semi-colon as the separator
            arr = arr.split(/[\s,;]+/);

            var errorEmails = new Array(); //New array to contain the errors

            var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);

            for (var i = 0; i < arr.length; i++) {
                //Check if the email is already added, only if dupEmailCheck is set to true
                if ( dupEmailCheck === true && $orig.val().indexOf(arr[i]) != -1 ) {
                    if (arr[i] && arr[i].length > 0) {
                        new function () {
                            var existingElement = $list.find('.email_name[data-email=' + arr[i].toLowerCase().replace('.', '\\.').replace('@', '\\@') + ']');
                            existingElement.css('font-weight', 'bold');
                            setTimeout(function() { existingElement.css('font-weight', ''); }, 1500);
                        }(); // Use a IIFE function to create a new scope so existingElement won't be overriden
                    }
                }
                else if (pattern.test(arr[i]) == true) {
                    $list.append($('<li class="multiple_emails-email"><span class="email_name" data-email="' + arr[i].toLowerCase() + '">' + arr[i] + '</span></li>')
                          .prepend($(deleteIconHTML)
                               .click(function(e) { $(this).parent().remove(); refresh_emails(); e.preventDefault(); })
                          )
                    );
                }
                else
                    errorEmails.push(arr[i]);
            }
            // If erroneous emails found, or if duplicate email found
            if(errorEmails.length > 0)
				{
                t.val(errorEmails.join("; ")).addClass('multiple_emails-error');
					
				}else{
                t.val("");
				$(".errorsgroupemail").html('');
			}
            refresh_emails ();
        }

        function refresh_emails () {
            var emails = new Array();
            var container = $orig.siblings('.multiple_emails-container');
            container.find('.multiple_emails-email span.email_name').each(function() { emails.push($(this).html()); });
            $orig.val(JSON.stringify(emails)).trigger('change');
        }

        function IsJsonString(str) {
            try { JSON.parse(str); }
            catch (e) { return false; }
            return true;
        }

        return $(this).hide();

    });

};

})(jQuery);
</script>


<?php get_footer(); ?>

