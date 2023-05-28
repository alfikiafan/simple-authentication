# Simple Authentication System

The Simple Authentication System is a lightweight, framework-independent login, register, and logout system developed with PHP, JavaScript, and CSS. It offers a robust set of features including input validation, session management, profile viewing, profile editing, and password changing. The system utilizes Bootstrap 4 to create an intuitive and visually appealing user interface. Behind the scenes, a collection of classes powers the system, enabling seamless configuration management, efficient cookie handling, secure database operations, reliable password hashing, effective input handling, robust session management, CSRF protection, user management, and thorough input validation. With its comprehensive functionality and clean design, this Simple Authentication System provides a reliable and secure foundation for implementing user authentication in PHP web applications.

## Screenshots  
### Register  
![Register](https://github.com/alfikiafan/simple-authentication/blob/master/images/register.jpg?raw=true)  
### Login  
![Login](https://github.com/alfikiafan/simple-authentication/blob/master/images/login.jpg?raw=true)  
### Profile Page  
![Profile](https://github.com/alfikiafan/simple-authentication/blob/master/images/profile.jpg?raw=true)  

## Usage
To use the authentication system, follow these steps:

1. Make sure you have a local web server capable of running PHP (e.g., XAMPP).
2. Import the database by running the `db.sql` script located in the `database` directory. This will create the necessary tables for the authentication system.
3. Configure the database connection in the `DB.php` file located in the `classes` directory. Update the database credentials to match your local environment.
4. Access the system through your web browser, starting with the `index.php` file (e.g., `http://localhost/auth/index.php`).
5. Use the provided functionality for login, registration, profile management, and changing passwords.

**Note:** It is important to ensure that the necessary dependencies, such as PHP and MySQL, are properly set up on your local system before running the authentication system.

## Credit
This system was created by Alfiki Diastama Afan Firdaus. Image (Aerial Photo of Brown Mountains) by [John Towner](https://unsplash.com/@heytowner)

## License
This system is licensed under the [MIT License](https://choosealicense.com/licenses/mit/).
