document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    const projectItems = document.querySelectorAll('.project-item');
    const projectDetails = document.getElementById('project-details');
    const scrollContainer = document.getElementById('project-list');
    let mm = gsap.matchMedia();

    // --- RESPONSIVIDAD CON GSAP matchMedia ---
    mm.add({
        isDesktop: "(min-width: 1025px)",
        isMobile: "(max-width: 1024px)"
    }, (context) => {
        let { isDesktop, isMobile } = context.conditions;

        if (isDesktop) {
            // Limpiar clases activas de escritorio y estilos móviles previos
            projectItems.forEach(i => {
                i.classList.remove('active');
                i.style.removeProperty('opacity');
                i.style.removeProperty('transform');
                i.style.removeProperty('filter');
                i.style.removeProperty('z-index');
                i.style.removeProperty('pointer-events');
            });

            let activeId = null;

            // Función para actualizar los detalles del proyecto con transición premium y escalonada (stagger)
            const updateProjectDetails = (id) => {
                const oldArticle = projectDetails.querySelector('article');
                const source = document.querySelector(`.project-item[data-id="${id}"] .project-details-container`);
                const sourceHTML = source ? source.innerHTML : '';

                if (oldArticle) {
                    // Ocultar scrollbar durante la transición para evitar flashes
                    projectDetails.classList.add('hide-scrollbar');

                    // Animación de salida: desvanecer todo el contenedor (incluye scrollbar y track)
                    gsap.to(projectDetails, {
                        opacity: 0,
                        duration: 0.2,
                        ease: "power2.in",
                        onComplete: () => {
                            projectDetails.innerHTML = sourceHTML;
                            projectDetails.scrollTop = 0; // Reinicio invisible ya que opacity es 0

                            const newChildren = projectDetails.querySelectorAll('article > *');

                            // Animación de entrada: desvanecer entrada del contenedor
                            gsap.to(projectDetails, {
                                opacity: 1,
                                duration: 0.3,
                                ease: "power2.out"
                            });

                            // Entrada escalonada de los elementos de información
                            gsap.fromTo(newChildren,
                                { y: 15, opacity: 0 },
                                { 
                                    y: 0, 
                                    opacity: 1, 
                                    duration: 0.4, 
                                    stagger: 0.04, 
                                    ease: "power2.out",
                                    onComplete: () => {
                                        // Restaurar scrollbar una vez completada la animación
                                        projectDetails.classList.remove('hide-scrollbar');
                                    }
                                }
                            );
                        }
                    });
                } else {
                    // Carga inicial
                    projectDetails.classList.add('hide-scrollbar');
                    projectDetails.innerHTML = sourceHTML;
                    projectDetails.scrollTop = 0;
                    
                    const newChildren = projectDetails.querySelectorAll('article > *');
                    gsap.fromTo(newChildren,
                        { y: 15, opacity: 0 },
                        { 
                            y: 0, 
                            opacity: 1, 
                            duration: 0.4, 
                            stagger: 0.04, 
                            ease: "power2.out",
                            onComplete: () => {
                                projectDetails.classList.remove('hide-scrollbar');
                            }
                        }
                    );
                }
            };

            // Lógica Escritorio: Intersection Observer
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        projectItems.forEach(i => {
                            i.classList.remove('active');
                        });
                        entry.target.classList.add('active');
                        
                        const id = entry.target.getAttribute('data-id');
                        if (id !== activeId) {
                            updateProjectDetails(id);
                            activeId = id;
                        }
                    }
                });
            }, { root: scrollContainer, rootMargin: '-40% 0px -40% 0px', threshold: 0 });

            projectItems.forEach(item => observer.observe(item));

            // --- INTERCEPCIÓN DE SCROLL (PROYECTO POR PROYECTO) ---
            let activeIndex = 0;
            let isAnimating = false;
            const articles = Array.from(projectItems);

            const scrollToProject = (index) => {
                if (index < 0 || index >= articles.length) return;
                isAnimating = true;
                activeIndex = index;

                const item = articles[index];
                
                // Actualizar inmediatamente la clase activa para respuesta visual instantánea
                projectItems.forEach(i => i.classList.remove('active'));
                item.classList.add('active');

                // Inyectar detalles e información del proyecto con transición premium
                const id = item.getAttribute('data-id');
                if (id !== activeId) {
                    updateProjectDetails(id);
                    activeId = id;
                }

                const itemCenter = item.offsetTop + (item.offsetHeight / 2);
                const containerCenter = scrollContainer.offsetHeight / 2;
                const targetTop = itemCenter - containerCenter;

                gsap.to(scrollContainer, {
                    scrollTop: targetTop,
                    duration: 0.3, // Animación muy rápida (300ms)
                    ease: "power2.out",
                    onComplete: () => {
                        isAnimating = false;
                    }
                });
            };

            const handleWheel = (e) => {
                e.preventDefault();
                if (isAnimating) return;

                if (e.deltaY > 0) {
                    if (activeIndex < articles.length - 1) {
                        scrollToProject(activeIndex + 1);
                    }
                } else if (e.deltaY < 0) {
                    if (activeIndex > 0) {
                        scrollToProject(activeIndex - 1);
                    }
                }
            };

            const eventHandlers = [];
            articles.forEach((item, index) => {
                const clickHandler = () => {
                    if (!isAnimating && index !== activeIndex) {
                        scrollToProject(index);
                    }
                };

                const keydownHandler = (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault(); // Evitar desplazamiento de página por la tecla espacio
                        if (!isAnimating && index !== activeIndex) {
                            scrollToProject(index);
                        }
                    }
                };

                item.addEventListener('click', clickHandler);
                item.addEventListener('keydown', keydownHandler);
                eventHandlers.push({ item, clickHandler, keydownHandler });
            });

            scrollContainer.addEventListener('wheel', handleWheel, { passive: false });

            // Alinear al primer proyecto inmediatamente al cargar
            setTimeout(() => scrollToProject(0), 100);

            return () => {
                observer.disconnect();
                scrollContainer.removeEventListener('wheel', handleWheel);
                eventHandlers.forEach(({ item, clickHandler, keydownHandler }) => {
                    item.removeEventListener('click', clickHandler);
                    item.removeEventListener('keydown', keydownHandler);
                });
                projectItems.forEach(i => i.classList.remove('active'));
            };
        }

        if (isMobile) {
            // Limpiar clases de escritorio previas
            projectItems.forEach(i => {
                i.classList.remove('active');
            });

            // Obtener altura dinámica del header
            const updateHeaderHeight = () => {
                const header = document.querySelector('header');
                const height = header ? header.offsetHeight : 90;
                document.documentElement.style.setProperty('--header-height-mobile', `${height}px`);
                return height;
            };

            updateHeaderHeight();
            window.addEventListener('resize', updateHeaderHeight);

            let currentIndex = 0;
            const totalProjects = projectItems.length;

            const updateMobileCards = (prevIndex, newIndex, animated = true) => {
                if (!animated) {
                    projectItems.forEach((item, index) => {
                        // Normal DOM order z-index: higher index stacks on top
                        item.style.zIndex = index + 1;

                        if (index < newIndex) {
                            gsap.set(item, {
                                y: "0%",
                                opacity: 0,
                                scale: 0.85,
                                filter: "blur(10px)",
                                pointerEvents: "none"
                            });
                            item.setAttribute('aria-hidden', 'true');
                            item.setAttribute('inert', '');
                        } else if (index === newIndex) {
                            gsap.set(item, {
                                y: "0%",
                                opacity: 1,
                                scale: 1,
                                filter: "blur(0px)",
                                pointerEvents: "auto"
                            });
                            item.setAttribute('aria-hidden', 'false');
                            item.removeAttribute('inert');
                        } else {
                            gsap.set(item, {
                                y: "100%",
                                opacity: 1,
                                scale: 1,
                                filter: "blur(0px)",
                                pointerEvents: "none"
                            });
                            item.setAttribute('aria-hidden', 'true');
                            item.setAttribute('inert', '');
                        }
                    });
                } else {
                    const oldCard = projectItems[prevIndex];
                    const newCard = projectItems[newIndex];

                    if (newIndex > prevIndex) {
                        // NEXT transition: oldCard scales down/fades/blurs, newCard slides UP
                        gsap.killTweensOf([oldCard, newCard]);

                        gsap.set(newCard, { y: "100%", opacity: 1, scale: 1, filter: "blur(0px)" });

                        gsap.to(oldCard, {
                            opacity: 0,
                            scale: 0.85,
                            filter: "blur(10px)",
                            pointerEvents: "none",
                            duration: 0.2,
                            ease: "power2.out",
                            onStart: () => {
                                oldCard.setAttribute('aria-hidden', 'true');
                                oldCard.setAttribute('inert', '');
                            }
                        });

                        gsap.to(newCard, {
                            y: "0%",
                            pointerEvents: "auto",
                            duration: 0.2,
                            ease: "power2.out",
                            onStart: () => {
                                newCard.setAttribute('aria-hidden', 'false');
                                newCard.removeAttribute('inert');
                            }
                        });
                    } else {
                        // PREV transition: oldCard slides DOWN, newCard scales up/fades in/unblurs
                        gsap.killTweensOf([oldCard, newCard]);

                        gsap.to(oldCard, {
                            y: "100%",
                            pointerEvents: "none",
                            duration: 0.2,
                            ease: "power2.out",
                            onStart: () => {
                                oldCard.setAttribute('aria-hidden', 'true');
                                oldCard.setAttribute('inert', '');
                            }
                        });

                        gsap.to(newCard, {
                            opacity: 1,
                            scale: 1,
                            filter: "blur(0px)",
                            pointerEvents: "auto",
                            duration: 0.2,
                            ease: "power2.out",
                            onStart: () => {
                                newCard.setAttribute('aria-hidden', 'false');
                                newCard.removeAttribute('inert');
                            }
                        });
                    }
                }

                // Actualizar contador y estado de los botones
                const counter = document.getElementById('mobile-proj-counter');
                if (counter) {
                    counter.textContent = `${newIndex + 1}/${totalProjects}`;
                }

                const prevBtn = document.getElementById('mobile-prev-btn');
                const nextBtn = document.getElementById('mobile-next-btn');

                if (prevBtn) prevBtn.disabled = (newIndex === 0);
                if (nextBtn) nextBtn.disabled = (newIndex === totalProjects - 1);
            };

            // Inicializar sin animación
            updateMobileCards(null, 0, false);

            const onNext = () => {
                if (currentIndex < totalProjects - 1) {
                    const prev = currentIndex;
                    currentIndex++;
                    updateMobileCards(prev, currentIndex, true);
                }
            };

            const onPrev = () => {
                if (currentIndex > 0) {
                    const prev = currentIndex;
                    currentIndex--;
                    updateMobileCards(prev, currentIndex, true);
                }
            };

            const nextBtn = document.getElementById('mobile-next-btn');
            const prevBtn = document.getElementById('mobile-prev-btn');

            if (nextBtn) nextBtn.addEventListener('click', onNext);
            if (prevBtn) prevBtn.addEventListener('click', onPrev);

            // Retornar función de limpieza
            return () => {
                window.removeEventListener('resize', updateHeaderHeight);
                document.documentElement.style.removeProperty('--header-height-mobile');
                
                if (nextBtn) nextBtn.removeEventListener('click', onNext);
                if (prevBtn) prevBtn.removeEventListener('click', onPrev);

                projectItems.forEach(i => {
                    i.style.removeProperty('opacity');
                    i.style.removeProperty('transform');
                    i.style.removeProperty('filter');
                    i.style.removeProperty('z-index');
                    i.style.removeProperty('pointer-events');
                    i.removeAttribute('aria-hidden');
                    i.removeAttribute('inert');
                });
            };
        }
    });
});
