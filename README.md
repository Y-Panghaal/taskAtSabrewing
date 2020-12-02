## Testing environment
**Operating System** Windows 10  
**PHP Version** 7.4.3 (XAMPP)  
**Database** Maria DB 10.4.11 (XAMPP)

##  Steps needed for setup

To get the best out of this package, please follow these steps:
- Install composer dependencies using command `composer install`. 
- Create a new file `.env` by copying contents from `.env.example` file.
- Run command `php artisan key generate`.
- Setup your database credentials in your `.env` file.
```dotenv
DB_CONNECTION=<DATABASE DRIVER (task is only tested for `mysql` driver)>
DB_HOST=<DATABASE HOST>
DB_PORT=<DATABASE PORT>
DB_DATABASE=<YOUR PREFERRED DATABASE NAME>
DB_USERNAME=<DATABASE USERNAME>
DB_PASSWORD=<DATABASE PASSWORD>
```

- Migrate your tables after running command `php artisan migrate`.
- Go to [Google Console](https://console.developers.google.com/ "Google Developer Console") and follow these steps:
  1. Create a new project or select a project in case you already have one.
  2. Go to credentials and click on **+ CREATE CREDENTIALS** button and select **OAuth Client ID** from dropdown.
  3. If asked to create a **OAuth Consent Screen**, please create one then repeat the previous step again.
  4. While creating credentials, add url `http://localhost:8000` to **Authorized JavaScript origins** and `http://localhost:8000/login/google/callback` to **Authorized redirect URIs**.
  5. After creating the credentials, you will receive the **Client ID** and **Client Secret**. Save them in your `.env` file as `GOOGLE_CLIENT_ID` and `GOOGLE_CLIENT_SECRET`. Save url `http://localhost:8000/login/google/callback` as `GOOGLE_CALLBACK_URL`.
- Run the application using command `php artisan serve`.
