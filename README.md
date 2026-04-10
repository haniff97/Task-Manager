# Task-Manager

## Setup

1. Clone the repository
   git clone <your-repo-url>
   cd task-manager

2. Install dependencies
   composer install
   npm install && npm run build

3. Environment setup
   cp .env.example .env
   php artisan key:generate

4. Configure database in .env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=task_manager
   DB_USERNAME=root
   DB_PASSWORD=your_mysql_password   <- change password here

5. Create the database in MySQL
   mysql -u root -p
   CREATE DATABASE task_manager;
   exit;

6. Run migrations and seed
   php artisan migrate:fresh --seed

7. Start the server
   php artisan serve

Visit http://localhost:8000

## Test accounts (after seeding)
You can register a new account or check the seeder for generated users.

## Features
- User authentication (register, login, logout)
- Project management (create, edit, delete)
- Task management (create, edit, delete, filter by status)
- Dashboard with task statistics
- Authorization — users can only access their own data