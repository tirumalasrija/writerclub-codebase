<?php
/**
 * Template Name: Subscribe Template
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();

?>
<div class="container">

    <div class="row justify-content-around direction-column">

      <div class="col-lg-6 col-12">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/kids-registration.svg" class="img-fluid" alt="Italian Trulli">
      </div>

     

        <div class="col-lg-6 col-12 bd-highlight outer-space">
            <form name="subscribe_form" id="subscribe_form" class="subscribe_form">

                <div class="d-flex justify-content-center mb-3 logo">
                  <img class="img-fluid" src="https://worldwidestorytellers.com/wp-content/uploads/2020/10/cropped-wwstlogofinal-removebg-preview-1-1.png" alt="logo">
                </div>

                  <div class="subscribe-buttons">
                    <h4 class="text-center mb-4">Subscribe</h4>
                   <!-- <div class="btn-group mb-4 text-center" role="group" aria-label="subscribe">
                        <button type="button" class="btn btn-warning yearly">YEARLY</button>
                        <button type="button" class="btn btn-default monthly">MONTHLY</button>
                    </div>  -->
                  </div> 
                    <!--subscription-->

                    <div class="card-columns d-flex" >
                      <div class="card">
                        <div class="card-body" data-url="add-to-cart=386">
                        <div class="radio">
                            <input  type="radio" name="plan" class="form-check-input" checked/>
                            <label class="radio-label"></label>
                          </div>
                          <p class="card-text Basic-Plan">Monthly PLAN</p>
                          <div class="mon">$0.99/Monthly</div>
                        </div>
                      </div> 
  			 		<div class="card">
                        <div class="card-body" data-url="add-to-cart=628">
                        <div class="radio">
                            <input  type="radio" name="plan" class="form-check-input" />
                            <label class="radio-label"></label>
                          </div>
                          <p class="card-text Basic-Plan">Quarterly PLAN</p>
                          <div class="mon">$3/Quarterly</div>
                        </div>
                      </div> 
                      <div class="card">
                        <div class="card-body" data-url="add-to-cart=627">
                          <div class="radio">
                            <input  data-url="add-to-cart=627" type="radio" name="plan" class="form-check-input" />
                            <label onclick='myFunction()' class="radio-label"></label>
                          </div>
                          <p class="card-text Premium-Plan">Yearly PLAN</p>
                          <div class="mon">$9/Yearly</div>
                        </div>
                      </div>

                    </div>

                    <div class="d-flex justify-content-between nav-buttons">
                      <a href="<?php echo site_url(''); ?>" title="goback" class="btn-transparent btn-nav">Go Back</a>
                      <a href="?add-to-cart=386" title="proceed to payment" id="payment" class="pay btn-nav">Proceed to Payment</a>
                    </div>

                


            </form>
        </div>

      

    </div>

</div>


<?php get_footer(); ?>

<script>
    $('.btn-group .btn').on('click',function(){
        $('.btn').addClass('btn-default').removeClass('btn-warning');
         $(this).removeClass('btn-default').addClass('btn-warning');
    });
    $('.card-body').on('click',function(){
		
		 document.getElementById('payment').href = "?"+$(this).attr('data-url');
      $('.card-body').find('.form-check-input').prop('checked',false);
      $(this).find('.form-check-input').prop('checked',true)
    });
</script>

