# SIPASMA — Sistem Penjaringan Aspirasi Mahasiswa

> A web-based platform for collecting and managing student aspirations at FTI UKSW, built as an undergraduate thesis project.

---

## About

SIPASMA replaces fragmented communication channels (chat groups, direct messages, etc.) with a centralized, organized, and transparent platform. Students can submit aspirations, track their progress anonymously, and the advocacy commission team can manage, assign, and respond to each one through a role-based dashboard.

Research derived from this project has been accepted for publication and is scheduled for release in **June 2027**.

---

## Features

- **Aspiration Submission Form** — validates major code (FTI UKSW program codes) and active enrollment status before allowing submission.
- **Daily Submission Limit** — prevents spam by limiting one submission per NIM/IP per day.
- **Anonymous Aspiration Tracking** — students can track their aspiration status using a unique 9-character tracking code, no login required.
- **Role-Based Access Control (RBAC)** — separate access levels for Chairperson (`Ketua`), Secretary (`Sekretaris`), and Staff (`Fungsionaris`).
- **Aspiration Management Dashboard** — assign person-in-charge (PJ), update status, and provide official responses.
- **Statistical Data Visualization** — pie chart by category and line graph of monthly submissions for data-driven decision-making.
- **FAQ Page** — frequently asked questions grouped by category.
- **Organizational Structure Page** — displays the advocacy commission team.

---

## Tech Stack

| Layer      | Technology                                                                                                                                                                                                                      |
|------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Backend    | ![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white) ![Laravel](https://img.shields.io/badge/Laravel-B71C1C?style=flat&logo=laravel&logoColor=white)                                             |
| Frontend   | ![Blade](https://img.shields.io/badge/Blade-B71C1C?style=flat&logo=laravel&logoColor=white) ![CSS](https://img.shields.io/badge/CSS-1572B6?style=flat&logo=css&logoColor=white) ![jQuery](https://img.shields.io/badge/jQuery-0769AD?style=flat&logo=jquery&logoColor=white) |
| Database   | ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)                                                                                                                                       |

---

## Prerequisites

- PHP >= 8.2
- Composer
- MySQL

---

## Installation

**1. Clone the repository**
```bash
git clone https://github.com/ALVILO-6/SIPASMA.git
cd SIPASMA
```

**2. Install PHP dependencies**
```bash
composer install
```

**3. Configure environment**
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your database connection:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sipasma
DB_USERNAME=root
DB_PASSWORD=your_password
```

**4. Run migrations and seeders**
```bash
php artisan migrate --seed
```

**5. Start the development server**
```bash
php artisan serve
```

App will be available at `http://127.0.0.1:8000`.

---

## Project Architecture

```
sipasma/
├── app/
│   └── Http/
│       ├── Controllers/
│       │   ├── AdminController.php         # Dashboard, aspiration management, charts
│       │   ├── AdvoController.php          # Public pages, form, tracking, FAQ, structure
│       │   └── AuthController.php          # Login, logout, NIM validation, password reset
│       └── Middleware/
│           ├── AdvoMiddleware.php          # Role-based access control (RBAC)
│           └── AdvoCheckSession.php        # Session validation guard
│
├── bootstrap/
│   └── app.php                             # Middleware registration
│
├── database/
│   ├── migrations/
│   │   ├── advo_aspirasi.php               # Aspirations table
│   │   ├── advo_kategori.php               # Aspiration categories table
│   │   ├── advo_status.php                 # Status codes table
│   │   ├── advo_struktur.php               # Commission members table
│   │   ├── advo_faq.php                    # FAQ entries table
│   │   └── reset_password.php              # Password reset tokens table
│   └── seeders/
│       ├── RunSeeder.php                   # Master seeder entry point
│       └── advo_seeders/
│           ├── AdvoAspirasiSeeder.php
│           ├── AdvoKategoriSeeder.php
│           ├── AdvoStatusSeeder.php
│           ├── AdvoStrukturSeeder.php
│           └── AdvoFAQSeeder.php
│
├── public/                                 # Static assets & image storage
│   ├── anggota/                            # Commission member photos
│   │   └── Anggota1-9.png
│   └── icons/                             # UI icons for all pages
│
├── resources/
│   └── views/
│       ├── Advokasi.blade.php              # Landing/home page
│       ├── Form.blade.php                  # Aspiration submission form
│       ├── Struktur.blade.php              # Commission organizational structure
│       ├── FAQ.blade.php                   # FAQ page
│       ├── Dashboard.blade.php             # Admin management dashboard
│       ├── Done.blade.php                  # Completed aspirations list
│       └── Login.blade.php                 # Login page
│
└── routes/
    └── web.php                             # All routes: public, auth, admin (GET & POST)
```

---

## Database Structure

| Table            | Description                                      |
|------------------|--------------------------------------------------|
| `advo_aspirasi`  | Submitted aspirations with tracking code & status|
| `advo_kategori`  | Aspiration categories                            |
| `advo_status`    | Status codes (e.g., pending, in-progress, done)  |
| `advo_struktur`  | Advocacy commission members (RBAC users)         |
| `advo_faq`       | FAQ entries grouped by category                  |
| `reset_password` | Temporary storage for password reset             |

---

## NIM Validation Rules

The aspiration form validates student NIM (ID number) against the following rules:
- Must be exactly 9 digits
- First 2 digits must match a registered FTI UKSW program code
- Enrollment year (digits 3–6) must fall within an active 7-year study window
- Last 3 digits must not be `000`

Supported program codes: `56` (D3 TI), `60` (S1 Humas), `67` (S1 TI), `68` (S1 SI), `69` (S1 DKV), `71` (S1 PTIK), `74` (S1 PSI), `84` (S1 BD).

---

Any suggestions and feedbacks are welcome. Feel free to share your thoughts to help improve this project. Thanks for checking out!