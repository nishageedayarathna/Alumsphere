# AlumSphere - Alumni Management System

## Project Overview

AlumSphere is a web-based Alumni Management System developed as a sample project for the **Management Information Systems (MIS)** subject at the University of Vavuniya.

The system provides a platform for alumni and administrators to manage alumni information and university events. It demonstrates how a Management Information System can improve communication and information management between a university and its past students.

This project is developed for academic purposes and includes the core functionalities required to demonstrate the design and implementation of an Alumni Management System.

---

## Features

### Alumni (Student) Features

- Register using a University of Vavuniya student email address
- Secure login using encrypted passwords
- Upload alumni information through a CSV file
- View personal alumni details
- View available alumni events
- Confirm participation in events
- Cancel event participation

### Administrator Features

- Secure administrator login
- Create and manage alumni events
- View event participation responses
- View registered alumni information

---

## Technologies Used

### Frontend
- HTML
- CSS

### Backend
- PHP

### Database
- MySQL

### Development Tools
- XAMPP
- MySQL Workbench
- Visual Studio Code

---

## Project Structure

```
AlumSphere
│
├── database
│   └── alumsphere.sql
│
├── images
│
├── admin_dashboard.php
├── admin_login.php
├── admin_logout.php
├── dashboard.php
├── home.php
├── signup.php
├── signin.php
├── logout.php
├── upload_csv.php
├── manage_events.php
├── view_events.php
├── view_participants.php
├── view_alumni.php
├── view_my_details.php
├── footer.php
├── db_connect_example.php
│
├── style.css
├── style2.css
├── style3.css
├── style4.css
├── style5.css
├── style6.css
├── styledashboard.css
│
├── README.md
├── LICENSE
└── .gitignore
```

---

## Database Setup

1. Create a MySQL database named:

```
alumni_management
```

2. Import the SQL file located in:

```
database/alumsphere.sql
```


4. Update the database credentials according to your local MySQL configuration.

---

## Running the Project

1. Install XAMPP.
2. Copy the project folder into the **htdocs** directory.
3. Start Apache and MySQL.
4. Import the database.
5. Open your browser and visit:

```
http://localhost/AlumSphere
```

---

## Limitations

This project was developed as a sample academic system for the Management Information Systems (MIS) subject. Therefore, it contains only the essential features required to demonstrate the system design.

Current limitations include:

- Basic user management
- Basic event management
- No email notifications
- No online deployment
- Limited security features
- No analytics dashboard

---

## Future Improvements

Possible enhancements include:

- Email notification system
- Alumni profile editing
- Advanced search and filtering
- Dashboard analytics
- Improved authentication and security
- Online/cloud deployment
- Mobile-friendly responsive interface

---

## Academic Information

**Project Title:** AlumSphere – Alumni Management System

**Subject:** Management Information Systems (MIS)

**Institution:** University of Vavuniya

**Purpose:** Academic sample system design project

---

## License

This project is licensed under the MIT License. See the LICENSE file for more information.
