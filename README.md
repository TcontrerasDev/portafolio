# Portafolio WordPress Theme

Portafolio is a custom WordPress starter theme designed as a personal portfolio website. It is built upon the Underscores (_s) starter theme by Automattic and modified to include specific modular asset management and custom page templates.

This repository branch contains the WordPress theme version of the site, whereas the main branch hosts the static HTML/CSS version.

## Key Information

* Theme Name: Portafolio
* Author: Tomas Contreras Moya - Tom.Dev
* Base Theme: Underscores (_s)
* Text Domain: portafolio
* Requires PHP: 5.6 or higher
* License: GNU General Public License v2 or later

## Project Structure and Architecture

The theme organizes its core logic and frontend resources as follows:

* **inc/**: Houses core PHP theme logic, customizer settings, and template tags.
* **template-parts/**: Contains reusable HTML template fragments (e.g., header, footer, content loop files).
* **assets/**: Features a modular asset management system that handles fonts, CSS, JavaScript, menus, and widget functions.
* **js/**: Holds frontend JavaScript functionality.
* **languages/**: Contains translation files (.pot).

### Custom Page Templates

To support a portfolio layout, the theme implements the following custom templates:

* **home-page.php**: The main landing page template.
* **perfil-page.php**: The user profile/about page template.
* **exp-page.php**: The professional experience page template.
* **proyectos-page.php**: The portfolio projects display page template.
* **contacto-page.php**: The contact form and info page template.

## Installation and Setup

### Prerequisites

* Local WordPress installation (e.g., LocalWP, XAMPP, DevKinsta)
* PHP version 5.6 or higher
* Node.js and npm
* Composer

### Steps

1. Clone or copy this theme folder into your WordPress installation's `wp-content/themes/` directory.
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install Node.js dependencies:
   ```bash
   npm install
   ```

## Development and Compilation Commands

The following commands are defined in the project configuration files (composer.json and package.json) to aid development:

* **PHP Linting**:
  * `composer lint:php`: Checks PHP files for syntax errors.
  * `composer lint:wpcs`: Checks PHP files against WordPress Coding Standards (WPCS).
* **SASS and CSS Compilation**:
  * `npm run compile:css`: Compiles SASS stylesheet files to CSS.
  * `npm run compile:rtl`: Generates the RTL stylesheet from style.css.
  * `npm run watch`: Automatically watches for changes in SASS files and compiles them.
* **JavaScript Linting**:
  * `npm run lint:js`: Verifies JS files against WordPress JavaScript Coding Standards.
* **Other Tools**:
  * `composer make-pot`: Generates a translation template (.pot) file in the languages directory.
  * `npm run bundle`: Packs the theme into a zip file for distribution, excluding development and system files.
