<!doctype html>
<html lang="es">

<?php
// Es vital que siempre carguemos la sesión al principio de cada página que necesite acceder a los datos del usuario, para evitar errores.
session_start();
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Camisaedit - Editor de Diseño</title>
    <!-- Enlace a archivo CSS en la carpeta styles -->
    <link rel="stylesheet" href="./styles/generalStyle.css" />
    <link rel="stylesheet" href="./styles/formEditorStyle.css" />
    <script src="../model/formEditor.js" type="text/javascript"></script>
</head>

<body>
    <header>
        <div class="container bar">
            <div id="logo">
                <img src="./img/Logo-camisaEdit.svg" alt="Logo Camisaedit" width="40" height="40" />
                <div>
                    <h1>Camisaedit</h1>
                    <p>Camisetas para todos</p>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="../index.html">Inicio</a></li>
                    <li><a href="#">Acerca de</a></li>
                    <li><a href="#">Contacto</a></li>
                    <li><a id="link_iniSess_nav" href="profile.php">Perfil</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="editor"> <!--Editor-->
            <div class="widget-wrap">
                <div class="edit_wraper">
                    <svg id="tapEdit" class="previsTapiz" width="50%" height="40%" min-width="40%" min-height="40%"
                        viewBox="-75 -72.5 250 250" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:dc="http://purl.org/dc/elements/1.1/"
                        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
                        <defs></defs>
                        <g></g>
                        <rect x="0" y="0" width="100" height="100" fill="#e6dbbf" />
                        <rect x="10" y="10" width="80" height="80" stroke="red" stroke-width="3" fill="none" />
                    </svg>
                </div>
                <!-- <button onclick="fillDummyDataTapiz();">Fill tapiz data</button> -->

                <div class="form_wraper">
                    <form id="form_camisetaDatos" method="POST">
                        <div role="group" class="bar_select">
                            <button type="button" class="btn" id="btn_goToBase" value="Base y Diseño" href="#set_base">Base y Diseño</button>
                            <button type="button" class="btn" id="btn_goToTxt" value="Texto" href="#set_txt">Texto</button>
                            <button type="button" class="btn" id="btn_goToImg" value="Imágen" href="#set_img">Imágen</button>
                            <button type="submit" class="btn" id="btn_confirm_diseño" name="submit" value="Confirmar el diseño">Confirmar el diseño</button>
                        </div>

                        <!-- BASE -->
                        <div>
                            <fieldset id="set_base">
                                <legend>&nbsp;Opciones Base&nbsp;</legend>

                                <label for="ropa_tam">Tamaño deseado:</label>
                                <select id="ropa_tam" name="ropa_tam" aria-placeholder="Tamaño" required>
                                    <option value="">Elija una opción</option>
                                    <option value="small">Small</option>
                                    <option value="medium">Medium</option>
                                    <option value="large">Large</option>
                                    <option value="xtra-large">Xtra-Large</option>
                                </select>

                                <label for="ropa_col">Color base:</label>
                                <select id="ropa_col" name="ropa_col" aria-placeholder="Color" required>
                                    <option value="">Elija una opción</option>
                                    <option value="rojo">Rojo</option>
                                    <option value="azul">Azul</option>
                                    <option value="verde">Verde</option>
                                </select>
                            </fieldset>
                        </div>

                        <!-- DISEÑO -->
                        <div>
                            <label for="chk_dis">¿Quiere un diseño en la camiseta?</label>
                            <input type="checkbox" id="chk_dis" name="chk_dis">

                            <fieldset id="set_dis" disabled>
                                <legend>&nbsp;Diseño&nbsp;</legend>
                                <label for="ropa_dis">Patrón del diseño:</label>
                                <select id="ropa_dis" name="ropa_dis" aria-placeholder="Patrón del diseño">
                                    <option value="">Elija una opción</option>
                                    <option value="polka">Polka</option>
                                    <option value="rayas">Rayas</option>
                                    <option value="fuego">Fuego</option>
                                    <option value="mitades">Mitades</option>
                                </select>

                                <label for="ropa_dis_col">Color del diseño:</label>
                                <select id="ropa_dis_col" name="ropa_dis_col" aria-placeholder="Color">
                                    <option value="">Elija una opción</option>
                                    <option value="rojo">Rojo</option>
                                    <option value="azul">Azul</option>
                                    <option value="verde">Verde</option>
                                </select>
                            </fieldset>
                        </div>

                        <!-- TEXTO -->
                        <div>
                            <label for="chk_txt">¿Quiere añadirle texto a la camiseta?</label>
                            <input type="checkbox" id="chk_txt" name="chk_txt">
                            <fieldset id="set_txt" disabled>
                                <legend>&nbsp;Texto&nbsp;</legend>

                                <label for="ropa_text_cont">Contenido (máximo de 15 carácteres):</label>
                                <input type="text" id="ropa_text_cont" name="ropa_text_cont" maxlength="15">

                                <label for="ropa_txt_tam">Tamaño deseado:</label>
                                <select id="ropa_txt_tam" name="ropa_txt_tam" aria-placeholder="Tamaño_txt">
                                    <option value="">Elija una opción</option>
                                    <option value="small">Small</option>
                                    <option value="medium">Medium</option>
                                    <option value="large">Large</option>
                                    <option value="xtra-large">Xtra-Large</option>
                                </select>

                                <label for="ropa_text_tipo">Tipografía:</label>
                                <select type="text" id="ropa_text_tipo" name="ropa_text_tipo"
                                    aria-placeholder="Tipografia_txt">
                                    <option value="">Elija una opción</option>
                                    <option value="Arial">Arial</option>
                                    <option value="Times New Roman">Times New Roman</option>
                                    <option value="Courier New">Courier New</option>
                                </select>

                                <label for="ropa_txt_col">Color del texto:</label>
                                <select id="ropa_txt_col" name="ropa_txt_col" aria-placeholder="Color_txt">
                                    <option value="">Elija una opción</option>
                                    <option value="rojo">Rojo</option>
                                    <option value="azul">Azul</option>
                                    <option value="verde">Verde</option>
                                </select>

                                <label for="ropa_text_pos">Posición:</label>
                                <select type="text" id="ropa_text_pos" name="ropa_text_pos" aria-placeholder="Pos_txt">
                                    <option value="">Elija una opción</option>
                                    <option value="top">Arriba</option>
                                    <option value="middle">Medio</option>
                                    <option value="bottom">Abajo</option>
                                </select>
                            </fieldset>
                        </div>

                        <!-- IMÁGEN -->
                        <div>
                            <label for="chk_img">¿Quiere añadirle una imágen a la camiseta?</label>
                            <input type="checkbox" id="chk_img" name="chk_img">
                            <fieldset id="set_img" disabled>
                                <legend>&nbsp;Imágen&nbsp;</legend>

                                <label for="ropa_img_sel">Imágen:</label>
                                <select id="ropa_img_sel" name="ropa_img_sel" aria-placeholder="imagen_select">
                                    <option value="">Elija una opción</option>
                                    <option value="cohete">Cohete</option>
                                    <option value="avion">Avión</option>
                                    <option value="coche">Coche</option>
                                </select>

                                <label for="ropa_img_tam">Tamaño deseado:</label>
                                <select id="ropa_img_tam" name="ropa_img_tam" aria-placeholder="Tamaño imagen">
                                    <option value="">Elija una opción</option>
                                    <option value="small">Small</option>
                                    <option value="medium">Medium</option>
                                    <option value="large">Large</option>
                                    <option value="xtra-large">Xtra-Large</option>
                                </select>

                                <label for="ropa_img_elevación">Elevación:</label>
                                <select type="text" id="ropa_img_elevación" name="ropa_img_elevación"
                                    aria-placeholder="elevacion_img">
                                    <option value="">Elija una opción</option>
                                    <option value="above">Encima del texto</option>
                                    <option value="below">Debajo del texto</option>
                                </select>

                                <label for="ropa_img_pos">Posición:</label>
                                <select type="text" id="ropa_img_pos" name="ropa_img_pos" aria-placeholder="Pos_img">
                                    <option value="">Elija una opción</option>
                                    <option value="top">Arriba</option>
                                    <option value="middle">Medio</option>
                                    <option value="bottom">Abajo</option>
                                </select>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <!-- FOOTER -->
    <footer>
        <p>&copy; 2026 Iru Borredá Bin. Todos los derechos reservados.</p>
    </footer>
</body>

<script>
    // Checkboxes
    var chk_dis = document.getElementById("chk_dis"); //Aquí controlamos si el checkbox del texto está chequeado. 
    var set_dis = document.getElementById("set_dis");

    chk_dis.addEventListener('change', function () {
        set_dis.disabled = !chk_dis.checked;

        console.log("LOG: status de selección de Texto: " + chk_dis.checked);
        console.log("");
    });

    var chk_txt = document.getElementById("chk_txt"); //Aquí controlamos si el checkbox del texto está chequeado. 
    var set_txt = document.getElementById("set_txt");

    chk_txt.addEventListener('change', function () {
        set_txt.disabled = !chk_txt.checked;

        console.log("LOG: status de selección de Texto: " + chk_txt.checked);
        console.log("");
    });

    var chk_img = document.getElementById("chk_img"); //Aquí controlamos si el checkbox de la imágen está chequeado. 
    var set_img = document.getElementById("set_img");

    chk_img.addEventListener('change', function () {
        set_img.disabled = !chk_img.checked;

        console.log("LOG: status de selección de Imagen: " + chk_img.checked);
        console.log("");
    });

    // Testing
    // function fillDummyDataTapiz() {
    //     document.getElementById("chk_txt").checked = true;
    //     document.getElementById("chk_img").checked = true;
    //     document.getElementById("dat_text_cont").value = "PruebaTexto";
    //     document.getElementById("dat_text_tipo").value = "Arial";
    //     document.getElementById("dat_text_pos").value = "Arriba";
    // }
</script>

<?php
require_once "../controller/bdcon/bdcon.php";
require_once "../controller/ropasController.php";
require_once "../controller/pedidoController.php";

console_log('Datos del usuario cargados en sesión:');
console_log('ID: ' . $_SESSION['user_id']);
console_log('Email: ' . $_SESSION['user_email']);
console_log('Nombre: ' . $_SESSION['user_nomCom']);
console_log('Teléfono: ' . $_SESSION['user_tlf']);
console_log('Fecha de creación: ' . $_SESSION['user_dateCreado']);

if (isset($_POST['submit'])) {
    $base_tamano = $_POST['ropa_tam'];
    $base_color = $_POST['ropa_col'];

    $dis_patr = $_POST['ropa_dis'];
    $dis_color = $_POST['ropa_dis_col'];

    $txt_cont = $_POST['ropa_text_cont'];
    $txt_tam = $_POST['ropa_txt_tam'];
    $txt_tipo = $_POST['ropa_text_tipo'];
    $txt_color = $_POST['ropa_txt_col'];
    $txt_pos = $_POST['ropa_text_pos'];

    $img_sel = $_POST['ropa_img_sel'];
    $img_tam = $_POST['ropa_img_tam'];
    $img_elev = $_POST['ropa_img_elevación'];
    $img_pos = $_POST['ropa_img_pos'];


    //En caso que el usuario no haya marcado el checkbox de diseño, texto o imágen, se le asignará un valor de "-" a los campos relacionados para que no den error de campo vacío en la validación del backend. Esto se hace porque, aunque el campo esté deshabilitado, al no marcar el checkbox el campo queda vacío y la función valid_ropaForm() lanzaría una excepción por campos vacíos.
    $dis_patr = changeToDashIfEmpty($dis_patr);
    $dis_color = changeToDashIfEmpty($dis_color);

    $txt_cont = changeToDashIfEmpty($txt_cont);
    $txt_tam = changeToDashIfEmpty($txt_tam);
    $txt_tipo = changeToDashIfEmpty($txt_tipo);
    $txt_color = changeToDashIfEmpty($txt_color);
    $txt_pos = changeToDashIfEmpty($txt_pos);

    $img_sel = changeToDashIfEmpty($img_sel);
    $img_tam = changeToDashIfEmpty($img_tam);
    $img_elev = changeToDashIfEmpty($img_elev);
    $img_pos = changeToDashIfEmpty($img_pos);

    try {
        console_log('====Validación PHP de los datos de la ropa====');
        console_log("Datos: " . $base_tamano . ", " . $base_color . ", " . $dis_patr . ", " . $dis_color . ", " . $txt_cont . ", " . $txt_tam . ", " . $txt_tipo . ", " . $txt_color . ", " . $txt_pos . ", " . $img_sel . ", " . $img_tam . ", " . $img_elev . ", " . $img_pos);
        valid_ropaForm($base_tamano, $base_color, $dis_patr, $dis_color, $txt_cont, $txt_tam, $txt_tipo, $txt_color, $txt_pos, $img_sel, $img_tam, $img_elev, $img_pos);
        alert_popup('Validación de ropa exitosa. Subiendo datos a la base de datos...');
        console_log("====Subiendo...====");
        subir_ropaForm($conn, $base_tamano, $base_color, $dis_patr, $dis_color, $txt_cont, $txt_tam, $txt_tipo, $txt_color, $txt_pos, $img_sel, $img_tam, $img_elev, $img_pos);
        console_log(" ");
        console_log("====Creando Pedido====");
        $last_id_ropa = mysqli_insert_id($conn); //Obtenemos el ID de la ropa recién insertada para luego crear el pedido con ese ID de ropa.
        console_log("ID de usuario: " . $_SESSION['user_id'] . ", ID de la ropa recién insertada: " . $last_id_ropa);
        subir_pedidoForm($conn, $_SESSION['user_id'], $last_id_ropa);
        echo '<script type="text/javascript">window.location.href="profile.php";</script>';
    } catch (Exception $e) {
        console_log('ERROR: ' . $e->getMessage());
    }
}

function changeToDashIfEmpty($valor)
{
    if ($valor == "" || $valor == null) {
        return "-";
    }
    return $valor;
}
?>

</html>