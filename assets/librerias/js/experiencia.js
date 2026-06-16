document.addEventListener('DOMContentLoaded', () => {
    const mm = gsap.matchMedia();
    const cardWidth = 460;
    const gap = 60;

    mm.add({
        isDesktop: "(min-width: 1025px)",
        isMobile: "(max-width: 1024px)",
        reduceMotion: "(prefers-reduced-motion: reduce)"
    }, (context) => {
        const { isDesktop, isMobile, reduceMotion } = context.conditions;

        if (reduceMotion) {
            // Si el usuario prefiere movimiento reducido, desactivamos transiciones complejas
            gsap.set('.exp-title', { y: 0 });
            gsap.set('.exp-subtitle', { opacity: 1 });
            gsap.set('.timeline-line', { scaleX: 1 });
            gsap.set('.timeline-column', { y: 0, opacity: 1 });
            gsap.set('.accordion-item', { y: 0, opacity: 1 });
            return;
        }

        // --- MODO ESCRITORIO (TIMELINE HORIZONTAL) ---
        if (isDesktop) {
            // Animación de entrada inicial del encabezado (siempre se ejecuta)
            const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

            tl.to('.exp-title', {
                y: 0,
                duration: 0.8
            })
            .to('.exp-subtitle', {
                opacity: 1,
                duration: 0.6
            }, '-=0.4');

            const track = document.querySelector('.timeline-track');
            const columns = document.querySelectorAll('.timeline-column');
            const line = document.querySelector('.timeline-line');
            const prevBtn = document.querySelector('.prev-arrow');
            const nextBtn = document.querySelector('.next-arrow');

            if (track && columns.length > 0) {
                let activeIndex = 0;

                // Configurar tamaño y posición estáticos de la línea conectora
                if (line) {
                    line.style.left = `${cardWidth / 2}px`;
                    line.style.width = `${(columns.length - 1) * (cardWidth + gap)}px`;
                }

                // Función centralizada para actualizar posiciones y opacidades
                const updateTimeline = (instant = false) => {
                    if (prevBtn) prevBtn.disabled = activeIndex === 0;
                    if (nextBtn) nextBtn.disabled = activeIndex === columns.length - 1;

                    // Centrado exacto relativo al contenedor (wrapper) para evitar el desplazamiento a la derecha
                    const wrapper = track.parentElement;
                    const containerWidth = (wrapper && wrapper.offsetWidth > 0) ? wrapper.offsetWidth : (window.innerWidth - 128);
                    const containerCenter = containerWidth / 2;
                    const cardCenter = cardWidth / 2;
                    const itemOffset = activeIndex * (cardWidth + gap);
                    const targetX = containerCenter - itemOffset - cardCenter;

                    // Desplazar la pista de la línea de tiempo
                    gsap.to(track, {
                        x: targetX,
                        duration: instant ? 0 : 0.8,
                        ease: "power3.out"
                    });

                    // Actualizar estilos activos de las tarjetas y puntos
                    const animDuration = instant ? 0 : 0.5;

                    columns.forEach((col, idx) => {
                        const card = col.querySelector('.timeline-card');
                        const dot = col.querySelector('.timeline-dot');
                        const dotInner = col.querySelector('.timeline-dot-inner');

                        if (idx === activeIndex) {
                            col.classList.add('active');
                            gsap.to(col, {
                                opacity: 1,
                                duration: animDuration
                            });
                            gsap.to(card, {
                                borderColor: 'rgba(155, 89, 182, 0.6)',
                                backgroundColor: 'rgba(22, 15, 28, 0.8)',
                                scale: 1.02,
                                duration: animDuration
                            });
                            gsap.to(dot, {
                                borderColor: '#9B59B6',
                                scale: 1.3,
                                boxShadow: '0 0 15px rgba(155, 89, 182, 0.8), 0 0 5px rgba(155, 89, 182, 0.5)',
                                duration: animDuration
                            });
                            gsap.to(dotInner, {
                                opacity: 1,
                                scale: 1,
                                backgroundColor: '#ffffff',
                                duration: animDuration
                            });
                        } else {
                            col.classList.remove('active');
                            gsap.to(col, {
                                opacity: 0.4,
                                duration: animDuration
                            });
                            gsap.to(card, {
                                borderColor: 'rgba(155, 89, 182, 0.15)',
                                backgroundColor: 'rgba(22, 15, 28, 0.3)',
                                scale: 0.98,
                                duration: animDuration
                            });
                            gsap.to(dot, {
                                borderColor: 'rgba(155, 89, 182, 0.4)',
                                scale: 1.0,
                                boxShadow: 'none',
                                duration: animDuration
                            });
                            gsap.to(dotInner, {
                                opacity: 0,
                                scale: 0.5,
                                backgroundColor: '#9B59B6',
                                duration: animDuration
                            });
                        }
                    });
                };

                // Establecer estado inicial instantáneamente
                updateTimeline(true);

                // Controladores de eventos de las flechas
                const onPrevClick = () => {
                    if (activeIndex > 0) {
                        activeIndex--;
                        updateTimeline();
                    }
                };

                const onNextClick = () => {
                    if (activeIndex < columns.length - 1) {
                        activeIndex++;
                        updateTimeline();
                    }
                };

                if (prevBtn) prevBtn.addEventListener('click', onPrevClick);
                if (nextBtn) nextBtn.addEventListener('click', onNextClick);

                // Soporte para navegación con teclado (flechas izquierda/derecha)
                const timelineContainer = document.querySelector('.timeline-container');
                const onKeyDown = (e) => {
                    if (e.key === 'ArrowLeft' && activeIndex > 0) {
                        e.preventDefault();
                        activeIndex--;
                        updateTimeline();
                    } else if (e.key === 'ArrowRight' && activeIndex < columns.length - 1) {
                        e.preventDefault();
                        activeIndex++;
                        updateTimeline();
                    }
                };
                if (timelineContainer) {
                    timelineContainer.addEventListener('keydown', onKeyDown);
                }

                // Re-centrar elemento activo en redimensionado de pantalla
                const onResize = () => updateTimeline(true);
                window.addEventListener('resize', onResize);

                // Agregar la animación de los elementos de la línea de tiempo al timeline principal
                tl.to('.timeline-line', {
                    scaleX: 1,
                    duration: 0.8,
                    ease: 'power2.inOut'
                }, '-=0.2')
                .fromTo('.timeline-column', {
                    y: 50,
                    opacity: 0
                }, {
                    y: 0,
                    opacity: (i) => i === 0 ? 1 : 0.4,
                    stagger: 0.15,
                    duration: 0.8,
                    onComplete: () => {
                        updateTimeline();
                    }
                }, '-=0.5');

                // Limpieza al cambiar de breakpoint o destruir contexto
                return () => {
                    if (prevBtn) prevBtn.removeEventListener('click', onPrevClick);
                    if (nextBtn) nextBtn.removeEventListener('click', onNextClick);
                    if (timelineContainer) timelineContainer.removeEventListener('keydown', onKeyDown);
                    window.removeEventListener('resize', onResize);
                    gsap.killTweensOf([track, columns, line, prevBtn, nextBtn]);
                };
            }
        }

        // --- MODO MÓVIL (ACORDEONES VERTICALES) ---
        if (isMobile) {
            // Animación de entrada inicial del encabezado (siempre se ejecuta)
            const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

            tl.to('.exp-title', {
                y: 0,
                duration: 0.8
            })
            .to('.exp-subtitle', {
                opacity: 1,
                duration: 0.6
            }, '-=0.4');

            const headers = document.querySelectorAll('.accordion-header');
            const accordions = document.querySelectorAll('.accordion-item');
            const clickHandlers = [];

            if (accordions.length > 0) {
                headers.forEach(header => {
                    const handler = () => {
                        const item = header.closest('.accordion-item');
                        const content = item.querySelector('.accordion-content');
                        const icon = header.querySelector('i');
                        const isOpen = item.classList.contains('active');

                        // Cerrar el resto de los acordeones abiertos
                        accordions.forEach(activeItem => {
                            if (activeItem !== item && activeItem.classList.contains('active')) {
                                activeItem.classList.remove('active');
                                const activeHeader = activeItem.querySelector('.accordion-header');
                                const activeContent = activeItem.querySelector('.accordion-content');
                                const activeIcon = activeItem.querySelector('.accordion-header i');
                                if (activeHeader) activeHeader.setAttribute('aria-expanded', 'false');
                                gsap.to(activeContent, { height: 0, duration: 0.4, ease: "power2.out" });
                                gsap.to(activeIcon, { rotation: 0, duration: 0.4, ease: "power2.out" });
                            }
                        });

                        // Alternar estado del acordeón actual
                        if (isOpen) {
                            item.classList.remove('active');
                            header.setAttribute('aria-expanded', 'false');
                            gsap.to(content, { height: 0, duration: 0.4, ease: "power2.out" });
                            gsap.to(icon, { rotation: 0, duration: 0.4, ease: "power2.out" });
                        } else {
                            item.classList.add('active');
                            header.setAttribute('aria-expanded', 'true');
                            gsap.to(content, { height: content.scrollHeight, duration: 0.4, ease: "power2.out" });
                            gsap.to(icon, { rotation: 180, duration: 0.4, ease: "power2.out" });
                        }
                    };

                    header.addEventListener('click', handler);
                    clickHandlers.push({ header, handler });
                });

                tl.fromTo('.accordion-item', {
                    y: 30,
                    opacity: 0
                }, {
                    y: 0,
                    opacity: 1,
                    stagger: 0.15,
                    duration: 0.6,
                    onComplete: () => {
                        // Abrir el primer acordeón por defecto
                        const firstItem = accordions[0];
                        if (firstItem) {
                            firstItem.classList.add('active');
                            const firstHeader = firstItem.querySelector('.accordion-header');
                            const firstContent = firstItem.querySelector('.accordion-content');
                            const firstIcon = firstItem.querySelector('.accordion-header i');
                            if (firstHeader) firstHeader.setAttribute('aria-expanded', 'true');
                            gsap.to(firstContent, { height: firstContent.scrollHeight, duration: 0.4, ease: "power2.out" });
                            gsap.to(firstIcon, { rotation: 180, duration: 0.4, ease: "power2.out" });
                        }
                    }
                }, '-=0.4');

                // Limpieza al cambiar de breakpoint o destruir contexto
                return () => {
                    clickHandlers.forEach(({ header, handler }) => {
                        header.removeEventListener('click', handler);
                    });
                    accordions.forEach(item => {
                        item.classList.remove('active');
                        const header = item.querySelector('.accordion-header');
                        const content = item.querySelector('.accordion-content');
                        const icon = item.querySelector('.accordion-header i');
                        if (header) header.removeAttribute('aria-expanded');
                        if (content) gsap.set(content, { height: '' });
                        if (icon) gsap.set(icon, { rotation: '' });
                    });
                    gsap.killTweensOf(accordions);
                };
            }
        }
    });
});
