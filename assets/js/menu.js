document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle');
    const menuOverlay = document.getElementById('full-screen-menu');
    
    if (!menuToggle || !menuOverlay) return;

    const menuItems = document.querySelectorAll('.menu-item');
    const brandSection = document.querySelector('.menu-brand-section');
    const containerLogo = document.getElementById('logo');
    const headerNavLinks = document.querySelector('header ul');
    const line1 = menuToggle.querySelector('.line-1');
    const line2 = menuToggle.querySelector('.line-2');

    let isOpen = false;

    // Crear la línea de tiempo del menú
    const menuTL = gsap.timeline({ paused: true });

    // 1. Animaciones base del overlay y botón hamburguesa
    menuTL
        .to(menuOverlay, {
            display: 'flex',
            opacity: 1,
            duration: 0.4,
            ease: "power2.out"
        });

    if (line1 && line2) {
        menuTL
            .to(line1, {
                attr: { x1: 15, y1: 45, x2: 45, y2: 15 }, // Diagonal larga
                duration: 0.4,
                ease: "expo.inOut"
            }, 0)
            .to(line2, {
                attr: { x1: 15, y1: 15, x2: 30, y2: 30 }, // Diagonal corta
                duration: 0.4,
                ease: "expo.inOut"
            }, 0);
    }

    // 2. Animación condicional de enlaces de navegación superiores (solo existen en index)
    if (headerNavLinks) {
        menuTL.to(headerNavLinks, {
            opacity: 0,
            y: -20,
            duration: 0.3,
            pointerEvents: 'none',
            ease: "power2.inOut"
        }, 0);
    }

    // 3. Animación condicional del logo superior (solo existe en subpáginas)
    if (containerLogo) {
        menuTL.to(containerLogo, {
            opacity: 0,
            x: 0,
            duration: 0.8,
            ease: "expo.out"
        }, "-=0.3");
    }

    // 4. Animación de items internos del menú
    if (menuItems.length > 0) {
        menuTL.to(menuItems, {
            opacity: 1,
            y: 0,
            duration: 0.6,
            stagger: 0.1,
            ease: "expo.out"
        }, "-=0.2");
    }

    if (brandSection) {
        menuTL.to(brandSection, {
            opacity: 1,
            x: 0,
            duration: 0.8,
            ease: "expo.out"
        }, "-=0.5");
    }

    let previousActiveElement = null;

    // Obtener los elementos interactivos visibles dentro del menú overlay
    const getFocusableElements = () => {
        return Array.from(menuOverlay.querySelectorAll('a, button, [tabindex="0"]'))
            .filter(el => {
                return !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length) && !el.hasAttribute('disabled');
            });
    };

    // Manejar la trampa de foco y el cierre con Escape
    const handleFocusTrap = (e) => {
        if (e.key === 'Escape') {
            toggleMenu();
            return;
        }

        if (e.key === 'Tab') {
            const focusable = getFocusableElements();
            if (focusable.length === 0) {
                e.preventDefault();
                return;
            }

            const first = focusable[0];
            const last = focusable[focusable.length - 1];

            if (e.shiftKey) {
                // Shift + Tab: ciclar de primero a último
                if (document.activeElement === first) {
                    last.focus();
                    e.preventDefault();
                }
            } else {
                // Tab: ciclar de último a primero
                if (document.activeElement === last) {
                    first.focus();
                    e.preventDefault();
                }
            }
        }
    };

    const toggleMenu = () => {
        if (!isOpen) {
            previousActiveElement = document.activeElement;
            menuToggle.setAttribute('aria-expanded', 'true');
            
            menuTL.play();
            document.body.style.overflow = 'hidden';
            
            window.addEventListener('keydown', handleFocusTrap);
            
            // Retrasar el foco ligeramente para permitir que se inicie la animación
            setTimeout(() => {
                const focusable = getFocusableElements();
                if (focusable.length > 0) {
                    focusable[0].focus();
                }
            }, 100);
        } else {
            menuToggle.setAttribute('aria-expanded', 'false');
            
            menuTL.reverse();
            document.body.style.overflow = 'auto';
            
            window.removeEventListener('keydown', handleFocusTrap);
            
            if (previousActiveElement) {
                previousActiveElement.focus();
            } else {
                menuToggle.focus();
            }
        }
        isOpen = !isOpen;
    };

    menuToggle.addEventListener('click', toggleMenu);

    // Cerrar menú al hacer clic en un enlace y restablecer el foco
    const menuLinks = menuOverlay.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('click', () => {
            menuToggle.setAttribute('aria-expanded', 'false');
            menuTL.reverse();
            isOpen = false;
            document.body.style.overflow = 'auto';
            window.removeEventListener('keydown', handleFocusTrap);
            
            // Devolver el foco al toggle para mantener una posición de navegación clara
            if (previousActiveElement) {
                previousActiveElement.focus();
            } else {
                menuToggle.focus();
            }
        });
    });
});
