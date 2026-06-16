document.addEventListener('DOMContentLoaded', () => {
    // 1. Animación y seguimiento de cursor de .luz-hero (Efecto radial global)
    const luzHero = document.querySelector('.luz-hero');
    if (luzHero) {
        const mm = gsap.matchMedia();

        mm.add({
            isDesktop: "(min-width: 1025px)",
            isMobile: "(max-width: 1024px)",
            reduceMotion: "(prefers-reduced-motion: reduce)"
        }, (context) => {
            const { isDesktop, isMobile, reduceMotion } = context.conditions;

            if (reduceMotion) {
                // Si el usuario prefiere movimiento reducido, fijamos el estado estático en el centro
                gsap.set(luzHero, { x: 0, y: 0, xPercent: -50, yPercent: -50, scale: 1, opacity: 0.8 });
                return;
            }

            // Inicializar centrado estándar en GSAP
            gsap.set(luzHero, { x: 0, y: 0, xPercent: -50, yPercent: -50, scale: 0.85, opacity: 0.5 });

            // Animación infinita de pulso controlada por GSAP
            // const pulse = gsap.to(luzHero, {
            //     scale: 1.15,
            //     opacity: 0.8,
            //     duration: 6,
            //     ease: "sine.inOut",
            //     repeat: -1,
            //     yoyo: true
            // });

            // Movimiento interactivo suave desde el centro (solo en desktop)
            if (isDesktop) {
                const xTo = gsap.quickTo(luzHero, "x", { duration: 0.8, ease: "power2.out" });
                const yTo = gsap.quickTo(luzHero, "y", { duration: 0.8, ease: "power2.out" });

                const handleMouseMove = (e) => {
                    const xOffset = e.clientX - window.innerWidth / 2;
                    const yOffset = e.clientY - window.innerHeight / 2;
                    xTo(xOffset);
                    yTo(yOffset);
                };

                window.addEventListener('mousemove', handleMouseMove);

                return () => {
                    window.removeEventListener('mousemove', handleMouseMove);
                    // pulse.kill();
                };
            } else {
                // En mobile, forzar centro absoluto (x: 0, y: 0)
                gsap.set(luzHero, { x: 0, y: 0 });
                return () => {
                    // pulse.kill();
                };
            }
        });
    }

    // 2. Hover Premium: Rollover Staggered (Efecto Awwwards para .menu-link-fill)
    const menuLinks = document.querySelectorAll('.menu-link-fill');
    menuLinks.forEach(link => {
        const text = link.textContent.trim();
        if (!text) return;

        // Limpiar el contenido original y preparar estilos inline mínimos
        link.textContent = '';
        link.style.overflow = 'hidden';
        link.style.verticalAlign = 'bottom';

        // Determinar colores según el estado activo/pasivo del enlace
        const parentLink = link.closest('a');
        const isOverlayMenu = link.closest('#full-screen-menu');
        const isPurple = isOverlayMenu || link.classList.contains('text-[#9B59B6]') || (parentLink && parentLink.classList.contains('text-[#9B59B6]'));
        const hoverColorClass = isPurple ? 'text-white' : 'text-[#9B59B6]';

        // Contenedor del texto original
        const origSpan = document.createElement('span');
        origSpan.className = 'inline-block orig-text';

        // Contenedor del texto duplicado que desliza
        const hoverSpan = document.createElement('span');
        hoverSpan.className = `absolute left-0 top-full inline-block hover-text ${hoverColorClass}`;

        // Llenar con caracteres individuales
        [...text].forEach(char => {
            const charSpanOrig = document.createElement('span');
            charSpanOrig.textContent = char === ' ' ? '\u00A0' : char;
charSpanOrig.className = 'inline-block char-orig';
            origSpan.appendChild(charSpanOrig);

            const charSpanHover = document.createElement('span');
            charSpanHover.textContent = char === ' ' ? '\u00A0' : char;
            charSpanHover.className = 'inline-block char-hover';
            hoverSpan.appendChild(charSpanHover);
        });

        link.appendChild(origSpan);
        link.appendChild(hoverSpan);

        const origChars = origSpan.querySelectorAll('.char-orig');
        const hoverChars = hoverSpan.querySelectorAll('.char-hover');
        const numberSpan = parentLink ? parentLink.querySelector('.menu-link-number') : null;

        // Crear línea de tiempo de hover coordinada
        const hoverTL = gsap.timeline({ paused: true });

        hoverTL.to(origChars, {
            yPercent: -100,
            stagger: 0.02,
            duration: 0.45,
            ease: "power2.inOut"
        }, 0)
        .to(hoverChars, {
            yPercent: -100,
            stagger: 0.02,
            duration: 0.45,
            ease: "power2.inOut"
        }, 0);

        // Si hay número (como "01"), invertimos su color
        if (numberSpan) {
            const targetColor = isPurple ? '#ffffff' : '#9B59B6';
            hoverTL.to(numberSpan, {
                color: targetColor,
                duration: 0.3,
                ease: "power2.out"
            }, 0);
        }

        // Listener en el tag <a> completo
        const hoverTarget = parentLink || link;
        hoverTarget.addEventListener('mouseenter', () => hoverTL.play());
        hoverTarget.addEventListener('mouseleave', () => hoverTL.reverse());
    });

    // 3. Animación de Entrada Global del Header (Logo/Enlaces y líneas del botón hamburguesa)
    const header = document.querySelector('header');
    if (header) {
        const mmHeader = gsap.matchMedia();
        mmHeader.add({
            reduceMotion: "(prefers-reduced-motion: reduce)",
            allowMotion: "(prefers-reduced-motion: no-preference)"
        }, (context) => {
            const { reduceMotion } = context.conditions;
            if (reduceMotion) return;

            const headerTL = gsap.timeline({ defaults: { ease: 'power3.out' } });

            const logo = header.querySelector('#logo');
            const navLinks = header.querySelectorAll('ul li');
            const line1 = header.querySelector('#menu-toggle .line-1');
            const line2 = header.querySelector('#menu-toggle .line-2');

            // Si hay logo (subpáginas: perfil, proyectos, contacto), deslizar desde arriba
            if (logo) {
                headerTL.from(logo, {
                    y: -25,
                    opacity: 0,
                    duration: 0.8
                }, 0.2);
            }
            // Si hay enlaces directos (index), revelar escalonado
            else if (navLinks.length > 0) {
                headerTL.from(navLinks, {
                    y: -25,
                    opacity: 0,
                    stagger: 0.08,
                    duration: 0.8
                }, 0.2);
            }

            // Dibujo dinámico de las líneas del botón hamburguesa en todas las páginas
            if (line1 && line2) {
                headerTL.from(line1, {
                    attr: { x2: 10 },
                    duration: 0.8
                }, logo ? 0.2 : 0.4)
                .from(line2, {
                    attr: { x2: 30.0006 },
                    duration: 0.8
                }, logo ? 0.3 : 0.5);
            }
        });
    }

    // 4. Inyección y animación del cursor personalizado (Solo desktop no-táctil)
    const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    if (!isTouchDevice) {
        // Crear elementos del cursor dinámicamente
        const cursorDot = document.createElement('div');
        cursorDot.className = 'custom-cursor-dot';
        const cursorRing = document.createElement('div');
        cursorRing.className = 'custom-cursor-ring';

        document.body.appendChild(cursorDot);
        document.body.appendChild(cursorRing);
        document.body.classList.add('js-cursor-loaded');

        // Configurar quickTo para dot (rápido) y ring (desplazamiento suavizado con delay)
        const dotX = gsap.quickTo(cursorDot, "x", { duration: 0.08, ease: "power3.out" });
        const dotY = gsap.quickTo(cursorDot, "y", { duration: 0.08, ease: "power3.out" });
        const ringX = gsap.quickTo(cursorRing, "x", { duration: 0.3, ease: "power2.out" });
        const ringY = gsap.quickTo(cursorRing, "y", { duration: 0.3, ease: "power2.out" });

        // Evento de movimiento del ratón
        window.addEventListener('mousemove', (e) => {
            dotX(e.clientX);
            dotY(e.clientY);
            ringX(e.clientX);
            ringY(e.clientY);
        });

        // Ocultar/mostrar cursor al salir/entrar de la pantalla del navegador
        document.addEventListener('mouseleave', () => {
            gsap.to([cursorDot, cursorRing], { opacity: 0, duration: 0.3 });
        });
        document.addEventListener('mouseenter', () => {
            gsap.to([cursorDot, cursorRing], { opacity: 1, duration: 0.3 });
        });

        // Delegación de eventos óptima para hover en elementos interactivos
        const hoverElements = 'a, button, .cursor-pointer, input[type="submit"], [role="button"]';
        
        document.addEventListener('mouseover', (e) => {
            const target = e.target.closest(hoverElements);
            if (target) {
                cursorDot.classList.add('cursor-hover');
                cursorRing.classList.add('cursor-hover');
            }
        });

        document.addEventListener('mouseout', (e) => {
            const target = e.target.closest(hoverElements);
            if (target) {
                const relatedTarget = e.relatedTarget ? e.relatedTarget.closest(hoverElements) : null;
                if (!relatedTarget) {
                    cursorDot.classList.remove('cursor-hover');
                    cursorRing.classList.remove('cursor-hover');
                }
            }
        });
    }

    // 5. Cuadrícula Técnica Interactiva por Canvas
    const initInteractiveGrid = () => {
        const canvas = document.createElement('canvas');
        canvas.id = 'interactive-grid';
        document.body.prepend(canvas);
        document.body.classList.add('js-grid-loaded');

        // Ocultar overlay de fondo si existe para poder ver el Canvas claramente
        const overlay = document.querySelector('div[class*="bg-[#010101f0]"]');
        if (overlay) {
            overlay.style.display = 'none';
        }

        const ctx = canvas.getContext('2d');
        let width = 0;
        let height = 0;
        const gridSpacing = 40; // Píxeles de espaciado para igualar el CSS original

        // Coordenadas para cálculo e interpolación
        let mouseX = -1000;
        let mouseY = -1000;
        let targetMouseX = -1000;
        let targetMouseY = -1000;
        let animId = null;

        const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        // Ajustar resolución de pantalla (High-DPI / Retina)
        const resizeCanvas = () => {
            const dpr = window.devicePixelRatio || 1;
            width = window.innerWidth;
            height = window.innerHeight;
            canvas.width = width * dpr;
            canvas.height = height * dpr;
            ctx.scale(dpr, dpr);
            drawGrid();
        };

        const drawGrid = () => {
            ctx.clearRect(0, 0, width, height);

            // 1. Dibujar líneas base fijas y muy sutiles
            ctx.beginPath();
            ctx.strokeStyle = 'rgba(155, 89, 182, 0.04)';
            ctx.lineWidth = 1;

            // Líneas verticales
            for (let x = 0; x < width; x += gridSpacing) {
                ctx.moveTo(x, 0);
                ctx.lineTo(x, height);
            }
            // Líneas horizontales
            for (let y = 0; y < height; y += gridSpacing) {
                ctx.moveTo(0, y);
                ctx.lineTo(width, y);
            }
            ctx.stroke();

            // 2. Dibujar puntos de intersección base (micro-puntos muy sutiles)
            ctx.fillStyle = 'rgba(155, 89, 182, 0.02)'; // Reducido de 0.08 a 0.02
            for (let x = 0; x < width; x += gridSpacing) {
                for (let y = 0; y < height; y += gridSpacing) {
                    ctx.beginPath();
                    ctx.arc(x, y, 0.75, 0, Math.PI * 2); // Reducido de 1 a 0.75
                    ctx.fill();
                }
            }

            // 3. Dibujar brillo de interacción (solo en desktop no-táctil y sin prefers-reduced-motion)
            if (!isTouchDevice && !reduceMotion && mouseX > -500 && mouseY > -500) {
                const radius = 220; // Radio del brillo

                // A. Crear degradado radial para las líneas de la cuadrícula
                const lineGrad = ctx.createRadialGradient(mouseX, mouseY, 0, mouseX, mouseY, radius);
                lineGrad.addColorStop(0, 'rgba(155, 89, 182, 0.25)'); // Brillo en el centro
                lineGrad.addColorStop(1, 'rgba(155, 89, 182, 0.0)');

                ctx.beginPath();
                ctx.strokeStyle = lineGrad;
                ctx.lineWidth = 1;

                // Optimización crítica: Solo iterar dentro del área del mouse
                const startX = Math.max(0, Math.floor((mouseX - radius) / gridSpacing) * gridSpacing);
                const endX = Math.min(width, Math.ceil((mouseX + radius) / gridSpacing) * gridSpacing);
                const startY = Math.max(0, Math.floor((mouseY - radius) / gridSpacing) * gridSpacing);
                const endY = Math.min(height, Math.ceil((mouseY + radius) / gridSpacing) * gridSpacing);

                for (let x = startX; x <= endX; x += gridSpacing) {
                    ctx.moveTo(x, startY);
                    ctx.lineTo(x, endY);
                }
                for (let y = startY; y <= endY; y += gridSpacing) {
                    ctx.moveTo(startX, y);
                    ctx.lineTo(endX, y);
                }
                ctx.stroke();

                // B. Crear degradado radial para los puntos de intersección
                const dotGrad = ctx.createRadialGradient(mouseX, mouseY, 0, mouseX, mouseY, radius);
                dotGrad.addColorStop(0, 'rgba(155, 89, 182, 0.85)'); // Aumentado de 0.7 a 0.85 para mayor contraste
                dotGrad.addColorStop(0.3, 'rgba(155, 89, 182, 0.35)');
                dotGrad.addColorStop(1, 'rgba(155, 89, 182, 0.0)');

                ctx.fillStyle = dotGrad;
                for (let x = startX; x <= endX; x += gridSpacing) {
                    for (let y = startY; y <= endY; y += gridSpacing) {
                        const dx = x - mouseX;
                        const dy = y - mouseY;
                        const dist = Math.sqrt(dx * dx + dy * dy);
                        if (dist < radius) {
                            ctx.beginPath();
                            // El punto se agranda desde 0.75 hasta 2.5px según proximidad
                            const r = 0.75 + (1 - dist / radius) * 1.75;
                            ctx.arc(x, y, r, 0, Math.PI * 2);
                            ctx.fill();
                        }
                    }
                }
            }
        };

        // Loop de animación con interpolación (lerp) para el lag líquido premium
        const update = () => {
            const dx = targetMouseX - mouseX;
            const dy = targetMouseY - mouseY;

            // Si ya estamos muy cerca de la posición objetivo, detener el loop de animación
            if (Math.abs(dx) < 0.1 && Math.abs(dy) < 0.1) {
                mouseX = targetMouseX;
                mouseY = targetMouseY;
                drawGrid();
                animId = null;
                return;
            }

            mouseX += dx * 0.08;
            mouseY += dy * 0.08;

            drawGrid();
            animId = requestAnimationFrame(update);
        };

        // Eventos de redimensionamiento
        window.addEventListener('resize', resizeCanvas);

        // Eventos del mouse (solo si no es táctil ni prefiere movimiento reducido)
        if (!isTouchDevice && !reduceMotion) {
            window.addEventListener('mousemove', (e) => {
                const isFirstMove = (targetMouseX === -1000 && targetMouseY === -1000);
                targetMouseX = e.clientX;
                targetMouseY = e.clientY;

                if (isFirstMove) {
                    mouseX = targetMouseX;
                    mouseY = targetMouseY;
                }

                if (!animId) {
                    animId = requestAnimationFrame(update);
                }
            });

            document.addEventListener('mouseenter', (e) => {
                mouseX = targetMouseX = e.clientX;
                mouseY = targetMouseY = e.clientY;
                if (!animId) {
                    animId = requestAnimationFrame(update);
                }
            });

            document.addEventListener('mouseleave', () => {
                targetMouseX = -1000;
                targetMouseY = -1000;
                if (!animId) {
                    animId = requestAnimationFrame(update);
                }
            });
        }

        // Inicializar tamaño y primer renderizado
        resizeCanvas();
    };

    initInteractiveGrid();
});
