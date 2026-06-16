# Portafolio - Tomas Contreras

## Project Overview
This is a static portfolio website for **Tomas Contreras**, a Front-End Developer and UX/UI Designer. The project is designed with a modern, dark-themed aesthetic featuring a radial light effect and a grid background.

### Key Technologies
- **HTML5**: Semantic structure.
- **Tailwind CSS v4**: Utilized via the browser script for rapid styling.
- **GSAP (GreenSock Animation Platform)**: Integrated via CDN for high-end ("Awwwards level") animations and transitions.
- **FontAwesome 6.5.1**: Used for social media and general iconography.
- **Google Fonts**: 
    - `Space Grotesk`: Used for headings and branding.
    - `JetBrains Mono`: Used for body text, navigation, and technical details.

## Project Structure
```text
/
├── index.html            # Main entry point and full-screen menu structure
├── perfil.html           # Profile/About Me page with specific animations
├── experiencia.html      # Interactive timeline page for professional experience
├── contacto.html         # Contact page with reveal and interactive elements
├── proyectos.html        # Projects showcase page (desktop: dual-column, mobile: stacking cards)
├── GEMINI.md             # Project documentation and conventions
└── assets/
    ├── css/
    │   ├── global.css    # Background grid, base typography, global resets, and .luz-hero style
    │   ├── index.css     # Tailwind imports, hero effects, and custom text animations
    │   ├── experiencia.css # Styles for horizontal timeline track, cards, navigation arrows, and mobile accordion
    │   ├── contacto.css  # Hardware acceleration and CSS-based button/link hover transitions
    │   └── proyectos.css # Scroll behavior, card stacking layout, and mobile/desktop states
    ├── img/
    │   └── Isotipo.png   # Brand logo
    └── js/
        ├── global.js     # Shared animations (puntero, luz-hero y revelado global de cabecera)
        ├── menu.js       # GSAP-powered logic for menu toggle and interactions
        ├── inicio.js     # Home page entrance reveal animations
        ├── perfil.js     # Profile page-specific entrance reveal animations
        ├── experiencia.js # Horizontal timeline animations, programmatic centering, and mobile accordion toggle
        ├── contacto.js   # Contact page-specific entrance reveal animations
        └── proyectos.js  # Project details templating, IntersectionObserver (desktop), and ScrollTrigger (mobile)
```

## Development Conventions

### Theming & Aesthetics
- **Core Colors**:
    - Background: `#010101`
    - Accent: `#9B59B6` (Purple)
    - Contrast: `white`
- **Typography**: 
    - Use `Space Grotesk` for headings and brand elements.
    - Use `JetBrains Mono` for navigation links and code-like text.
- **Custom Cursor**: Custom dual-element cursor (dot + lag-ring) for desktop devices.
    - Hovering interactive elements expands the ring to solid purple with scale, and shrinks the inner dot.
    - Implemented with dynamic fallback: native cursor is only hidden when JavaScript loads successfully.
- **Scroll & Background Containment**:
    - For full-viewport layouts (e.g. `contacto.html`), body scroll is disabled (`overflow: hidden`) to keep the grid/glow background fixed.
    - Scroll is handled internally by the `main` tag with dynamic viewport height (`h-screen`) and padding safeguards.

### Navigation (Full-Screen Menu)
- **Menu Toggle**: The hamburger icon transforms into a "rotated T/arrow" shape when active.
- **Header States**: When the menu is open, the main header navigation links must be hidden via GSAP to focus on the menu content.
- **Hover Effects (Staggered Rollover)**:
    - **Wave Rollover**: Links use a JS split-text wave transition. Hovering slides characters up while duplicates slide in from below.
    - **Color Inversion**: Overlay links start as purple and transition to white; header nav links start as white and transition to purple.
    - **Coordinated Numbers**: The corresponding numbers slide/fade to match the text color transition.
- **Height-Responsive Layout**:
    - Menu link sizes and gaps scale fluidly on short screens using `vh` and `clamp()`.
    - Viewports below `620px` in height automatically hide the logo/branding column to guarantee link accessibility.

### Projects Showcase (Responsiveness & Animations)
- **Desktop Layout (`min-width: 1025px`)**:
    - **Dual-column structure**: Left column shows dynamic details of the currently hovered/active project. Right column contains a scrollable list of project names.
    - **Active States**: List items snap to center (`scroll-snap-align: center`) and transition smoothly. The active item has `opacity: 1`, `filter: blur(0)`, and a scale of `1.05`. Non-active items are blurred (`blur(6px)`) and dimmed (`opacity: 0.3`).
    - **Detection**: Intersection Observer is set to trigger when project list items cross the center of the list container (`rootMargin: '-40% 0px -40% 0px'`).
- **Mobile Layout (`max-width: 1024px`)**:
    - **Stacking Cards**: Projects are styled as full-height sticky panels (`position: sticky; top: 0; height: 100vh`) stacked on top of one another.
    - **GSAP ScrollTrigger**: Older cards fade out (`opacity: 0`), scale down (`scale(0.85)`), and blur (`blur(10px)`) as the user scrolls them away, revealing the next card underneath.
    - **Content Injection**: Project details are pre-rendered inline inside the `.project-mobile-content` container of each card.

### Experience Timeline Showcase (Responsiveness & Animations)
- **Desktop Layout (`min-width: 1025px`)**:
    - **Horizontal Timeline**: Experience cards are organized horizontally on a single track connected by a centered line.
    - **Active Card & Navigation**: Clicking the next/previous navigation arrows scrolls and centers the active card. Non-active items are dimmed, and arrows are disabled at the track boundaries.
    - **Center Alignment**: Precise programmatic offset calculation ensures the selected card is perfectly centered in the viewport.
- **Mobile Layout (`max-width: 1024px`)**:
    - **Interactive Accordion**: The horizontal track is hidden, and experience items stack vertically as an accordion.
    - **Accordion Toggle**: Clicking an item expands its content smoothly via GSAP, while changing its border and background styling to purple.
- **Prefers-Reduced-Motion**: Under user motion restrictions, all dynamic timeline transitions and translations are disabled, rendering a static, fully accessible layout.

### Accessibility & AI Agent Skills
- **Accessibility Standards**: The project prioritizes high accessibility, implementing responsive layouts and motion preferences support (`prefers-reduced-motion`).
- **Installed Agent Skills**: To guarantee WCAG compliance and standard-compliant coding, 27 accessibility skills from `mgifford/accessibility-skills` are installed under `.agents/skills/`.
    - Key skills include `color-contrast`, `keyboard`, `aria-live-regions`, `image-alt-text`, `touch-pointer`, `forms`, and `navigation`.
    - These skills guide AI agents during coding to ensure all interactive states, labels, contrasts, and structures are fully accessible.

### Animation Standards
- **GSAP First**: Use GSAP for any complex state transitions or interactive animations.
- **Easing**: Prefer `expo.out` or `power3.out` for sophisticated, high-end movement.
- **Modularity**: Keep animation logic in `assets/js/` and component-specific styles in `assets/css/index.css`.

## Building and Running
No build step required (Tailwind Browser script). Use `Live Server` or any static file host.
