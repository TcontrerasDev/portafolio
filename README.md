# Portafolio Profesional - Tomas Contreras

Este es el sitio web de portafolio estático para **Tomas Contreras**, Desarrollador Front-End y Diseñador UX/UI. El proyecto presenta una estética de tema oscuro de alta gama ("Awwwards level") con efectos de iluminación radiales y un fondo de cuadrícula retro-futurista, complementado por animaciones de alta calidad y un fuerte enfoque en la accesibilidad.

## Tecnologías Utilizadas

- **HTML5**: Estructuración semántica de cada una de las páginas.
- **Tailwind CSS v4**: Cargado de manera dinámica mediante script de navegador para un estilado y maquetación ágiles.
- **GSAP (GreenSock Animation Platform)**: Utilizado para orquestar animaciones de entrada, efectos al hacer scroll (ScrollTrigger) e interactividad fluida.
- **FontAwesome 6.5.1**: Iconografía del sitio y enlaces a redes sociales.
- **Google Fonts**:
  - `Space Grotesk`: Para títulos llamativos, marcas y encabezados.
  - `JetBrains Mono`: Para texto de cuerpo, enlaces de navegación y detalles de estilo de código.

---

## Estructura del Proyecto

El proyecto está organizado de manera modular e intuitiva:

```text
/
├── index.html            # Página de inicio y estructura del menú a pantalla completa
├── perfil.html           # Página "Sobre Mí" con animaciones y detalles personales
├── experiencia.html      # Página de trayectoria profesional interactiva
├── proyectos.html        # Galería de proyectos destacados (adaptativa)
├── contacto.html         # Formulario/Detalles de contacto con efectos interactivos
├── GEMINI.md             # Guía interna para asistentes IA y estándares del proyecto
├── README.md             # Documentación principal del proyecto (este archivo)
└── assets/
    ├── css/
    │   ├── global.css    # Fondo de cuadrícula, reseteo, tipografía base y luz-hero
    │   ├── index.css     # Importaciones de Tailwind, efectos hero y animaciones de texto
    │   ├── experiencia.css # Estilos de línea de tiempo horizontal, tarjetas y versión móvil
    │   ├── contacto.css  # Transiciones CSS y aceleración de hardware para botones
    │   └── proyectos.css # Scroll, tarjetas apiladas y estados adaptativos de la galería
    ├── img/
    │   └── Isotipo.png   # Logotipo del portafolio
    └── js/
        ├── global.js     # Lógica transversal (cursor interactivo y efecto luz-hero)
        ├── menu.js       # Control y animación por GSAP del menú a pantalla completa
        ├── inicio.js     # Animación de revelado de la página de inicio
        ├── perfil.js     # Animaciones de entrada específicas para la sección perfil
        ├── experiencia.js # Navegación de la línea de tiempo y acordeón en dispositivos móviles
        ├── contacto.js   # Animaciones de entrada específicas para la sección contacto
        └── proyectos.js  # Lógica de carga de proyectos y triggers de scroll/observadores
```

---

## Características y Animaciones Destacadas

### Cursor Personalizado Dinámico
- Cuenta con un cursor doble interactivo (un punto central y un anillo exterior con retraso/lag).
- Al interactuar con botones o enlaces (`a`, `button`, etc.), el anillo se expande y cambia a color púrpura sólido mientras el punto se encoge.
- **Fallback Seguro**: Si Javascript no se carga correctamente, se utiliza el cursor nativo del sistema de manera automática sin romper la experiencia.

### Menú de Pantalla Completa
- El icono de hamburguesa se transforma dinámicamente en una forma de "T rotada" o flecha cuando el menú está abierto.
- Al abrirse, los enlaces de cabecera estándar se ocultan con GSAP para centrar la atención en el menú a pantalla completa.
- **Efecto Hover Avanzado (Wave Rollover)**: Los textos de los enlaces utilizan una división de caracteres que genera una ola de texto al deslizarse hacia arriba, con letras duplicadas entrando desde abajo.
- **Inversión de Color**: Los enlaces comienzan en púrpura y pasan a blanco coordinadamente con sus números de sección.
- **Adaptabilidad a la Altura**: En pantallas de baja altura (menor a `620px`), el logotipo y la columna lateral se ocultan automáticamente para priorizar el menú de enlaces.

### Galería de Proyectos (Doble Modo Adaptativo)
- **Escritorio (`min-width: 1025px`)**: Diseño de doble columna. La columna izquierda muestra los detalles del proyecto activo, mientras la derecha es una lista con scroll vertical. Al hacer scroll, los elementos se centran (`scroll-snap-align: center`). Los elementos activos se enfocan (sin desenfoque, opacidad al 100% y escala de 1.05), mientras que los no activos se difuminan con desenfoque gaussiano y bajan su opacidad. Detectado vía `IntersectionObserver`.
- **Móvil (`max-width: 1024px`)**: Las tarjetas de proyectos se apilan de forma fija (`sticky panels`) con una altura de `100vh`. Mediante GSAP `ScrollTrigger`, las tarjetas anteriores se difuminan, se reducen en escala y se desvanecen gradualmente a medida que el usuario hace scroll hacia abajo para revelar el siguiente proyecto.

### Línea de Tiempo de Experiencia (Doble Modo Adaptativo)
- **Escritorio (`min-width: 1025px`)**: Una trayectoria horizontal conectada por una línea central. Contiene botones de navegación previa/siguiente que calculan dinámicamente el desplazamiento para centrar la tarjeta de experiencia activa exactamente en pantalla.
- **Móvil (`max-width: 1024px`)**: La vista horizontal se apaga y se despliega un acordeón vertical interactivo. Al pulsar una tarjeta, esta se expande de manera fluida usando GSAP, iluminando el borde y el fondo en color púrpura.

---

## Accesibilidad (A11y)

Este portafolio ha sido diseñado priorizando la inclusión y los estándares de accesibilidad web (WCAG 2.1/2.2):
- **Soporte de Reducción de Movimiento**: Respeta la preferencia del sistema `prefers-reduced-motion`. Si el usuario tiene deshabilitadas las animaciones complejas, las transiciones dinámicas se desactivan, ofreciendo una navegación estática limpia y funcional.
- **Habilidades de Accesibilidad Integradas**: Se incorporan validaciones basadas en 27 destrezas de accesibilidad (de `mgifford/accessibility-skills`) tales como contraste de colores apto, navegación completa por teclado, etiquetas ARIA y alternativos de imágenes.

---

## Instalación y Ejecución Local

Dado que el portafolio está estructurado como un sitio web estático (procesando Tailwind CSS directamente en el navegador):
1. **Clona el repositorio**:
   ```bash
   git clone <url-del-repositorio>
   cd portafolio
   ```
2. **Ejecuta un servidor web estático**:
   No necesitas procesos de construcción o instalación de paquetes `npm`. Puedes usar cualquiera de las siguientes herramientas:
   - **VS Code Live Server**: Instala la extensión e inicia el servidor con un clic.
   - **Python 3**:
     ```bash
     python3 -m http.server 8000
     ```
     Luego abre [http://localhost:8000](http://localhost:8000) en tu navegador.
   - **Node.js (npx)**:
     ```bash
     npx serve .
     ```

---

## Licencia

Este proyecto está bajo licencia de su respectivo autor. Queda prohibida la reproducción parcial o total con fines comerciales sin autorización previa de Tomas Contreras.
