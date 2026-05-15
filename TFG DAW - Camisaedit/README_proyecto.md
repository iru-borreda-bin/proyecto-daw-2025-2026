<p align="center">
 <img width=auto height=200px src="./view/img/Logo-camisaEdit.svg" alt="Project logo">
</p>

<h1 align="center">Editor de Camisetas en línea "Camisaedit"</h3>

## Tabla de Contenidos

- [Carta de presentación](#presetation)
- [Acerca del proyecto](#about)
  - [Mapa del sitio](#map)
  - [Cómo navegar](#howtonav)
- [Instrucciones](#instructions)
  - [De instalación](#install)
  - [De despliegue](#deploy)

## Carta de presentación <a name = "presentation"></a>

¡Bienvenido al README.md del proyecto para Camisaedit!

Aquí encontrará toda la información necesaria sobre el proyecto. En este documento se explicará el proyecto en sí, su estructura y funcionamiento, así como instrucciones para su instalación y uso.

## Sobre el proyecto <a name = "about"></a>

Esta MVP web (Minimum Value Product) proporcionará a los usuarios la capacidad de entrar en la página para Camisaedit, una empresa de manufacturación de camisetas personalizadas a los gustos del cliente, pudiendo especificar como se quiere la camiseta a través del editor de camisetas en línea al que la web le llevaría tras ingresar en una cuenta.

Debido a ser esto un proyecto MVP conceptual para enseñar una aplicación básica sobre el que mejorar, el diseño tanto estético como funcional que no están implementados en sus versiones definitivas.

### Árbol de directorios <a name = "map"></a>

<p align="center">
 <img width=auto height=700px src="../Docs a entregar/docs_imgs/filetree_readme.drawio.png" alt="Project Map">
</p>

### Cómo navegar <a name = "howtonav"></a> 

#### <a href="./index.html">index.html</a>

Primero tenemos la página de inicio, que es la que se muestra al entrar en la web. En esta página el usuario puede elegir entre iniciar sesión, desde donde podrá acceder a registrarse si no tiene una cuenta todavía.

<p align="center">
 <img width=auto height=700px src="../Docs a entregar/docs_imgs/screenshots/index_capturFull.png" alt="index capture">
</p>

#### <a href="./view/login.php">login.php</a> y <a href="./view/register.html">register.html</a>

En estas páginas el usuario puede iniciar sesión o registrarse respectivamente. En ambas páginas, se puede volver de vuelta a <a href="./index.html">index.html</a> y en la página de login, el usuario también tiene la opción de volver a la página de registro.

<p align="center">
 <img width=500px height=auto src="../Docs a entregar/docs_imgs/screenshots/login_capturFull.png" alt="login capture">
</p>
<p align="center">
 <img width=500px height=auto src="../Docs a entregar/docs_imgs/screenshots/register_capturFull.png" alt="register capture">
</p>

En cuanto register.php, una vez se haya registrado correctamente, el usuario será redirigido a login.php para iniciar sesión con su nueva cuenta, desde donde podrá acceder a <a href="./view/profile.php">profile.php</a>.


>Si quiere acceder tanto al usuario cliente como el de administrador, puede utilizar los siguientes datos de acceso:
>- Usuario cliente: 
>   - Email: ejemplo@email.com
>   - Contraseña: !1234ABcd
>- Usuario administrador:
>   - Email: camisedit.admin@email.com
>   - Contraseña: !1234ABcd

#### <a href="./view/profile.php">profile.php</a>
En esta página el usuario puede ver su perfil, con su información personal y sus pedidos. Desde aquí, el usuario también puede acceder al editor de camisetas en línea a través del botón "Crear Nueva Camiseta", o cerrar sesión a través del botón "Cerrar Sesión".
<p align="center">
 <img width=500px height=auto src="../Docs a entregar/docs_imgs/screenshots/profile_capturFull.png" alt="profile capture">
</p>

También, aquí el usuario puede examinar con mayor detalle sus pedidos haciendo "click" en el botón "Ver Detalles" de cada pedido. Donde un modal le saltará con los datos del pedido y de la camiseta asociada, y podrá editar los datos de la camiseta (y del pedido si el usuario es un administrador) e incluso directamente borrar el pedido.

<p align="center">
 <img width=500px height=auto src="../Docs a entregar/docs_imgs/screenshots/profile_modal.png" alt="profile capture">
</p>

##### <a href="./view/formEditor.php">formEditor.php</a>
En esta página el usuario puede crear una nueva camiseta personalizada. En esta página el usuario puede elegir el tipo de camiseta que quiere, su color, añadir un texto personalizado y subir una imagen personalizada. Una vez haya terminado de personalizar su camiseta, podrá crearla y automáticamente esta será agregada a un nuevo pedido. Tras esto, el usuario será redirigido a su perfil para ver su nuevo pedido aparecer en la tabla.

<p align="center">
 <img width=500px height=auto src="../Docs a entregar/docs_imgs/screenshots/formEditor__capturFull.png" alt="editor capture">
</p>

## Instrucciones <a name = "instructions"></a>

### De instalación <a name = "install"></a>

Esta guía de instalación asume que usted ya tiene instalado XAMPP en su máquina con Apache y MySQL pre-configurados.
-	<strong>Paso 1:</strong> Descárguese el proyecto desde Github (Haga click en “<> Code” y busque la opción “Descagar ZIP” en las opciones del desplegable como aparece señalado en el pantallazo.
 
<p align="center">
 <img width=500px height=auto src="../Docs a entregar/docs_imgs/Screenshots/github_download.png" alt="img download">
</p>

-	<strong>Paso 2:</strong> Localice dónde tiene la carpeta de XAMPP instalada (normalmente en C: si no le ha dicho al Wizard otra dirección). Por defecto está en “C:\xampp”

-	<strong>Paso 3:</strong> Entre en la carpeta, busque la carpeta htdocs y entre en ella. (estamos en “C:\xampp\htdocs”)

-	<strong>Paso 4:</strong> Una vez ahí, creé una carpeta que se llame “phpProjects”, dentro de esta carpeta podremos ejecutar nuestro proyecto, ya que una vez que encendamos el Apache de XAMPP, nuestro navegador podrá interpretarlo.

-	<strong>Paso 5:</strong> Una vez haya creado “phpProjects” y se meta, descomprima el zip aquí.
El proyecto al final de este proceso tendría que estar en la siguiente dirección:
“C:\xampp\htdocs\phpProjects\proyecto-daw-2025-2026” (\TFG DAW - Camisaedit si se mete en esta carpeta en su explorador de archivos). 

Tras esto, una vez que se tiene el proyecto descomprimido, localize el archivo “camisedit_bd.sql” dentro de la carpeta “BDSQLs”, ya que la va a necesitar para realizar una importación de base de datos.
-	<strong>Paso 1:</strong> Abra XAMPP y encienda Apache y luego MySQL tras esperar a que el nombre de Apache se vuelva verde.
 
<p align="center">
 <img width=500px height=auto src="../Docs a entregar/docs_imgs/Screenshots/xampp.png" alt="img Xampp start">
</p>

-	<strong>Paso 2:</strong> Coja su navegador preferido y escriba en la barra de búsqueda http://localhost/phpmyadmin y pulse enter para entrar a la base de datos.
 
<p align="center">
 <img width=500px height=auto src="../Docs a entregar/docs_imgs/Screenshots/landing_phpmyadmin.png" alt="img myadmin landing">
</p>

-	<strong>Paso 3:</strong> Una vez hecho esto, creamos una nueva base datos con el nombre “camisedit_bd” pulsando el enlace “Nueva” en la barra lateral. (Tengo que utilizar camisedit_2 debido a que ya tengo un “camisedit_bd”)
 
<p align="center">
 <img width=500px height=auto src="../Docs a entregar/docs_imgs/Screenshots/create_bbdd.png" alt="img crea BBDD">
</p>

-	<strong>Paso 4:</strong> Una vez pinche en “Crear”, será redirigido a la página de la base datos. Ahí encontrará una barra superior donde tiene que entrar a “importar”. Ahí interactúe con la primera opción “Archivo a Importar” y seleccione nuestro archivo “camisedit_bd.sql”.
 De ahí vaya abajo del todo y pulse en “Importar”.
 <p align="center">
 <img width=500px height=auto src="../Docs a entregar/docs_imgs/Screenshots/import_bbdd.png" alt="img import">
  </p>
Una vez hecho todo esto, ya se le debería creado la base de datos en su servidor:
<p align="center">
 <img width=500px height=auto src="../Docs a entregar/docs_imgs/Screenshots/bbdd_creado.png" alt="img import">
</p>

### De Despliegue <a name = "deploy"></a>
-	<strong>Paso 1:</strong> Abra XAMPP y encienda Apache y luego MySQL tras esperar a que el nombre de Apache se vuelva verde.
 
<p align="center">
 <img width=500px height=auto src="../Docs a entregar/docs_imgs/Screenshots/xampp.png" alt="img Xampp start">
</p>

-	<strong>Paso 2:</strong> Una vez tanto el servidor de Apache como el de MySQL estén levantados, elija su navegador de preferencia, y en la barra de búsqueda, introduzca “localhost/phpProjects”, donde le aparecerá un enlace a “Index of phpProjects”, haga click sobre el link.
 
<p align="center">
 <img width=500px height=auto src="../Docs a entregar/docs_imgs/Screenshots/barra_de_búsqueda.png" alt="img Xampp start">
</p>

-	<strong>Paso 3:</strong> Una vez esté ahí, se encontrará con la siguiente pantalla (ignore la carpeta EjerciciosPHP):
 
<p align="center">
 <img width=500px height=auto src="../Docs a entregar/docs_imgs/Screenshots/directorio_php.png" alt="img Xampp start">
</p>

Una vez aquí, navegue a “proyecto-daw-2025-2026”, y dentro de ahí, haga click sobre “TFG DAW – Camisaedit”.
Y una vez hecho eso, le saldrá la pantalla principal (“index.html”) y podrá utilizar la aplicación sin problemas.

<p align="center">
 <img width=600px height=auto src="../Docs a entregar/docs_imgs/Screenshots/index.png" alt="img download">
</p>
