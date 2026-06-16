document.addEventListener('DOMContentLoaded', () => {
    const mm = gsap.matchMedia();

    mm.add({
        reduceMotion: "(prefers-reduced-motion: reduce)",
        allowMotion: "(prefers-reduced-motion: no-preference)"
    }, (context) => {
        const { reduceMotion } = context.conditions;

        if (reduceMotion) {
            // Si el usuario prefiere movimiento reducido, mostrar de inmediato sin transiciones
            gsap.set('.profile-card', { opacity: 1, y: 0 });
            gsap.set('.profile-img', { opacity: 1, scale: 1 });
            gsap.set('.profile-name', { y: 0 });
            gsap.set(['.profile-para', '.profile-grid-item'], { opacity: 1, y: 0 });
            return;
        }

        // Timeline de Entrada Awwwards-level optimizada para Perfil
        const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

        // 1. Revelación de la tarjeta principal (fade + leve deslizamiento)
        tl.to('.profile-card', {
            opacity: 1,
            y: 0,
            duration: 1.0,
            ease: 'power3.out'
        })
        // 2. Animación de revelación de la imagen de perfil (escala suave)
        .to('.profile-img', {
            opacity: 1,
            scale: 1,
            duration: 1.2,
            ease: 'power2.out'
        }, '-=0.6')
        // 3. Revelación del nombre (de abajo hacia arriba mediante máscara)
        .to('.profile-name', {
            y: 0,
            duration: 0.9,
            ease: 'expo.out'
        }, '-=0.8')
        // 4. Entrada secuencial de los párrafos informativos
        .to('.profile-para', {
            opacity: 1,
            y: 0,
            duration: 0.8,
            stagger: 0.15
        }, '-=0.7')
        // 5. Entrada escalonada de los bloques de metadatos (Ubicación, Disponibilidad, etc.)
        .to('.profile-grid-item', {
            opacity: 1,
            y: 0,
            stagger: 0.08,
            duration: 0.6
        }, '-=0.6');
    });
});
