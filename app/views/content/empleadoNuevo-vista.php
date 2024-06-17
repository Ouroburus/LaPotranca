<?php 
function getOptions($type, $parent_id = null) {
    global $conn;
    $options = "<option value=''>Seleccionar</option>";
    
    if ($type == 'departamento') {
        $sql = "SELECT id, nombre FROM departamentos";
    } elseif ($type == 'municipio') {
        $sql = "SELECT id, nombre FROM municipios WHERE departamento_id = ?";
    } elseif ($type == 'distrito') {
        $sql = "SELECT id, nombre FROM distritos WHERE municipio_id = ?";
    } else {
        return $options;
    }

    if ($parent_id) {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $parent_id);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $conn->query($sql);
    }

    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
    }

    return $options;
}

if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $parent_id = isset($_GET['parent_id']) ? $_GET['parent_id'] : null;
    echo getOptions($type, $parent_id);
    exit;
}
?>
    <div class="container is-fluid mb-6">
        <h1 class="title">Empleados</h1>
        <h2 class="subtitle"><i class="fas fa-male fa-fw"></i> &nbsp; Nuevo empleado</h2>
    </div>

    <div class="container pb-6 pt-6">
        <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/empleadoAjax.php" method="POST" autocomplete="off">
            <input type="hidden" name="modulo_empleado" value="registrar">

            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Tipo de documento <?php echo CAMPO_OBLIGATORIO; ?></label><br>
                        <div class="select">
                            <select name="empleado_tipo_documento">
                                <option value="" selected="">Seleccione una opción</option>
                                <?php echo $insLogin->generarSelect(DOCUMENTOS_USUARIOS, "VACIO"); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Número de documento <?php echo CAMPO_OBLIGATORIO; ?></label>
                        <input class="input" type="text" name="empleado_numero_documento" pattern="[a-zA-Z0-9-]{7,30}" maxlength="30" required>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Nombres <?php echo CAMPO_OBLIGATORIO; ?></label>
                        <input class="input" type="text" name="empleado_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Apellidos <?php echo CAMPO_OBLIGATORIO; ?></label>
                        <input class="input" type="text" name="empleado_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Departamento <?php echo CAMPO_OBLIGATORIO; ?></label>
                        <div class="select">
                            <select id="departamento" name="departamento" required>
                                <option value="">Seleccionar</option>
                                <?php echo getOptions('departamento'); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Municipio <?php echo CAMPO_OBLIGATORIO; ?></label>
                        <div class="select">
                            <select id="municipio" name="municipio" required>
                                <option value="">Seleccionar</option>
                                <!-- Opciones de municipios se cargarán aquí mediante AJAX -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Distrito <?php echo CAMPO_OBLIGATORIO; ?></label>
                        <div class="select">
                            <select id="distrito" name="distrito" required>
                                <option value="">Seleccionar</option>
                                <!-- Opciones de distritos se cargarán aquí mediante AJAX -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Teléfono</label>
                        <input class="input" type="text" name="empleado_telefono" pattern="[0-9()+]{8,20}" maxlength="20">
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Email</label>
                        <input class="input" type="email" name="empleado_email" maxlength="70">
                    </div>
                </div>
            </div>

            <p class="has-text-centered">
                <button type="reset" class="button is-link is-light is-rounded"><i class="fas fa-paint-roller"></i> &nbsp; Limpiar</button>
                <button type="submit" class="button is-info is-rounded"><i class="far fa-save"></i> &nbsp; Guardar</button>
            </p>
            <p class="has-text-centered pt-6">
                <small>Los campos marcados con <?php echo CAMPO_OBLIGATORIO; ?> son obligatorios</small>
            </p>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Cargar departamentos al cargar la página
            $.ajax({
                url: 'empleadoAjax.php',
                method: 'GET',
                data: {type: 'departamento'},
                success: function(data) {
                    $('#departamento').append(data);
                }
            });

            // Actualizar municipios cuando se seleccione un departamento
            $('#departamento').change(function() {
                var departamento_id = $(this).val();
                $.ajax({
                    url: 'empleadoAjax.php',
                    method: 'GET',
                    data: {type: 'municipio', parent_id: departamento_id},
                    success: function(data) {
                        $('#municipio').html(data);
                        $('#distrito').html('<option value="">Seleccionar</option>'); // Resetear distritos
                    }
                });
            });

            // Actualizar distritos cuando se seleccione un municipio
            $('#municipio').change(function() {
                var municipio_id = $(this).val();
                $.ajax({
                    url: 'empleadoAjax.php',
                    method: 'GET',
                    data: {type: 'distrito', parent_id: municipio_id},
                    success: function(data) {
                        $('#distrito').html(data);
                    }
                });
            });
        });
    </script>
</body>
</html>