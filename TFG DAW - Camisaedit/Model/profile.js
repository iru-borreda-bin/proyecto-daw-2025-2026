// profile.js

document.addEventListener("DOMContentLoaded", function () {
    // Habilitando botones del Administrador
    const userID = "<?php echo $_SESSION['user_id']; ?>";
    if (userID === "1") {
        document.querySelectorAll(".modal-action-editPed").forEach(button => {
            button.disabled = false;
        });
    }

    // Añadimos un listener para habilitar el modal desde los botones "Ver Detalles" de cada pedido
    document.querySelectorAll("#btn_ver_pedido").forEach(button => {
        button.addEventListener("click", async () => {
            const pedidoID = button.getAttribute("data-ped-id");
            const ropaID = button.getAttribute("data-ropa-id");
            console.log("Pedido ID: " + pedidoID);
            console.log("Ropa ID: " + ropaID);
            try {
                // Cargar detalles del pedido
                const responsePedido = await fetch(`../controller/get_pedido_details.php?ped_id=${pedidoID}`);
                const dataPedido = await responsePedido.json();

                if (dataPedido.error) {
                    alert(dataPedido.error);
                    return;
                }

                // Cargar detalles de la ropa
                const responseRopa = await fetch(`../controller/get_ropa_details.php?ropa_id=${ropaID}`);
                const dataRopa = await responseRopa.json();

                if (dataRopa.error) {
                    alert(dataRopa.error);
                    return;
                }

                // Rellenar el formulario del pedido en el modal
                document.getElementById("ped_id").value = dataPedido.ped_id;
                document.getElementById("ped_estado").value = dataPedido.ped_estado; // Convertir a minúsculas para el select
                document.getElementById("ped_dateIni").value = dataPedido.ped_dateIni;
                document.getElementById("ped_dateStart").value = dataPedido.ped_dateStart;
                document.getElementById("ped_dateEnd").value = dataPedido.ped_dateEnd;

                // Rellenar los detalles de la ropa
                document.getElementById("ropa_id").value = dataRopa.ropa_id;
                document.getElementById("ropa_tamano").value = dataRopa.ropa_tamano;
                document.getElementById("ropa_colBase").value = dataRopa.ropa_colBase;
                document.getElementById("ropa_dis").value = dataRopa.ropa_dis;
                document.getElementById("ropa_colDis").value = dataRopa.ropa_colDis;
                document.getElementById("ropa_txtCont").value = dataRopa.ropa_txtCont;
                document.getElementById("ropa_txtCol").value = dataRopa.ropa_txtCol;
                document.getElementById("ropa_txtPos").value = dataRopa.ropa_txtPos;
                document.getElementById("ropa_txtTam").value = dataRopa.ropa_txtTam;
                document.getElementById("ropa_txtTip").value = dataRopa.ropa_txtTip;
                document.getElementById("ropa_logo").value = dataRopa.ropa_logo;
                document.getElementById("ropa_logoElev").value = dataRopa.ropa_logoElev;
                document.getElementById("ropa_logoPos").value = dataRopa.ropa_logoPos;
                document.getElementById("ropa_logoTam").value = dataRopa.ropa_logoTam;

                // Actualizar títulos del modal
                document.getElementById("modal-title").textContent = "Detalles del Pedido ID: " + dataPedido.ped_id;
                document.getElementById("modal-titleRopa").textContent = "Detalles de la Ropa ID: " + dataRopa.ropa_id;

                // Mostrar el modal
                console.log("Mostrando modal");
                const modal = document.getElementById("template-modal");
                const overlay = document.getElementById("modal-overlay");
                if (modal && overlay) {
                    modal.classList.remove("hidden");
                    overlay.classList.remove("hidden");
                    console.log("Modal mostrado");
                } else {
                    console.error("Modal o overlay no encontrados");
                }
            } catch (error) {
                console.error("Error en la petición AJAX:", error);
                alert("Error al cargar los detalles.");
            }
        });
    });

    // Listeners específicos al MODAL
    // Añadimos listeners para cerrar el modal
    document.querySelectorAll(".modal-close").forEach(button => {
        button.addEventListener("click", () => {
            console.log("Cerrando modal");
            document.getElementById("template-modal").classList.add("hidden");
            document.getElementById("modal-overlay").classList.add("hidden");
        });
    });

    // Listener para el botón de eliminar ropa en el modal
    document.addEventListener("click", (event) => {
        if (event.target.classList.contains("modal-action-camDelete")) {
            console.log("Abriendo modal de confirmación");
            document.getElementById("confirm-modal-overlay").classList.remove("hidden");
            document.getElementById("confirm-modal").classList.remove("hidden");
        }
    });

    // Listener para el botón de editar pedido en el modal
    document.addEventListener("click", (event) => {
        if (event.target.classList.contains("modal-action-pedEdit")) {
            console.log("Habilitando edición del pedido");
            // Remover readonly de los campos del formulario de pedidos
            const pedidoForm = document.getElementById("pedido-form");
            const inputs = pedidoForm.querySelectorAll("input");
            const selects = pedidoForm.querySelectorAll("select");
            inputs.forEach(input => {
                if (input.id !== "ped_id") { // El ID del pedido no debe ser editable
                    input.removeAttribute("readonly");
                }
            });
            // inputs.forEach(input => {
            //     if (input.id !== "ped_dateIni") { // La fecha del registro del pedido no debe ser editable
            //         input.removeAttribute("readonly");
            //     }
            // });
            // Añadir clase para modo edición
            pedidoForm.classList.add("editing");
            // Cambiar el estado del botón
            event.target.disabled = true;
            event.target.textContent = "Modo Edición Activo";
            console.log("Modo edición activado para pedido");
        }
    });

    // Listener para el botón de editar camiseta en el modal
    document.addEventListener("click", (event) => {
        if (event.target.classList.contains("modal-action-camEdit")) {
            console.log("Habilitando edición de la camiseta");
            // Remover readonly de los campos del formulario de ropa
            const ropaForm = document.getElementById("ropa-form");
            const inputs = ropaForm.querySelectorAll("input");
            inputs.forEach(input => {
                if (input.id !== "ropa_id") { // El ID de la ropa no debe ser editable
                    input.removeAttribute("readonly");
                }
            });
            // Añadir clase para modo edición
            ropaForm.classList.add("editing");
            // Cambiar el estado del botón
            event.target.disabled = true;
            event.target.textContent = "Modo Edición Activo";
            console.log("Modo edición activado para camiseta");
        }
    });

    
    // Listener para el botón Editar Perfil
    document.getElementById("btn_edit_profile").addEventListener("click", () => {
        console.log("Abriendo modal WIP");
        document.getElementById("wip-modal").classList.remove("hidden");
        document.getElementById("wip-modal-overlay").classList.remove("hidden");
    });

    // Listener para cerrar el modal WIP
    document.getElementById("wip-close").addEventListener("click", () => {
        console.log("Cerrando modal WIP");
        document.getElementById("wip-modal").classList.add("hidden");
        document.getElementById("wip-modal-overlay").classList.add("hidden");
    });
});