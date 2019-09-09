<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package edsBootstrap
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	$edsbootstrap_options = get_theme_mod( 'edsbootstrap_theme_options' );
?>

<!-- Preloader -->
<!--<div id="preloader">
    <div class="loader"></div>
</div>-->
<!-- /Preloader -->
<!-- Header -->
<header id="home" class="header">

    <!-- Navigation -->
    <nav id="navigation" class="navbar affix">
		<?php if( get_theme_mod( 'edsbootstrap_theme_options_contact_info','0') == 1 ||  get_theme_mod( 'edsbootstrap_theme_options_socialheader','0') == 1):?>  
        <!-- Company Information -->
        <div class="information hidden-sm hidden-xs">
            <div class="container">
                <div class="row">
                	<!-- Feedback -->
					<?php if( get_theme_mod( 'edsbootstrap_theme_options_contact_info','0') == 1 ):?>   
                    <div class="col-md-7">
                    	<?php foreach ($edsbootstrap_options['info'] as $key => $info):?>
                            <span><i class="icon <?php echo esc_html($key);?>"></i> <?php echo esc_html( $info );?></span>
                        <?php endforeach;?>
                    </div>
                    <?php endif; ?>
                    <!-- /Feedback -->
                    
					<?php if( get_theme_mod( 'edsbootstrap_theme_options_socialheader','0') == 1 ):?> 
                    <!-- Social -->
                    <div class="col-md-5 pull-right">
                        <ul class="social">
                         <?php foreach ($edsbootstrap_options['social'] as $key => $social):?>
                            <li><a href="<?php echo esc_url( $social );?>" class="fa fa-fw <?php echo esc_html($key);?>" target="_blank"></a></li>
                          <?php endforeach;?>
                        </ul>
                    </div>
                    <!-- /Social -->
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <!-- /Company Information -->
		<?php endif; ?>
        <div class="container">

            <div class="row">
                <div class="col-md-12">

                    <!-- Navigation Header -->
                    <div class="navbar-header">

                        <!-- Toggle Button -->
                        <button type="button"
                                class="navbar-toggle collapsed"
                                data-toggle="collapse"
                                data-target="#main-menu"
                                aria-expanded="false"
                                aria-controls="main-menu">

                            <span class="sr-only"><?php esc_html_e('Toggle Navigation', 'edsbootstrap');?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>

                        </button>
                        <!-- /Toggle Button -->

                        <!-- Brand -->
                       
                        
                         <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"> 
							<?php
                            if (has_custom_logo()) {
                                 the_custom_logo();
                            } else { ?>
                                <h1 class='logo_text'><?php bloginfo( 'name' ) ?></h1>
                                <?php
                                $description = get_bloginfo( 'description' );
                                if ( $description ) {
                                    echo  '<p class="site-description">' . esc_attr( $description ) . '</p>' ;
                                }
                            }
                            ?>
                       </a>
                        <!-- /Brand -->

                    </div>
                    <!-- /Navigation Header -->

                    <!-- Navigation -->
					<?php
                        wp_nav_menu( array(
                            'theme_location'    => 'primary',
                            'depth'             => 3,
                            'container'         => 'div',
                            'container_class'   => 'navbar-collapse collapse',
                            'container_id'      => 'main-menu',
                            'menu_class'        => 'nav navbar-nav navbar-right',
                            'fallback_cb'       => 'edsbootstrap_bootstrap_navwalker::fallback',
                            'walker'            => new edsbootstrap_bootstrap_navwalker())
                        );
                    ?>
                    <!-- /Navigation -->

                </div>
            </div>

        </div>
    </nav>
    <!-- /Navigation -->

</header>
<!-- /Header -->


