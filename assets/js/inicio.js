document.addEventListener('DOMContentLoaded', () => {
    const mm = gsap.matchMedia();

    mm.add({
        reduceMotion: "(prefers-reduced-motion: reduce)",
        allowMotion: "(prefers-reduced-motion: no-preference)"
    }, (context) => {
        const { reduceMotion } = context.conditions;

        if (reduceMotion) {
            // Si el usuario prefiere movimiento reducido, mostrar elementos de inmediato
            gsap.set('.hero-logo', { opacity: 1, scale: 1, filter: 'blur(0px)' });
            gsap.set(['.hero-title-text', '.hero-footer-title', '.hero-footer-desc'], { y: 0 });
            gsap.set('.hero-title-dot', { scale: 1 });
            return;
        }

        // Timeline de Entrada Awwwards-level optimizada
        const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

        // 1. Revelación del Isotipo (Logo) con desenfoque y escala sutil
        tl.to('.hero-logo', {
            opacity: 1,
            scale: 1,
            filter: 'blur(0px)',
            duration: 1.4,
            ease: 'power4.out'
        })
        // 2. Revelación del título "Tom" y "Dev" (de abajo a arriba)
        .to('.hero-title-text', {
            y: 0,
            duration: 1.1,
            stagger: 0.15,
            ease: 'expo.out'
        }, '-=0.9')
        // 3. Entrada con rebote elástico para el punto morado "."
        .to('.hero-title-dot', {
            scale: 1,
            duration: 1.0,
            ease: 'elastic.out(1.2, 0.5)'
        }, '-=0.6')
        // 4. Revelación del footer "Portafolio"
        .to('.hero-footer-title', {
            y: 0,
            duration: 0.8,
            ease: 'power3.out'
        }, '-=0.7')
        // 5. Revelación del footer "DESARROLLADOR..."
        .to('.hero-footer-desc', {
            y: 0,
            duration: 0.8,
            ease: 'power3.out'
        }, '-=0.6');
    });
});
