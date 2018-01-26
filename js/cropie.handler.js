(function() {
    var $ = jQuery;
    $(document).ready(function() {

        // Paso 1: inicializamos Croppie especificando el tag img de donde
        // se sacarán los datos binarios de la imagen original.
        window.$croppieComponent = $('.original-image').croppie({
            viewport: {
                width: 400,
                height: 400
            },
            boundary: {
                width: 640,
                height: 400
            }
        });

        // Paso 2: definimos las funciones que guardarán los resultados del componente
        // Croopie a los tags input hidden, los cuales se enviaran por un HTML form
        // que tiene como action la URL "upload.php" (que ejecutará el paso 3).
        $('#cropImagesBtn').on('click', function (ev) {
            ev.preventDefault();

            // Llenar input ID image400x400Base64 con el valor base64 de la imagen
            // cortada originalmente con el componente.
            $croppieComponent.croppie('result', {
                type: 'base64',
                size: {width: 400, height: 400}
            }).then(function (resp) {
                $('#image400x400Base64').val(resp);
            });

            // Llenar input ID image100x100Base64 con el valor base64 de la imagen
            // miniatura ya cortada (100x100).
            $croppieComponent.croppie('result', {
                type: 'base64',
                size: {width: 100, height: 100}
            }).then(function (resp) {
                $('#image100x100Base64').val(resp);
            });

            // Esto es sólo por motivos demo, no es necesario ya que los input tienen los
            // valores que necesitamos, mostrar el contenido de las imágenes en el HTML
            // no es requerido para realizar la subida con el archivo upload.php
            setTimeout(function() {
                $('#demoImage100x100').attr('src', $('#image100x100Base64').val());
                $('#demoImage400x400').attr('src', $('#image400x400Base64').val());
            }, 1000); // esperar un segundo antes de ver las imágenes en el cliente
        });
    });
})();
