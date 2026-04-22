# SiSidang — Copilot Instructions

## Project
SiSidang is a thesis defense management system for ITPLN university.
Manage: schedules, examiners, grading, digital signatures, PDF/DOCX generation.

## Tech Stack
- Laravel 11, PHP 8.2
- Blade Templates + Alpine.js v3
- Livewire 3 for reactive components
- Tailwind CSS v3 (utility classes only, NO custom CSS)
- MySQL 8 with Eloquent ORM
- Spatie Laravel Permission (roles: admin, kaprodi, dosen, mahasiswa, staff_ften)
- barryvdh/laravel-dompdf for PDF
- phpoffice/phpword for DOCX
- phpoffice/phpspreadsheet for Excel import/export
- Laravel Reverb for WebSocket

## Coding Rules
- Always use FormRequest classes for validation (never validate in controller)
- Use SoftDeletes on all models except Notification
- Use Eloquent relationships, never raw SQL queries
- Indonesian comments for complex business logic
- PSR-12 code style
- Always add role-based middleware to routes
- Use route() helper for all URLs in Blade
- Alpine.js for client-side interactivity (modals, toggles, dropdowns)
- Always handle exceptions with try-catch in controllers

## Database Conventions
- Table names: snake_case plural
- FK columns: {table_singular}_id
- All tables have: id, timestamps, deleted_at (SoftDeletes)
- Use bigIncrements for primary keys

## View Structure
- layouts/app.blade.php → main layout with sidebar
- {role}/{module}/index.blade.php → list views
- {role}/{module}/form.blade.php → create/edit forms
- components/{name}.blade.php → reusable Blade components
