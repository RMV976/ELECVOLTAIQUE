/* global elecvoltaiqueData */
( function () {
    'use strict';

    /* ============================================================
       MOBILE NAVIGATION TOGGLE
       ============================================================ */
    var navToggle = document.getElementById( 'nav-toggle' );
    var siteNav   = document.getElementById( 'site-navigation' );

    if ( navToggle && siteNav ) {
        navToggle.addEventListener( 'click', function () {
            var isOpen = siteNav.classList.toggle( 'is-open' );
            navToggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
            navToggle.setAttribute( 'aria-label', isOpen ? 'Fermer le menu' : 'Ouvrir le menu' );
        } );

        // Close nav when a link is clicked
        siteNav.addEventListener( 'click', function ( e ) {
            if ( e.target.tagName === 'A' ) {
                siteNav.classList.remove( 'is-open' );
                navToggle.setAttribute( 'aria-expanded', 'false' );
            }
        } );
    }

    /* ============================================================
       SMOOTH SCROLL FOR ANCHOR LINKS
       ============================================================ */
    document.addEventListener( 'click', function ( e ) {
        var link = e.target.closest( 'a[href^="#"]' );
        if ( ! link ) {
            return;
        }
        var targetId = link.getAttribute( 'href' ).slice( 1 );
        if ( ! targetId ) {
            return;
        }
        var target = document.getElementById( targetId );
        if ( target ) {
            e.preventDefault();
            target.scrollIntoView( { behavior: 'smooth', block: 'start' } );
            target.focus( { preventScroll: true } );
        }
    } );

    /* ============================================================
       CONTACT FORM SUBMISSION
       ============================================================ */
    var contactForm = document.getElementById( 'contact-form' );
    var formResponse = document.getElementById( 'form-response' );

    if ( contactForm && typeof elecvoltaiqueData !== 'undefined' ) {
        contactForm.addEventListener( 'submit', function ( e ) {
            e.preventDefault();

            var submitBtn = contactForm.querySelector( '[type="submit"]' );
            var originalText = submitBtn.textContent;

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.textContent = elecvoltaiqueData.strings.sending;

            // Clear previous response
            formResponse.textContent = '';
            formResponse.className = '';

            // Build form data
            var formData = new FormData( contactForm );
            formData.append( 'action', 'elecvoltaique_contact' );
            formData.append( 'nonce', elecvoltaiqueData.nonce );

            fetch( elecvoltaiqueData.ajaxUrl, {
                method: 'POST',
                credentials: 'same-origin',
                body: formData,
            } )
                .then( function ( response ) {
                    if ( ! response.ok ) {
                        throw new Error( 'Network response was not ok' );
                    }
                    return response.json();
                } )
                .then( function ( data ) {
                    if ( data.success ) {
                        formResponse.textContent = data.data.message;
                        formResponse.className = 'form-response--success';
                        contactForm.reset();
                    } else {
                        formResponse.textContent = data.data ? data.data.message : elecvoltaiqueData.strings.error;
                        formResponse.className = 'form-response--error';
                    }
                } )
                .catch( function () {
                    formResponse.textContent = elecvoltaiqueData.strings.error;
                    formResponse.className = 'form-response--error';
                } )
                .finally( function () {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                    formResponse.scrollIntoView( { behavior: 'smooth', block: 'nearest' } );
                } );
        } );
    }
} )();
