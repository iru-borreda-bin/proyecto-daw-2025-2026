<p align="center">
 <img width=auto height=200px src="./img/Logo-alhondiga.png" alt="Project logo">
</p>

<h1 align="center">Mercado de Barrio "La Alhóndiga"</h3>

## Table of Contents

- [Carta de presentación](#presetation)
- [Acerca del proyecto](#about)
  - [Cómo navegar](#howtonav)
  - [Mapa del sitio](#map)
  - [Diseño](#design)
- [Instrucciones](#instructions)
  - [De instalación](#install)
  - [De uso](#use)

## Carta de presentación <a name = "presentation"></a>

¡Bienvenido al README.md del proyecto para La Alhóndiga!

Este proyecto es un mini-sitio (en estado de MVP [Minimum Viable Product] actualmente) para un mercado de barrio situado en Madrid llamado "La Alhóndiga", que está reabriendo sus puertas tras un cambio de gerencia y un incendio que lo clausuró hace unos años.

Como parte de esta reignauración, el nuevo dueño ("Manuel Rivero García") busca establecer la presencia del mercado a las redes sociales y a internet y atraer a tanto dueños y clientes antiguos, como atraer a nuevas caras, ya sean potenciales negocios o más clientes. Esta web no solo servirá como un sitio donde los usuario puedan leer más acerca del mercado, si no que también pueden ver más acerca de sus puestos y los productos de estos, facilitando así ver sus existencias sin tener que ir ahí en persona, ya sea en sus ordenadores, tablets o móviles.

## About <a name = "about"></a>

Este mini-sitio permitiría a los usuarios (suponiendo que son vecinos de barrio) ingresar en la web para buscar y encontrar los puestos que le interesen, ver su catálogo, y mandarles sus datos con tal que el puesto les notifique por email en cuestión de un día para contestarles.

Debido a la restricción de este proyecto de no utilizar ningún script, hay varias funciones que no están implementadas aún.

### Cómo navegar <a name = "howtonav"></a>

Al ser un "mini-sitio" web, su estructura es muy simple, constando de tres páginas diferentes: "Inicio", "Puestos" y "Contacto"

#### <a href="./src/index.html">Index.html</a>

Dentro de "Inicio" nos encontramos con una bienvenida, un pequeño adelanto de la página "Puestos" enseñándo algunos puestos destacados, y por último más información acerca del mercado, su nuevo gerente, localización y contactos. "Inicio" tiene vínculos tanto para acceder a la Página "Puestos" (el botón "Puestos" en la barra de navegación; y el botón "Ver todos los puestos" en la sección de "Puestos Destacados") como para acceder directamente a la página "Contacto" (los botones al final de cada puesto destacado).

#### <a href="./src/puestos.html">Puestos.html</a>

En la página "Puestos" nos encontraremos con la lista de todos los puestos del mercado, completo con unos filtros básicos (puramente visuales por el momento) que servirán para organizar y enseñar los puestos en función de los parámetros que se introduzcan: Su nombre, categoría y horario; Que a su vez son etiquetas visibles que uno puede ver en sus "fichas" en la pantalla. De aquí, pinchando en el botón de una de las fichas (botón "Contactar") nos redirije a la página "Contacto"

#### <a href="./src/contacto.html">Contacto.html</a>

Finalmente llegamos a la página "Contacto", dónde se nos presenta un formulario del cual todos los campos son obligatorios y son validados dentro en el propio html, incluído el checkbox de "Aviso de privacidad". Hasta que el usuario no rellene de forma satisfactoria todos los campos, no podrá "enviar" su información al puesto. Una vez "enviado", saltará un aviso de la página notificando al usuario que su información ha sido mandada al puesto, y que recibirá un email de su parte en las próximas 24 horas.

En el estado actual del proyecto, estas últimas funcionalidades no están implementadas, y tampoco se pueden mostrar mensajes de error personalizados al error (por ejemplo, poner letras en el input para el teléfono) ni controlar que todos los datos estén bien validados antes que el aviso salte.

### Mapa del sitio <a name = "map"></a>

<p align="center">
 <img width=auto height=200px src="./z_diagramas/R1_DEF-Mapa.drawio.png" alt="Project logo">
</p>

### Decisiones de diseño <a name = "design"></a>

Al estar en las fases iniciales del proyecto, la tipografía y el diseño final podría variar del producto actual.

De momento, se ha optado por la fuente Roboto para todo el proyecto, debido a ser una fuente sin serifas y snecilla, lo cual ayuda su fácil lectura y a las personas disléxicas a leer correctamente lo que ven en pantalla.

En cuanto a su estructura, me he ceñido a mantener una columna central en la que usuario podrá ver todo el contenido de la página en la que esté de forma cómoda y a golpe de vista. Esto también me ha ayudado a hacer la resposividad de la web a diferentes tamaños de pantalla más fácil.

Y por último, decidí usar tonos blancos simples con uso del granate del logo del mercado (en específico, #8b0f26 en hexadecimal).

Todos los documentos han pasado la Validación W3C (salvo por "Puestos", donde persiste un error donde dice que la etiqueta "card" no puede ser hija de un "div").

## Instrucciones <a name = "instructions"></a>

### De instalación <a name = "install"></a>

Para "Instalar" este MVP, solo se ha de abrir el documento "index.html" dentro de la carpeta "src", ya sea pinchando sobre este dos veces rápidamente (tras lo cual, se abrirá en el navegador predeterminado de su máquina) o pinchando y arrastrándolo a una ventana de su navegador preferido.

### De Uso <a name = "use"></a>

Debido al estado actual del proyecto, no es posible interactuar con mucho salvo por los botones habilitados para ir de una página a otra.
