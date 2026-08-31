# Clinic Management System

A multi-tenant clinic management platform built on Laravel and React (Inertia). Each clinic operates as an isolated **team** (tenant) with its own members, roles, and permissions, sitting on top of a secure authentication foundation with passkeys and two-factor authentication.

> **Status:** early development. The authentication, team/tenant, and account-security foundation is in place; clinic-specific modules (patients, appointments, billing, tenant provisioning, subscriptions) are being built out next — see [Roadmap](#roadmap).

## Tech Stack

| Layer      | Technology                                                                 |
| ---------- | --------------------------------------------------------------------------- |
| Backend    | Laravel 13 (PHP 8.3+), Laravel Fortify (auth), Laravel Wayfinder            |
| Frontend   | React 19, Inertia.js v3, TypeScript, Vite                                   |
| Styling    | Tailwind CSS v4, Radix UI primitives, `class-variance-authority`            |
| Database   | SQLite by default (any Laravel-supported database works)                   |
| Auth       | Fortify, WebAuthn passkeys, TOTP two-factor authentication                  |
| Tooling    | Pint (PHP formatting), Larastan/PHPStan (static analysis), ESLint, Prettier |

## Features

**Available today**

- Email/password authentication with email verification and password reset (Fortify)
- Two-factor authentication (TOTP) and passkey (WebAuthn) sign-in
- Multi-tenant teams: create teams, invite members, assign roles/permissions, switch active team
- Role-based access control via `TeamRole` / `TeamPermission` enums and policies
- User profile and account security settings
- Light/dark appearance switching

## Roadmap

The `screens/` and `new_screen_set/` directories contain UI design packages for upcoming modules, including:

- Tenant lifecycle management — registration, approval, provisioning, activation, suspension, archiving, and decommissioning workflows
- Subscription & plan management — plan catalog, entitlements, plan assignment
- Extended session and role/permission management screens
- Integration & interoperability module

These represent design work staged ahead of implementation and are not yet wired into the application.

## Requirements

- PHP 8.3+
- Composer
- Node.js 20+ and npm (or pnpm — a `pnpm-workspace.yaml` is present)
- A database supported by Laravel (SQLite is configured by default)

## Getting Started

Clone the repository, then install dependencies:

```bash
composer install
npm install
```

Copy the environment file and generate an application key:

```bash
cp .env.example .env
php artisan key:generate
```

By default the app uses SQLite. Create the database file and run migrations:

```bash
touch database/database.sqlite
php artisan migrate
```

Alternatively, run the full setup script (install, env, key, migrate, build) with:

```bash
composer run setup
```

### Running the app

Start the backend server, queue worker, and Vite dev server together:

```bash
composer run dev
```

Or run each piece individually:

```bash
php artisan serve
php artisan queue:listen --tries=1 --timeout=0
npm run dev
```

The app will be available at `http://localhost:8000`.

## Testing & Code Quality

```bash
# Run the full test suite
php artisan test --compact

# PHP static analysis
composer run types:check

# PHP formatting (fixes in place)
composer run lint

# Full CI-style check (lint, format, types, tests)
composer run ci:check
```

Frontend checks:

```bash
npm run lint          # ESLint (fixes in place)
npm run format        # Prettier (fixes in place)
npm run types:check   # TypeScript
```

## Project Structure

```
app/
  Actions/          Fortify and team actions (registration, password reset, team creation)
  Enums/            TeamRole, TeamPermission
  Http/Controllers/ Dashboard, settings, and team controllers
  Models/           User, Team, Membership, TeamInvitation
  Policies/         Authorization policies (e.g. TeamPolicy)
resources/js/
  pages/            Inertia page components (auth, dashboard, settings, teams)
routes/             web.php, settings.php, console.php
database/migrations/
```

## License

This project is proprietary and not licensed for public use unless stated otherwise by the project owner.
