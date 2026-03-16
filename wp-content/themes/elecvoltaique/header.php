<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e( 'Aller au contenu', 'elecvoltaique' ); ?></a>

<header class="site-header" role="banner">
    <div class="container site-header__inner">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <span class="site-logo__icon" aria-hidden="true">⚡</span>
                <span class="site-logo__text">
                    ELEC<span>VOLTAIQUE</span>
                </span>
            <?php endif; ?>
        </a>

        <!-- Primary navigation -->
        <nav class="site-nav" id="site-navigation" aria-label="<?php esc_attr_e( 'Menu principal', 'elecvoltaique' ); ?>">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'menu_class'     => 'site-nav__list',
                'fallback_cb'    => 'elecvoltaique_fallback_menu',
            ) );
            ?>
        </nav>

        <!-- Mobile toggle -->
        <button class="nav-toggle" id="nav-toggle" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e( 'Ouvrir le menu', 'elecvoltaique' ); ?>">
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div><!-- .site-header__inner -->
</header><!-- .site-header -->
