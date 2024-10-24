<?php 
    session_start();
    $logeado = false;
    if(isset($_SESSION["iniciada"]) && $_SESSION["iniciada"]){
        $logeado=true;
    }
    $servername = "127.0.0.1";
    $database = "pagina_web_street_tango";
    $username = "alumno";
    $password = "alumnoipm";
    
    $conexion = mysqli_connect($servername, $username, $password, $database); // se crea la conexion

    if (!$conexion) {
        die("Conexion fallida: " . mysqli_connect_error());
    }
    else{
        $query_check = "select * from productos where productos_id=".$_GET['id'].";";
        $consulta_talles="select descripcion from producto_talle pt join talle t on pt.talle_id = t.talle_id where pt.producto_id =".$_GET['id'].";";
        $consulta_color = "select descripcion from producto_color pc join color c on pc.color_id = c.color_id where pc.productos_id =" . $_GET['id'] . ";";
        $resultados= mysqli_query($conexion, $query_check);
        $resultado_talles= mysqli_query($conexion, $consulta_talles);
        $resultado_color= mysqli_query($conexion, $consulta_color);
        $string_talles = "";
        $string_color = "";
    }
    
    ?>


<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Producto</title>
<link rel="stylesheet" href="producto2.css" type="text/css">
<link rel="shortcut icon" href="../imgs/logo-st-tango.png" type="image/x-icon">
<body>
    <header>
        <div id="container">
 
            <button id="toggleButton" class="icon">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAExJREFUSEtjZKAxYKSx+QyjFhAM4QEJov8EnYVfAYqjsfmA5hZQ6AFU7QMSBzT3Ac3jgOYW0DyIhr4FNI8Dmlsw9ONg1AcoIUDz0hQAbegGGXzv/l0AAAAASUVORK5CYII="/>
            </button>
 
            <div id="sidebar" class="sidebar">
                <?php 
                if($logeado==true)
                {
                    ?>
                    <div id=acount>
                    <img id=imgcount src="data:image/png;base64,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"/>
                    <div id="sessionlogeada">
                    <h5>BIENVENIDO</h5>
                    <a href="../cerrar_sesion.php" class="cierresesion">Cerrar sesion</a>
                    </div>
                    </div>
                <?php 

                }
                else{
                    ?>
                    <div id="sessionArea">
                    <a href="../inicio sesion/inicio_sesion_index.html" class="botoncuentas">Iniciar Sesión</a>
                    <a href="../registro/registro-index.html" class="botoncuentas">Registrarse</a>
                </div>
                
                <?php 


                }
                ?>

            </div>

            <script>
                const toggleButton = document.getElementById('toggleButton');
                const sidebar = document.getElementById('sidebar');
        
                // Función para mostrar/ocultar la barra
                toggleButton.addEventListener('click', () => {
                    sidebar.classList.toggle('show');
                });
        
                // Función para ocultar la barra si se hace clic fuera de ella
                document.addEventListener('click', (event) => {
                    const isClickInside = sidebar.contains(event.target) || toggleButton.contains(event.target);
                    if (!isClickInside) {
                        sidebar.classList.remove('show');
                    }
                });
            </script>
 
            <div id="logo">
                <a href="/pagina/pagina_web_header.php" class="btn"><img src="/imgs/logo-st-tango2.png" alt="Producto 1"></a>
            </div>
 
        
            <button class="icon">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAORJREFUSEvtld0RATEUhb+twKiATtCBDujAqAAdKEEHlEAlRgc6YI5JdshKbnZNxsvmZTP5Od/Nyd3cisKtKqxPLmAOrICpC+gM7AB9ky0HcAAWERVBtimCBVDkRyewBk6uvwQ2rj9LncQCyIIJIPF9EKkiF+TyZl3jMBbg4XYMgXuwewxc3VhUJxcQW+cDyAZ4S6zkSM1LQ/fyaiHZR/QL4EM3BvDjlgXhfGP93wFtrWp9gh4QTVPrB4xZ19+BmVSmRXoxB6ZMesEN0Ev79S1SSVQFG3WESFzFqC6lXbMlm18c8ATvMDIZGBnHqwAAAABJRU5ErkJggg=="/>
            </button>
    </header>
 
    <main>
    <section class="product-details">
        <?php
        if ($resultados && mysqli_num_rows($resultados) > 0) {
            $fila = mysqli_fetch_assoc($resultados);
            $stock = $fila["stock"];
            $string_talles = '';
            $string_color = '';
        ?>
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($fila['ruta_imagen_dorso']); ?>">
                <img src="<?php echo htmlspecialchars($fila['ruta_imagen_reverso']); ?>" alt="Imagen alternativa del producto" class="hover-image">
            </div>
            <div class="product-info">
                <h2><?php echo htmlspecialchars($fila['nombre']); ?></h2>
                <p class="price">$<?php echo htmlspecialchars($fila['precio']); ?></p>
                <p class="description"><?php echo htmlspecialchars($fila['descripcion']); ?></p>


                <div id="producto" class="inputs">
                    <form action="../compra/compra.php" class="form purchase-form" method="get" onsubmit="return showReservationForm(event);">
                        <label for="size">Tamaño:</label>
                        <select class="input1"  id="size" name="size">
                            <?php
                            while ($fila1 = mysqli_fetch_assoc($resultado_talles)) {
                                $string_talles .= $fila1['descripcion'] . ", ";
                            ?>
                                <option value="<?php echo htmlspecialchars($fila1['descripcion']); ?>"><?php echo htmlspecialchars($fila1['descripcion']); ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <label for="color">Color:</label>
                        <select class="input1"  id="color" name="color">
                            <?php
                            while ($fila2 = mysqli_fetch_assoc($resultado_color)) {
                                $string_color .= $fila2['descripcion'] . ", ";
                            ?>
                                <option value="<?php echo htmlspecialchars($fila2['descripcion']); ?>"><?php echo htmlspecialchars($fila2['descripcion']); ?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <label for="cantidad" id="labelCantidad">Cantidad:</label>
                        <input class="input1" type="number" name="cdt" value="1" min="1" max="<?php echo $stock; ?>" />

                        <div onclick="mostrarElemento1()" type="submit" data-tooltip="Click reserva" class="buttoncom">
                            <div class="button-wrappercom">
                            <div class="textcom">Comprar</div>
                                <span class="iconcom">
                                <svg viewBox="0 0 16 16" class="bi bi-cart2" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                            </svg>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>


                <div id="reserva" class="ocultar" >
                    <form method="GET" class="reserva-form" action="">


                        <label for="nombre">Nombre:</label>
                        <input class="input1" type="text" id="nombre" name="nombre" required>

                        <label for="apellido">Apellido:</label>
                        <input class="input1" type="text" id="apellido" name="apellido" required>

                        <label for="dni">DNI:</label>
                        <input class="input1" type="text" id="dni" name="dni" required>

                        <label for="telefono">Número de Teléfono:</label>
                        <input class="input1" type="tel" id="telefono" name="telefono" required>

                        <label for="email">Email:</label>
                        <input class="input1" type="email" id="email" name="email" required>

                        <label for="fecha">Selecciona una fecha:</label>
                        <select class="input1"  id="fecha" name="fecha" required>
                            <option value="">Seleccione una fecha</option>
                            <option value="2024-10-25">25 de Octubre 2024</option>
                            <option value="2024-10-26">26 de Octubre 2024</option>
                            <option value="2024-10-27">27 de Octubre 2024</option>
                        </select>

                        <label for="lugar">Selecciona un lugar de retiro:</label>
                        <select class="input1" id="lugar" name="lugar" required>
                            <option value="">Seleccione un lugar</option>
                            <option value="lugar1">Sucursal Centro</option>
                            <option value="lugar2">Sucursal Norte</option>
                            <option value="lugar3">Sucursal Sur</option>
                            <option value="lugar4">Sucursal Este</option>
                        </select>

                        <div type="submit" data-tooltip="enviar" class="buttoncom">
                            <div class="button-wrappercom">
                            <div class="textcom">Reservar</div>
                                <span class="iconcom">
                                <svg viewBox="0 0 16 16" class="bi bi-cart2" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                            </svg>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php
        } else {
            echo "<p>Producto no encontrado.</p>";
        }
        ?>
    </section>

    <section class="product-specs">
        <h3>Especificaciones: </h3>
        <ul>
            <li>Descripción: <?php echo isset($fila) ? htmlspecialchars($fila['descripcion_larga']) : 'N/A'; ?></li>
            <li>Colores disponibles: <?php echo !empty($string_color) ? rtrim($string_color, ', ') : 'N/A'; ?></li>
            <li>Talles: <?php echo !empty($string_talles) ? rtrim($string_talles, ', ') : 'N/A'; ?></li>
            <li>Corte: <?php echo isset($fila) ? htmlspecialchars($fila['genero']) : 'N/A'; ?></li>
            <li>Marca: <?php echo isset($fila) ? htmlspecialchars($fila['marca']) : 'N/A'; ?></li>
        </ul>
    </section>
</main>

<script>
    function showReservationForm(event) {
        event.preventDefault(); // Evita el envío del formulario

        // Oculta el formulario de producto
        //document.getElementById("producto").className = "ocultar";
        //document.getElementById('producto').style.display = 'none';
        document.getElementById("producto").classList.add('ocultar');
        console.log("Producto ocultado");


        
        document.getElementById("reserva").classList.remove('ocultar');
        document.getElementById("reserva").classList.add('view');
        console.log("Reserva mostrada");


        // Muestra el formulario de reserva
        //document.getElementById("reserva").className = "view";
        //document.getElementById('reserva').style.display = 'block';
    }





    function mostrarElemento1() {
        var elemento1 = document.getElementById("producto");
        var elemento2 = document.getElementById("reserva");
        elemento1.style.display = "none";
        elemento2.style.display = "block";
}
</script>

    <footer>
        <div class="footer-content">
        <h3>Street Tango</h3>
<ul class="politics">
<li><a href="#">Como comprar</a></li>
<li><a href="/politica_de_devolucion/politica_devolucion.html">Politica de devolucion</a></li>

</ul>
        <ul class="socials">
            <li><a href="#"><img src="data:image/png;base64,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" alt="instagram">Instagram</a></li>

            <li><a href="#"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPAAAADwCAYAAAA+VemSAAAAAXNSR0IArs4c6QAAE2ZJREFUeF7tnQ225DYRhTsrCawksJLASmBWAlkJZCWQlcBU8pTReLrbkm79SrfPeWd+nmXLt+qTqkpy+7sHP1SACpRV4LuyPWfHqQAVeBBgOgEVKKwAAS5sPHadChBg+gAVKKwAAS5sPHadChBg+gAVKKwAAS5sPHadChBg+gAVKKwAAS5sPHadChBg+gAVKKwAAS5sPHadChBg+gAVKKwAAS5sPHadChBg+gAVKKwAAS5sPHadChBg+gAVKKwAAS5sPHadChBg+gAVKKwAAS5sPHadChBg+gAVKKwAAS5sPHadChBg+gAVKKwAAS5sPHadChBg+gAVKKwAAS5sPHadChBg+gAVKKwAAS5sPHadChBg+gAVKKwAAS5sPHadChDgej7wh8fjIT8/fHRd/i6f9mf/9/Z//73cZvt3//8/Px4P+Xf7qafMgT0mwHmNLvD96fF4fP8BZ/u3R48b2P/+uFiDu/3bow+8xoACBHhAJKdDBNAfP671d6drzl5GwBaICfSsckbHE2AjYQdOWwHYu9sg0HcKGf+eABsLfDl9g/Yvl5zVtxd2VxOg//kxQzPcttP59zMTYAeRH4/H3z6AFXBP+TSYP51ywxH3SYDtVG+zbdZ81u7Ovz5zH2bL7MyPogIEWFHMj1PJbLtriIyqxVkZVfDSngDrCSrgnj7bjqpJkEeVujmOAGNCMkzG9Gsg//SxgQQ724GtCfCa0Qnumm6vWrU8WQpe111julfa7GwEeN6gkt/+Y74ZWwwowNB6QKT+EAI8LpjMugKubG/kx1YBAfmvH7u+bK9U/OwEeMyALFCN6aR9lCw7Max+oyoBfu9yMtv+S9sreb4pBRhWE+Aph5GDK4TL/RNDfeHnl0shSH737FFDuc/+Saf2mOK0WE4N5D7+zCLX12pzBv7W+7LNuu353P7RPqt9xg30lufLM8eZtn9yNr74KwH+WpAMuW4PrDy2ZwXrzMTZnkXOArRsmOEe688iEODf3Dg6ZK72FE8DWp5fjqrKM6QmwL/CGxUy77ILKfIRyeND6tNn4IiQWUJi2Tq445M5UTvUjg2pTwZYNmV4FWhOmykiZmUZEGXzx1GfUwGWtV2P3O00cK/weIMsev/xJIJPBNgD3tPBfQayDJgeRa+jilsnAexVaT42HxuY+bxy5GMgPgVgD3ilOCU5GB+HuyfZA+QjID4BYHGW/9z71PIRfHJmWTrz9fftbbM7wAKv5Lz9XuB1d/u2JcNlXE3r2XjrmXh3gK0KVtuP7DiX02ewHGy3hXhngK3glVxXnorhR18By9l4S4h3BdgKXobM+tA+O6PV9tbt1ol3BNgCXobMPuD2V7EKqbeKoHYD2GJv81YG9+cQuqJVSL3NtsudALYIuwgvxJ9aY4uBeYt0aBeALdZ6txml1TCKPZE2xFukRbsArJ33bjE6x/JmcnULiEs//LADwNpGle2QOz6ra0JUwEm1v1i/dKRVHWDtvFfWdzN8B1UAF6UuqQ1x2YirMsDaeW9ZI5ZCT6+zmhCXzYcrA6yZ95YOo/SYKHcmzfSp5CaPqgBrjr5cKirH7Vcd1oS43EBeFeD/Kfkc4VUSMvg0WhCXC6UrAqwVOpcMmYJByXp5zS9sKDWoVwNYs+rMinNWHNf6pbl3usxSYjWAtWZfwrsGSfZWWgN8meisEsBaeU6pECk7MQn7p+UnJQpaVQDWWvMtM7ImBKNKl7Ty4RIFrSoAa71FgaFzFQyxfmrlw+mjtSoAaywbeRcm2rOs4oqvvlRP3pHErZsYrK9aa+XDqQf9CgBrzL6eI+nM6M83ONjA286qUfT09J1pNSoArDH7eo2iKwWUErnWtGflaKBVO/Hyn2nVsgOsMft6VRORvqYe5ae9KlcDjW23Xj40rVx2gDVmX497XJl5r8ZKO8pPe1WuBhpV6bRRkodzr5pTAwqPwpVWsSTtKL9qwETtNGyU0j6ZAUZnX4+wVMMxmp9zjdqWeLSglfKL4bMCrJG3eISkqFNcXdYjYrDFJO/ZNQpa6WbhrACjYHjMZhoh/tXdPfqdFzH7nlXwqykVsgKMhs/WM5nGaP7KUB6Rw5STbHSwRsqTyj4ZAUaWY8TXPGYxtI/vmPDI3TdicvpW0Fk4VRidEWB5GTfyPl/r2Vc8Bo0Q3nldymLJNCZ5G6CzsMcEMaxeNoA1ilfW96TRxzsD8Rsy7xTCfo/OwmnCaGtnn5UZDU09whvU+COapBrlRzpc7Bh0EE6T5mQDGA1N5TUZ4vyWH7SPo31LM8qPdrjQcWgRMs0AmwngCqMi2scZH08zys90utCxaCTlUWu5lTMTwGj47CEo2sdbg1wO4Cw8q9j48WgxK8UAmwlgtPrsET57A+yR04+7/F5HbhFGZwIYyS29HB0dZGYRSJNrzXa8yPHogBweIWUBGM0tPcJn8UlvgOWaXvdWhDnVbqJhdPhyXxaA0ZHQI3wWz0GihFXP4yy8qtx9OzSMDs+DswCMzGxe4XMUwHLd8FDtnoWyRyDV6PDBNQvAyMzmBTA6WiMeHh6qIZ1P3hZ9qix0cM0AcJX8N3IGZh5sNwqgA3Po4JoBYDT/9bwHJNRHXDB0lEc6XqQtEgGG5sGezv/KlgjAXuFz6zuSL636cqiDrHa6WDvErqH2yQAwMqt5hy/IYLPq05x9V5Ubb4fkwaGFrAwAI+GLd26IrhuOu9RvR4aO7rOdLXw8alevZcxvJI4GGC0geAuH9nfGx0NH9pmObnAsatewKCkaYLQCHdF/JOSf8fUwp5jp5EbHInb1jgR/lz0CgN7mCMBRM5RHHkx4/UcGpJDlXYtJAzACg3cFuomG5kt3rhk2mt91bPPfI74YVquInoGRUS8KYPFjpN/vOIi8p835vL29kpXoaIBL5h2fH2pAjP3Kk8JG8VvXPuMAJLKKSucelQGOzBPRquUzJLwr6mdgOX6XCMBylRCWQi7aaYrMwJEAyy0gOdMzt4q2xbir73kkOiiH2C/kop39kU0c0TMWavArBixexQ4MqD1DWAq56CYAa8/CYXlULDdpro4CHDKhEGDMf1CjX68etp6IybBN63IRYSTAqPNH9r33WM1cmO9Fih0LEIBDajKREJSs+j3xLxmIZF0YeSFbf1ouJ8VBXK6oSoB1nAXZEvqsBwyldewyexYCPKEYMgNnLPho7s6S+5OqtMzG/PgpQIAntN4lB263rB1KZxykJsxb8lDmwBNmQwEOKdvf3J92KM290RMOpXAoAnCIP0bmwKI3IlhI1W/ASbT3STMfHhBd6RDEHwnwpBGyAmwRSjMfnnSOhcNLRoTRM3C5osGgY6DOcL0M14cHhQcOQ20WwlLIRTuRkcpt9r3D2vkwIQboHGiKrIrI6UNYCrmoEsAVckPNXVoiGyEeIHHxEGTADVsxIMCL1h5spp0PE+JB4RcOI8ALoiEzVJUlFjS3eiYrZ+IFZ7tpUtIXo2dgZMml0p5hZHR/5XcZIJa8UT477BgjwAuDIgJwWN6xcJ/SBLnXdxBHLDFdowqxhUD8U2GYkRWRsIJq9AyMVv6yrgW/As4KYkknPi0OLLPN7lIC6UtFkJFNHMcCfOcMd85VDWC5XwnVWuh5d38zv/eqyo8u/cmsLIOKAJ39g04kIbuwRNToGVj6gIQuXk6r6YAWlenWP+u8eCWCqAAyWqMI4yjswh0RoyP6M4gqFbL6/ltDbBFSo7OUgGzRL43BFSlghdZiMgC8Mqr3M46ELxU/aPpwd8+as7FmXzOCjESBocuZGQBGR/ZqefB1JhbnsfpowYJESe8q6FlmZKSAFZrGZQAYHd3DKoBK1KH3P9INBGQLePs+I30bufe7Y9D8N9T/MgCMFrKq5sGeM3GfcszMekhueAfO9fdRIKP3GFaBzlKFln4go3xoEWHWS98c7zETz4CM1CYQWTRz95F+lM1/MwGMOkvlPDhiJr6CLBsvBJz2QcPKEXDeHeM5KCP5b2gBKxPAaCErXEjUY7v2lktM77opqYiAI9e32GgyK5FHeocOVKH5byaA0fDRc8SedcSV46MgXumrVRsPgJHULQU/HiKNGhgVc5cwuullue1y1CaRx3n4ZunwOcUI0nkIGkbvUI2+AiMQ//j5P2Wt8bSPNcBo9Tl0/bc5g7VIM07HMPq1WmiRb8YOGY71GIyR6rNolCLiywSwiIKG0eFFBUPvPykvti5KosWrNNFrNoAZRr8fAU7Ji60HYjR8th5ghueBbACjYXSa0GbYAvMHnpAXW+9uQopXYjHr/g17RTaANcLoNKPjsBXWDtw5pLb0S3T29cjPhz3CUqjhTlwORMNo7614q/ep0W7H2dh6AEZnX+vwfsovMgKsEUZbO8GUyA4H75QbW4anGtV8y/5Nu0pGgDXC6FNfkC3VVXFSAbrix3rgRWdf6/5N2ywrwGgYLUKkE3vaOmsNqobV1rmlxuybYu23d4usAGvMwidUpN8hXglkj7oFunEj5X77zABrzMLWo/raHOnbqoEs4XXG0NoDDLTyLBZLVbxqLpQZYM7CuqC3xwRlb3WGxwXl7jwGWI2JwGOQWbJ2doC3Fn/JYjqNMoTXXg8DoNtz086+0rHsAGvNwinDHx0WobNEzMoy64o9+m8AgW7iTWONPc+pOakAMGdhK/f++rzWMEcs7aHLRqln39Qjy8VnNcKgU5eVVvDXgrl90+T1O7dW+jTbRsNn0jNSYQYWETVm4fTGmPVQx+Mb0D90lexnFW0Btv38HPiqUS1/8crTl01ZBWCNXJgz8LKblGqosRVXbjht5bm3RiWA0YIEC1mlOFzurFbonG7X1TNFKgGMboVLtQl92T3Z8J0CWvCWidYqAYxuhat0r8R0XgGtvFeuXGawr+TUyJJAmRF13m/ZQrHImX7Z6GrtKgAz/yWnrxTQKlrJ+T22dqpasgrA6Gb0MiGRqnX3P5n2FxmUKFxVrEIz/90fxpU71CpaybXTr/lWrkIz/11x773baMJbLnRupq0QQjP/3RvElbvThLdU1bliEQvNfysMUitOfGobbXjL5b3VcmCGz6ei+vV9axesyua9lQBm+Ex4RQELeMvmvZUARsNnLh/VHwA013l7Nbbwjez5IZeP6gOI3IHm9si+H6Xz3kozMPNfxP1rt0UfXnl199vAKzeYeQZm/lsbwNXeW+S7rS/bPVKaGWDmv6sI1G1nFTJvUXF+ZtbMADP/rQviSs+tQmbpy7ZPo2UGOHv+275bOeIL21YAydpGZl2JtqzeGrHFctEr42UFOGP+24AVh+vfbNC+efFTVkKS9kv0lFlXbG312RrezEUsNP/VGJgasC1/unMygnyn0JffW4bL7Srbhs0VlpEiwuf21anffxZIHi1b/RDk18pZh8vtyiUfDVxxOI2ZauW679p4hc8CrPzIdx1bvLmPIH+xsueLx7dbKnoHS0aA0fD53Ra5V3ms9iDUn+9kkFuOa1Wgutptq00aI06ZEWDN5aMIYF/pHvmakRFf0Dom6n3Ex8GbtYiF5L9SdZSfa6VYyzk1ztNePSLLT1Jo2eUjmsu7hy2rys+0inhpWhqbZZuB0fw3jbCDHRHnkwFH3iNUEebo9wwfUWmulAOj+e8gNykPqwCzVqVewwBHFateCZZtBkbzXw3HyHKOHuj2d+++WVfqV+7n6JD5Klg2gJH8d8UZqrW5Qt3eco++7b4HVTTJWkM4PmTODPBp+a/24NFD3Apl12v0yznt715LPMj9ctZ9oV6mGfjk/Bdx7t3bHrOrasWQmQBm+LxiwX3bcNYdsG0WgBk+DxjrkENO3rk2beIsAFcKn1t+2T9SOC08GzxVgOHypGNkATj78lGbFWTDhWy8kE/0JoZJU6c+XMDlFyMsmCgLwNny32fAvpKXIC843kcTzrjr2v3aMgPAGfLfGWDvQLZ4NBE0c6rmzHEVzZEB4Ij8tzmRSKn9VThtu6Fs7Gee/MVZCa4iuO1UGQD2yH9b4UnyV89cS2bj9oUBBuZLf0qNyCb9TUZ2MBpgq/feiKaZnKdtVYx43C7CvzjbOqkeDbBm/psJ2Hfmy/iAgIa7EVoNFSfPEQ0wkv9WAfbOJJm+NeSur/3vd9F/5p7THRsN8MzykWXhKYth2uzcvmyvFcSi+9celJCngfq18Oh+HX/9SIDvwuf26Jz86Vl4yuYU7WkhqWhLQayHXLuvfbFPzk1YtRVWPl8kwNfwuXceOs6Yod89Hijfby0fOaZ/1PCXj/8fefxwrBc8KkyBSIBl+Ug+DMvCzM8LV1cgEuDq2rH/VCBcAQIcbgJ2gAqsK0CA17VjSyoQrgABDjcBO0AF1hUgwOvasSUVCFeAAIebgB2gAusKEOB17diSCoQrQIDDTcAOUIF1BQjwunZsSQXCFSDA4SZgB6jAugIEeF07tqQC4QoQ4HATsANUYF0BAryuHVtSgXAFCHC4CdgBKrCuAAFe144tqUC4AgQ43ATsABVYV4AAr2vHllQgXAECHG4CdoAKrCtAgNe1Y0sqEK4AAQ43ATtABdYVIMDr2rElFQhXgACHm4AdoALrChDgde3YkgqEK0CAw03ADlCBdQUI8Lp2bEkFwhUgwOEmYAeowLoCBHhdO7akAuEKEOBwE7ADVGBdAQK8rh1bUoFwBf4P4jMVLcWf12gAAAAASUVORK5CYII="/>54 11 1234-5678</a></li>
            
            <li><a><img src="data:image/png;base64,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"/>11 1234-5678</a> </li>
            
            <li><a href="#"><img src="data:image/png;base64,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"/> Ejemplo 1234</a></li>
            
            <li><a href="#"><img src="data:image/png;base64,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"/> Example@gmail.com</a></li>

    </ul>
        </div>
        <div class="footer-bottom">
        <p>&copy; 2024 Street Tango | Todos los derechos reservados | Diseñado por <span>Nicolas oddo</span></p>
        </div>
    </footer>
</body>
