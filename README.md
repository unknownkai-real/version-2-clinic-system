# Clinic Monitoring System (PHP MVC)

## Folder Structure

```
version-2-clinic-system/
├── app/
│   ├── config/
│   ├── controllers/
│   ├── core/
│   ├── models/
│   └── views/
├── database/
│   └── schema.sql
├── public/
│   ├── .htaccess
│   ├── index.php
│   ├── assets.css
│   └── assets.js
└── README.md
```

## Setup (XAMPP)
1. Copy project folder to `htdocs`.
2. Import `database/schema.sql` in phpMyAdmin.
3. Configure DB credentials in `app/config/config.php`.
4. Open: `http://localhost/version-2-clinic-system/public/index.php?route=login`
5. Login with:
   - Username: `admin`
   - Password: `admin123`

## Implemented Modules
- Authentication with password hashing + sessions
- Student health records (CRUD + modal history)
- Employee health records (CRUD + tab-like modal details)
- Inventory system + damaged/expiration tracking
- Clinic visits with private notes modal
- Doctor consultations + confidential notes modal
- Borrowing of equipment logs
- First aid records with diagnosis shown in modal only
- Flash messages, search bars, record highlighting

