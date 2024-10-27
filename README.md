## About

This application is a Decision Support System project using the Multi-Objective Optimization method on the basis of Ratio Analysis, developed by STMIK Triguna Dharma, [spk-moora](https://github.com/Kaitama/spk-moora). This application is designed to fulfill the Thesis Program Interest learning at [Institut Teknologi Adhi Tama Surabaya](https://itats.ac.id/). This application can be freely downloaded, used, and modified according to anyone's needs with the provision to **NOT SELL** in any form.

## Framework

technologies using in this application : 
-   [Laravel](https://laravel.com).
-   [jetstream](https://jetstream.laravel.com)
-   [livewire](https://livewire.laravel.com)
-   [Tailwindcss](https://tailwindcss.com).

## installation

1. Download a local server application that supports PHP version 8.1 such as [xampp](https://www.apachefriends.org/) or [Laragon](https://laragon.org/) or [WAMP Server](https://www.wampserver.com/en/download-wampserver-64bits/) for Windows operating system.
2. Download and install [Composer](https://getcomposer.org/Composer-Setup.exe).
3. Download and install [Node JS](https://nodejs.org/en/download/).
4. Restart computer.
5. Run local server **XAMPP Control Panel**, click button `RUN` for Apache and MySQL.
6. Download and install [Visual Studio Code](https://code.visualstudio.com/Download).
7. [Download](https://github.com/adamjatim/spk-moora/archive/refs/heads/main.zip) and extract this project on your computer's drive D, rename the extracted folder to `spk-moora`.
8. Run the **Visual Studio Code** application, select the `File` -> `Open Folder` menu then select the `spk-moora` folder from the previous step.
9. Select the `Terminal` -> `New Terminal` menu in the **Visual Studio Code** application then type the following commands one by one to install the required packages:

```bash
# setup laravel vendor dependencies
composer install

# setup node_module dependencies and build for tailwind css
npm install
npm run build
```
10. Open the **Google Chrome** browser, type the address [http://localhost/phpmyadmin](http://localhost/phpmyadmin) then check a database with the name `spk-moora` if still not exists you can create new one.
11. Reopen the **Visual Studio Code** Terminal and run.
```bash
cp .env.example .env
```
and then edit the database section as follows:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE="spk-moora"
DB_USERNAME=root
DB_PASSWORD=
```

12. Type the following commands one by one in the **Visual Studio Code** terminal to create an app key, migrate tables to the database, and run a local server:

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

13. Type the url address ([http://127.0.0.1:8000/register](http://127.0.0.1:8000/register)) in the **Google Chrome** web browser to see how to register an admin account.

## Author

This application was developed by [Adam Rahmat Ilahi](https://github.com/adamjatim) through the development of [Khairi Ibnutama, S.Kom., M.Kom](https://kaitama.dev), a permanent lecturer at the Bina Keluarga Sejahtera Foundation, [STMIK Triguna Dharma](https://www.trigunadharma.ac.id).


## License

This application is licensed as "open-sourced software" under the [MIT license](https://opensource.org/licenses/MIT).
