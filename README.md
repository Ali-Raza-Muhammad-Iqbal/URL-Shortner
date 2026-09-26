# 🔗 URL-Shortify

**URL-Shortify** is a web-based URL shortening application that converts long and lengthy URLs into short, concise, and easy-to-share links.

The application is built using **HTML, CSS, JavaScript, Bootstrap, PHP 8.0, MySQL, and XAMPP Server**. It provides separate modules for **Users** and **Administrators**, allowing registered users to create and manage shortened URLs while administrators can manage users, links, and other system-level operations.

---

## 📌 Overview

Sharing long URLs can be inconvenient, especially when links contain lengthy query parameters or complex paths. URL-Shortify provides a simple solution by generating a short URL against the original long URL.

### How it works

1. A user creates an account and logs into the system.
2. The user submits a long URL.
3. The application processes the URL and generates a unique short identifier.
4. The original URL and generated short identifier are stored in the **MySQL database**.
5. A short URL is provided to the user.
6. When someone accesses the short URL, the application retrieves the corresponding original URL from the database.
7. The user is redirected to the original destination.

The application uses **Base64 encoding** as part of its URL-shortening mechanism.

---

## 🚀 Key Features

### 👤 User Module

* User registration and account creation
* User login/logout
* Secure user authentication
* Generate shortened URLs
* Store generated URLs in the database
* View previously generated links
* Manage user-generated links
* Redirect from short URL to original URL
* User-specific URL management

### 🛡️ Admin Module

The administrator has system-level access to manage the application.

* Admin authentication
* Dashboard
* Manage registered users
* View user information
* Manage shortened URLs
* View generated links
* Delete or manage inappropriate links
* Monitor system activities
* Perform other administrative operations

### 🔗 URL Shortening

* Converts lengthy URLs into concise links
* Uses Base64-based encoding
* Stores URL mappings in MySQL
* Generates short identifiers
* Retrieves original URLs dynamically
* Redirects users to the original destination

---

## 🛠️ Technology Stack

| Technology     | Purpose                                 |
| -------------- | --------------------------------------- |
| **HTML5**      | Application structure                   |
| **CSS3**       | Custom styling                          |
| **JavaScript** | Client-side functionality               |
| **Bootstrap**  | Responsive UI and components            |
| **PHP 8.0**    | Backend/server-side development         |
| **MySQL**      | Database management                     |
| **XAMPP**      | Local Apache & MySQL development server |

---

## 🏗️ System Architecture

The application follows a simple client-server architecture:

```text
                    ┌─────────────────────┐
                    │       Client        │
                    │  Browser / User UI  │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │     PHP Backend     │
                    │   Business Logic    │
                    └──────────┬──────────┘
                               │
                     ┌─────────┴─────────┐
                     ▼                   ▼
              ┌─────────────┐     ┌─────────────┐
              │    MySQL    │     │     API     │
              │  Database   │     │ URL Mapping │
              └─────────────┘     └─────────────┘
```

---

## 🔄 URL Shortening Workflow

```text
Long URL
   │
   ▼
User submits URL
   │
   ▼
PHP Backend
   │
   ▼
Base64 Processing
   │
   ▼
Short Identifier Generated
   │
   ▼
URL Mapping Stored in MySQL
   │
   ▼
Short URL Generated
   │
   ▼
User Shares Short URL
   │
   ▼
Short URL Accessed
   │
   ▼
Backend/API Lookup
   │
   ▼
Original URL Retrieved
   │
   ▼
HTTP Redirect
   │
   ▼
Original Website
```

---

## 🗄️ Database Concept

The application uses **MySQL** to maintain URL mappings and user information.

A URL mapping conceptually contains:

| Field          | Description                  |
| -------------- | ---------------------------- |
| `id`           | Unique record identifier     |
| `user_id`      | User associated with the URL |
| `original_url` | Original lengthy URL         |
| `short_code`   | Generated short identifier   |
| `created_at`   | URL creation timestamp       |

The user module and administrative module can use additional tables for authentication, user management, and system administration.

---

## 🔌 URL Redirection

When a user opens a shortened URL, the application identifies the associated short code and queries the database.

Example:

```text
Original URL:
https://example.com/products/category/item?id=12345

        ↓

URL-Shortify

        ↓

Short URL:
http://localhost/URL-Shortify/abc123

        ↓

Database Lookup

        ↓

Original URL Retrieved

        ↓

Redirect to:
https://example.com/products/category/item?id=12345
```

---

## 💻 Installation & Setup

### Prerequisites

Make sure the following are installed:

* XAMPP
* PHP 8.0+
* MySQL
* Web Browser
* Git

---

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/URL-Shortify.git
```

Move into the project directory:

```bash
cd URL-Shortify
```

---

### 2. Move Project to XAMPP

Copy the project folder into:

```text
C:\xampp\htdocs\
```

The final structure should look similar to:

```text
C:\xampp\htdocs\URL-Shortify\
```

---

### 3. Start XAMPP

Open **XAMPP Control Panel** and start:

```text
Apache
MySQL
```

---

### 4. Create the Database

Open:

```text
http://localhost/phpmyadmin
```

Create a new database for the project.

For example:

```text
url_shortify
```

Import the project's SQL/database file if one is provided.

---

### 5. Configure Database Connection

Locate the project's database configuration file and update the MySQL credentials.

Example:

```php
$host = "localhost";
$username = "root";
$password = "";
$database = "url_shortify";
```

Update the values according to your local MySQL configuration.

---

### 6. Run the Application

Open your browser and navigate to:

```text
http://localhost/URL-Shortify/
```

The application should now be available locally.

---

## 👥 Application Modules

### User

```text
Registration
     ↓
Login
     ↓
User Dashboard
     ↓
Generate Short URL
     ↓
View / Manage Links
```

### Administrator

```text
Admin Login
     ↓
Admin Dashboard
     ↓
Manage Users
     ↓
Manage URLs
     ↓
System Administration
```

---

## 🔐 Security Considerations

For a production deployment, the following security practices should be implemented or strengthened:

* Password hashing using `password_hash()`
* Password verification using `password_verify()`
* Prepared SQL statements / PDO or MySQLi
* Input validation and sanitization
* Protection against SQL Injection
* Protection against XSS
* CSRF protection
* Session security
* Admin authorization and access control
* URL validation
* Rate limiting for URL generation
* Secure error handling

> **Note:** Base64 is an encoding mechanism, not encryption. It should not be considered a security mechanism for protecting sensitive information.

---

## 📱 Responsive Design

The frontend uses **Bootstrap** to provide a responsive interface that can work across:

* 💻 Desktop
* 💼 Laptop
* 📱 Mobile
* 📟 Tablet

---

## 🔮 Future Enhancements

Potential future improvements include:

* Custom short URLs
* URL expiration
* QR code generation
* Click/visit analytics
* Geographic analytics
* Browser/device statistics
* Link activation/deactivation
* User profile management
* Advanced admin dashboard
* Search and filtering
* API authentication
* REST API for third-party applications
* Rate limiting
* Improved URL validation
* Docker deployment
* Production hosting support

---

## 📊 Project Goals

The primary goals of URL-Shortify are to:

* Provide a simple URL-shortening solution
* Demonstrate PHP backend development
* Implement MySQL database integration
* Provide user authentication and authorization
* Implement administrative controls
* Practice API-based URL redirection
* Build a responsive web application using Bootstrap

---

## 🤝 Contributing

Contributions are welcome.

To contribute:

1. Fork the repository.
2. Create a new branch.

```bash
git checkout -b feature/new-feature
```

3. Make your changes.
4. Commit your changes.

```bash
git commit -m "Add new feature"
```

5. Push the branch.

```bash
git push origin feature/new-feature
```

6. Open a Pull Request.

---

## 📄 License

This project is available for educational and development purposes.

If you intend to use or distribute this project commercially, please review and define an appropriate open-source license for the repository.

---

## 👨‍💻 Author

**ALI RAZA**

GitHub: `https://github.com/Ali-Raza-Muhammad-Iqbal`

---

## ⭐ Support

If you find **URL-Shortify** useful, consider giving the repository a ⭐ on GitHub.

---

### 📌 Project Summary

**URL-Shortify** is a PHP and MySQL-based URL shortening platform that provides registered users with the ability to generate short URLs from lengthy web addresses. The system stores URL mappings in MySQL and dynamically redirects users from the generated short URL to the original destination. It also provides an administrative module for managing users, links, and other system-level operations.
