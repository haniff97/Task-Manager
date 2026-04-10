# 📋 Task Manager

A simple web-based Task Management System built with Laravel 13, MySQL, and Tailwind CSS. Built as part of a technical assessment for Telediant Engineering.

## Tech Stack

- **Backend** — Laravel 13
- **Database** — MySQL
- **Frontend** — Blade + Tailwind CSS
- **Auth** — Laravel Breeze
- **Version Control** — Git

## Features

- 🔐 User authentication (register, login, logout)
- 📁 Project management (create, edit, delete)
- ✅ Task management (create, edit, delete, filter by status)
- 📊 Dashboard with project and task statistics
- 🔒 Authorization — users can only access their own data
- ✔️ Server-side validation with proper error messages

## Requirements

- PHP 8.2+
- Composer
- MySQL 8.0+
- Node.js 18+

## Setup

### 1. Clone the repository
```bash
git clone <your-repo-url>
cd task-manager
```

### 2. Install dependencies
```bash
composer install
npm install && npm run build
```

### 3. Environment setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure database

Edit `.env` and update these values:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

### 5. Create the database
```bash
mysql -u root -p
```
```sql
CREATE DATABASE task_manager;
exit;
```

### 6. Run migrations and seed
```bash
php artisan migrate --seed
```

### 7. Start the server
```bash
php artisan serve
```

Visit `http://localhost:8000`

## Database Structure

| Table    | Key Fields                                      |
|----------|-------------------------------------------------|
| users    | id, name, email, password                       |
| projects | id, user_id, name, created_at                   |
| tasks    | id, project_id, title, description, status, due_date |

## Design Decisions

- **Shallow nested routes** — `projects.tasks` uses `->shallow()` for clean URLs
- **Form Request classes** — validation separated from controllers
- **Policies** — authorization handled via `ProjectPolicy` and `TaskPolicy`, not manual if-checks
- **Eloquent scoping** — all queries scoped to `auth()->user()` to prevent data leakage
- **cascadeOnDelete** — deleting a project automatically removes all its tasks at DB level
