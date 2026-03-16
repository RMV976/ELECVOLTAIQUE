<?php
/**
 * ELECVOLTAIQUE Theme Functions
 *
 * @package elecvoltaique
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'ELECVOLTAIQUE_VERSION', '1.0.0' );
define( 'ELECVOLTAIQUE_DIR', get_template_directory() );
define( 'ELECVOLTAIQUE_URI', get_template_directory_uri() );

/* ============================================================
   THEME SETUP
   ============================================================ */
function elecvoltaique_setup() {
    load_theme_textdomain( 'elecvoltaique', ELECVOLTAIQUE_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'customize-selective-refresh-widgets' );

    register_nav_menus( array(
        'primary' => esc_html__( 'Menu principal', 'elecvoltaique' ),
        'footer'  => esc_html__( 'Menu pied de page', 'elecvoltaique' ),
    ) );
}
add_action( 'after_setup_theme', 'elecvoltaique_setup' );

/* ============================================================
   ASSETS
   ============================================================ */
function elecvoltaique_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'elecvoltaique-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Open+Sans:wght@400;600&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'elecvoltaique-style',
        get_stylesheet_uri(),
        array( 'elecvoltaique-fonts' ),
        ELECVOLTAIQUE_VERSION
    );

    // Main script
    wp_enqueue_script(
        'elecvoltaique-main',
        ELECVOLTAIQUE_URI . '/assets/js/main.js',
        array(),
        ELECVOLTAIQUE_VERSION,
        true
    );

    // Pass data to JS
    wp_localize_script( 'elecvoltaique-main', 'elecvoltaiqueData', array(
        'ajaxUrl' => esc_url( admin_url( 'admin-ajax.php' ) ),
        'nonce'   => wp_create_nonce( 'elecvoltaique_contact' ),
        'strings' => array(
            'sending' => esc_html__( 'Envoi en cours…', 'elecvoltaique' ),
            'success' => esc_html__( 'Message envoyé avec succès !', 'elecvoltaique' ),
            'error'   => esc_html__( 'Une erreur est survenue. Veuillez réessayer.', 'elecvoltaique' ),
        ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'elecvoltaique_enqueue_assets' );

/* ============================================================
   CONTENT WIDTH
   ============================================================ */
function elecvoltaique_content_width() {
    $GLOBALS['content_width'] = 1200;
}
add_action( 'after_setup_theme', 'elecvoltaique_content_width', 0 );

/* ============================================================
   WIDGETS
   ============================================================ */
function elecvoltaique_register_widgets() {
    register_sidebar( array(
        'name'          => esc_html__( 'Barre latérale', 'elecvoltaique' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Ajoutez des widgets ici.', 'elecvoltaique' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'elecvoltaique_register_widgets' );

/* ============================================================
   CONTACT FORM AJAX HANDLER
   ============================================================ */
function elecvoltaique_handle_contact() {
    check_ajax_referer( 'elecvoltaique_contact', 'nonce' );

    $name    = isset( $_POST['contact_name'] )    ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) )    : '';
    $email   = isset( $_POST['contact_email'] )   ? sanitize_email( wp_unslash( $_POST['contact_email'] ) )        : '';
    $phone   = isset( $_POST['contact_phone'] )   ? sanitize_text_field( wp_unslash( $_POST['contact_phone'] ) )   : '';
    $service = isset( $_POST['contact_service'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_service'] ) ) : '';
    $message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Veuillez remplir tous les champs obligatoires.', 'elecvoltaique' ) ) );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Adresse e-mail invalide.', 'elecvoltaique' ) ) );
    }

    $to      = get_option( 'admin_email' );
    $subject = sprintf(
        /* translators: %1$s: site name, %2$s: service name */
        esc_html__( '[%1$s] Nouvelle demande – %2$s', 'elecvoltaique' ),
        get_bloginfo( 'name' ),
        $service ? $service : esc_html__( 'Service non précisé', 'elecvoltaique' )
    );

    $body  = sprintf( "Nom    : %s\n", $name );
    $body .= sprintf( "E-mail : %s\n", $email );
    $body .= sprintf( "Tél    : %s\n", $phone ? $phone : '—' );
    $body .= sprintf( "Service: %s\n\n", $service ? $service : '—' );
    $body .= sprintf( "Message:\n%s\n", $message );

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( array( 'message' => esc_html__( 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.', 'elecvoltaique' ) ) );
    } else {
        wp_send_json_error( array( 'message' => esc_html__( 'L\'envoi a échoué. Veuillez nous contacter directement par téléphone.', 'elecvoltaique' ) ) );
    }
}
add_action( 'wp_ajax_elecvoltaique_contact',        'elecvoltaique_handle_contact' );
add_action( 'wp_ajax_nopriv_elecvoltaique_contact', 'elecvoltaique_handle_contact' );

/* ============================================================
   FALLBACK NAVIGATION MENU
   ============================================================ */
function elecvoltaique_fallback_menu() {
    echo '<ul class="site-nav__list">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Accueil', 'elecvoltaique' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/#services' ) ) . '">' . esc_html__( 'Services', 'elecvoltaique' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/#contact' ) ) . '">' . esc_html__( 'Contact', 'elecvoltaique' ) . '</a></li>';
    echo '</ul>';
}

/* ============================================================
   SERVICES DATA HELPER
   ============================================================ */
function elecvoltaique_get_services() {
    return array(
        array(
            'id'          => 'electricite',
            'icon'        => '⚡',
            'title'       => esc_html__( 'Électricité', 'elecvoltaique' ),
            'description' => esc_html__( 'Installation, mise aux normes et dépannage de tous vos équipements électriques résidentiels et tertiaires.', 'elecvoltaique' ),
            'features'    => array(
                esc_html__( 'Tableaux électriques', 'elecvoltaique' ),
                esc_html__( 'Mise aux normes NF C 15-100', 'elecvoltaique' ),
                esc_html__( 'Dépannage & urgences', 'elecvoltaique' ),
            ),
        ),
        array(
            'id'          => 'cameras',
            'icon'        => '📷',
            'title'       => esc_html__( 'Pose de caméras', 'elecvoltaique' ),
            'description' => esc_html__( 'Installation de systèmes de vidéosurveillance IP et analogiques pour la sécurité de vos locaux et domiciles.', 'elecvoltaique' ),
            'features'    => array(
                esc_html__( 'Caméras IP HD/4K', 'elecvoltaique' ),
                esc_html__( 'Enregistrement NVR/DVR', 'elecvoltaique' ),
                esc_html__( 'Accès à distance (smartphone)', 'elecvoltaique' ),
            ),
        ),
        array(
            'id'          => 'alarmes',
            'icon'        => '🚨',
            'title'       => esc_html__( 'Pose d\'alarmes', 'elecvoltaique' ),
            'description' => esc_html__( 'Conception et installation de systèmes d\'alarme intrusion et anti-incendie certifiés pour particuliers et professionnels.', 'elecvoltaique' ),
            'features'    => array(
                esc_html__( 'Alarme intrusion & incendie', 'elecvoltaique' ),
                esc_html__( 'Détecteurs de mouvement', 'elecvoltaique' ),
                esc_html__( 'Télésurveillance 24h/24', 'elecvoltaique' ),
            ),
        ),
        array(
            'id'          => 'solaire',
            'icon'        => '☀️',
            'title'       => esc_html__( 'Panneaux solaires', 'elecvoltaique' ),
            'description' => esc_html__( 'Installation de panneaux photovoltaïques pour l\'autoconsommation ou la revente d\'électricité sur le réseau.', 'elecvoltaique' ),
            'features'    => array(
                esc_html__( 'Photovoltaïque & thermique', 'elecvoltaique' ),
                esc_html__( 'Autoconsommation & revente', 'elecvoltaique' ),
                esc_html__( 'Batterie de stockage', 'elecvoltaique' ),
            ),
        ),
        array(
            'id'          => 'point-a-point',
            'icon'        => '📡',
            'title'       => esc_html__( 'Liaisons point à point', 'elecvoltaique' ),
            'description' => esc_html__( 'Déploiement de liaisons sans fil point à point ou point à multipoint pour interconnecter vos sites distants.', 'elecvoltaique' ),
            'features'    => array(
                esc_html__( 'Liaisons radio longue portée', 'elecvoltaique' ),
                esc_html__( 'Wi-Fi sectoriel & bridge', 'elecvoltaique' ),
                esc_html__( 'Étude de couverture incluse', 'elecvoltaique' ),
            ),
        ),
        array(
            'id'          => 'courant',
            'icon'        => '🔌',
            'title'       => esc_html__( 'Courant fort & faible', 'elecvoltaique' ),
            'description' => esc_html__( 'Expertise en courant fort (alimentation, distribution) et courant faible (data, voix, contrôle d\'accès).', 'elecvoltaique' ),
            'features'    => array(
                esc_html__( 'Distribution HTA/BT', 'elecvoltaique' ),
                esc_html__( 'Câblage voix / data', 'elecvoltaique' ),
                esc_html__( 'Contrôle d\'accès & interphonie', 'elecvoltaique' ),
            ),
        ),
        array(
            'id'          => 'baies',
            'icon'        => '🗄️',
            'title'       => esc_html__( 'Baies de brassage', 'elecvoltaique' ),
            'description' => esc_html__( 'Équipement et câblage de baies de brassage : patch panels, switches, organiseurs, pour une infrastructure propre et performante.', 'elecvoltaique' ),
            'features'    => array(
                esc_html__( 'Patch panels Cat 6 / Cat 6A', 'elecvoltaique' ),
                esc_html__( 'Brassage fibre optique', 'elecvoltaique' ),
                esc_html__( 'Étiquetage & documentation', 'elecvoltaique' ),
            ),
        ),
        array(
            'id'          => 'reseaux',
            'icon'        => '🌐',
            'title'       => esc_html__( 'Réseaux informatiques', 'elecvoltaique' ),
            'description' => esc_html__( 'Installation et configuration de réseaux LAN/WAN, Wi-Fi d\'entreprise, VPN et solutions de connectivité pour PME et grands comptes.', 'elecvoltaique' ),
            'features'    => array(
                esc_html__( 'LAN / WAN / Wi-Fi entreprise', 'elecvoltaique' ),
                esc_html__( 'VPN & sécurité réseau', 'elecvoltaique' ),
                esc_html__( 'Infogérance & support', 'elecvoltaique' ),
            ),
        ),
    );
}
