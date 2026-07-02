# Personal Expense Tracker

A modern personal expense tracking web application built with Laravel.  
This project helps users record daily expenses, manage categories, track monthly budgets, review spending reports, and customize account preferences through a clean responsive dashboard.

## Project Overview

Personal Expense Tracker is a Laravel portfolio project focused on practical personal finance management. The application allows users to manage their own expense records, organize spending by category, monitor budget usage, filter and search records, and view financial summaries through a dashboard and reports module.

The project includes authentication, password reset, reusable Blade components, responsive layouts, dark mode support, AJAX pagination, settings management, and Mailtrap SMTP integration for development email testing.

## Live Demo

Live URL: https://your-app-name.onrender.com

Note: The app is hosted on Render free tier, so the first load may take a short moment if the service is sleeping.

## Demo Account

Email: demo@example.com  
Password: password

Note: The app is hosted on Render free tier, so the first visit may take a short moment to load if the service is sleeping.

## Features

### Authentication

- User registration
- User login and logout
- Remember Me login support
- Custom login error message
- Forgot Password
- Reset Password
- Mailtrap SMTP Sandbox for development email testing
- Email verification is postponed for now and can be enabled later during deployment

### Dashboard

- Monthly expense summary
- Today’s expense summary
- Total transaction count
- Top spending category
- Monthly budget progress
- Top categories breakdown
- Recent expenses overview

### Categories

- Create categories
- Edit categories
- Delete categories
- Category color support
- Search categories
- Sort categories
- Paginated category list
- Responsive mobile card layout
- Desktop table layout

### Expenses

- Create expenses
- Edit expenses
- Delete expenses
- Assign expenses to categories
- Filter expenses by month, year, and category
- Sort expenses
- AJAX pagination
- Responsive mobile card layout
- Desktop table layout

### Budgets

- Create monthly budgets
- View budget history
- Track budget usage
- Budget status indicators
- Paginated budget list
- Responsive layout

### Reports

- Spending summary
- Category-based report breakdown
- Filtered report data
- Expense report list
- Export support
- AJAX pagination

### Settings

- User preference settings
- Theme preference support
- Currency setting
- Dashboard display options
- Reset settings option

### UI / UX

- Responsive design
- Dark mode support
- Reusable Blade UI components
- Custom pagination design
- Toast notifications
- Empty states
- Mobile-friendly pages
- Dashboard widgets
- Consistent validation styling

## Tech Stack

- Laravel 13
- PHP
- Blade
- Tailwind CSS
- Laravel Breeze
- Mailtrap SMTP Sandbox
- Git
- GitHub
- MySQL for local development
- PostgreSQL via Neon for production database
- Render for deployment
- Docker for deployment setup

## Requirements

Make sure these are installed:

- PHP 8.3 or newer
- Composer
- Node.js
- npm
- MySQL
- Git

Optional:

- Docker
- Laravel Herd
- Redis

## Installation

Clone the repository:

```bash
git clone https://github.com/your-username/expense-tracker.git
cd expense-tracker
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Copy the environment file:

For macOS / Linux:

```bash
cp .env.example .env
```

For Windows:

```bash
copy .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

## Environment Configuration

Update your `.env` file.

## Local Development Database

```md
## Deployment Notes

The application is deployed on Render using Docker. Frontend assets are built during deployment, and Laravel migrations are executed automatically when the service starts.

Because production uses PostgreSQL, database queries are written to avoid MySQL-only functions where possible.
```

This project uses MySQL locally through Docker.
The deployed version uses PostgreSQL through Neon.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=expense_tracker
DB_USERNAME=root
DB_PASSWORD=secret

DB_CONNECTION=pgsql
DB_HOST=your-neon-direct-host
DB_PORT=5432
DB_DATABASE=expense_tracker
DB_USERNAME=your-neon-username
DB_PASSWORD=your-neon-password
DB_SSLMODE=require

MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_FROM_ADDRESS="no-reply@expensetracker.test"
MAIL_FROM_NAME="${APP_NAME}"
```

If you are using Laravel Herd, set `APP_URL` to your Herd site URL.

Example:

```env
APP_URL=http://expense-tracker.test
```

If you are using `php artisan serve`, use:

```env
APP_URL=http://127.0.0.1:8000
```

## Database Setup

Create a MySQL database:

```sql
CREATE DATABASE expense_tracker;
```

Then run migrations:

```bash
php artisan migrate
```

## Docker Database Setup

If using Docker for MySQL, your database service can use values like:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=expense_tracker
DB_USERNAME=root
DB_PASSWORD=secret
```

Then start your Docker containers and run:

```bash
php artisan migrate
```

## Running the Project

Start the frontend development server:

```bash
npm run dev
```

Start the Laravel development server:

```bash
php artisan serve
```

Or open your Laravel Herd site directly.

## Building Assets

For production build:

```bash
npm run build
```

## Mailtrap Setup

This project uses Mailtrap SMTP Sandbox for development email testing.

Mailtrap is used for:

- Forgot Password emails
- Reset Password links
- Development mail testing

Mailtrap Sandbox does not send emails to real inboxes. Instead, it captures emails inside the Mailtrap inbox.

Example `.env` configuration:

```env
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_FROM_ADDRESS="no-reply@expensetracker.test"
MAIL_FROM_NAME="${APP_NAME}"
```

After changing mail settings, clear Laravel config:

```bash
php artisan optimize:clear
```

To test the password reset flow:

1. Go to `/forgot-password`
2. Enter a registered email
3. Open Mailtrap inbox
4. Click the reset password link
5. Set a new password
6. Login with the new password

## Email Verification Note

Email verification is currently postponed.

Reason:

- The project currently uses Mailtrap Sandbox for development testing
- Live email sending usually requires a verified sending domain
- Email verification can be enabled later during deployment or production mail setup

Current behavior:

- Users can register and access the app after logging in
- Forgot Password and Reset Password still work through Mailtrap Sandbox

## Useful Commands

Clear cached files:

```bash
php artisan optimize:clear
```

Clear compiled views:

```bash
php artisan view:clear
```

Run migrations:

```bash
php artisan migrate
```

Rollback migrations:

```bash
php artisan migrate:rollback
```

Run frontend development server:

```bash
npm run dev
```

Build frontend assets:

```bash
npm run build
```

Check routes:

```bash
php artisan route:list
```

## Project Structure

```txt
app/
├── Http/
│   ├── Controllers/
│   └── Requests/
├── Models/

database/
├── migrations/

resources/
├── views/
│   ├── auth/
│   ├── budgets/
│   ├── categories/
│   ├── components/
│   │   └── ui/
│   ├── dashboard/
│   ├── expenses/
│   ├── layouts/
│   ├── profile/
│   ├── reports/
│   ├── settings/
│   └── welcome.blade.php

routes/
├── auth.php
└── web.php
```

## Main Modules

### Dashboard Module

Displays the main user overview, including monthly spending, today’s spending, total transactions, top category, budget progress, category breakdown, and recent expenses.

### Category Module

Allows users to manage custom expense categories with colors, search, sorting, pagination, and responsive layouts.

### Expense Module

Allows users to record, update, delete, filter, sort, and paginate expenses. Expenses can be linked to categories.

### Budget Module

Allows users to set monthly budgets and monitor their budget usage.

### Report Module

Provides spending summaries, category breakdowns, filtered expense lists, and export support.

### Settings Module

Allows users to manage app preferences such as theme, currency, dashboard display options, and reset settings.

### Authentication Module

Handles user registration, login, logout, remember me, forgot password, reset password, and Mailtrap-based email testing.

## Screenshots

Screenshots will be added after final UI testing.

Suggested screenshots:

- Welcome page
- Login page
- Dashboard
- Expenses page
- Categories page
- Budgets page
- Reports page
- Settings page
- Dark mode preview
- Mobile responsive preview

## Development Progress

Current status: **Phase 9 — Testing, Optimization, and Final Polish**

Completed phases:

- Phase 1 — Project Setup
- Phase 2 — Categories and Expenses
- Phase 3 — Dashboard
- Phase 4 — Budget Management
- Phase 5 — Reports and Export
- Phase 6 — Search, Filtering, Sorting, and Pagination
- Phase 7 — UI / UX Polish
- Phase 8 — Settings
- Phase 9 — Auth flow polish, dark mode support, pagination polish, and final QA in progress

Pending tasks:

- Final validation message check
- Final empty state check
- Final dark mode scan
- Final mobile responsive scan
- Screenshots
- Deployment preparation
- Portfolio write-up

## Git Commit Style

This project follows a clean commit message style:

```txt
chore: setup/configuration changes
feat: new functionality
refactor: code restructuring
style: UI/UX or visual polish
fix: bug fixes
docs: documentation updates
```

Example:

```bash
git commit -m "docs: add project README"
```

## Security Notes

Do not commit sensitive environment files.

Make sure `.env` is ignored by Git:

```txt
.env
```

Do not commit:

- Database passwords
- Mailtrap credentials
- API keys
- Production secrets

## Portfolio Purpose

This project was built as a Laravel portfolio project to demonstrate:

- Laravel CRUD development
- Authentication flow
- Password reset flow
- Mail testing with SMTP
- Dashboard analytics
- Filtering and pagination
- Responsive UI
- Dark mode implementation
- Reusable Blade components
- Clean project organization
- Git and GitHub workflow

## License

This project is currently intended for portfolio and learning purposes.
