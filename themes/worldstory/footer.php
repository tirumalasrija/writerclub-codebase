<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
		<!-- Footer -->
<footer class="page-footer font-small mdb-color pt-4 footer-bg">

  <!-- Footer Links -->
  <div class="container text-md-left">

    <!-- Footer links -->
    <div class="row text-md-left mt-3 pb-3 footer-m row-cols-1 row-cols-sm-3 row-cols-md-3 row-cols-lg-3">
      
     <!-- Grid column -->
     <!-- <div class="col mt-3">
      <h6 class="text-uppercase mb-4 font-weight-normal color">Stories</h6>
      <ul>
       
        <li> <a href="<?php echo site_url('story-feed'); ?>" class="" >Story Feeds</a></li>
       
      </ul>
    </div> -->
    <!-- Grid column -->

    

    <!-- Grid column -->
    <div class="col mt-4">
      <h6 class="text-uppercase mb-4 font-weight-normal color">Policy</h6>
      <ul>
        <li><a href="<?php echo site_url('privacy-policy'); ?>">Terms and Conditions</a></li>
        <li><a  href="<?php echo site_url('privacy-policy'); ?>" >Privacy Policy</a></li>
      </ul>
    </div>
    <!-- Grid column -->

    

    <!-- Grid column -->
    <!-- <div class="col mt-3">
      <h6 class="text-uppercase mb-4 font-weight-normal color">Services</h6>
      <ul>
        <li> <a href="<?php echo site_url('story-feed'); ?>">Story Feed</a></li>
     
      </ul>
    </div> -->

	<!-- Grid column -->
      <div class="col mt-4">
        <h6 class="text-uppercase mb-4 font-weight-normal color">Contact</h6>
        <ul>         
          <li><a href="#"><i class="fas fa-envelope mr-3"></i>worldwidestorytellers@gmail.com</a></li>  
          <li><a href="#"><i class="fas fa-phone mr-3"></i>+91 95632 23658</a></li>       
        </ul>
           <!-- Social buttons -->
        <div class="text-center text-md-left ">
          <ul class="list-unstyled list-inline">
            <li class="list-inline-item">
              <a  href="#" class="btn-floating btn-sm rgba-white-slight mx-1 ">
                <i class="fab fa-facebook-f social"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a  href="#" class="btn-floating btn-sm rgba-white-slight mx-1">
                <i class="fab fa-twitter social"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a  href="#" class="btn-floating btn-sm rgba-white-slight mx-1">
                  <i class="fab fa-linkedin-in social"></i>
               
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#" class="btn-floating btn-sm rgba-white-slight mx-1">
                  <i class="fab fa-instagram social"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <!-- Grid column -->	

      <div class="col mt-4">
          <h6 class="text-uppercase mb-4 font-weight-normal color">Subscribe Now</h6>
          <?php echo do_shortcode('[email-subscribers-form id="1"]'); ?>
      </div>

    </div>
    <!-- Footer links -->

    <!-- Modal -->
<div class="modal fade" id="video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
      <video width="100%" height="420" controls autoplay="true">
        <source src="<?php echo get_template_directory_uri(); ?>/assets/homepage_vid.mp4" type="video/mp4">
      Your browser does not support the video tag.
      </video> 
        
      </div>
      
    </div>
  </div>
</div>
   

  </div>
  <!-- Footer Links -->

</footer>
<!-- Footer -->
  

   <script type="text/javascript">$('.nav-item').on('click',function(){
        $('.nav-item .nav-link').removeClass('active');
        $(this).find('.nav-link').addClass('active');
    });

    $('.navbar-toggler').on('click',function(){
        $('.overlay').toggleClass('show');
        setTimeout(() => {
            if($('.overlay').hasClass('show')){
                $('body').addClass('overflow-hide');
            }else{
                $('body').removeClass('overflow-hide');
            }
        }, 300);      
    });
  

    $('.overlay').on('click',function(){
       $(this).removeClass('show');
        $('.collapse').removeClass('show');
        $('body').removeClass('overflow-hide');
    });</script>
    <?php wp_footer(); ?>
    
    <script>
      document.addEventListener("DOMContentLoaded", function(){
        $("#video").modal('show');
      });
      
    </script>

	</body>
</html>
