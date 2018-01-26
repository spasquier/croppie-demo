<?php
/**
 * Esta función recibe el valor que normalmente se pone en el
 * atributo src de un tag img usando codificación base64 y lo
 * guarda en el sistema de archivos con el nombre pasado
 * como parámetro (si no se pasa, se genera uno aleatorio).
 *
 * @param $imageBase64Data string Código base 64 compatible con tag img de HTML, ver https://tools.ietf.org/html/rfc2397
 * @param $imageName       string Nombre con el cual se desea almacenar la imagene en el sistema de archivos.
 *
 * @return string Nombre completo (incluyendo directorio contenedor) de la imagen almacenada.
 */
function storeBase64Image($imageBase64Data, $imageName = '')
{
    // Por ahora guardaremos imagen en la carpeta uploads de este proyecto
    $uploadDirectory = __DIR__ . '/uploads/';

    // Dividir cadena base64 por delimitador ";", el tipo está al inicio (MIME),
    // los datos binarios de la imagen en código base64 están después.
    list($type, $imageBase64) = explode(';', $imageBase64Data);

    // Necesitamos la variable $type (image/png, image/jpeg, etc) para sacar
    // la extensión debido a que no tenemos el nombre original de la imagen,
    // en el caso de Joomla como la imagen original ya está subida, se puede
    // inferir el tipo de imagen del nombre de la imagen original.
    $extension = explode('/', $type)[1];

    // Para el ejemplo estoy generando un nombre de imagen aleatorio, en Joomla
    // se debería obtener el nombre original de la imagen y agregarle un sufijo
    // como "_100x100", "_400x400" o algo así, y finalmente pasarlo como
    // parámetro a esta función para que no se genere este nombre aleatorio.
    if (empty($imageName)) {
        $imageName = uniqid('cropped_image_');
    }

    // Para los datos binarios de la imagen solo nos interesa el código base64,
    // el prefijo antes de ',' sólo especifica la codificación utilizada,
    // información que ya conocemos (base64).
    list(, $croppedImageBase64) = explode(',', $imageBase64);

    // Convertir el código base64 de la imagen a código binario
    // (utilizado para guardar en el sistema de ficheros).
    $croppedImageBinary = base64_decode($croppedImageBase64);

    // Concatenar nombre completo de imagen donde será guardado el
    // contenido binario de ésta.
    $fullImageName = $uploadDirectory . $imageName . '.' . $extension;

    // Finalmente guardar el contenido binario en un fichero específico.
    file_put_contents($fullImageName, $croppedImageBinary);

    return $fullImageName;
}

if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
    die("Restricted.");
}

// Obteniendo las dos imágenes desde POST data y
// guardandolas en el sistema de ficheros
$image100x100Base64 = $_POST['image100x100Base64'];
$image400x400Base64 = $_POST['image400x400Base64'];

// Usando la función que convierte el base64 de los valores obtenidos y
// finalmente los guarda en el sistema de archivos.
$image100x100FileName = storeBase64Image($image100x100Base64);
$image400x400FileName = storeBase64Image($image400x400Base64);

// Hacer lo que se desee con los nombres de las imágenes (guardar en BBDD,
// usar en otras funciones, etc.), por ahora imprimiremos las imágenes
// en los atributos src de tags img en un fichero HTML.
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Croppie JS - Ejemplo</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="PeopleWalking">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
<h1>Imágenes subidas al servidor web</h1>
<hr>

<h2>Imagen de 100x100 pixeles (miniatura)</h2>
<img src="uploads/<?php echo basename($image100x100FileName); ?>" width="100px" height="100px" />
<hr>

<h2>Imagen de 400x400 pixeles</h2>
<img src="uploads/<?php echo basename($image400x400FileName);; ?>" width="400px" height="400px" />
<hr>

<h2>Imagen original</h2>
<img src="uploads/original_d52fb970-02b2-11e8-ba89-0ed5f89f718b.jpg" />

</body>
</html>
