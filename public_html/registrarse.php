<nav id="menu">
        <button id="iniciarSesion" style="border:none;">Iniciar Sesion</button>
        <button id="registrar" style="border: 2px solid white;">Registrarse</button>
</nav>

<form action="info.php" method="post" id="formLogin">
        <label for="nombre">Nombre: </label>
        <br>
        <input type="text" name="nombre" placeholder="Nombre" required autocomplete="off">
        <br>
        <label for="cuenta">Cuenta: </label>
        <br>
        <input type="text" name="cuenta" placeholder="Usuario" required required autocomplete="off">
        <br>
        <label for="correo">Correo electronico: </label>
        <br>
        <input type="email" name="correo" placeholder="Correo electronico" required required autocomplete="off">
        <br>
        <label for="password">Contraseña: </label>
        <br>
        <input type="password" name="password" placeholder="Ingresa tu contraseña" required required autocomplete="off">
        <br>
        <label for="password2">Repetir Contraseña: </label>
        <br>
        <input type="password" name="password2" placeholder="Confirma tu contraseña" required required autocomplete="off">
        <br>
        <label for="respuestaSeguridad">Pregunta de Seguridad: </label>
        <br>
        <select name="preguntaSeguridad" required>
            <option value="" disabled selected hidden>Selecciona una pregunta</option>
            <option value="PreguntaSeguridad">¿Cuál es el nombre de tu primera mascota?</option>
            <option value="PreguntaSeguridad">¿Cuál es tu deporte favorito?</option>
            <option value="PreguntaSeguridad">¿En qué ciudad naciste?</option>
        </select>
        <br>
        <input type="password" name="respuestaSeguridad" placeholder="Ingresa tu contraseña" required required autocomplete="off">
        <button id="submit" type="submit">Registrarse</button>
</form>
