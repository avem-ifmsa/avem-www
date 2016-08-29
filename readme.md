# avem-www
Este es el repositorio oficial de la web de [AVEM](http://avem.es).

HOlaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa

`avem-www` es un proyecto de código abierto, lo que significa que todo el código está a disposición del público. Cualquiera puede examinarlo, reutilizarlo, así como colaborar con nosotros. Si eres un desarrollador, tal vez quieras echarle un vistazo a nuestras [instrucciones para desarrolladores](#instrucciones-para-desarrolladores).

Si estás a cargo de la página web, aquí tienes las [instrucciones para el administrador](#instrucciones-para-el-administrador).

## Instrucciones para el administrador
Antes de configurar el proyecto, debe asegurarse de que todo esté configurado correctamente (parámetros de acceso a la base de datos, claves de acceso a las APIs de terceros, etc). Para ello, revise el fichero `.env`.

Una vez hecho esto, acceda a la carpeta del proyecto desde la línea de comandos y ejecute lo siguiente:

```sh
composer install
npm install
gulp
php artisan key:generate
php artisan migrate
```

## Instrucciones para desarrolladores
La forma de colaborar en el desarrollo de la nueva web es a través de GitHub. Las siguientes instrucciones asumen que el usuario tiene al menos cierta familiaridad con Git, el sistema de control de versiones.

Para poder compartir sus cambios, deberá realizar un *fork* del proyecto desde su cuenta de GitHub. Una vez hecho esto, ejecute lo siguiente:

```sh
git clone https://github.com/<su nombre de usuario>/avem-www.git
```

Si todo ha salido bien, debería tener una nueva carpeta llamada `avem-www` en su carpeta personal. Es en esta carpeta en la que debe realizar sus cambios.

Para facilitar el mantenimiento de la nueva web a largo plazo, hemos optado por utilizar, en la medida de lo posible, servicios de terceros. Un ejemplo de esto es MailChimp, un servicio de envío masivo de emails que utilizamos para el envío de correos a nuestros socios.

Cada vez que un usuario se registra en la nueva web, nuestros servicios se encargan de darle de alta en MailChimp de forma automática. Aunque esto es muy útil en producción, durante el desarrollo esto no es necesario y puede dar lugar a errores que pueden ser difíciles de diagnosticar. Por todo esto, edite el archivo `config/app.php` y comente la siguiente línea:

```php
App\Providers\MailchimpServiceProvider::class,
```

El resultado debe ser este:

```php
// App\Providers\MailchimpServiceProvider::class,
```

Guarde el archivo y recuerde: **nunca debe añadir este archivo al sistema de control de versiones**. (Si en algún momento necesita modificar este archivo, deberá primero restaurarlo a su estado original, realizar las modificaciones, ejecutar un *git commit* seguido de *git push* y volver a comentar esta línea).

Opcionalmente, puede añadir `config/app.php` a su fichero `.gitignore`, situado en la carpeta raíz del proyecto. De esta forma, Git ignorará este archivo y podrá seguir trabajando sin peligro.

Este proyecto está configurado para trabajar con una base de datos remota por defecto. No obstante, durante el desarrollo resulta más sencillo trabajar con una base de datos local (p ej. SQLite3). Así que copie el archivo `.env.example` con el nombre `.env` y cree un archivo vacío en la ruta `database/database.sqlite`.

Ahora ejecute lo siguiente para instalar las dependencias necesarias:

```sh
composer install
npm install
```

También debe ejecutar lo siguiente:

```sh
php artisan key:generate
php artisan migrate
```

Algunos de los archivos de este proyecto requieren un preprocesado previo (p ej, las hojas de estilos SCSS). Por esta razón, es posible que los cambios que lleve a cabo no se reflejen en la web. Si esto le ocurre, acuérdese de ejecutar `gulp` desde la carpeta raíz del proyecto.

## Uso de Homestead
Durante el desarrollo, es vital que todos los desarrolladores trabajen con las mismas versiones de las herramientas. *Homestead* (parte del proyecto Laravel) es una máquina virtual que incluye todas las herramientas que vamos a necesitar.

Homestead necesita de VirtualBox para funcionar, así que asegúrese de tenerlo instalado antes de continuar. Una vez homestead está instalado, puede editar su fichero de configuración con `homestead edit`. Asegúrese de que las carpetas estén configuradas correctamente.

Una vez configurado, puede poner en marcha la máquina virtual con `homestead up`. Si todo está bien, visite el siguiente enlace desde el navegador para acceder a una versión en pruebas de la nueva web: http://192.168.10.10

![Homestead Index HTML Page](https://www.googledrive.com/host/0BzZnU4OoaaKbU18tX1FuMTc3d2c)
