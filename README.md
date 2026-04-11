# 📋 Task Manager

A simple web-based Task Management System built with Laravel 13, MySQL, and Tailwind CSS.

## Tech Stack

- **Backend** — Laravel 13
- **Database** — MySQL
- **Frontend** — Blade + Tailwind CSS
- **Auth** — Laravel Breeze
- **Version Control** — Git

## Features

- **🌓 Dynamic Dual-Theme UI:** Persistent Light & Dark mode seamlessly integrated universally via Tailwind CSS and `localStorage`.
- **🔐 Modern Form Authentication:** Completely redesigned "Split-Screen" authentication portal with sleek glassmorphism panels.
- 📁 **Project Management** (create, edit, delete)
- ✅ **Task Management** (create, edit, delete, filter by status)
- 📊 **Dashboard** with project and task statistics seamlessly matched to the current styling.
- 🔒 **Authorization** — users can only access their own data
- ✔️ **Server-side validation** with proper error messages

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
DB_PASSWORD=your_mysql_password <--- change password here
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

## Database Schema

**users**
| Column | Type | Notes |
|---|---|---|
| id | bigint | Primary key, auto increment |
| name | varchar(255) | Required |
| email | varchar(255) | Required, unique |
| email_verified_at | timestamp | Nullable |
| password | varchar(255) | Bcrypt hashed |
| created_at | timestamp | Auto generated |
| updated_at | timestamp | Auto generated |

**projects**
| Column | Type | Notes |
|---|---|---|
| id | bigint | Primary key, auto increment |
| user_id | bigint | Foreign key → users.id |
| name | varchar(255) | Required |
| created_at | timestamp | Auto generated |
| updated_at | timestamp | Auto generated |

**tasks**
| Column | Type | Notes |
|---|---|---|
| id | bigint | Primary key, auto increment |
| project_id | bigint | Foreign key → projects.id |
| title | varchar(255) | Required |
| description | text | Nullable |
| status | enum | todo, in_progress, done |
| due_date | date | Nullable |
| created_at | timestamp | Auto generated |
| updated_at | timestamp | Auto generated |

## Design User Interface Decisions

- **Tailwind UI Control** — Explicitly bypassed generic system themes by enforcing CSS variables like `color-scheme: dark`. This ensures all native components—like dropdowns, checkboxes, and scrollbars—obey the app's dark mode toggle rather than user browser biases.
- **Mobile UI Safety** — Hardcoded Flatpickr configuration (`disableMobile: true`).
- **Shallow nested routes** — `projects.tasks` uses `->shallow()` for clean URLs
- **Form Request classes** — validation separated from controllers
- **Policies** — authorization handled via `ProjectPolicy` and `TaskPolicy`, not manual if-checks
- **Eloquent scoping** — all queries scoped to `auth()->user()` to prevent data leakage
- **cascadeOnDelete** — deleting a project automatically removes all its tasks at DB level
