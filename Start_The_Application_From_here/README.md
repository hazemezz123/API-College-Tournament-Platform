# Student Tournament Platform

A comprehensive web platform for hosting and participating in programming quizzes and tournaments. This application allows students to test their knowledge in various programming languages and technologies like PHP, JavaScript, HTML, and CSS.

## Features

- **User Authentication System**
  - Secure registration and login
  - User profiles with customizable information
  - Password hashing for security
- **Interactive Quizzes**

  - Multiple-choice questions for different programming languages
  - Immediate feedback on quiz completion
  - Score tracking and history
  - Various difficulty levels

- **Tournament System**

  - Upcoming and active tournaments
  - Registration for tournaments
  - Leaderboard to display top performers
  - Tournament details and schedules

- **Profile Management**

  - Update personal information
  - View quiz history and performance
  - Track tournament participation

- **Responsive Design**
  - Mobile-friendly interface
  - Dark mode for comfortable viewing

## Technology Stack

- **Frontend**
  - HTML5
  - CSS3 with Tailwind CSS framework
  - JavaScript
- **Backend**
  - PHP
  - MySQL Database
- **Development Tools**
  - Node.js (for Tailwind CSS)
  - NPM for package management

## Setup Instructions

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Node.js and NPM
- Web server (Apache/Nginx)

### Installation Steps

1. **Clone the repository**

   ```
   git clone <repository-url>
   cd Tournament_Students/Code
   ```

2. **Install NPM dependencies**

   ```
   npm install
   ```

3. **Build the CSS files**

   ```
   npm run build
   ```

4. **Set up the database**

   - Create a MySQL database named `students_tournament`
   - Import the database structure from `database_setup.sql`

   ```
   mysql -u username -p students_tournament < database_setup.sql
   ```

5. **Configure the application**

   - Update database credentials in `includes/config.php` if necessary
   - Set the appropriate `APP_URL` in `includes/config.php`

6. **Set up your web server**

   - Configure your web server to point to the project's directory
   - Ensure the server has permission to write to the `assets/uploads/` directory

7. **Access the application**
   - Navigate to the configured URL in your web browser
   - Default admin login (if using the provided database dump):
     - Username: admin
     - Password: admin123

## Project Structure

```
Tournament_Students/Code/
├── assets/               # Static assets (images, etc.)
├── includes/             # PHP includes and helper files
│   ├── config.php        # Configuration file
│   └── Test.php          # Test utilities
├── public/               # Publicly accessible files
│   ├── handlers/         # Backend request handlers
│   ├── layouts/          # Common layout components
│   ├── build.css         # Compiled CSS file
│   └── *.php             # PHP pages
├── src/                  # Source files
│   └── styles.css        # Tailwind source CSS
├── database_setup.sql    # Database initialization script
├── package.json          # NPM dependencies
├── postcss.config.js     # PostCSS configuration
└── tailwind.config.js    # Tailwind CSS configuration
```

## Quiz Questions

The platform includes a variety of quiz questions on the following topics:

1. **PHP**

   - Syntax and basic concepts
   - Functions and variables
   - File handling
   - Database operations

2. **JavaScript**

   - Core concepts
   - DOM manipulation
   - Functions and objects
   - Events and operators

3. **HTML**

   - Tags and attributes
   - Document structure
   - Forms and inputs
   - Semantic HTML

4. **CSS**
   - Selectors and properties
   - Styling techniques
   - Layout models
   - Responsive design

## Development

To continue development on this project:

1. **Run the Tailwind CSS watcher**

   ```
   npm run build
   ```

2. **Add new questions**

   - Insert new questions into the `questions` table following the existing structure

3. **Create new tournaments**
   - Add new tournaments through the database or admin interface

## License

This project is licensed under the ISC License. See the LICENSE file for details.
