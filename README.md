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


# Manejo de Variables y Codigo
- Todas las variables se espera que sean en ingles.
- puede ser un acronimo de la misma palabra si llega a ser muy larga.
- si es mas de una palabra se usaran giones bajos.
- No se pondran mayusculas.
- se espera por obvias razones que el nombre de la variable tenga sentido con el apartado de codigo.
- Intentar comentariar partes complejas para entendimiento general.
- este razonamiento sera aplicado tanto en la base de datos como en variables de la aplicacion web.
- indenta tu codigo no seas flojo y acomodalo, una buena indentación puede ayudar a encontrar errores y mejorar el entendimiento general.
- 



# Hacer
| STATUS | TAREA | 
| :---: | :---: |
|COMPLETADO| puestos-areas: un puesto puede estar o no a una area lo que definira el puesto del Empleado | 
|COMPLETADO| Un empleado tendra un usuario que sera generado automaticamente |
|COMPLETADO| Un empleado podra solicitar actualizar ciertos datos |
|COMPLETADO| Una convocatoria podra o no tener un cargo y/o un puesto. |
|COMPLETADO| Condicionales para la muestra de convocatorias en base a el puesto y/o cargo del empleado |
|COMPLETADO| Muestra de conteo de los empleados que tienen un puesto | 
|COMPLETADO| Muestra de conteo de los empleados que tienen un cargo |
|COMPLETADO| Muestra de todas las actividades de un cargo |
| | Muestra de todos los puestos de una area | 
| | Se podra mandar para que actualicen su cv |
| | Se podra ver en la informacion del empleado, las capacitaciones relacionadas |
| | Herramientas de ayuda |
| | Validaciones Generales |
| | Mostrar en el puesto a que area pertenece al momento de seleccionar en empleado o candidato |
| | Mostrar la cantidad de puestos en una area |
| | Poder definir una hora en candidatos |
| | Funcionalidad de muestra de numero de capacitaciones en un empleado|
| | Funcionalidad mostrar boton cuando un empleado solicite cambio de información en la lista de empleados |
| | Funcionalidad de muestra de numero y informacion de todas las capacitaciones de un empleado en overview |
| | Validacion de si el empleado puede o no meterse a una convocatoria en especifico dependiendo de su cargo, area y puesto |
|COMPLETADO| Muestra de informacion faltante en empleado |
|COMPLETADO| Muestra de todos los archivos de una capacitacion  |
|COMPLETADO| Nueva tabla de solicitud de aspirar a convocatoria |
|COMPLETADO| Nueva tabla de solicitud para actualizar informacion de empleado |
| | Funcionalidad de actualizacion de informacion de la vista del empleado |
| | Funcionalidad de actualizacion de contraseña del usuario desde la vista del empleado |
| | Un empleado podra aplicar a la convocatoria |
| | Una convocatoria podra mostrar la cantidad de aspirantes a ella y quienes |
| | El administrador podra rechazar o aceptar el aspirante a esa convocatoria |
|COMPLETADO| Validación de numero de telefono |
|COMPLETADO| Cerrar sesión |
|COMPLETADO| Manejo de sesiones |
|COMPLETADO| validation type user in other pages with no access for employees |
|COMPLETADO| El usuario podra cambiar contraseña de usuario |
