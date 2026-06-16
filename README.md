# Tema de WordPress Portafolio

Portafolio es un tema de inicio personalizado para WordPress diseñado como un sitio web de portafolio personal. Está construido sobre el tema de inicio Underscores (_s) de Automattic y modificado para incluir un sistema de gestión de recursos modular y plantillas de página personalizadas.

Esta rama del repositorio contiene la versión del tema de WordPress del sitio, mientras que la rama main aloja la versión estática en HTML/CSS.

## Información Clave

* Nombre del tema: Portafolio
* Autor: Tomas Contreras Moya - Tom.Dev
* Tema base: Underscores (_s)
* Dominio de texto: portafolio
* Requiere PHP: 5.6 o superior
* Licencia: GNU General Public License v2 o posterior

## Estructura del Proyecto y Arquitectura

El tema organiza su lógica central y recursos frontend de la siguiente manera:

* **inc/**: Contiene la lógica central del tema en PHP, configuraciones del personalizador (customizer) y etiquetas de plantilla (template tags).
* **template-parts/**: Contiene fragmentos de plantilla HTML reutilizables (por ejemplo, cabecera, pie de página, archivos de bucle de contenido).
* **assets/**: Presenta un sistema de gestión de recursos modular que maneja fuentes, CSS, JavaScript, menús y funciones de widgets.
* **js/**: Contiene la funcionalidad de JavaScript para el frontend.
* **languages/**: Contiene archivos de traducción (.pot).

### Plantillas de Página Personalizadas

Para admitir el diseño de un portafolio, el tema implementa las siguientes plantillas personalizadas:

* **home-page.php**: La plantilla de la página de inicio principal.
* **perfil-page.php**: La plantilla de la página de perfil/sobre mí.
* **exp-page.php**: La plantilla de la página de experiencia profesional.
* **proyectos-page.php**: La plantilla de la página de visualización de proyectos del portafolio.
* **contacto-page.php**: La plantilla de la página de formulario e información de contacto.

## Instalación y Configuración

### Prerrequisitos

* Instalación local de WordPress (por ejemplo, LocalWP, XAMPP, DevKinsta).
* Versión de PHP 5.6 o superior.
* Node.js y npm.
* Composer.

### Pasos

1. Clona o copia esta carpeta del tema en el directorio `wp-content/themes/` de tu instalación de WordPress.
2. Instala las dependencias de PHP:
   ```bash
   composer install
   ```
3. Instala las dependencias de Node.js:
   ```bash
   npm install
   ```

## Comandos de Desarrollo y Compilación

Los siguientes comandos están definidos en los archivos de configuración del proyecto (composer.json y package.json) para ayudar en el desarrollo:

* **Linter de PHP**:
  * `composer lint:php`: Verifica errores de sintaxis en los archivos PHP.
  * `composer lint:wpcs`: Verifica los archivos PHP según los Estándares de Codificación de WordPress (WPCS).
* **Compilación de SASS y CSS**:
  * `npm run compile:css`: Compila los archivos de hojas de estilo SASS a CSS.
  * `npm run compile:rtl`: Genera la hoja de estilo RTL a partir de style.css.
  * `npm run watch`: Monitorea automáticamente los cambios en los archivos SASS y los compila.
* **Linter de JavaScript**:
  * `npm run lint:js`: Verifica los archivos JS según los Estándares de Codificación de JavaScript de WordPress.
* **Otras Herramientas**:
  * `composer make-pot`: Genera un archivo de plantilla de traducción (.pot) en el directorio languages.
  * `npm run bundle`: Empaqueta el tema en un archivo zip para distribución, excluyendo archivos de desarrollo y del sistema.
