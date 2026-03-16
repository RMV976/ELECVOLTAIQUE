<footer class="site-footer" role="contentinfo">
    <div class="container">

        <div class="footer-grid">

            <!-- Brand column -->
            <div class="footer-brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
                    <span class="site-logo__icon" aria-hidden="true">⚡</span>
                    <span class="site-logo__text">ELEC<span>VOLTAIQUE</span></span>
                </a>
                <p class="footer-brand__tagline">
                    <?php esc_html_e( 'Votre expert en électricité, sécurité, énergie solaire et réseaux informatiques.', 'elecvoltaique' ); ?>
                </p>
            </div>

            <!-- Services links -->
            <div>
                <p class="footer-title"><?php esc_html_e( 'Nos services', 'elecvoltaique' ); ?></p>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url( home_url( '/#electricite' ) ); ?>"><?php esc_html_e( 'Électricité', 'elecvoltaique' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#cameras' ) ); ?>"><?php esc_html_e( 'Pose de caméras', 'elecvoltaique' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#alarmes' ) ); ?>"><?php esc_html_e( 'Pose d\'alarmes', 'elecvoltaique' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#solaire' ) ); ?>"><?php esc_html_e( 'Panneaux solaires', 'elecvoltaique' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#point-a-point' ) ); ?>"><?php esc_html_e( 'Liaisons point à point', 'elecvoltaique' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#courant' ) ); ?>"><?php esc_html_e( 'Courant fort & faible', 'elecvoltaique' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#baies' ) ); ?>"><?php esc_html_e( 'Baies de brassage', 'elecvoltaique' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#reseaux' ) ); ?>"><?php esc_html_e( 'Réseaux informatiques', 'elecvoltaique' ); ?></a></li>
                </ul>
            </div>

            <!-- Contact info -->
            <div>
                <p class="footer-title"><?php esc_html_e( 'Contact', 'elecvoltaique' ); ?></p>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>"><?php esc_html_e( 'Formulaire de contact', 'elecvoltaique' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Accueil', 'elecvoltaique' ); ?></a></li>
                    <li><a href="<?php echo esc_url( get_privacy_policy_url() ); ?>"><?php esc_html_e( 'Politique de confidentialité', 'elecvoltaique' ); ?></a></li>
                </ul>
            </div>

        </div><!-- .footer-grid -->

        <div class="footer-bottom">
            <p>
                &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
                <?php bloginfo( 'name' ); ?>.
                <?php esc_html_e( 'Tous droits réservés.', 'elecvoltaique' ); ?>
            </p>
            <p><?php esc_html_e( 'Réalisé avec ❤️ pour vos projets électriques.', 'elecvoltaique' ); ?></p>
        </div>

    </div><!-- .container -->
</footer><!-- .site-footer -->

<?php wp_footer(); ?>
</body>
</html>
