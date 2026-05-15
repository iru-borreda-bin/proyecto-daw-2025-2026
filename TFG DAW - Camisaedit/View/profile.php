<!doctype html>
<html lang="es">

<?php
// Es vital que siempre carguemos la sesión al principio de cada página que necesite acceder a los datos del usuario, para evitar errores.
session_start();
require_once "../controller/bdcon/bdcon.php";
require_once "../controller/userController.php";
require_once "../controller/ropasController.php";
require_once "../controller/pedidoController.php";

console_log('Datos del usuario cargados en sesión:');
console_log('ID: ' . $_SESSION['user_id']);
console_log('Email: ' . $_SESSION['user_email']);
console_log('Nombre: ' . $_SESSION['user_nomCom']);
console_log('Teléfono: ' . $_SESSION['user_tlf']);
console_log('Fecha de creación: ' . $_SESSION['user_dateCreado']);

// Hacemos una consulta que guardamos para traer a nuestra página de perfil los pedidos del usuario logueado.
// Para esto, utilizamos el ID del usuario que tenemos guardado en la sesión.
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1) {
    $userID = $_SESSION['user_id'];
    $pedidos = consult_getPedidosAdmin($conn);
    console_log('Todos los pedidos (Vista Administrador):');
    console_log($pedidos);
    $tableOutput = generatePedidosTable($pedidos);
} else if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];
    $pedidos = consult_getPedidosByUserID($conn, $userID);
    console_log('Pedidos obtenidos para el usuario con ID ' . $userID . ':');
    console_log($pedidos);
    $tableOutput = generatePedidosTable($pedidos);
} else {
    console_log('No se encontró un ID de usuario en la sesión. No se pueden cargar los pedidos.');
}


// Con esta variable guardaremos el código HTML generado para mostrar la tabla de pedidos, 
// que luego se inyectará en el HTML del perfil. 
$tableOutput;
function generatePedidosTable($pedidos)
{
    $row = "";
    foreach ($pedidos as $pedido) {
        $row .= "<tr>";
        $row .= "<td>" . $pedido['ped_id'] . "</td>";
        $row .= "<td>" . $pedido['ped_user_id'] . "</td>";
        $row .= "<td>" . $pedido['ped_ropa_id'] . "</td>";
        $row .= "<td><span class='tag tag-" . $pedido['ped_estado'] . "'>" . $pedido['ped_estado'] . "</span></td>";
        $row .= "<td>" . $pedido['ped_dateIni'] . "</td>";
        $row .= "<td>" . $pedido['ped_dateStart'] . "</td>";
        $row .= "<td>" . $pedido['ped_dateEnd'] . "</td>";
        $row .= "<td><button class='btn' id='btn_ver_pedido' data-ped-id='" . $pedido['ped_id'] . "' data-ropa-id='" . $pedido['ped_ropa_id'] . "'>Ver Detalles</button></td>";
        $row .= "</tr>";
    }
    return $row;
}

// Para la validación e interacción del usuario con la base de datos
// UPDATE PEDIDO
if (isset($_POST['submit_ped'])) {
    $ped_id = $_POST['ped_id'];
    $ped_estado = $_POST['ped_estado'];
    $ped_dateIni = $_POST['ped_dateIni'];
    $ped_dateStart = $_POST['ped_dateStart'];
    $ped_dateEnd = $_POST['ped_dateEnd'];

    try {
        console_log('====Validación PHP====');
        console_log("Datos: " . $ped_id . " " . $ped_estado . " " . $ped_dateIni . " " . $ped_dateStart . " " . $ped_dateEnd);
        valid_pedForm($ped_id, $ped_estado, $ped_dateIni, $ped_dateStart, $ped_dateEnd);
        alert_popup('Validación exitosa. Subiendo datos a la base de datos...');
        console_log("====Actualizando pedido...====");
        update_pedido($conn, $ped_id, $ped_estado, $ped_dateIni, $ped_dateStart, $ped_dateEnd);
        console_log(" ");
        console_log("====Recargando profile.php====");
        echo '<script type="text/javascript">window.location.href="profile.php";</script>';
        exit();
    } catch (Exception $e) {
        console_log('ERROR: ' . $e->getMessage());
    }
}

if (isset($_POST['delete_ropa'])) {
    $ropa_id = $_POST['ropa_id'];
    $base_tamano = $_POST['ropa_tamano'];
    $base_color = $_POST['ropa_colBase'];
    $dis_patr = $_POST['ropa_dis'];
    $dis_color = $_POST['ropa_colDis'];
    $txt_cont = $_POST['ropa_txtCont'];
    $txt_color = $_POST['ropa_txtCol'];
    $txt_pos = $_POST['ropa_txtPos'];
    $txt_tam = $_POST['ropa_txtTam'];
    $txt_tipo = $_POST['ropa_txtTip'];
    $img_sel = $_POST['ropa_logo'];
    $img_elev = $_POST['ropa_logoElev'];
    $img_pos = $_POST['ropa_logoPos'];
    $img_tam = $_POST['ropa_logoTam'];

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
        console_log('====Validación PHP para eliminación de ropa====');
        console_log("Datos: " . $ropa_id . " " . $base_tamano . " " . $base_color . " " . $dis_patr . " " . $dis_color . " " . $txt_cont . " " . $txt_color . " " . $txt_pos . " " . $txt_tam . " " . $txt_tipo . " " . $img_sel . " " . $img_elev . " " . $img_pos . " " . $img_tam);
        valid_ropaForm($base_tamano, $base_color, $dis_patr, $dis_color, $txt_cont, $txt_tam, $txt_tipo, $txt_color, $txt_pos, $img_sel, $img_tam, $img_elev, $img_pos);
        console_log("====Eliminando ropa...====");
        delete_ropa($conn, $ropa_id);
        console_log(" ");
        console_log("====Recargando profile.php====");
        echo '<script type="text/javascript">window.location.href="profile.php";</script>';
        exit();
    } catch (Exception $e) {
        console_log('ERROR: ' . $e->getMessage());
    }
}

if (isset($_POST['submit_ropa'])) {
    $ropa_id = $_POST['ropa_id'];
    $base_tamano = $_POST['ropa_tamano'];
    $base_color = $_POST['ropa_colBase'];
    $dis_patr = $_POST['ropa_dis'];
    $dis_color = $_POST['ropa_colDis'];
    $txt_cont = $_POST['ropa_txtCont'];
    $txt_color = $_POST['ropa_txtCol'];
    $txt_pos = $_POST['ropa_txtPos'];
    $txt_tam = $_POST['ropa_txtTam'];
    $txt_tipo = $_POST['ropa_txtTip'];
    $img_sel = $_POST['ropa_logo'];
    $img_elev = $_POST['ropa_logoElev'];
    $img_pos = $_POST['ropa_logoPos'];
    $img_tam = $_POST['ropa_logoTam'];

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
        console_log('====Validación PHP====');
        console_log("Datos: " . $ropa_id . " " . $base_tamano . " " . $base_color . " " . $dis_patr . " " . $dis_color . " " . $txt_cont . " " . $txt_color . " " . $txt_pos . " " . $txt_tam . " " . $txt_tipo . " " . $img_sel . " " . $img_elev . " " . $img_pos . " " . $img_tam);
        valid_ropaForm($base_tamano, $base_color, $dis_patr, $dis_color, $txt_cont, $txt_tam, $txt_tipo, $txt_color, $txt_pos, $img_sel, $img_tam, $img_elev, $img_pos);
        alert_popup('Validación exitosa. Subiendo datos a la base de datos...');
        console_log("====Actualizando ropa...====");
        update_ropa($conn, $ropa_id, $base_tamano, $base_color, $dis_patr, $dis_color, $txt_cont, $txt_tam, $txt_tipo, $txt_color, $txt_pos, $img_sel, $img_tam, $img_elev, $img_pos);
        console_log(" ");
        console_log("====Recargando profile.php====");
        echo '<script type="text/javascript">window.location.href="profile.php";</script>';
        exit();
    } catch (Exception $e) {
        console_log('ERROR: ' . $e->getMessage());
    }
}

// Con tal de no repetir código, esta función se encargará de convertir cualquier valor vacío o nulo a un guión "-" como en formEditor.php
function changeToDashIfEmpty($valor)
{
    if ($valor == "" || $valor == null) {
        return "-";
    }
    return $valor;
}
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Camisaedit - Perfil del Usuario</title>
    <!-- Enlace a archivo CSS en la carpeta styles -->
    <link rel="stylesheet" href="./styles/generalStyle.css" />
    <link rel="stylesheet" href="./styles/profileStyle.css" />
    <script src="../model/profile.js" type="text/javascript"></script>
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
                    <li><a id="link_iniSess_nav" href="login.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="sect_profile">
            <div id="profile_info">
                <h2>Información del Usuario</h2>
                <div id="profile_info_text">
                    <p><strong>ID de Usuario:</strong> <span
                            class="profile-value"><?php echo htmlspecialchars($_SESSION['user_id']); ?></span></p>
                    <p><strong>Nombre Completo:</strong> <span
                            class="profile-value"><?php echo htmlspecialchars($_SESSION['user_nomCom']); ?></span></p>
                    <p><strong>Email:</strong> <span
                            class="profile-value"><?php echo htmlspecialchars($_SESSION['user_email']); ?></span></p>
                    <p><strong>Teléfono:</strong> <span
                            class="profile-value"><?php echo htmlspecialchars($_SESSION['user_tlf']); ?></span></p>
                    <p><strong>Fecha de Creación:</strong> <span
                            class="profile-value"><?php echo htmlspecialchars($_SESSION['user_dateCreado']); ?></span>
                    </p>
                </div>
            </div>
            <div id="profile_actions">
                <h2>Acciones</h2>

                <?php //Para que así podamos acceder a el editor con nuestra sesión de usuario
                if (!empty($_GET['act'])) {
                    echo '<script type="text/javascript">window.location.href="formEditor.php";</script>';
                    exit();
                } else {
                    ?>
                    <form action="profile.php" method="get">
                        <input type="hidden" name="act" value="run">
                        <button class="btn" id="btn_create_new_camiseta" type="submit">Crear Nueva Camiseta</button>
                    </form>
                    <?php
                }
                ?>
                <button class="btn" id="btn_edit_profile">Editar Perfil</button>
                <button class="btn" id="btn_logout" onclick="window.location.href='login.php'">Cerrar Sesión</button>
            </div>
        </section>
        <section id="sect_pedidos">
            <h2>Mis Pedidos</h2>
            <div id="pedidos_grid">
                <!-- Aquí se mostrarán los pedidos del usuario en una tabla generada por js-->
                <table id="table_datashow">
                    <thead>
                        <tr>
                            <th>ID Pedido</th>
                            <th>ID Usuario</th>
                            <th>ID Ropa</th>
                            <th>Estado</th>
                            <th>Fecha Subida</th>
                            <th>Fecha Iniciada</th>
                            <th>Fecha Finalizada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $tableOutput; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- Modal WIP para Editar Perfil -->
    <div id="wip-modal-overlay" class="modal-overlay hidden"></div>
    <div id="wip-modal" class="confirm-modal hidden">
        <div class="confirm-modal-content">
            <p>Esta funcionalidad está en desarrollo (WIP). Próximamente disponible.</p>
            <div class="confirm-actions">
                <button id="wip-close" class="confirm-btn confirm-no">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal-overlay" class="modal-overlay hidden"></div>
    <div id="template-modal" class="modal hidden" role="dialog" aria-modal="true" aria-labelledby="modal-title">
        <div class="modal-content">
            <button type="button" class="modal-close" aria-label="Cerrar modal">&times;</button>
            <!-- El contenido del modal se inyectará dinámicamente desde JavaScript usando AJAX-->
            <section id="modal-infoPed">
                <h2 id="modal-title">Detalles del Pedido</h2>
                <form id="pedido-form" method="post" action="">
                    <fieldset>
                        <div class="div_formSeparators">
                            <label for="ped_id">ID Pedido:</label>
                            <input type="text" id="ped_id" name="ped_id" readonly><br><br>

                            <label for="ped_estado">Estado:</label>
                            <select id="ped_estado" name="ped_estado" aria-placeholder="Estado" readonly>
                                <option value="Cancelado">Cancelado</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Producción">Producción</option>
                                <option value="Reparto">Reparto</option>
                                <option value="Entregado">Entregado</option>
                            </select><br><br>

                            <label for="ped_dateIni">Fecha de Registro:</label>
                            <input type="date" id="ped_dateIni" name="ped_dateIni" readonly /><br><br>
                        </div>
                        <div class="div_formSeparators">
                            <label for="ped_dateStart">Fecha de Inicio:</label>
                            <input type="date" id="ped_dateStart" name="ped_dateStart" readonly /><br><br>

                            <label for="ped_dateEnd">Fecha de Finalización:</label>
                            <input type="date" id="ped_dateEnd" name="ped_dateEnd" readonly /><br><br>
                        </div>
                    </fieldset>

                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1): ?>
                        <div class="modal-actions admin-only">
                            <button type="button" class="btn modal-action-pedEdit">Editar Pedido</button>
                            <button type="submit" class="btn" name="submit_ped" id="btn_confirm_changes">Confirmar
                                cambios</button>
                        </div>
                    <?php endif; ?>
                </form>
            </section>
            <section id="modal-infoRopa">
                <h2 id="modal-titleRopa">Detalles de la Ropa</h2>
                <form id="ropa-form" method="post" action="">
                    <fieldset>
                        <div class="div_formSeparators">
                            <label for="ropa_id">ID Ropa:</label>
                            <input type="text" id="ropa_id" name="ropa_id" readonly><br><br>

                            <label for="ropa_tamano">Tamaño:</label>
                            <select id="ropa_tamano" name="ropa_tamano" aria-placeholder="Tamaño" readonly>
                                <option value="-">-</option>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                                <option value="xtra-large">Xtra-Large</option>
                            </select><br><br>

                            <label for="ropa_colBase">Color Base:</label>
                            <select id="ropa_colBase" name="ropa_colBase" aria-placeholder="Color" readonly>
                                <option value="-">-</option>
                                <option value="rojo">Rojo</option>
                                <option value="azul">Azul</option>
                                <option value="verde">Verde</option>
                            </select><br><br>

                            <label for="ropa_dis">Diseño:</label>
                            <select id="ropa_dis" name="ropa_dis" aria-placeholder="Patrón del diseño" readonly>
                                <option value="-">-</option>
                                <option value="polka">Polka</option>
                                <option value="rayas">Rayas</option>
                                <option value="fuego">Fuego</option>
                                <option value="mitades">Mitades</option>
                            </select>

                            <label for="ropa_colDis">Color Diseño:</label>
                            <select id="ropa_colDis" name="ropa_colDis" aria-placeholder="Color" readonly>
                                <option value="-">-</option>
                                <option value="rojo">Rojo</option>
                                <option value="azul">Azul</option>
                                <option value="verde">Verde</option>
                            </select><br><br>
                        </div>
                        <div class="div_formSeparators">
                            <label for="ropa_txtCont">Contenido Texto:</label>
                            <input type="text" id="ropa_txtCont" name="ropa_txtCont" readonly><br><br>

                            <label for="ropa_txtCol">Color Texto:</label>
                            <select id="ropa_txtCol" name="ropa_txtCol" aria-placeholder="Color" readonly>
                                <option value="-">-</option>
                                <option value="rojo">Rojo</option>
                                <option value="azul">Azul</option>
                                <option value="verde">Verde</option>
                            </select><br><br>

                            <label for="ropa_txtPos">Posición Texto:</label>
                            <select type="text" id="ropa_txtPos" name="ropa_txtPos" aria-placeholder="Pos_txt" readonly>
                                <option value="-">-</option>
                                <option value="top">Arriba</option>
                                <option value="middle">Medio</option>
                                <option value="bottom">Abajo</option>
                            </select>

                            <label for="ropa_txtTam">Tamaño Texto:</label>
                            <select id="ropa_txtTam" name="ropa_txtTam" aria-placeholder="Tamaño_txt" readonly>
                                <option value="-">-</option>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                                <option value="xtra-large">Xtra-Large</option>
                            </select><br><br>

                            <label for="ropa_txtTip">Tipografía:</label>
                            <select type="text" id="ropa_txtTip" name="ropa_txtTip" aria-placeholder="Tipografia_txt"
                                readonly>
                                <option value="-">-</option>
                                <option value="Arial">Arial</option>
                                <option value="Times New Roman">Times New Roman</option>
                                <option value="Courier New">Courier New</option>
                            </select><br><br>

                            <label for="ropa_logo">Logo:</label>
                            <select id="ropa_logo" name="ropa_logo" aria-placeholder="imagen_select" readonly>
                                <option value="-">-</option>
                                <option value="cohete">Cohete</option>
                                <option value="avion">Avión</option>
                                <option value="coche">Coche</option>
                            </select><br><br>

                            <label for="ropa_logoElev">Elevación Logo:</label>
                            <select type="text" id="ropa_logoElev" name="ropa_logoElev" aria-placeholder="elevacion_img"
                                readonly>
                                <option value="-">-</option>
                                <option value="above">Encima del texto</option>
                                <option value="below">Debajo del texto</option>
                            </select><br><br>

                            <label for="ropa_logoPos">Posición Logo:</label>
                            <select type="text" id="ropa_logoPos" name="ropa_logoPos" aria-placeholder="Pos_img"
                                readonly>
                                <option value="-">-</option>
                                <option value="top">Arriba</option>
                                <option value="middle">Medio</option>
                                <option value="bottom">Abajo</option>
                            </select><br><br>

                            <label for="ropa_logoTam">Tamaño Logo:</label>
                            <select id="ropa_logoTam" name="ropa_logoTam" aria-placeholder="Tamaño imagen" readonly>
                                <option value="-">-</option>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                                <option value="xtra-large">Xtra-Large</option>
                            </select><br><br>
                        </div>
                    </fieldset>
                    <div class="modal-actions">
                        <button type="button" class="btn modal-action-camEdit">Editar Camiseta</button>
                        <button type="sumbit" class="btn" name="submit_ropa" id="btn_confirm_changes">Confirmar
                            cambios</button>
                    </div>
                    <div class="modal-actions-deleteWrapper">
                        <button type="button" class="btn modal-action-camDelete">Eliminar Camiseta</button>
                    </div>
                    <!-- Mini modal de confirmación para borrar pedido -->
                    <div id="confirm-modal-overlay" class="modal-overlay hidden"></div>
                    <div id="confirm-modal" class="confirm-modal hidden">
                        <div class="confirm-modal-content">
                            <p>¿Estás seguro de que quieres borrar esta ropa? Esta acción no se puede deshacer y
                                también eliminará el pedido.
                            </p>
                            <div class="confirm-actions">
                                <button type="sumbit" id="confirm-yes" class="btn confirm-btn confirm-yes"
                                    name="delete_ropa">Sí, borrar</button>
                                <button id="confirm-no" class="btn confirm-btn confirm-no">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <!-- FOOTER -->
    <footer>
        <p>&copy; 2026 Iru Borredá Bin. Todos los derechos reservados.</p>
    </footer>
</body>

<script>
    // Para que se deshabiliten las elecciones de fecha que sean posteriores al día actual.
    ped_dateStart.min = new Date().toISOString().split("T")[0];
    ped_dateEnd.min = new Date().toISOString().split("T")[0];
</script>

</html>