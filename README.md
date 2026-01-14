# User Authentication System (PHP & MySQL)

This project is a **User Authentication Module** developed as part of an **internship technical assessment**.  
It demonstrates secure authentication practices, clean application workflow, and a professional user interface using **PHP, MySQL, HTML, and CSS**.

---

##  Features

- User Registration
- User Login
- Secure Password Hashing
- Strong Password Validation
- Edit User Profile
- Change Password
- Session-based Authentication
- Protected Routes (Dashboard, Profile, Change Password)
- Clean and Professional UI

---

##  Security Implementations

- Passwords are **never stored in plain text**
- Password hashing using PHP `password_hash()`
- Strong password policy:
  - Minimum 8 characters
  - At least one uppercase letter
  - At least one lowercase letter
  - At least one number
  - At least one special character
- Session-based access control
- Unauthorized users cannot access protected pages

---

##  Tech Stack

- **Programming Language:** PHP  
- **Frontend:** HTML, CSS  
- **Database:** MySQL  
- **Server:** XAMPP (Apache & MySQL)  
- **Version Control:** Git & GitHub  

---

##  Project Structure
user_auth_system/
│
├── assets/
│ ├── css/
│ │ └── style.css
│ └── js/
│
├── auth/
│ ├── login.php
│ ├── register.php
│ ├── change_password.php
│ └── logout.php
│
├── config/
│ └── db.php
│
├── profile/
│ └── edit_profile.php
│
├── includes/
│ ├── header.php
│ └── footer.php
│
├── dashboard.php
└── index.php


---

##  How to Run the Project Locally

1. Install **XAMPP**
2. Start **Apache** and **MySQL**
3. Clone this repository:
4. Move the project folder to:
5. Create a MySQL database named:
6. Create the `users` table on phpmyadmin:
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
7. http://localhost/user_auth_system


