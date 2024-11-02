Proyecto de Netberry

Consiste en crear un gestor de tareas,pudiendo cada tarea tener una o mas categorias, estas se podran crear y eliminar y se deberan de mostrar sin que se recargue la pagina y lo mismo al eliminar una tarea se eliminara de la base de datos y se debera mostrar sin recargar la pagina.
Adicionalmente a esto le implemente un login  y registro para que solo los usuarios registrados puedan acceder a la aplicacion.

El desarrollo del backend se realizo con Laravel en su version 9.52.16.
El desarrollo del frontend se realizo con Vue.js en su version 3.2.31
El gestor de base de datos que se uso fue  MySQL.

Lo primero que haremos una vez tengamos clonado el repositorio es instalar las  dependencias de PHP con este comando:
composer install

Y acto seguido las dependencias de node.js 
npm install

Configuraremos el archivo .env para conectarse a la base de datos y usaremos el siguiente comando
cp  .env.example .env
y luego editaremos el archivo .env para agregar la siguiente informacion
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=netberry
DB_USERNAME=root
DB_PASSWORD=

Ahora generaremos  la clave de la aplicacion con el siguiente comando
php artisan key:generate

Ahora ejecutaremos las migraciones  para crear la base de datos con el siguiente comando
php artisan migrate

Ahora ejecutamos los seeder  para agregar datos a la base de datos con el siguiente comando
php artisan db:seed --class=CategoriesSeeder
Esto nos creara las categorias que se mencionan en el pdf de la prueba
Ahora por comodidad he proporcionado un seeder con un usuario para  que puedas acceder a la aplicacion
php artisan db:seed --class=UserSeeder

el  usuario es el siguiente email:admin@ejemplo.com  y contraseña: password, en el caso que no quiera usar este usaurio puede  crear uno nuevo usuario cuando inicie la aplicacion.

Compilamos  el frontend con el siguiente comando
npm run dev

y ejecutamos el backend con el siguiente comando
php artisan serve

y listo ya podemos acceder a la aplicacion en el navegador  en la siguiente url http://localhost:8000#   N e t b e r r y - G e s t o r - d e - T a r e a s  
 