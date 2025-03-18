-- Database Creation
CREATE DATABASE IF NOT EXISTS students_tournament;
USE students_tournament;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    profile_image VARCHAR(255) DEFAULT 'default.jpg',
    bio TEXT,
    Age INT,
    membership_type ENUM('individual', 'team') DEFAULT 'individual',
    team_id INT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    role ENUM('student', 'admin') DEFAULT 'student'
);

-- Questions Table
CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    option1 VARCHAR(255) NOT NULL,
    option2 VARCHAR(255) NOT NULL,
    option3 VARCHAR(255) NOT NULL,
    option4 VARCHAR(255) NOT NULL,
    correct_answer VARCHAR(255) NOT NULL,
    question_type VARCHAR(50) NOT NULL,
    difficulty_level ENUM('easy', 'medium', 'hard') DEFAULT 'medium',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Quiz Scores Table
CREATE TABLE IF NOT EXISTS quiz_scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    score INT NOT NULL,
    quiz_type VARCHAR(50) NOT NULL,
    quiz_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tournaments Table
CREATE TABLE IF NOT EXISTS tournaments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status ENUM('upcoming', 'active', 'completed') DEFAULT 'upcoming',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tournament Participants Table
CREATE TABLE IF NOT EXISTS tournament_participants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tournament_id INT NOT NULL,
    user_id INT NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tournament_id) REFERENCES tournaments(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Teams Table
CREATE TABLE IF NOT EXISTS teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample Questions Data
INSERT INTO questions (question, option1, option2, option3, option4, correct_answer, question_type) VALUES
('What does PHP stand for?', 'Personal Home Page', 'Hypertext Preprocessor', 'Programming Hypertext Protocol', 'Preprocessed Hypertext Pages', 'Hypertext Preprocessor', 'PHP'),
('Which of the following is used to declare a constant in PHP?', 'const', 'define()', 'Both const and define()', 'constant', 'Both const and define()', 'PHP'),
('Which function is used to open a file in PHP?', 'fopen()', 'file_open()', 'open_file()', 'fileopen()', 'fopen()', 'PHP'),
('What is the correct way to create an array in PHP?', '$array = array();', '$array = [];', 'Both $array = array(); and $array = [];', 'array $array = new array();', 'Both $array = array(); and $array = [];', 'PHP'),
('Which superglobal variable is used to collect form data in PHP?', '$_GET', '$_POST', 'Both $_GET and $_POST', '$_FORM', 'Both $_GET and $_POST', 'PHP'),
('Which function is used to check if a file exists in PHP?', 'file_exists()', 'exists()', 'is_file()', 'check_file()', 'file_exists()', 'PHP'),
('What is the correct way to connect to a MySQL database in PHP using MySQLi?', 'mysqli_connect()', 'mysql_connect()', 'database_connect()', 'db_connect()', 'mysqli_connect()', 'PHP'),
('Which operator is used for string concatenation in PHP?', '+', '.', '&', '|', '.', 'PHP'),
('How do you start a PHP session?', 'session_start()', 'start_session()', 'begin_session()', 'session_begin()', 'session_start()', 'PHP'),
('Which function outputs data to the browser in PHP?', 'echo', 'print', 'Both echo and print', 'output()', 'Both echo and print', 'PHP'),

('What is JavaScript?', 'A markup language', 'A programming language', 'A database language', 'A styling language', 'A programming language', 'JavaScript'),
('Which keyword is used to declare variables in JavaScript?', 'var', 'let', 'const', 'All of the above', 'All of the above', 'JavaScript'),
('How do you create a function in JavaScript?', 'function myFunction()', 'function = myFunction()', 'function:myFunction()', 'create myFunction()', 'function myFunction()', 'JavaScript'),
('How do you call a function named "myFunction"?', 'call myFunction()', 'myFunction()', 'call function myFunction()', 'Call.myFunction()', 'myFunction()', 'JavaScript'),
('How can you add a comment in JavaScript?', '//This is a comment', '<!--This is a comment-->', '#This is a comment', '**This is a comment**', '//This is a comment', 'JavaScript'),
('Which event occurs when the user clicks on an HTML element?', 'onmouseover', 'onchange', 'onclick', 'onmouseclick', 'onclick', 'JavaScript'),
('How do you declare a JavaScript array?', 'var colors = ["red", "green", "blue"]', 'var colors = (1:"red", 2:"green", 3:"blue")', 'var colors = "red", "green", "blue"', 'var colors = 1 = ("red"), 2 = ("green"), 3 = ("blue")', 'var colors = ["red", "green", "blue"]', 'JavaScript'),
('How do you round the number 7.25 to the nearest integer in JavaScript?', 'Math.round(7.25)', 'round(7.25)', 'Math.rnd(7.25)', 'rnd(7.25)', 'Math.round(7.25)', 'JavaScript'),
('How do you find the number with the highest value of x and y?', 'Math.max(x, y)', 'top(x, y)', 'ceil(x, y)', 'Math.ceil(x, y)', 'Math.max(x, y)', 'JavaScript'),
('Which operator is used to assign a value to a variable?', '*', '-', '=', 'x', '=', 'JavaScript'),

('What does HTML stand for?', 'Hyper Text Markup Language', 'Home Tool Markup Language', 'Hyperlinks and Text Markup Language', 'Hyper Technical Markup Language', 'Hyper Text Markup Language', 'HTML'),
('Which tag is used to define an internal style sheet?', '<script>', '<css>', '<style>', '<link>', '<style>', 'HTML'),
('Which HTML attribute is used to define inline styles?', 'class', 'style', 'font', 'styles', 'style', 'HTML'),
('Which is the correct HTML element for the largest heading?', '<h6>', '<heading>', '<h1>', '<head>', '<h1>', 'HTML'),
('Which character is used to indicate an end tag?', '^', '/', '*', '<', '/', 'HTML'),
('How do you create a hyperlink in HTML?', '<a url="http://example.com">Example</a>', '<a>http://example.com</a>', '<a href="http://example.com">Example</a>', '<link>http://example.com</link>', '<a href="http://example.com">Example</a>', 'HTML'),
('Which HTML tag is used to define an unordered list?', '<ul>', '<ol>', '<list>', '<dl>', '<ul>', 'HTML'),
('Which tag is used to create a line break in HTML?', '<lb>', '<break>', '<br>', '<newline>', '<br>', 'HTML'),
('Which attribute is used to provide additional information about an HTML element?', 'title', 'info', 'data', 'tooltip', 'title', 'HTML'),
('Which element defines the document type and HTML version?', '<head>', '<meta>', '<!DOCTYPE>', '<html>', '<!DOCTYPE>', 'HTML'),

('What does CSS stand for?', 'Creative Style Sheets', 'Cascading Style Sheets', 'Computer Style Sheets', 'Colorful Style Sheets', 'Cascading Style Sheets', 'CSS'),
('Which property is used to change the background color?', 'color', 'bgcolor', 'background-color', 'background', 'background-color', 'CSS'),
('How do you add a comment in CSS?', '// This is a comment', '/* This is a comment */', '-- This is a comment --', '<!-- This is a comment -->', '/* This is a comment */', 'CSS'),
('Which CSS property controls the text size?', 'text-size', 'font-size', 'text-style', 'font-style', 'font-size', 'CSS'),
('How do you select an element with id "demo"?', '#demo', '.demo', 'demo', '*demo', '#demo', 'CSS'),
('How do you select elements with class name "test"?', '#test', '.test', 'test', '*test', '.test', 'CSS'),
('How do you make each word in a text start with a capital letter?', 'text-transform: capitalize', 'transform: capitalize', 'text-style: capitalize', 'font-transform: capitalize', 'text-transform: capitalize', 'CSS'),
('Which property is used to change the font of an element?', 'font-style', 'text-style', 'font-family', 'text-family', 'font-family', 'CSS'),
('How do you display a border like this: "Solid red border 1px wide"?', 'border: 1px solid red;', 'border: red 1px solid;', 'border: solid 1px red;', 'All of the above', 'All of the above', 'CSS'),
('Which property is used to change the left margin of an element?', 'margin-left', 'padding-left', 'indent', 'left-margin', 'margin-left', 'CSS'),

-- Python Questions
('What is Python?', 'A markup language', 'A programming language', 'A database language', 'A styling language', 'A programming language', 'Python'),
('Which of the following is the correct extension of the Python file?', '.python', '.py', '.p', '.pt', '.py', 'Python'),
('Who developed Python programming language?', 'Wick van Rossum', 'Rasmus Lerdorf', 'Guido van Rossum', 'Niene Stom', 'Guido van Rossum', 'Python'),
('Which type of programming does Python support?', 'Object-oriented programming', 'Structured programming', 'Functional programming', 'All of the above', 'All of the above', 'Python'),
('Is Python case sensitive when dealing with identifiers?', 'No', 'Yes', 'Machine dependent', 'None of the above', 'Yes', 'Python'),
('What is the output of print(2**3**2)?', '64', '512', '8', '36', '512', 'Python'),
('How do you create a list in Python?', 'list = []', 'list = list()', 'list = ()', 'Both A and B', 'Both A and B', 'Python'),
('Which built-in function is used to calculate the length of a sequence in Python?', 'count()', 'size()', 'len()', 'length()', 'len()', 'Python'),
('Which of the following is a valid way to comment multiple lines in Python?', '# This is a comment', '/* This is a comment */', 'Triple double quotes comment', 'Triple single quotes comment', 'Triple double quotes comment', 'Python'),
('What is the output of the following code: print(3 * "abc")?', 'abcabcabc', '3abc', 'abc3', 'Error', 'abcabcabc', 'Python'),
('How do you open a file in read mode in Python?', 'file = open("file.txt", "r")', 'file = open("file.txt", "read")', 'file = open("file.txt", "rb")', 'file = open_read("file.txt")', 'file = open("file.txt", "r")', 'Python'),
('How do you check the type of a variable in Python?', 'typeof(variable)', 'type(variable)', 'vartype(variable)', 'checktype(variable)', 'type(variable)', 'Python'),
('What is the result of 10 % 3 in Python?', '1', '3', '0', '10/3', '1', 'Python'),
('Which statement is used for implementing a loop in Python?', 'for', 'while', 'loop', 'Both A and B', 'Both A and B', 'Python'),
('How do you install an external package in Python?', 'pip install package_name', 'python install package_name', 'install package_name', 'package install package_name', 'pip install package_name', 'Python'),

-- MySQL Questions
('What is MySQL?', 'A programming language', 'A database management system', 'A web server', 'A design tool', 'A database management system', 'MySQL'),
('Which SQL statement is used to extract data from a database?', 'SELECT', 'EXTRACT', 'GET', 'OPEN', 'SELECT', 'MySQL'),
('Which SQL clause is used to filter the results of a query?', 'FROM', 'WHERE', 'HAVING', 'ORDER BY', 'WHERE', 'MySQL'),
('Which SQL statement is used to update data in a database?', 'SAVE', 'MODIFY', 'UPDATE', 'CHANGE', 'UPDATE', 'MySQL'),
('Which SQL statement is used to delete data from a database?', 'REMOVE', 'DELETE', 'COLLAPSE', 'ERASE', 'DELETE', 'MySQL'),
('Which SQL statement is used to insert new data in a database?', 'ADD', 'INSERT INTO', 'UPDATE', 'INSERT NEW', 'INSERT INTO', 'MySQL'),
('Which of the following is not a valid SQL data type?', 'VARCHAR', 'FLOAT', 'DATE', 'CHARACTER', 'CHARACTER', 'MySQL'),
('How do you create a new database in MySQL?', 'CREATE DATABASE db_name;', 'NEW DATABASE db_name;', 'ADD DATABASE db_name;', 'GENERATE DATABASE db_name;', 'CREATE DATABASE db_name;', 'MySQL'),
('Which MySQL statement is used to create a table?', 'CREATE TABLE', 'BUILD TABLE', 'GENERATE TABLE', 'MAKE TABLE', 'CREATE TABLE', 'MySQL'),
('Which SQL keyword is used to sort the result-set?', 'SORT BY', 'ORDER BY', 'ARRANGE BY', 'ORGANIZE BY', 'ORDER BY', 'MySQL'),
('What is a foreign key in MySQL?', 'A key used to link two tables together', 'A key from a foreign country', 'A key that is unique', 'A key that can only be used outside the table', 'A key used to link two tables together', 'MySQL'),
('Which SQL function is used to count the number of rows in a SQL query?', 'COUNT()', 'SUM()', 'NUMBER()', 'ROWS()', 'COUNT()', 'MySQL'),
('How do you add a column to an existing table in MySQL?', 'ALTER TABLE table_name ADD column_name datatype;', 'MODIFY TABLE table_name ADD column_name datatype;', 'ADD column_name datatype TO table_name;', 'CREATE column_name datatype IN table_name;', 'ALTER TABLE table_name ADD column_name datatype;', 'MySQL'),
('Which join returns all records when there is a match in either left or right table?', 'INNER JOIN', 'LEFT JOIN', 'RIGHT JOIN', 'FULL JOIN', 'FULL JOIN', 'MySQL'),
('What does SQL stand for?', 'Structured Query Language', 'Simple Query Language', 'Standard Query Language', 'Sequential Query Language', 'Structured Query Language', 'MySQL');

-- Sample Tournament Data
INSERT INTO tournaments (name, description, start_date, end_date, status) VALUES
('Web Development Challenge', 'A tournament focused on testing web development skills including HTML, CSS, JavaScript, and PHP.', '2024-11-15', '2024-11-30', 'upcoming'),
('Programming Olympiad', 'Test your programming knowledge in various languages and win exciting prizes!', '2024-12-05', '2024-12-20', 'upcoming'); 