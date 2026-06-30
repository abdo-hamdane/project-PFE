'use strict';

/* ══════════════════════════════════════════════════════════════
   1. DOM CACHE
══════════════════════════════════════════════════════════════ */
const DOM = {
  navBurger:    document.getElementById('navBurger'),
  navLinks:     document.querySelector('.nav__links'),
  filterBtns:   document.querySelectorAll('.filter__btn'),
  cards:        document.querySelectorAll('.card'),
  bookBtns:     document.querySelectorAll('.card__btn'),
  modal:        document.getElementById('modal'),
  modalBackdrop:document.getElementById('modalBackdrop'),
  modalClose:   document.getElementById('modalClose'),
  modalTitle:   document.getElementById('modalTitle'),
  modalPrice:   document.getElementById('modalPrice'),
  modalGo:      document.getElementById('modalGo'),
  form:         document.getElementById('bookingForm'),
  activitySel:  document.getElementById('activity'),
  personsSel:   document.getElementById('persons'),
  dateSel:      document.getElementById('date'),
  nameSel:      document.getElementById('name'),
  emailSel:     document.getElementById('email'),
  priceSummary: document.getElementById('priceSummary'),
  totalPrice:   document.getElementById('totalPrice'),
  formSuccess:  document.getElementById('formSuccess'),
  formError:    document.getElementById('formError'),
  submitBtn:    document.getElementById('submitBtn'),
  statNums:     document.querySelectorAll('.stats__num'),
  fadeEls:      document.querySelectorAll('.fade-in'),
};

/* ══════════════════════════════════════════════════════════════
   2. PRICES MAP
══════════════════════════════════════════════════════════════ */
const PRICES = {
  'Quad Biking':   350,
  'Camel Ride':    200,
  'Buggy Ride':    500,
  'Dinner & Show': 450,
  'Transport':     150,
  'Sandboarding':  250,
};

/* ══════════════════════════════════════════════════════════════
   3. NAVIGATION — Mobile burger
══════════════════════════════════════════════════════════════ */
DOM.navBurger.addEventListener('click', () => {
  DOM.navLinks.classList.toggle('open');
  const spans = DOM.navBurger.querySelectorAll('span');
  spans[0].style.transform = DOM.navLinks.classList.contains('open') ? 'translateY(7px) rotate(45deg)' : '';
  spans[1].style.opacity   = DOM.navLinks.classList.contains('open') ? '0' : '1';
  spans[2].style.transform = DOM.navLinks.classList.contains('open') ? 'translateY(-7px) rotate(-45deg)' : '';
});

/* Close nav on link click */
DOM.navLinks.querySelectorAll('a').forEach(a => {
  a.addEventListener('click', () => DOM.navLinks.classList.remove('open'));
});

/* ══════════════════════════════════════════════════════════════
   4. ACTIVITY FILTER
══════════════════════════════════════════════════════════════ */
DOM.filterBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    DOM.filterBtns.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const filter = btn.dataset.filter;

    DOM.cards.forEach((card, i) => {
      const match = filter === 'all' || card.dataset.category === filter;

      if (match) {
        card.classList.remove('hidden');
        // Stagger re-appearance
        card.style.animationDelay = `${i * 0.07}s`;
        card.style.animation = 'none';
        requestAnimationFrame(() => {
          card.style.animation = '';
        });
      } else {
        card.classList.add('hidden');
      }
    });
  });
});

/* ══════════════════════════════════════════════════════════════
   5. MODAL — Open on "Book Now" card buttons
══════════════════════════════════════════════════════════════ */
function openModal(activity, price) {
  DOM.modalTitle.textContent = activity;
  DOM.modalPrice.textContent = `From ${price} MAD / person`;
  DOM.modal.classList.add('active');
  document.body.style.overflow = 'hidden';
}

function closeModal() {
  DOM.modal.classList.remove('active');
  document.body.style.overflow = '';
}

DOM.bookBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    openModal(btn.dataset.activity, btn.dataset.price);
  });
});

DOM.modalClose.addEventListener('click', closeModal);
DOM.modalBackdrop.addEventListener('click', closeModal);

document.addEventListener('keydown', e => {
  if (e.key === 'Escape') closeModal();
});

/* Modal "Go to Booking Form" button */
DOM.modalGo.addEventListener('click', () => {
  const activity = DOM.modalTitle.textContent;

  // Pre-fill the select
  for (let option of DOM.activitySel.options) {
    if (option.value === activity) {
      option.selected = true;
      break;
    }
  }

  closeModal();
  updatePriceSummary();

  // Smooth scroll to form
  setTimeout(() => {
    document.getElementById('booking').scrollIntoView({ behavior: 'smooth', block: 'start' });
    // Brief highlight on select
    DOM.activitySel.classList.add('highlight');
    setTimeout(() => DOM.activitySel.classList.remove('highlight'), 1200);
  }, 250);
});

/* ══════════════════════════════════════════════════════════════
   6. PRICE SUMMARY — live update
══════════════════════════════════════════════════════════════ */
function updatePriceSummary() {
  const activity = DOM.activitySel.value;
  const persons  = parseInt(DOM.personsSel.value, 10) || 0;

  if (activity && persons > 0) {
    const basePrice = PRICES[activity] || 0;
    const total = basePrice * persons;
    DOM.totalPrice.textContent = `${total.toLocaleString()} MAD`;
    DOM.priceSummary.hidden = false;
  } else {
    DOM.priceSummary.hidden = true;
  }
}

DOM.activitySel.addEventListener('change', updatePriceSummary);
DOM.personsSel.addEventListener('input',  updatePriceSummary);

/* ══════════════════════════════════════════════════════════════
   9. STATS COUNTER — animate when visible
══════════════════════════════════════════════════════════════ */
function animateCounter(el, target, duration = 1600) {
  const start    = performance.now();
  const startVal = 0;

  function step(now) {
    const elapsed  = now - start;
    const progress = Math.min(elapsed / duration, 1);
    // Ease out cubic
    const ease     = 1 - Math.pow(1 - progress, 3);
    const current  = Math.floor(startVal + (target - startVal) * ease);

    el.textContent = current.toLocaleString();

    if (progress < 1) requestAnimationFrame(step);
    else el.textContent = target.toLocaleString();
  }
  requestAnimationFrame(step);
}

const statsObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const el     = entry.target;
      const target = parseInt(el.dataset.target, 10);
      animateCounter(el, target);
      statsObserver.unobserve(el);
    }
  });
}, { threshold: 0.5 });

DOM.statNums.forEach(el => statsObserver.observe(el));

/* ══════════════════════════════════════════════════════════════
   10. SCROLL FADE-IN — for sections
══════════════════════════════════════════════════════════════ */
const fadeObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      fadeObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.1 });

DOM.fadeEls.forEach(el => fadeObserver.observe(el));

/* ══════════════════════════════════════════════════════════════
   11. NAV SCROLL — subtle BG change
══════════════════════════════════════════════════════════════ */
window.addEventListener('scroll', () => {
  const nav = document.querySelector('.nav');
  if (window.scrollY > 60) {
    nav.style.background = 'rgba(26,17,8,0.98)';
  } else {
    nav.style.background = 'rgba(26,17,8,0.92)';
  }
}, { passive: true });

/* ══════════════════════════════════════════════════════════════
   12. CARD HOVER TILT (subtle 3D effect)
══════════════════════════════════════════════════════════════ */
DOM.cards.forEach(card => {
  card.addEventListener('mousemove', e => {
    const rect   = card.getBoundingClientRect();
    const x      = e.clientX - rect.left;
    const y      = e.clientY - rect.top;
    const midX   = rect.width / 2;
    const midY   = rect.height / 2;
    const rotateX = ((y - midY) / midY) * -4;
    const rotateY = ((x - midX) / midX) * 4;

    card.style.transform = `translateY(-6px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
  });

  card.addEventListener('mouseleave', () => {
    card.style.transform = '';
    card.style.transition = 'transform 0.5s var(--ease)';
    setTimeout(() => { card.style.transition = ''; }, 500);
  });
});
