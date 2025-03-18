# API College Tournament Platform

A web-based tournament scoring system that allows students to participate in programming competitions either individually or as teams. The platform features quiz-based competitions, real-time scoring, and comprehensive performance tracking.

## 🌟 Features

### User Management

- Individual and team-based registration
- Secure authentication system
- Customizable user profiles
- Team type selection (Alpha, Beta, Gamma, Delta)

### Tournament System

- Multiple quiz types covering different programming languages
- Individual and team participation modes
- Real-time score tracking
- Comprehensive leaderboard system

### Performance Tracking

- Individual and team statistics
- Quiz history
- Average scores
- Total points calculation

### User Interface

- Modern, responsive design
- Dark theme
- Mobile-friendly layout
- Interactive elements and animations

## 🛠️ Technologies Used

- **Frontend**:

  - HTML5
  - CSS3 (Tailwind CSS)
  - JavaScript
  - Font Awesome icons

- **Backend**:

  - PHP 8.2+
  - MySQL Database

- **Development Tools**:
  - XAMPP/PHP Development Server
  - MySQL Workbench/phpMyAdmin

## 📋 Requirements

- PHP 8.2 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx) or PHP's built-in server
- Modern web browser

## 🚀 Installation

1. **Clone the Repository**

   ```bash
   git clone [repository-url]
   cd tournament-platform
   ```

2. **Database Setup**

   - Create a new MySQL database
   - Import the database schema from `database/database_setup.sql`
   - Configure database credentials in `includes/credentials.php`:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'your_username');
     define('DB_PASSWORD', 'your_password');
     define('DB_NAME', 'tournament_db');
     ```

3. **Configure Application**

   - Update `includes/config.php` with your application settings
   - Ensure proper file permissions
   - Configure your web server or use PHP's built-in server

4. **Start the Application**
   ```bash
   cd public
   php -S localhost:8000
   ```

## 🎮 Usage

1. **User Registration**

   - Navigate to the signup page
   - Choose between individual or team participation
   - Select team type (if applicable)
   - Complete registration form

2. **Participating in Tournaments**

   - Log in to your account
   - Browse available quizzes
   - Participate in competitions
   - View your scores on the leaderboard

3. **Viewing Progress**
   - Check personal/team statistics
   - View quiz history
   - Track ranking on leaderboard
   - Monitor team performance

## 👥 User Roles

1. **Individual Participants**

   - Take quizzes independently
   - Track personal progress
   - Compete for individual rankings

2. **Team Members**
   - Participate in team events
   - Contribute to team score
   - View team statistics

## 📊 Scoring System

- Individual quiz scores
- Cumulative point system
- Average score calculation
- Team performance metrics

## 🔒 Security Features

- Password hashing
- Input validation
- SQL injection prevention
- XSS protection
- Session management

## 🛠️ Development

### File Structure

```
/
├── includes/
│   ├── config.php
│   └── credentials.php
├── public/
│   ├── handlers/
│   ├── layouts/
│   ├── assets/
│   ├── index.php
│   ├── signup.php
│   └── ...
└── database/
    └── database_setup.sql
```

### Key Components

- Authentication system
- Quiz management
- Score tracking
- User profiles
- Team management
- Leaderboard system

## 🔄 Updates and Maintenance

1. **Database Updates**

   ```bash
   php public/db_update.php
   ```

2. **Regular Maintenance**
   - Check error logs
   - Update dependencies
   - Backup database
   - Monitor performance

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## 📝 License

This project is part of the API College curriculum and is intended for educational purposes.

## 👥 Team

- Development Team: API College Students
- Project Supervisor: Course Instructors
- Contact: [Your Contact Information]

## 🆘 Support

For support and queries:

1. Check documentation
2. Contact system administrator
3. Submit issue tickets
4. Consult with instructors

---

_Last Updated: March 2024_
