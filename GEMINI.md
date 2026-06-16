# Portafolio WordPress Theme

Portafolio is a custom WordPress starter theme based on [Underscores (_s)](https://underscores.me/). It is designed as a personal portfolio theme with specific templates for profile, experience, projects, and contact pages.

## Project Overview

- **Main Technologies:** PHP (WordPress), JavaScript, SASS (tooling present, but `.scss` files missing in root), Composer, NPM.
- **Base Theme:** Underscores (`_s`) by Automattic.
- **Author:** Tomas Contreras Moya - Tom.Dev.
- **Architecture:** 
    - `inc/`: Core theme logic, customizer settings, and template tags.
    - `template-parts/`: Reusable HTML fragments.
    - `assets/`: Modular asset management system (includes fonts, CSS, JS, menu, and widget functions).
    - `js/`: Frontend JavaScript files.
    - `languages/`: Translation files (`.pot`).

## Building and Running

### Prerequisites
- PHP >= 5.6
- Node.js & NPM
- Composer
- A local WordPress environment (e.g., XAMPP, Local, DevKinsta)

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

## Development Conventions

- **File Naming:** Follow standard WordPress naming conventions (e.g., `content-{slug}.php` for template parts, `{slug}-page.php` for page templates).
- **Coding Standards:** Adhere to [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/) for PHP, JS, and CSS. Use the provided linting tools to verify.
- **Template Parts:** Use `get_template_part( 'template-parts/content', 'name' )` to include reusable UI components.
- **Asset Management:** While standard WordPress enqueuing is used in `functions.php`, there is a modular system started in `assets/assets.php`. Prefer using `assets/includes/` for specific asset-related logic to keep `functions.php` clean.

## Key Files

- `functions.php`: Theme initialization and core setup.
- `style.css`: Main stylesheet and theme metadata.
- `assets/assets.php`: Entry point for modular asset enqueuing.
- `template-parts/`: Contains specific content blocks for different page types.
- `home-page.php`, `perfil-page.php`, `exp-page.php`, `proyectos-page.php`, `contacto-page.php`: Custom page templates.
