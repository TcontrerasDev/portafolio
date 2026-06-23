# Portafolio WordPress Theme

Portafolio is a custom WordPress starter theme based on [Underscores (_s)](https://underscores.me/). It is designed as a personal portfolio theme with specific templates for profile, experience, projects, and contact pages. It features high-quality micro-animations via GSAP, responsive layout architecture, and dynamic CSS loading using Tailwind CSS v4.

## Project Overview

- **Main Technologies:** PHP (WordPress), Tailwind CSS v4 (loaded via browser CDN runtime), JavaScript (GSAP & ScrollTrigger), SASS (tooling configured in [package.json](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/package.json), but currently styled using modular plain CSS in `assets/librerias/css/`), Composer, NPM.
- **Base Theme:** Underscores (`_s`) by Automattic.
- **Author:** Tomas Contreras Moya - Tom.Dev.
- **Architecture:** 
    - [inc/](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/inc/): Core theme logic, customizer settings, and template tags.
    - [template-parts/](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/template-parts/): Reusable HTML fragments.
    - [assets/](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/): Modular asset management system (includes fonts, CSS, JS, menu, and widget functions).
    - [js/](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/js/): Standard fallback/theme JavaScript files.
    - [languages/](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/languages/): Translation files (`.pot`).

---

## Technical Stack & Configuration

### 1. Style & Framework Integration
- **Tailwind CSS v4:** Injected dynamically on the frontend via CDN using `@tailwindcss/browser@4` inside [assets/includes/js-functions.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/includes/js-functions.php).
- **GSAP & ScrollTrigger:** Integrated via CDN to power page layouts, custom mouse cursor rings, slide-in timelines, hover-based 3D rotations, and responsive accordions.
- **Google Fonts:** Loads `Space Grotesk` (for headings) and `JetBrains Mono` (for body/monospaced items) preconnected for efficiency via [assets/includes/fonts-functions.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/includes/fonts-functions.php).

### 2. WordPress Cleanup & Optimization
The entry file [assets/assets.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/assets.php) strips default bloat from the theme's frontend:
- Disables speculations rules, emoji detection script, and default block library inline CSS.
- Dequeues `global-styles`, `classic-theme-styles`, and block library stylesheets to maintain a clean stylesheet footprint.
- Automatically inserts customized SEO metadata, Open Graph (Facebook/Instagram), Twitter Card meta tags, and schema.org JSON-LD structured data for Tomás Contreras Moya in the `<head>`.

---

## Directory Structure & Modular Assets

### Asset Loader System
- [assets/assets.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/assets.php): Master inclusion file.
- [assets/includes/fonts-functions.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/includes/fonts-functions.php): Enqueues Google Fonts and adds preconnect links to filter hooks.
- [assets/includes/css-functions.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/includes/css-functions.php): Registers and conditionally enqueues style modules based on page queries (`is_front_page()`, `is_page('proyectos')`, etc.).
- [assets/includes/js-functions.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/includes/js-functions.php): Handles conditional scripting loading (GSAP, Tailwind CDN, and customized script scripts).
- [assets/includes/menu-functions.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/includes/menu-functions.php): Modifies theme custom logo rendering and defines two Custom Navigation Walkers for numbering lists (`01`, `02` format) and GSAP animations:
  - [Portafolio_Walker_Nav_Menu](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/includes/menu-functions.php#L47)
  - [Portafolio_Overlay_Walker_Nav_Menu](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/includes/menu-functions.php#L100)
- [assets/includes/widgets-functions.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/includes/widgets-functions.php): Widget area setup placeholder.

### Modular Styles (`assets/librerias/css/`)
- [global.css](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/librerias/css/global.css): Global background, Space Grotesk/JetBrains Mono typography definitions, custom interactive cursor layout (dot & ring), high-contrast accessibility focus outline styles (`:focus-visible`), and full-screen menu overlay styling.
- [index.css](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/librerias/css/index.css): Frontpage hero animations and lighting configurations.
- [proyectos.css](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/librerias/css/proyectos.css): Desktop projects snap-scroll panel alignment and interactive styles.
- [experiencia.css](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/librerias/css/experiencia.css): Timelines, connection lines, accordion heights, and transitions.
- [contacto.css](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/librerias/css/contacto.css): Contact detail links and button animation states.

### Modular Scripts (`assets/librerias/js/`)
- [global.js](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/librerias/js/global.js): Custom mouse follower animation, Canvas background grid rendering, and keyboard accessibility triggers.
- [menu.js](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/librerias/js/menu.js): Overlay menu opening/closing timeline triggers.
- [inicio.js](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/librerias/js/inicio.js): Split-text hero animations on page entry.
- [perfil.js](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/librerias/js/perfil.js): Profile picture fade-ins and 3D card layout tilt triggers.
- [proyectos.js](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/librerias/js/proyectos.js): Handles horizontal snap navigation and detail swaps.
- [experiencia.js](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/librerias/js/experiencia.js): Animates horizontal timelines on desktop and handles collapsible accordions on mobile.
- [contacto.js](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/assets/librerias/js/contacto.js): Injects mailto details and button hover effects.

---

## Custom Post Types & Advanced Custom Fields (ACF) Setup

To match the design and loop structures, you must register two Custom Post Types and configure the following ACF groups:

### 1. CPT: Proyecto (`proyecto`)
- **ACF Field Group:** `Detalles del Proyecto`
- **Fields:**
  - `rrss_proyecto` (Repeater)
    - `enlace_proyecto` (URL) - Link to repository or website.
    - `area_label` (Text) - Descriptive aria label for accessibility.
    - `seleccionar_icono` (Text) - FontAwesome class (e.g. `fa-brands fa-github`).

### 2. CPT: Experiencia (`experiencia`)
- **ACF Field Group:** `Detalles de Experiencia`
- **Fields:**
  - `fechas` (Text) - E.g. "2022 - Presente".
  - `establecimiento` (Text) - Organization or company name.
  - `roles` (Repeater)
    - `rol` (Text) - Role title, task description, or duty checklist item.

### 3. Page Templates (ACF fields applied to page types)
- **Home Page / Default Pages:**
  - `span_title_1` (Text) - First section of the split heading.
  - `span_title_2` (Text) - Second section of the split heading.
  - `span_subtitle_1` (Text) - Main subtitle text.
  - `span_subtitle_2` (Text) - Subtitle detailed description text.
- **Contacto Page:**
  - `titulo` (Text) - Form or section heading.
  - `correo` (Email) - E-mail address.
  - `redes` (Repeater)
    - `nombre` (Text) - Social network name.
    - `enlace` (URL) - Profile link.

---

## Building and Running

### Prerequisites
- PHP >= 5.6
- Node.js & NPM
- Composer
- A local WordPress environment (e.g., LocalWP, XAMPP, DevKinsta)

### Installation
1. Clone the repository into your WordPress `wp-content/themes/` directory.
2. Run `composer install` to install PHP development dependencies.
3. Run `npm install` to install JavaScript development dependencies.

### Development Commands
The following commands are available via NPM and Composer:

- **Linting:**
    - `composer lint:php`: Check PHP files for syntax errors.
    - `composer lint:wpcs`: Check PHP files against WordPress Coding Standards.
    - `npm run lint:js`: Check JavaScript files against WordPress JS Coding Standards.
    - `npm run lint:scss`: Check SASS files (if present) against CSS Coding Standards.
- **Compilation:**
    - `npm run compile:css`: Compiles SASS to CSS (Requires `sass/` directory).
    - `npm run compile:rtl`: Generates the RTL stylesheet from `style.css`.
    - `npm run watch`: Watches for SASS changes and recompiles.
- **Other:**
    - `composer make-pot`: Generates a `.pot` file for translations.
    - `npm run bundle`: Creates a `.zip` archive for distribution.

> **Note:** The `sass/` directory and `.scss` source files are currently missing from the root. If you intend to use SASS, ensure the source files are restored or edit `style.css` directly.

---

## Key Templates Mapping

The personal portfolio custom page templates are mapped as follows:

| Template Name | Page Template File | Reusable Template Part |
|---|---|---|
| Main Home | [home-page.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/home-page.php) | [content-home-page.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/template-parts/content-home-page.php) |
| Profile | [perfil-page.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/perfil-page.php) | [content-perfil-page.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/template-parts/content-perfil-page.php) |
| Experience | [exp-page.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/exp-page.php) | [content-exp-page.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/template-parts/content-exp-page.php) |
| Projects | [proyectos-page.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/proyectos-page.php) | [content-proyectos-page.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/template-parts/content-proyectos-page.php) |
| Contact | [contacto-page.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/contacto-page.php) | [content-contacto-page.php](file:///home/tom/htdocs/portafolio/wp-content/themes/portafolio/template-parts/content-contacto-page.php) |
