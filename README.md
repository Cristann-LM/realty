# Realty Property Listing Platform

A modern real estate web application built with Laravel, Inertia.js, and Vue 3.

## Features

- Property listing and search with filters (location, price, type)
- Admin dashboard for managing properties, images, and content
- Image upload with preview and primary image selection
- Contact form with email notifications to admin
- Responsive design with modern UI components

## Tech Stack

- **Backend:** Laravel
- **Frontend:** Vue 3 + Inertia.js
- **Styling:** Tailwind CSS
- **Notifications:** Laravel Notifications (Mail)
- **File Uploads:** Laravel Storage

## Getting Started

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js & npm

### Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/your-username/your-repo.git
   cd your-repo
   ```

2. **Install PHP dependencies:**
   ```sh
   composer install
   ```

3. **Install JS dependencies:**
   ```sh
   npm install
   ```

4. **Copy `.env` and set up your environment:**
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your database and mail settings in `.env`.**

6. **Run migrations:**
   ```sh
   php artisan migrate
   ```

7. **Build frontend assets:**
   ```sh
   npm run build
   ```

8. **Start the development servers:**
   ```sh
   php artisan serve
   npm run dev
   ```

## Usage

- Visit the homepage to browse and filter properties.
- Admins can log in to manage properties, images, and content.
- Users can send inquiries via the contact form; admins receive email notifications.

## File Structure

- `app/` - Laravel backend (controllers, models, notifications)
- `resources/js/` - Vue 3 components and pages
- `routes/` - Laravel route definitions
- `public/` - Public assets and entry points

## Customization

- Update hero images and content in the admin dashboard.
- Configure property types and locations in the database or via admin.

## License

MIT

---

**For more details, see the code and comments in each file.**
