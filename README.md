# Proyecto AWARH | Aplicación Web de Administración de Recusos Humanos


Configuración `config/db.php`
```php
private $dbhost = "localhost";
private $dbuser = "root";
private $dbpass = "";
private $dbname = "recursoshumanos";
````


# Informacion
Se agrego el funcionamiento de subida de archivos en varias secciones.
por ende ya se puede subir y ver la informacion general de esas categorias.

Apartado de capacitaciones no funciona todavia con ese mismo funcionamiento.

Los botones de edicion de Candidatos, Empleados y Convocatorias no funcionan actualmente debido a la adicion de archivos.

Se plantea crear un usuario por cada empleado para ello se modifico la tabla users

Se hicieron varias modificaciones en la base de datos en base a las revisiones de giovanni, dando una mejor especificacion del dato y de donde viene en cuestion de la id. por ende, varios archivos y db.php cambiaron en cuestion de llamar a esas propiedades.

Se añadio una ventana de confirmacion de eliminacion de datos para todos los modulos funcionales actuales


#Manejo de Variables y Codigo
- Todas las variables se espera que sean en ingles.
- puede ser un acronimo de la misma palabra si llega a ser muy larga.
- si es mas de una palabra se usaran giones bajos.
- No se pondran mayusculas.
- se espera por obvias razones que el nombre de la variable tenga sentido con el apartado de codigo.
- Intentar comentariar partes complejas para entendimiento general.
- este razonamiento sera aplicado tanto en la base de datos como en variables de la aplicacion web.
- indenta tu codigo no seas flojo y acomodalo, una buena indentación puede ayudar a encontrar errores y mejorar el entendimiento general.
- 



#hacer
tooltips
validations
vistas de usuarios
que funcione capacitaciones
