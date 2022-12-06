<!-- author: Nacho Rodríguez  --> 

<?php require_once 'includes/helpers.php'; ?>
<!-- Sidebar -->
<aside id="sidebar">
    <div id="login" class="block-aside">
        <h3>Identifícate</h3>
        <form action="login.php" method="POST">
            <div>
                <label for="email">Email</label>
                <input type="email" name="email">
            </div>
            <div>
                <label for="password">Contraseña</label>
                <input type="password" name="password">
            </div>
            <div>
                <input type="submit" value="Entrar">
            </div>
        </form>
    </div>
    <div id="register" class="block-aside">
        <?php if(isset($_SESSION['errores'])): ?>
            <?php var_dump($_SESSION['errores']); ?> 
        <?php endif; ?>
 
        <h3>Registrate</h3>
        <?php if(isset($_SESSION['completado'])): ?>
            <div class="alerta alerta-exito">
                <?=$_SESSION['completado']?>
            </div>
        <?php elseif(isset($_SESSION['errores']['general'])): ?>
            <div class="alerta alerta-error">
                <?=$_SESSION['errores']['general']?>
            </div>
        <?php endif; ?>
        <form action="registro.php" method="POST">
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre">
            <?php 
            echo isset($_SESSION['errores']) 
                ? mostrarError($_SESSION['errores'], 'nombre') : ' '; 
            ?>
            </div>
            <div>
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos">
            <?php 
            echo isset($_SESSION['errores']) 
                ? mostrarError($_SESSION['errores'], 'apellidos') : ' '; 
            ?>               
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email">
            <?php 
            echo isset($_SESSION['errores']) 
                ? mostrarError($_SESSION['errores'], 'email') : ' '; 
            ?>                
            </div>
            <div>
                <label for="password">Contraseña</label>
                <input type="password" name="password">
            <?php 
            echo isset($_SESSION['errores']) 
                ? mostrarError($_SESSION['errores'], 'password') : ' '; 
            ?>                
            </div>
            <div>
                <input type="submit" name="submit" value="Registro">
            </div>
            <?php borrarErrores(); ?>
        </form>
    </div>
</aside>
