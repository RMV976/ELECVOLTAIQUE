/* ============================================================
   ElecVoltaique - JavaScript principal
   www.elecvoltaique.yt | Mayotte
   ============================================================ */

'use strict';

// ============================================================
// HEADER SCROLL EFFECT
// ============================================================
const header = document.querySelector('header');
if (header) {
  window.addEventListener('scroll', () => {
    header.classList.toggle('scrolled', window.scrollY > 60);
  }, { passive: true });
}

// ============================================================
// HAMBURGER MENU (MOBILE)
// ============================================================
const hamburger = document.querySelector('.hamburger');
const nav = document.querySelector('nav');
const body = document.body;

if (hamburger && nav) {
  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('open');
    nav.classList.toggle('mobile-open');
    body.style.overflow = nav.classList.contains('mobile-open') ? 'hidden' : '';
  });

  // Close on nav link click
  nav.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      hamburger.classList.remove('open');
      nav.classList.remove('mobile-open');
      body.style.overflow = '';
    });
  });

  // Close on outside click
  document.addEventListener('click', (e) => {
    if (!header.contains(e.target) && nav.classList.contains('mobile-open')) {
      hamburger.classList.remove('open');
      nav.classList.remove('mobile-open');
      body.style.overflow = '';
    }
  });
}

// ============================================================
// ACTIVE NAV LINK
// ============================================================
const currentPage = window.location.pathname.split('/').pop() || 'index.html';
document.querySelectorAll('nav a').forEach(link => {
  const href = link.getAttribute('href');
  if (href === currentPage || (currentPage === '' && href === 'index.html')) {
    link.classList.add('active');
  }
});

// ============================================================
// SCROLL ANIMATIONS (INTERSECTION OBSERVER)
// ============================================================
const animatedElements = document.querySelectorAll('.fade-in, .fade-left, .fade-right');

if (animatedElements.length > 0) {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.12,
    rootMargin: '0px 0px -40px 0px'
  });

  animatedElements.forEach(el => observer.observe(el));
}

// ============================================================
// COUNTER ANIMATION
// ============================================================
function animateCounter(el, target, suffix = '', duration = 2000) {
  let start = 0;
  const increment = target / (duration / 16);
  const timer = setInterval(() => {
    start += increment;
    if (start >= target) {
      el.textContent = target + suffix;
      clearInterval(timer);
    } else {
      el.textContent = Math.floor(start) + suffix;
    }
  }, 16);
}

const counterObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const el = entry.target;
      const target = parseInt(el.dataset.target, 10);
      const suffix = el.dataset.suffix || '';
      animateCounter(el, target, suffix);
      counterObserver.unobserve(el);
    }
  });
}, { threshold: 0.5 });

document.querySelectorAll('.counter-number[data-target]').forEach(el => {
  counterObserver.observe(el);
});

// ============================================================
// FAQ ACCORDION
// ============================================================
document.querySelectorAll('.faq-question').forEach(btn => {
  btn.addEventListener('click', () => {
    const item = btn.closest('.faq-item');
    const isOpen = item.classList.contains('open');

    // Close all
    document.querySelectorAll('.faq-item.open').forEach(openItem => {
      openItem.classList.remove('open');
    });

    // Open clicked if it was closed
    if (!isOpen) {
      item.classList.add('open');
    }
  });
});

// ============================================================
// DEVIS MODAL
// ============================================================
const devisModal = document.getElementById('devisModal');
const devisTriggers = document.querySelectorAll('[data-modal="devis"]');
const modalClose = document.querySelector('.modal-close');

if (devisModal) {
  devisTriggers.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      devisModal.classList.add('open');
      body.style.overflow = 'hidden';
    });
  });

  if (modalClose) {
    modalClose.addEventListener('click', () => {
      devisModal.classList.remove('open');
      body.style.overflow = '';
    });
  }

  devisModal.addEventListener('click', (e) => {
    if (e.target === devisModal) {
      devisModal.classList.remove('open');
      body.style.overflow = '';
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && devisModal.classList.contains('open')) {
      devisModal.classList.remove('open');
      body.style.overflow = '';
    }
  });
}

// ============================================================
// CONTACT / DEVIS FORM HANDLING
// ============================================================
function handleForm(form) {
  if (!form) return;
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const submitBtn = form.querySelector('[type="submit"]');
    const successMsg = form.querySelector('.form-success');

    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = 'Envoi en cours…';
    }

    // Simulate form submission
    setTimeout(() => {
      if (successMsg) {
        successMsg.style.display = 'block';
        successMsg.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
      form.reset();
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Envoyer la demande';
      }
    }, 1200);
  });
}

document.querySelectorAll('form.contact-form, form.devis-form').forEach(handleForm);

// ============================================================
// BACK TO TOP BUTTON
// ============================================================
const backToTop = document.querySelector('.back-to-top');
if (backToTop) {
  window.addEventListener('scroll', () => {
    backToTop.classList.toggle('visible', window.scrollY > 400);
  }, { passive: true });

  backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

// ============================================================
// GALLERY LIGHTBOX (simple version)
// ============================================================
const galleryItems = document.querySelectorAll('.gallery-item[data-lightbox]');
if (galleryItems.length > 0) {
  const lightboxOverlay = document.createElement('div');
  lightboxOverlay.className = 'lightbox-overlay';
  lightboxOverlay.innerHTML = `
    <div class="lightbox-box">
      <button class="lightbox-close" aria-label="Fermer">✕</button>
      <div class="lightbox-content"></div>
      <div class="lightbox-caption"></div>
    </div>
  `;
  lightboxOverlay.style.cssText = `
    position:fixed;inset:0;background:rgba(7,25,59,0.92);z-index:3000;
    display:flex;align-items:center;justify-content:center;padding:20px;
    opacity:0;pointer-events:none;transition:opacity 0.3s ease;backdrop-filter:blur(6px);
  `;
  const lightboxBox = lightboxOverlay.querySelector('.lightbox-box');
  lightboxBox.style.cssText = `
    background:#fff;border-radius:16px;padding:32px;max-width:700px;width:100%;
    position:relative;transform:scale(0.9);transition:transform 0.3s ease;
    text-align:center;
  `;
  const closeBtn = lightboxOverlay.querySelector('.lightbox-close');
  closeBtn.style.cssText = `
    position:absolute;top:12px;right:12px;background:#f1f5f9;border:none;
    width:36px;height:36px;border-radius:50%;font-size:1rem;cursor:pointer;
    display:flex;align-items:center;justify-content:center;
  `;
  document.body.appendChild(lightboxOverlay);

  function openLightbox(item) {
    const content = lightboxOverlay.querySelector('.lightbox-content');
    const caption = lightboxOverlay.querySelector('.lightbox-caption');
    const title = item.dataset.title || '';
    const desc = item.dataset.desc || '';
    content.innerHTML = `<div style="font-size:4rem;margin-bottom:16px;">${item.dataset.icon || '🏗️'}</div>`;
    caption.innerHTML = `<h4 style="font-size:1.1rem;font-weight:700;color:#0a2a5e;margin-bottom:8px;">${title}</h4><p style="color:#555e6e;font-size:0.92rem;">${desc}</p>`;
    lightboxOverlay.style.opacity = '1';
    lightboxOverlay.style.pointerEvents = 'all';
    lightboxBox.style.transform = 'scale(1)';
    body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    lightboxOverlay.style.opacity = '0';
    lightboxOverlay.style.pointerEvents = 'none';
    lightboxBox.style.transform = 'scale(0.9)';
    body.style.overflow = '';
  }

  galleryItems.forEach(item => {
    item.addEventListener('click', () => openLightbox(item));
  });

  closeBtn.addEventListener('click', closeLightbox);
  lightboxOverlay.addEventListener('click', (e) => {
    if (e.target === lightboxOverlay) closeLightbox();
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeLightbox();
  });
}

// ============================================================
// DYNAMIC COPYRIGHT YEAR
// ============================================================
document.querySelectorAll('.copyright-year').forEach(el => {
  el.textContent = new Date().getFullYear();
});
// ============================================================
const progressBar = document.createElement('div');
progressBar.style.cssText = `
  position:fixed;top:0;left:0;height:3px;background:linear-gradient(90deg,#f5a623,#d4891a);
  z-index:9999;width:0%;transition:width 0.1s linear;
`;
document.body.prepend(progressBar);

window.addEventListener('scroll', () => {
  const scrollTotal = document.body.scrollHeight - window.innerHeight;
  const scrolled = (window.scrollY / scrollTotal) * 100;
  progressBar.style.width = `${scrolled}%`;
}, { passive: true });
