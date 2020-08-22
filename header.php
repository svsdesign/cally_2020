<?php
/**
 *  Cally 2020
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

  <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/dist/icons/apple-touch-icon.png"/>
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/dist/icons/apple-touch-icon.png"/>
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/dist/icons/favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/dist/icons/favicon-16x16.png"/>
  <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/dist/icons/site.webmanifest"/>
  <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/dist/icons/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#ffffff"/>
  <meta name="theme-color" content="#ffffff"/>


<!-- end meta -->
 

<?php wp_head(); ?>

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
</head>


<?php if( get_field('keep_intro_logo', 'option') == 'no' ):  
  $keep_intro_logo_class = ' hide-intro-logo'; // don't keep the intro if this option is set to no
 else:  
  $keep_intro_logo_class = '';

endif; ?>


<?php if( get_field('colour_scheme', 'option') == 'black' ): ?>

 <body data-barba="wrapper" <?php body_class('animation-fix site-loading black-scheme dev-grid-on can-edit'.$keep_intro_logo_class.''); ?>>

<?php else: ?>

 <body data-barba="wrapper" <?php body_class('animation-fix site-loading white-scheme dev-grid-on can-edit'.$keep_intro_logo_class.''); ?>>

<?php endif; ?>
 

<div id="intro-area" class="visible"> 

  <?php get_template_part( 'cally_animation' );?>

</div> <!-- #intro-area .visible --> 

<?php include( 'navigation.php' );?>

<div id="loader">
</div> <!-- loader -->
<?php 
/* we need to move the following div, with data-barba="container" into the inde,page,post etc php files */
?>
<div id="main" class="wrapper main-fixer">

