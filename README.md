[![Latest Stable Version](https://poser.pugx.org/rogertm/twenty-em/version)](https://packagist.org/packages/rogertm/twenty-em)
[![Latest Unstable Version](https://poser.pugx.org/rogertm/twenty-em/v/unstable)](//packagist.org/packages/rogertm/twenty-em)
[![Total Downloads](https://poser.pugx.org/rogertm/twenty-em/downloads)](https://packagist.org/packages/rogertm/twenty-em)
[![Build Status](https://travis-ci.org/rogertm/twenty-em.svg?branch=master)](https://travis-ci.org/rogertm/twenty-em)
[![License](https://poser.pugx.org/rogertm/twenty-em/license)](https://packagist.org/packages/rogertm/twenty-em)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rogertm/twenty-em/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rogertm/twenty-em/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/rogertm/twenty-em/badges/build.png?b=master)](https://scrutinizer-ci.com/g/rogertm/twenty-em/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/rogertm/twenty-em/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

# Twenty'em WordPress Framework

## ¿Qué es Twenty'em?

Twenty'em es un theme/framework para WordPress creado específicamente para el desarrollo de Child Themes, que gracias a la gran variedad de opciones de configuración que posee y su API de Desarollo, puede ser usado tanto para proyectos sencillos como para proyectos de gran envergadura.

## Instalación

Twenty'em se instala como cualquier otro theme de WordPress. Para ello debes descargar la [última versión](https://github.com/rogertm/twenty-em/archive/master.zip) de este software, descompactar el archivo `.zip` y copiar su contenido en el directorio `/wp-content/themes/` de tu instalación de WordPress. O subirlo usando el instalador de themes de WordPress.

O bien puedes clonar el repositorio directamente de GitHub:

```bash
$ cd /path/to/your/wordpress-site/wp-content/themes/
$ git clone https://github.com/rogertm/twenty-em.git
```

## Panel de Administración

Twenty'em ofrece un **Panel de Administración** desde el que podrás configurar la estructura de tu sitio con un mínimo de esfuerzo.

Desde este panel podrás acceder a la ayuda, donde esbozados rápidamente cómo accionar en cada caso y para qué sirve cada opción.

El manejo de este panel de administración es muy fácil e intuitivo, en caso de que cada panel de opciones tenga sub-opciones, que permitan varios comportamientos para un mismo módulo, entonces se elegirá el indicado accionando la pestaña que activará dicha sub-opción.

Una vez configuradas todas las opciones, deberás hacer clic en **Guardar Cambios** para salvar toda la configuración que has hecho.

## Administrador de Resplado

Una vez hechas todas las configuraciones en el **Panel de Administración** de Twenty'em, podrás exportar un archivo `.txt` que luego podrás usar para importar dichas configuraciones en caso de que necesites restaurar todo el set de opciones. O incluso, configurar otro sitio hecho con Twenty'em.

Para ello debes acceder a **Twenty'em > Respaldo**, donde encontrarás nuestro **Administrador de Respaldo**, un asistente bien sencillo de usar.

### Exportar

Puedes exportar la configuración con el objetivo de restaurarla nuevamente, o copiarla en otro sitio. Si un Child Theme o Plugin hace un _merge_ de sus configuraciones en la opción `t_em_theme_options` de la tabla `wp_options` en la Base de Datos, esas opciones serán exportadas también en el mismo archivo `.txt`.

Las opciones serán exportadas en un archivo denominado `t-em-backup-` seguido por la fecha y el tiempo en que ha sido exportado. Ej: `t-em-backup-Ymd-His.txt`.

### Importar

Puedes importar archivos previamente exportados, esto actualizará la opción `t_em_theme_options` en la tabla `wp_options` en la Base de Datos.

**Importante**: Solo archivos generados a través del **Administrador de Respaldo** podrán ser importados nuevamente. **Esta acción no puede ser deshecha**.


## Widgets, Templates y Shortcodes

Twenty'em trae consigo de manera predeterminada una serie de elementos que te permitirán un mejor manejo del contenido dentro de tu proyecto.

### [Widgets](https://themingisprose.com/twenty-em/doc/widgets/)

Además de los widgets nativos de WordPress, Twenty'em trae nuevos widgets que mejorarán visual y estructuralmente tu proyecto, entre los que se encuentran Autores, Galería de Imágenes, Últimas Entradas, Entradas Populares, Comentarios y uno muy útil que permitirá a tus clientes o usuarios la Suscripción vía FeedBurner.

### [Templates](https://themingisprose.com/twenty-em/doc/plantillas-para-paginas/)

En WordPress, los Templates o Plantillas de Páginas son archivos mediante los que puedes crear páginas, pero con características o comportamientos que difieren de una página estándar. Twenty'em ofrece un grupo de estas plantillas, entre las que se destacan, Archivo, Autores, Mapa del Sitio, entre otras.

### [Shortcodes](https://themingisprose.com/twenty-em/doc/shortcodes/)

Los shortcodes son pequeños macro códigos que se insertan en el editor de entradas, y ejecutan funciones creadas por los desarrolladores. Twenty'em tiene una serie de estos shortcodes mediante los que podrás dar formato a tus entradas. Alertas, Citas, Iconos, Botones, entre otros, que a su vez tienen múltiples opciones.

## API de Desarrollo

Twenty'em se basa fundamentalmente en el uso de Hooks, lo cual permite que el desarrollo con este Framework sea extremadamente flexible y escalable. Además brindamos una serie de funciones (tipo _Helpers_) que su objetivo es facilitar el trabajo de los desarrolladores, y por su puesto Variables, Constantes, etc…

**Nota**: Actualmente estamos en proceso de documentar esta sección.

## Licencia

Como WordPress, **Twenty'em es un software de código libre y abierto y se distribuye bajo Licencia GPLv2 (o superior)**. Una copia de la licencia se puede encontrar en cada versión de Twenty'em, también incluimos una copia **no oficial** en español para usuarios hispanohablantes.

Asimismo, cada software que se derive de Twenty'em (plugin, módulo, código, etc…) y se distribuya desde este sitio heredará dicha licencia.
