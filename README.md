# Proyecto AWARH | Aplicación Web de Administración de Recusos Humanos


Configuración `config/db.php`
```php
private $dbhost = "localhost";
private $dbuser = "root";
private $dbpass = "";
private $dbname = "recursoshumanos";
````


# Información
Se agrego confirmacion en toda creacion y edicion de informacion, se agrego identificacion de dropdown en navbar, breves correcciones ortograficas, acomodo de diseño, se hizo funcional el boton de edicion de empleados y todo el apartado de capacitaciones, aunque sigue algo incompleto en la muestra de informacion, se agregaron mas procedimientos para el funcionamiento de los mencionados anteriormente, en la vision de un empleado ahora le permitira solicitar un cambio de sus datos.


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



#Hacer
- puestos-areas: un puesto puede estar o no a una area lo que definira el puesto del Empleado
- Un empleado tendra un usuario que sera generado automaticamente
- Un empleado podra solicitar actualizar ciertos datos
- Una convocatoria podra o no tener un cargo y/o un puesto.
- Condicionales para la muestra de convocatorias en base a el puesto y/o cargo del empleado
- Muestra de conteo de los empleados que tienen un puesto y quienes
- Muestra de conteo de los empleados que tienen un cargo y quienes
- Muestra de todas las actividades de un cargo
- Muestra de todos los puestos de una area
- Muestra de informacion faltante en empleado
- Se podra ver en la informacion del empleado, las capacitaciones relacionadas
- Muestra de todos los archivos de una capacitacion
- Un empleado podra aplicar a la convocatoria
- Una convocatoria podra mostrar la cantidad de aspirantes a ella y quienes
- El administrador podra rechazar o aceptar el aspirante a esa convocatoria
- tooltips
- validations





