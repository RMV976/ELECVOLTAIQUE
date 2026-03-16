<?php
/**
 * Homepage / Front-page template
 *
 * @package elecvoltaique
 */

get_header();
$services = elecvoltaique_get_services();
?>

<main id="main-content" role="main">

    <!-- ============================================================
         HERO SECTION
         ============================================================ -->
    <section class="hero" aria-label="<?php esc_attr_e( 'Présentation', 'elecvoltaique' ); ?>">
        <div class="container">
            <div class="hero__content">

                <p class="hero__badge">
                    <span aria-hidden="true">⚡</span>
                    <?php esc_html_e( 'Expert en électricité & réseaux', 'elecvoltaique' ); ?>
                </p>

                <h1 class="hero__title">
                    <?php esc_html_e( 'Solutions électriques & numériques pour', 'elecvoltaique' ); ?>
                    <em><?php esc_html_e( 'particuliers et professionnels', 'elecvoltaique' ); ?></em>
                </h1>

                <p class="hero__description">
                    <?php esc_html_e( 'Électricité, vidéosurveillance, alarmes, panneaux solaires, liaisons point à point, courant fort et faible, baies de brassage, réseaux informatiques — une seule entreprise pour tous vos besoins.', 'elecvoltaique' ); ?>
                </p>

                <div class="hero__cta">
                    <a href="#contact" class="btn btn--primary">
                        <?php esc_html_e( 'Demander un devis', 'elecvoltaique' ); ?>
                    </a>
                    <a href="#services" class="btn btn--outline">
                        <?php esc_html_e( 'Nos services', 'elecvoltaique' ); ?>
                    </a>
                </div>

                <div class="hero__stats" aria-label="<?php esc_attr_e( 'Chiffres clés', 'elecvoltaique' ); ?>">
                    <div>
                        <span class="hero__stat-number">8+</span>
                        <span class="hero__stat-label"><?php esc_html_e( 'Services', 'elecvoltaique' ); ?></span>
                    </div>
                    <div>
                        <span class="hero__stat-number">100%</span>
                        <span class="hero__stat-label"><?php esc_html_e( 'Satisfaction', 'elecvoltaique' ); ?></span>
                    </div>
                    <div>
                        <span class="hero__stat-number">24h</span>
                        <span class="hero__stat-label"><?php esc_html_e( 'Réactivité', 'elecvoltaique' ); ?></span>
                    </div>
                </div>

            </div>
        </div>
    </section><!-- .hero -->

    <!-- ============================================================
         SERVICES SECTION
         ============================================================ -->
    <section class="section section--alt" id="services" aria-labelledby="services-heading">
        <div class="container">

            <div class="section__header">
                <span class="section__subtitle"><?php esc_html_e( 'Ce que nous faisons', 'elecvoltaique' ); ?></span>
                <h2 class="section__title" id="services-heading">
                    <?php esc_html_e( 'Nos prestations', 'elecvoltaique' ); ?>
                </h2>
                <p class="section__description">
                    <?php esc_html_e( 'De l\'installation électrique à la mise en réseau, nous couvrons tous vos besoins en un seul interlocuteur.', 'elecvoltaique' ); ?>
                </p>
            </div>

            <div class="services-grid">
                <?php foreach ( $services as $service ) : ?>
                <article class="service-card" id="<?php echo esc_attr( $service['id'] ); ?>" aria-labelledby="service-title-<?php echo esc_attr( $service['id'] ); ?>">

                    <div class="service-card__icon" aria-hidden="true">
                        <?php echo esc_html( $service['icon'] ); ?>
                    </div>

                    <h3 class="service-card__title" id="service-title-<?php echo esc_attr( $service['id'] ); ?>">
                        <?php echo esc_html( $service['title'] ); ?>
                    </h3>

                    <p class="service-card__description">
                        <?php echo esc_html( $service['description'] ); ?>
                    </p>

                    <?php if ( ! empty( $service['features'] ) ) : ?>
                    <ul class="service-card__features" aria-label="<?php esc_attr_e( 'Détails du service', 'elecvoltaique' ); ?>">
                        <?php foreach ( $service['features'] as $feature ) : ?>
                        <li class="service-card__feature"><?php echo esc_html( $feature ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                </article>
                <?php endforeach; ?>
            </div>

        </div>
    </section><!-- #services -->

    <!-- ============================================================
         WHY US SECTION
         ============================================================ -->
    <section class="section why-us" aria-labelledby="why-heading">
        <div class="container">

            <div class="section__header">
                <span class="section__subtitle"><?php esc_html_e( 'Pourquoi nous choisir', 'elecvoltaique' ); ?></span>
                <h2 class="section__title" id="why-heading">
                    <?php esc_html_e( 'Votre partenaire de confiance', 'elecvoltaique' ); ?>
                </h2>
                <p class="section__description">
                    <?php esc_html_e( 'Professionnalisme, réactivité et qualité au service de vos projets électriques et numériques.', 'elecvoltaique' ); ?>
                </p>
            </div>

            <div class="why-us__grid">

                <div class="why-card">
                    <p class="why-card__icon" aria-hidden="true">🎓</p>
                    <h3 class="why-card__title"><?php esc_html_e( 'Expertise certifiée', 'elecvoltaique' ); ?></h3>
                    <p class="why-card__text"><?php esc_html_e( 'Techniciens qualifiés et formations continues pour rester à la pointe des technologies.', 'elecvoltaique' ); ?></p>
                </div>

                <div class="why-card">
                    <p class="why-card__icon" aria-hidden="true">⏱️</p>
                    <h3 class="why-card__title"><?php esc_html_e( 'Réactivité maximale', 'elecvoltaique' ); ?></h3>
                    <p class="why-card__text"><?php esc_html_e( 'Intervention rapide sous 24h pour les urgences, délais respectés pour vos projets planifiés.', 'elecvoltaique' ); ?></p>
                </div>

                <div class="why-card">
                    <p class="why-card__icon" aria-hidden="true">🛡️</p>
                    <h3 class="why-card__title"><?php esc_html_e( 'Travaux garantis', 'elecvoltaique' ); ?></h3>
                    <p class="why-card__text"><?php esc_html_e( 'Toutes nos installations sont garanties et conformes aux normes en vigueur (NF C 15-100, DTU…).', 'elecvoltaique' ); ?></p>
                </div>

                <div class="why-card">
                    <p class="why-card__icon" aria-hidden="true">💰</p>
                    <h3 class="why-card__title"><?php esc_html_e( 'Devis gratuit', 'elecvoltaique' ); ?></h3>
                    <p class="why-card__text"><?php esc_html_e( 'Étude et devis gratuits, sans engagement. Prix transparents et compétitifs.', 'elecvoltaique' ); ?></p>
                </div>

            </div>

        </div>
    </section><!-- .why-us -->

    <!-- ============================================================
         CONTACT SECTION
         ============================================================ -->
    <section class="section" id="contact" aria-labelledby="contact-heading">
        <div class="container">

            <div class="section__header">
                <span class="section__subtitle"><?php esc_html_e( 'Parlons de votre projet', 'elecvoltaique' ); ?></span>
                <h2 class="section__title" id="contact-heading">
                    <?php esc_html_e( 'Contactez-nous', 'elecvoltaique' ); ?>
                </h2>
            </div>

            <div class="contact-wrapper">

                <!-- Contact Info -->
                <div class="contact-info">
                    <h3 class="contact-info__title"><?php esc_html_e( 'Nous sommes à votre écoute', 'elecvoltaique' ); ?></h3>
                    <p class="contact-info__text">
                        <?php esc_html_e( 'Vous avez un projet électrique, de sécurité, de connectivité ou d\'énergie renouvelable ? Remplissez le formulaire ou contactez-nous directement.', 'elecvoltaique' ); ?>
                    </p>

                    <address class="contact-details">
                        <div class="contact-item">
                            <div class="contact-item__icon" aria-hidden="true">📞</div>
                            <div>
                                <span class="contact-item__label"><?php esc_html_e( 'Téléphone', 'elecvoltaique' ); ?></span>
                                <a class="contact-item__value" href="tel:+33000000000">+33 (0)0 00 00 00 00</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-item__icon" aria-hidden="true">✉️</div>
                            <div>
                                <span class="contact-item__label"><?php esc_html_e( 'E-mail', 'elecvoltaique' ); ?></span>
                                <a class="contact-item__value" href="mailto:contact@elecvoltaique.fr">contact@elecvoltaique.fr</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-item__icon" aria-hidden="true">🕒</div>
                            <div>
                                <span class="contact-item__label"><?php esc_html_e( 'Horaires', 'elecvoltaique' ); ?></span>
                                <span class="contact-item__value"><?php esc_html_e( 'Lun–Ven : 8h–18h', 'elecvoltaique' ); ?></span>
                            </div>
                        </div>
                    </address>
                </div><!-- .contact-info -->

                <!-- Contact Form -->
                <div class="contact-form" role="region" aria-label="<?php esc_attr_e( 'Formulaire de contact', 'elecvoltaique' ); ?>">
                    <form id="contact-form" novalidate>
                        <?php wp_nonce_field( 'elecvoltaique_contact', 'contact_nonce' ); ?>

                        <div class="form-group">
                            <label class="form-label" for="contact-name">
                                <?php esc_html_e( 'Nom complet', 'elecvoltaique' ); ?> <span aria-hidden="true">*</span>
                            </label>
                            <input
                                class="form-control"
                                id="contact-name"
                                name="contact_name"
                                type="text"
                                required
                                autocomplete="name"
                                placeholder="<?php esc_attr_e( 'Votre nom', 'elecvoltaique' ); ?>"
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact-email">
                                <?php esc_html_e( 'Adresse e-mail', 'elecvoltaique' ); ?> <span aria-hidden="true">*</span>
                            </label>
                            <input
                                class="form-control"
                                id="contact-email"
                                name="contact_email"
                                type="email"
                                required
                                autocomplete="email"
                                placeholder="<?php esc_attr_e( 'votre@email.com', 'elecvoltaique' ); ?>"
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact-phone">
                                <?php esc_html_e( 'Téléphone', 'elecvoltaique' ); ?>
                            </label>
                            <input
                                class="form-control"
                                id="contact-phone"
                                name="contact_phone"
                                type="tel"
                                autocomplete="tel"
                                placeholder="<?php esc_attr_e( '06 00 00 00 00', 'elecvoltaique' ); ?>"
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact-service">
                                <?php esc_html_e( 'Service souhaité', 'elecvoltaique' ); ?>
                            </label>
                            <select class="form-control" id="contact-service" name="contact_service">
                                <option value=""><?php esc_html_e( '— Choisir un service —', 'elecvoltaique' ); ?></option>
                                <?php foreach ( $services as $service ) : ?>
                                <option value="<?php echo esc_attr( $service['title'] ); ?>">
                                    <?php echo esc_html( $service['title'] ); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact-message">
                                <?php esc_html_e( 'Message', 'elecvoltaique' ); ?> <span aria-hidden="true">*</span>
                            </label>
                            <textarea
                                class="form-control"
                                id="contact-message"
                                name="contact_message"
                                required
                                rows="5"
                                placeholder="<?php esc_attr_e( 'Décrivez votre projet…', 'elecvoltaique' ); ?>"
                            ></textarea>
                        </div>

                        <div id="form-response" role="alert" aria-live="polite"></div>

                        <button type="submit" class="btn btn--primary">
                            <?php esc_html_e( 'Envoyer le message', 'elecvoltaique' ); ?>
                        </button>

                    </form>
                </div><!-- .contact-form -->

            </div><!-- .contact-wrapper -->

        </div>
    </section><!-- #contact -->

</main>

<?php get_footer(); ?>
