

<?php get_header(); ?>

<style>

    .jqvmap-label {

        color:#fff !important;

    }

</style>

<div class="my-custom-class">

    <div class="container">

             <!-- Top banner -->

             <div class="col-12 position-relative top-banner">

            <div class="row"><img src="<?php echo get_template_directory_uri(); ?>/assets/WorldwideStorytellers_HomeBanner-01.jpg" class="img-fluid"/></div>

            <!-- <div class="position-absolute d-flex flex-column align-items-center content">

                <h2 class="heading">Explore the world of stories</h2>

                <p>Read stories from kids all around the new world explore a new world of fictional and non-fictionl stories and write your own beautiful stories.</p>

                <a  [routerLink]="['/login']" class="btn btn-secondary getstart">Get started!</a>

            </div> -->

        </div>

        <!-- Map -->

        <div class="d-flex flex-column align-items-center map_container">
 <?php if(!is_user_logged_in()) { ?>
                <h2 class="heading">Writers All Around the World</h2>
<?php }else{ ?>
   <h2 class="heading">Writers All Around the World login</h2>
<?php } ?>
        <div id="vmap" style="width:100%; height: 400px;"></div>

        

        <!-- How it Works -->

        <div class="d-flex flex-column align-items-center how_it_work_container col-12">

            <h2 class="heading">Writers All Around the World</h2>

                <div class="d-flex flex-row justify-content-center flex-wrap pb-5">

                    <div class="row justify-content-center">





 <?php $allcat=get_categories(array( 'exclude'  => array(1),'number' => 4, 'hide_empty' =>false,'orderby' => 'name','order' => 'ASC',));

$taxonomy="category";

$i=0;

foreach($allcat as $value)

{

  $valueapla = '';

  if($i==0)

  {

  $valueapla='one';

  }else if($i==1)

  {

  $valueapla='two';

  }else if($i==2)

  {

  $valueapla='three';

  }else {

  $valueapla='four';

  }



 ?>



                        <div class="col-sm-5 col-12">

                        

                                <div class="img"><a href="<?php echo  site_url('story-feed'); ?>?cat=<?= $value->term_id ?>"><img src="<?php echo get_field('category_image',$taxonomy . '_' . $value->term_id); ?>" class="img-fluid"/></a></div>

                                <div class="oneimg"><img src="<?php echo get_template_directory_uri(); ?>/assets/<?php echo  $valueapla; ?>.jpg" class="img-fluid"/></div>

                               <a href="<?php echo  site_url('story-feed'); ?>?cat=<?= $value->term_id ?>"> <h5>Write a Story in Bongos Writers Club</h5></a>

                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>

                            

                        </div>



                      <?php $i++; }   ?>



                      <!--  <div class="col-sm-5 col-12">

                            

                                <div class="img"><img src="<?php echo get_template_directory_uri(); ?>/assets/how_to_work_2.jpg" class="img-fluid"/></div>

                                <div class="oneimg"><img src="<?php echo get_template_directory_uri(); ?>/assets/two.jpg" class="img-fluid"/></div>

                                <h5>Real World Wide Stories</h5>

                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

                            

                        </div>



                        <div class="col-sm-5 col-12">

                            

                                <div class="img"><img src="<?php echo get_template_directory_uri(); ?>/assets/how_to_work_3.jpg" class="img-fluid"/></div>

                                <div class="oneimg"><img src="<?php echo get_template_directory_uri(); ?>/assets/three.jpg" class="img-fluid"/></div>

                                <h5>Read and write on Any Device</h5>

                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

                            

                        </div>



                        <div class="col-sm-5 col-12">

                        

                                <div class="img"><img src="<?php echo get_template_directory_uri(); ?>/assets/how_to_work_3.jpg" class="img-fluid"/></div>

                                <div class="oneimg"><img src="<?php echo get_template_directory_uri(); ?>/assets/four.jpg" class="img-fluid"/></div>

                                <h5>Order the Books</h5>

                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

                            

                        </div> -->

                    </div>

                </div> 

        </div>

        <!-- Write Your Heart Out -->

        <div class="d-flex flex-row align-items-center write_your_container col-12">

            <div class="row">

                <div class="col-sm-5 col-12 pl-5 ho">

                    <h5 class="heading">Write Your Heart Out</h5>

                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

                    <button type="button" class="btn btn-secondary white_button">Get started!</button>

                </div>

                <!-- <div class="col-6"><img src="/<?php echo get_template_directory_uri(); ?>/assets/writing_bg.jpg" class="img-fluid"/></div> -->

            </div>

        </div>

    </div>

</div>



<?php 



$post_list = get_posts( array(

    'orderby'    => 'menu_order',

    'sort_order' => 'asc',

      'meta_key' => '_country_code'

) );

 

$posts = array();

 

foreach ( $post_list as $post ) {

    $posts[] = get_post_meta($post->ID,'_country_code', true );

}



?>

 <script> var allvalue = <?php echo json_encode(array_count_values($posts)); ?>; </script>

 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.vmap.min.js"></script>

    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.vmap.world.js" charset="utf-8"></script>

    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.vmap.sampledata.js"></script>

    <script>

       function highlightRegionOfCountry (cc) {

         

            jQuery('#vmap').vectorMap('highlight',cc);

            alert(cc)

         }

         

         function unhighlightRegionOfCountry (cc) {

           

             jQuery('#vmap').vectorMap('unhighlight',cc);

         }

          var sample_data={"af":"16.63","al":"11.58","dz":"158.97","ao":"85.81","ag":"1.1","ar":"351.02","am":"8.83","au":"1219.72","at":"366.26","az":"52.17","bs":"7.54","bh":"21.73","bd":"105.4","bb":"3.96","by":"52.89","be":"461.33","bz":"1.43","bj":"6.49","bt":"1.4","bo":"19.18","ba":"16.2","bw":"12.5","br":"2023.53","bn":"11.96","bg":"44.84","bf":"8.67","bi":"1.47","kh":"11.36","cm":"21.88","ca":"1563.66","cv":"1.57","cf":"2.11","td":"7.59","cl":"199.18","cn":"5745.13","co":"283.11","km":"0.56","cd":"12.6","cg":"11.88","cr":"35.02","ci":"22.38","hr":"59.92","cy":"22.75","cz":"195.23","dk":"304.56","dj":"1.14","dm":"0.38","do":"50.87","ec":"61.49","eg":"216.83","sv":"21.8","gq":"14.55","er":"2.25","ee":"19.22","et":"30.94","fj":"3.15","fi":"231.98","fr":"2555.44","ga":"12.56","gm":"1.04","ge":"11.23","de":"3305.9","gh":"18.06","gr":"305.01","gd":"0.65","gt":"40.77","gn":"4.34","gw":"0.83","gy":"2.2","ht":"6.5","hn":"15.34","hk":"226.49","hu":"132.28","is":"12.77","in":"1430.02","id":"695.06","ir":"337.9","iq":"84.14","ie":"204.14","il":"201.25","it":"2036.69","jm":"13.74","jp":"5390.9","jo":"27.13","kz":"129.76","ke":"32.42","ki":"0.15","kr":"986.26","undefined":"5.73","kw":"117.32","kg":"4.44","la":"6.34","lv":"23.39","lb":"39.15","ls":"1.8","lr":"0.98","ly":"77.91","lt":"35.73","lu":"52.43","mk":"9.58","mg":"8.33","mw":"5.04","my":"218.95","mv":"1.43","ml":"9.08","mt":"7.8","mr":"3.49","mu":"9.43","mx":"1004.04","md":"5.36","mn":"5.81","me":"3.88","ma":"91.7","mz":"10.21","mm":"35.65","na":"11.45","np":"15.11","nl":"770.31","nz":"138","ni":"6.38","ne":"5.6","ng":"206.66","no":"413.51","om":"53.78","pk":"174.79","pa":"27.2","pg":"8.81","py":"17.17","pe":"153.55","ph":"189.06","pl":"438.88","pt":"223.7","qa":"126.52","ro":"158.39","ru":"1476.91","rw":"5.69","ws":"0.55","st":"0.19","sa":"434.44","sn":"12.66","rs":"38.92","sc":"0.92","sl":"1.9","sg":"217.38","sk":"86.26","si":"46.44","sb":"0.67","za":"354.41","es":"1374.78","lk":"48.24","kn":"0.56","lc":"1","vc":"0.58","sd":"65.93","sr":"3.3","sz":"3.17","se":"444.59","ch":"522.44","sy":"59.63","tw":"426.98","tj":"5.58","tz":"22.43","th":"312.61","tl":"0.62","tg":"3.07","to":"0.3","tt":"21.2","tn":"43.86","tr":"729.05","tm":0,"ug":"17.12","ua":"136.56","ae":"239.65","gb":"2258.57","us":"14624.18","uy":"40.71","uz":"37.72","vu":"0.72","ve":"285.21","vn":"101.99","ye":"30.02","zm":"15.69","zw":"5.57"};

        

         jQuery(document).ready(function() {

           jQuery('#vmap').vectorMap({

               map: 'world_en',

               backgroundColor: '#fff',

               color: '#ffffff',

               hoverOpacity: 0.7,

               selectedColor: '#666666',



               enableZoom: false,

               showTooltip: true,

              values: sample_data,

              scaleColors: ['#C8EEFF', '#006491'],

               normalizeFunction: 'polynomial',

               onLabelShow: function(event, label, code)

               {  

               //  alert(label[0].innerHTML)

                 let countryName = label[0].innerHTML;

                 console.log(allvalue[code])

                 let content=countryName+"( No Writers)";

                 let countStories=allvalue[code];

                 if(countStories)

                 {

                  if(countStories>1)

                  {

                     content=countryName+"( "+countStories+" Writers )";

                  }else 

                  {

                   content=countryName+"( "+countStories+" Writer )";

                  }

                 }

            /*     let countStories=self.value[code];

                 let content;

                 if(countStories>1)

                 {

                    content=countStories+" Stories";

                 }else 

                 {

                  content=countStories+" story";

                 }

                 if(countStories==0)

                 {

                    content=" No stories";

                 }

                 console.log(countStories);

                 console.log(countStories["in"]); */

               

                 var html = ['<table>',

                   '<tr>',

                     '<td style="color:#fff">',content,'</td>',

                   '</tr></table>'

                 ].join("");



                 label[0].innerHTML = html;

               

               },

              

               

           });

       });

         

    

    

    </script>

<?php get_footer(); ?>