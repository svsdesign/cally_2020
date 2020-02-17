<?php
/**
 *  Theseus
 *  
 *  Developed by Simon van Stipriaan 
 *  http://svs.design
 *
 *  
 */
?>


<!DOCTYPE html>
<html <?php language_attributes(); ?> class="">
<head>

<!-- meta -->
<meta name="google-site-verification" content="-_1GqZ3pFQG58FsF2OJMLntsTCinTRsc7eUCSRqXJDI" />
  <meta charset="<?php bloginfo( 'charset' ); ?>"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11"/>
  <title><?php wp_title( ' ', true, 'right' ); ?></title>

  <meta property="og:title" content="<?php wp_title( ' ', true, 'right' ); ?>" />
  <meta property="og:type" content="website" />

  <meta property="og:url" content="<?php $current_url = "//" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>" />
  <meta property="og:description" content="<?php
  $site_description = get_bloginfo( 'description', 'display' );
  $site_name = get_bloginfo( 'name' );
    //for home page
  if ( $site_description && ( is_home() || is_front_page() ) ):
    echo $site_name;echo ' | '; echo  $site_description; 
  endif;
  // for other post pages
  if (!( is_home() ) && ! is_404() ):
  the_title(); echo ' | '; echo $site_name;
  endif;
  ?>" />
  <meta name="description" content="<?php
  $site_description = get_bloginfo( 'description', 'display' );
  $site_name = get_bloginfo( 'name' );
    //for home page
  if ( $site_description && ( is_home() || is_front_page() ) ):
    echo $site_name; echo ' | '; echo $site_description; 
  endif;
  // for other post pages
  if (!( is_home() ) && ! is_404() ):
  the_title(); echo ' | '; echo $site_name;
  endif;
  ?>" />

  <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/icons/apple-touch-icon.png"/>
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/icons/apple-touch-icon.png"/>
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/icons/favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/icons/favicon-16x16.png"/>
  <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/icons/site.webmanifest"/>
  <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/icons/safari-pinned-tab.svg" color="#111111"/>
  <meta name="msapplication-TileColor" content="#ffffff"/>
  <meta name="theme-color" content="#ffffff"/>
<!-- end meta -->
<!-- STYLE -->

  
<!-- END STYLE -->

<!-- SCRIPTS  - move into funcstion - apart from cookie consent ones?-->

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.easing-1.3.js" type="text/javascript"></script>
<!-- <script src="<?php//echo get_template_directory_uri(); ?>/assets/js/jquery-ui.min.js" type="text/javascript"></script> -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/enquire.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.4and5history.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/ajaxify-html5.js" type="text/javascript"></script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<!-- <script src="https://labs.nearpod.com/bodymovin/demo/events/bodymovin.js" type="text/javascript"></script>-->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/lottie.js" type="text/javascript"></script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<script type="text/ecmascript" xlink:href="<?php echo get_template_directory_uri(); ?>/assets/js/smil.user.js"></script>
 

<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUXYryE2krCQ7nIvVcXcFzWEPY0cEcXbE"></script> -->

<!-- END SCRIPTS -->


<?php /*
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46306774-2', 'auto');
  ga('send', 'pageview');

</script>
 */ ?>

<?php wp_head(); ?>
</head>

<script>
/* used for determining if we're local or live */
  theme_directory = "<?php echo get_template_directory_uri() ?>";
  home_directory = "<?php echo home_url();?>";

// determine if intro animation has been or not
  introanimationdone = false;
// determine if gmap scrip loaded or not
 var gMapsLoaded = false; // maybe I need to put this variable else where?
 //console.log("Header gMapsLoaded = " +gMapsLoaded+"");
</script>

<?php if( get_field('keep_intro_logo', 'option') == 'no' ):  
  $keep_intro_logo_class = ' hide-intro-logo'; // don't keep the intro if this option is set to no
endif; ?>


<?php if( get_field('colour_scheme', 'option') == 'black' ): ?>

 <body <?php body_class('animation-fix site-loading black-scheme dev-grid-on'.$keep_intro_logo_class.''); ?>>

<?php else: ?>

 <body <?php body_class('animation-fix site-loading white-scheme dev-grid-on'.$keep_intro_logo_class.''); ?>>

<?php endif; ?>

<?php /*
  <-- this moved from theseus-page 
  it was also wrapped in  <div id='site-wrap'> - so might need to review my overarching div struture
  to includ the navigation as well - delete this comment
*/?>

<div id="intro-area" class="visible"> 

  <?php get_template_part( 'theseus_animation' );?>

</div> <!-- #intro-area .visible --> 

<?php include( 'navigation.php' );?>

<div id="loader">
</div> <!-- loader -->

<div id="main" class="wrapper main-fixer"> <!-- ajax wrapper start -->


  <?php /*
  <-- END this moved from theseus-page  - delete this comment
*/?>
  