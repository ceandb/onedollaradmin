# OneDollar


1. Crear la BD y cambiar los valores en el archivo .env (en caso este no este, es porque github lo omite aveces, copiar el archvio .env.example y cambiarle el nombre a .env)
2. Instalar las dependencias de composer
3. Installar las dependencias de node_modules (npm install y npm run dev)
4. Para ejecutar las tablas con el comando php artisan migrate (para usar los datos de prueba debe importar el archivo ecommerce.sql)
5. Luego en la consola ejectuar php artisan key:generate (esto creara la llave del proyecto)
6. Luego en la consola ejecutar php artisan storage:link (esto creara un acceso directo en la carpeta public automaticamente para que se guarden y lean las imagenes del sistema completo).
7. Ejecutar php artisan serve (para levantar el servidor en este caso sea local, si es produccion omitir este paso)
