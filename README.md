
## Mis Comentarios


## Comandos de creación

- Parar servidor mysql:
    sudo service mysql sttop

- Ejecutar XAMPP (sólo necesitamos el Servidor de BBDD)


composer create-project laravel/laravel <proyecto>.

Instalar Breeze:
composer require laravel/breeze --dev
php artisan breeze:install


npm install
npm run dev

(RESTO NO NECESARIO CON BREEZE)
NO: npm install -D tailwindcss postcss autoprefixer
NO: npx tailwindcss init -p


php artisan serve
npm run dev

php artisan migrate.
php artisan make:migration add_username_to_users_table.


Instalar: LiveWire (NO EN ESTE PROYECTO):
composer require livewire/livewire
(En app.blade.php incluir en el HEAD y en el BODY los correspondientes @)


## Dudas y Posibles errores.

Cuando las rutas no funcionen bien, lanzar el comando:
php artisan route:cache

En producción, la carga de imágenes no funcionaba y hubo que instalar:
composer require ext-gd

Crear Notificaciones:
php artisan make:notification NuevoCandidato
más la tabla donde se volcará esa información:
php artisan notifications:table



IMPORTANTE:
Las imagenes se guardan en una ubicación a la que no tiene acceso el usuario, por lo que
hay que crear un enlace a la carpeta "storage/public/vacantes", mediante el comando:
php artisan storage:link
