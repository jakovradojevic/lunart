// Navigation: Mobile menu toggle for current markup (.mobile-menu-toggle / .mobile-menu)
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    const nav = document.querySelector('.navigation');
    if (!nav) return;

    const toggle = nav.querySelector('.mobile-menu-toggle');
    const mobileMenu = nav.querySelector('.mobile-menu');
    const overlay = nav.querySelector('.mobile-menu-overlay');
    const closeBtn = nav.querySelector('.mobile-menu-close');

    if (!toggle || !mobileMenu || !overlay) return;

    // Initialize ARIA state
    toggle.setAttribute('aria-expanded', 'false');

    function toggleOverlay(active) {
      if (!overlay) return;
      overlay.classList.toggle('active', !!active);
      overlay.setAttribute('aria-hidden', active ? 'false' : 'true');
    }

    // Basic focus handling: focus first link on open
    function focusFirstLink() {
      const firstLink = mobileMenu.querySelector('a, button');
      if (firstLink) firstLink.focus({ preventScroll: true });
    }

    function closeMenu() {
      mobileMenu.classList.remove('active');
      toggleOverlay(false);
      document.body.classList.remove('menu-open');
      toggle.setAttribute('aria-expanded', 'false');
    }

    function openMenu() {
      mobileMenu.classList.add('active');
      toggleOverlay(true);
      document.body.classList.add('menu-open');
      toggle.setAttribute('aria-expanded', 'true');
      setTimeout(focusFirstLink, 50);
    }

    toggle.addEventListener('click', function(e) {
      e.stopPropagation();
      if (mobileMenu.classList.contains('active')) {
        closeMenu();
      } else {
        openMenu();
      }
    });

    // Close when clicking overlay or outside nav
    overlay.addEventListener('click', closeMenu);
    document.addEventListener('click', function(e) {
      if (!nav.contains(e.target)) {
        closeMenu();
      }
    });

    // Close via close button
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);

    // Close when a menu link is clicked
    mobileMenu.addEventListener('click', function(e) {
      const link = e.target.closest('a');
      if (link) {
        closeMenu();
      }
    });

    // Optional: close on Escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeMenu();
      }
    });
  });
})();
