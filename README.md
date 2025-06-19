# Event Management System (Project)

A Laravel-based **Event Management System (EMS)** with:

- Vite for frontend asset bundling
- Docker-powered MySQL database
- JWT authentication
- Database seeding

---

## 🛠️ Setup Instructions

### 1. Install Dependencies

Install backend and frontend packages:

```bash
npm install
composer require firebase/php-jwt
composer require tymon/jwt-auth
```

### 2. Start MySQL Database with Docker

Run MySQL in a Docker container:

```env
docker run -p 3311:3306 --name ems_db -e MYSQL_ROOT_PASSWORD=your_password -d mysql:latest
```

** Replace your_password with your preferred root password.**

### 3. Build Frontend Assets

Compile frontend assets using Vite:

```bash
npm run build
```

This generates the public/build/manifest.json file required by Laravel.

### 4. Run Database Migrations and Seeders

Set up the database schema and seed data:

```bash
php artisan migrate
php artisan db:seed --class=FullDataSeeder
```

### 5. Run the Backend Server

Start Laravel's development server:

```bash
php artisan serve
```

### 6. Run the Frontend Dev Server

```bash
npm run dev
```

### ⚙️ Configuration Notes

** Ensure .env file has correct database configuration for Docker: **

```env
DB_HOST=127.0.0.1 DB_PORT=3311:3306 DB_DATABASE=laravel DB_USERNAME=root DB_PASSWORD=your_password
```


### 📄 License

This project is licensed under the MIT License.


Let me know if you want to include screenshots, API endpoints, or usage examples too!
