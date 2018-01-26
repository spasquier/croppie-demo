<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Croppie JS - Ejemplo</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="PeopleWalking">

    <!-- IMPORTANTE: para Joomla incluir CSS del componente Croppie -->
    <link rel="stylesheet" href="css/croppie.css">

    <link rel="stylesheet" href="css/demo.css">

    <!-- HTML5 shiv, por si acaso usan algo como Internet Explorer 7 u 8 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>

<!-- Asumamos que el modal es el siguiente div -->
<div id="modalBody">
    <h1>Recortar imagen</h1>

    <div id="croppieComponentContainer">
        <!--
        IMPORTANTE: definir la altura de la imagen original que ha sido
        cargada en el modal, debe ser la misma altura que el máximo permitido
        al cortar la imagen.
        -->
        <img class="original-image" src="uploads/original_d52fb970-02b2-11e8-ba89-0ed5f89f718b.jpg" height="400px" />

        <!--
        IMPORTANTE: Aquí el componente generará HTML para hacer el recorte, usar
        la clase "croppie-container" si se desea cambiar los estilos CSS.
        -->
    </div>
    <hr>

    <!--
    IMPORTANTE: upload.php contiene el código para subir las imágenes generadas
    por el componente Croppie, los input deben ser tipo text por requerimiento
    del componente y se deben ocultar con CSS.
    -->
    <form action="upload.php" method="post">
        <input type="text"
               id="image100x100Base64"
               name="image100x100Base64"
               required="required">

        <input type="text"
               id="image400x400Base64"
               name="image400x400Base64"
               required="required">

        <p class="warning">Necesita recortar la imagen antes de subirla.</p>
        <input type="button" id="cropImagesBtn" value="Cortar">
        <input type="submit" value="Subir" />
    </form>
    <hr>

    <h2>Imágenes base64 generadas en el cliente (aún no se suben)</h2>
    <h3>Imagen de 100x100 pixeles (miniatura)</h3>
    <img id="demoImage100x100" src="" width="100px" height="100px" />
    <h3>Imagen de 400x400 pixeles</h3>
    <img id="demoImage400x400" src="" width="400px" height="400px" />
</div>

<!-- Incluir jQuery para manipular el DOM -->
<script src="js/jquery-3.3.1.js"></script>

<!-- IMPORTANTE: para Joomla incluir JS del componente Croppie -->
<script src="js/croppie.js"></script>

<!-- IMPORTANTE: este fichero contiene el código de los pasos 1 y 2 que expliqué en el e-mail -->
<script src="js/cropie.handler.js"></script>
</body>
</html>