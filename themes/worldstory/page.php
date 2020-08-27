<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header(); ?>
<style>
	
        a.button.wc-backward {
    background: linear-gradient(to right, #f5ab29, #f6c343);
    border-radius: 25px !important;
    border: none;
    color: #fff;
}
.cart-empty.woocommerce-info {
    border-top-color: #f6c242;
}
.cart-empty.woocommerce-info::before {
    color: #f6bf3f;
}
 
    .form-row {
   display: flex;
}
.woocommerce-billing-fields .form-row, .woocommerce-shipping-fields .form-row,.woocommerce form .form-row {
display: block;
}
 
.woocommerce .col2-set .col-1, .woocommerce-page .col2-set .col-1,.woocommerce .col2-set .col-2, .woocommerce-page .col2-set .col-2 {
max-width: unset;
}
	.woocommerce form .form-row {
    width: 100% !important;
}
.woocommerce-checkout #payment div.payment_box input.input-text, .woocommerce-checkout #payment div.payment_box textarea {
    width: 100% !important;
    padding: 8px;
}
.woocommerce #payment .form-row select, .woocommerce-page #payment .form-row select {
    width: 100%;
    height: 30px;
}
.woocommerce .col2-set .col-1, .woocommerce-page .col2-set .col-1,.woocommerce .col2-set .col-2, .woocommerce-page .col2-set .col-2 {
    float: left;
    width: 100%;
} 
	@media (min-width: 981px) {
  .woocommerce { overflow: hidden;}
  .woocommerce:after { clear: both; }
  .woocommerce .col2-set .col-1, .woocommerce-page .col2-set .col-1 { width: 100%; }
  .woocommerce .col2-set .col-2, .woocommerce-page .col2-set .col-2 { display: none; }
  .woocommerce .col2-set, .woocommerce-page .col2-set { float:left; width: 48%; }
  #order_review_heading, .woocommerce #order_review, .woocommerce-page #order_review {
    float: left;
    width:48%;
    margin-left: 2%;
  }
}
 
/* Rounded corners on the WooCommerce "alert" messages */
.woocommerce-error, .woocommerce-info, .woocommerce-message { border-radius: 5px; }
 
/* Section Titles */
 
h3 {
    font-size: 1.75rem;
    color: #d63663;
}
 
/* FORM STYLING */

.select2-container .select2-selection--single { height: 40px; }
.select2-container--default .select2-selection--single .select2-selection__rendered {
  line-height: 40px;
  color: #4e4e4e;
  font-weight: bold;
}
.select2-container--default .select2-selection--single .select2-selection__arrow b { margin-top: 8px; }
.select2-container--default .select2-selection--single {
  background-color: rgba(0, 1, 0, 0.01);
  border: none;
}
 
.elementor-widget-text-editor {
    color: #492f70;
    font-family: "Roboto", Sans-serif;
    font-weight: 400;
}
 
/* YOUR ORDER FIELD TITLES */

table th {
    font-weight: bold;
    color: #492f70;
}

/* PAYMENT METHOD AREA*/

.woocommerce-checkout #payment { background: rgba(0, 1, 0, 0.01)!important; }
.woocommerce-checkout #payment ul.payment_methods { border: none; }

/* PLACE ORDER BUTTON CUSTOMIZATION */
 
#place_order {
  background-image: linear-gradient(90deg,#d63663 0%,#492f70 100%)!important;
  border: transparent;
  color: #fff;
  box-shadow: rgba(0, 0, 0, 0.30) 0px 2px 8px 0px;
  padding: 10px;
}
 
#place_order:hover { background-image: linear-gradient(90deg,#492f70 0%,#d63663 100%)!important; }

input.text, input.title, input[type="email"], input[type="password"], input[type="tel"], input[type="text"], select, textarea {
    border: none;
    color: #010101;
    height: 50px;
    width: 100%;
}

.woocommerce form .form-row textarea, .woocommerce input[type="email"], .woocommerce input[type="number"], .woocommerce input[type="password"], .woocommerce input[type="reset"], .woocommerce input[type="search"], .woocommerce input[type="tel"], .woocommerce input[type="text"], .woocommerce input[type="url"], .woocommerce textarea, .woocommerce-page form .form-row textarea, .woocommerce-page input[type="email"], .woocommerce-page input[type="number"], .woocommerce-page input[type="password"], .woocommerce-page input[type="reset"], .woocommerce-page input[type="search"], .woocommerce-page input[type="tel"], .woocommerce-page input[type="text"], .woocommerce-page input[type="url"], .woocommerce-page textarea {
    border-color: #ddd;
    background: #f0f0f0;
    box-shadow: none;
    border-radius: 0;
}
	@media only screen and (max-width: 600px) { 
	.woocommerce-cart-form{ width: 100% !important}
		li.woocommerce-cart-form__cart-item{ flex-direction: column;!important}
	}
	
</style>
<div class="container pt-60" style="padding-bottom:60px">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();

				the_content();
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
