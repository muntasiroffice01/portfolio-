# Professional Developer Portfolio Website

A full-stack responsive portfolio website built with Core PHP and MySQL.

## 🚀 Features
- **Modern UI**: Dark theme with gradient accents and smooth animations.
- **Dynamic Content**: Manage projects, blogs, and experience from an admin panel.
- **Contact Form**: Direct message storage in the database.
- **Secure Admin**: Password-protected dashboard with session management.
- **Responsive**: Works perfectly on mobile, tablet, and desktop.

## 📂 Project Structure
- `/admin`: Management dashboard files.
- `/assets`: CSS, JS, and image storage.
- `/includes`: Reusable components (header, footer, functions).
- `config.php`: Database connection settings.
- `database.sql`: MySQL schema and default admin user.

## 🛠️ Local Setup
1. **Database Setup**:
   - Open phpMyAdmin.
   - Create a new database named `portfolio_db`.
   - Import `database.sql` into the database.
2. **Configuration**:
   - Edit `config.php` and update `DB_USER`, `DB_PASS`, and `BASE_URL` as per your environment.
3. **Run**:
   - Place the project in your local server root (e.g., `htdocs` for XAMPP).
   - Access via `http://localhost/muntasir_ashif`.

## 🌐 Deployment on Shared Hosting
1. **Upload Files**: Upload all project files to the `public_html` directory using FTP or File Manager.
2. **Database**:
   - Create a MySQL database in your hosting cPanel.
   - Create a database user and assign them to the database.
   - Import `database.sql` using phpMyAdmin on your hosting.
3. **Update Config**:
   - Edit `config.php` on the server.
   - Change `DB_HOST`, `DB_NAME`, `DB_USER`, and `DB_PASS` to the values provided by your host.
   - Update `BASE_URL` to your domain (e.g., `https://yourdomain.com/`).
4. **Permissions**: Ensure `assets/images/projects` and `assets/images/blog` folders have write permissions (usually 755 or 775).

## 🔑 Admin Login
- **URL**: `yourdomain.com/admin/login.php`
- **Default Email**: `admin@example.com`
- **Default Password**: `admin123`
- *Note: Change your password immediately after login for security.*

## 🔒 Security Measures
- **Prepared Statements**: All SQL queries use PDO prepared statements to prevent SQL injection.
- **Password Hashing**: Admin passwords are stored using `PASSWORD_BCRYPT`.
- **Input Sanitization**: User inputs are sanitized using `htmlspecialchars` and `strip_tags`.
