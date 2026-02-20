# Django Professional Portfolio

A robust, full-stack responsive portfolio website built with Python & Django.

## 🚀 Features
- **Django Admin**: Powerful, secure built-in admin panel for content management.
- **ORM**: Clean database models for Projects, Blogs, and Experience.
- **Modern UI**: Dark theme with gradient accents and smooth animations (migrated from PHP version).
- **Contact Form**: Direct message storage using Django forms/models.
- **Responsive**: Mobile-friendly design.

## 📂 Project Structure
- `core/`: Main app containing models, views, and templates.
- `portfolio_project/`: Project configuration (settings, URLs).
- `core/static/portfolio`: CSS, JS, and Images.
- `media/`: User-uploaded content (Project/Blog images).

## 🛠️ How to Run
1.  **Dependencies**: Install Django and Pillow:
    ```bash
    python -m pip install django pillow
    ```
2.  **Database**: The project is already migrated. If you make changes, run:
    ```bash
    python manage.py makemigrations
    python manage.py migrate
    ```
3.  **Run Server**:
    ```bash
    python manage.py runserver
    ```
4.  **Access**:
    - Website: `http://127.0.0.1:8000/`
    - Admin: `http://127.0.0.1:8000/admin/`

## 🔑 Admin Credentials
- **Username**: `admin`
- **Email**: `admin@example.com`
- **Password**: `admin123`

## 📦 Migration from PHP
The previous PHP implementation has been moved to the `/legacy_php` folder. All assets have been successfully migrated to Django.
