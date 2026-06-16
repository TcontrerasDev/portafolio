document.addEventListener('DOMContentLoaded', () => {
    const mm = gsap.matchMedia();

    mm.add({
        reduceMotion: "(prefers-reduced-motion: reduce)",
        allowMotion: "(prefers-reduced-motion: no-preference)"
    }, (context) => {
        const { reduceMotion } = context.conditions;

        if (reduceMotion) {
            // Si el usuario prefiere movimiento reducido, mostramos los elementos de inmediato sin transiciones
            gsap.set('.contact-title', { y: 0 });
            gsap.set(['.contact-desc', '.contact-email', '.contact-btn'], { opacity: 1, y: 0 });
            gsap.set('.contact-line', { scaleX: 1 });
            return;
        }

        // Animación de entrada secuencial (Timeline) optimizada para la página de contacto
        const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

        tl.to('.contact-title', {
            y: 0,
            duration: 0.8
        })
        .to('.contact-desc', {
            opacity: 1,
            y: 0,
            duration: 0.6
        }, '-=0.5')
        .to('.contact-email', {
            opacity: 1,
            y: 0,
            duration: 0.6
        }, '-=0.4')
        .to('.contact-line', {
            scaleX: 1,
            duration: 0.8
        }, '-=0.4')
        .to('.contact-btn', {
            opacity: 1,
            y: 0,
            stagger: 0.08,
            duration: 0.6
        }, '-=0.5');
    });
});
