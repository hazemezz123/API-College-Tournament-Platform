-- ===============================================
-- ALL QUIZ QUESTIONS FOR PROGRAMMING LANGUAGES
-- ===============================================

-- PHP Quiz Questions
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
('Which function outputs data to the browser in PHP?', 'echo', 'print', 'Both echo and print', 'output()', 'Both echo and print', 'PHP');

-- JavaScript Questions
INSERT INTO questions (question, option1, option2, option3, option4, correct_answer, question_type) VALUES
('What is JavaScript?', 'A markup language', 'A programming language', 'A database language', 'A styling language', 'A programming language', 'JavaScript'),
('Which keyword is used to declare variables in JavaScript?', 'var', 'let', 'const', 'All of the above', 'All of the above', 'JavaScript'),
('How do you create a function in JavaScript?', 'function myFunction()', 'function = myFunction()', 'function:myFunction()', 'create myFunction()', 'function myFunction()', 'JavaScript'),
('How do you call a function named "myFunction"?', 'call myFunction()', 'myFunction()', 'call function myFunction()', 'Call.myFunction()', 'myFunction()', 'JavaScript'),
('How can you add a comment in JavaScript?', '//This is a comment', '<!--This is a comment-->', '#This is a comment', '**This is a comment**', '//This is a comment', 'JavaScript'),
('Which event occurs when the user clicks on an HTML element?', 'onmouseover', 'onchange', 'onclick', 'onmouseclick', 'onclick', 'JavaScript'),
('How do you declare a JavaScript array?', 'var colors = ["red", "green", "blue"]', 'var colors = (1:"red", 2:"green", 3:"blue")', 'var colors = "red", "green", "blue"', 'var colors = 1 = ("red"), 2 = ("green"), 3 = ("blue")', 'var colors = ["red", "green", "blue"]', 'JavaScript'),
('How do you round the number 7.25 to the nearest integer in JavaScript?', 'Math.round(7.25)', 'round(7.25)', 'Math.rnd(7.25)', 'rnd(7.25)', 'Math.round(7.25)', 'JavaScript'),
('How do you find the number with the highest value of x and y?', 'Math.max(x, y)', 'top(x, y)', 'ceil(x, y)', 'Math.ceil(x, y)', 'Math.max(x, y)', 'JavaScript'),
('Which operator is used to assign a value to a variable?', '*', '-', '=', 'x', '=', 'JavaScript');

-- HTML Questions
INSERT INTO questions (question, option1, option2, option3, option4, correct_answer, question_type) VALUES
('What does HTML stand for?', 'Hyper Text Markup Language', 'Home Tool Markup Language', 'Hyperlinks and Text Markup Language', 'Hyper Technical Markup Language', 'Hyper Text Markup Language', 'HTML'),
('Which tag is used to define an internal style sheet?', '<script>', '<css>', '<style>', '<link>', '<style>', 'HTML'),
('Which HTML attribute is used to define inline styles?', 'class', 'style', 'font', 'styles', 'style', 'HTML'),
('Which is the correct HTML element for the largest heading?', '<h6>', '<heading>', '<h1>', '<head>', '<h1>', 'HTML'),
('Which character is used to indicate an end tag?', '^', '/', '*', '<', '/', 'HTML'),
('How do you create a hyperlink in HTML?', '<a url="http://example.com">Example</a>', '<a>http://example.com</a>', '<a href="http://example.com">Example</a>', '<link>http://example.com</link>', '<a href="http://example.com">Example</a>', 'HTML'),
('Which HTML tag is used to define an unordered list?', '<ul>', '<ol>', '<list>', '<dl>', '<ul>', 'HTML'),
('Which tag is used to create a line break in HTML?', '<lb>', '<break>', '<br>', '<newline>', '<br>', 'HTML'),
('Which attribute is used to provide additional information about an HTML element?', 'title', 'info', 'data', 'tooltip', 'title', 'HTML'),
('Which element defines the document type and HTML version?', '<head>', '<meta>', '<!DOCTYPE>', '<html>', '<!DOCTYPE>', 'HTML');

-- CSS Questions
INSERT INTO questions (question, option1, option2, option3, option4, correct_answer, question_type) VALUES
('What does CSS stand for?', 'Creative Style Sheets', 'Cascading Style Sheets', 'Computer Style Sheets', 'Colorful Style Sheets', 'Cascading Style Sheets', 'CSS'),
('Which property is used to change the background color?', 'color', 'bgcolor', 'background-color', 'background', 'background-color', 'CSS'),
('How do you add a comment in CSS?', '// This is a comment', '/* This is a comment */', '-- This is a comment --', '<!-- This is a comment -->', '/* This is a comment */', 'CSS'),
('Which CSS property controls the text size?', 'text-size', 'font-size', 'text-style', 'font-style', 'font-size', 'CSS'),
('How do you select an element with id "demo"?', '#demo', '.demo', 'demo', '*demo', '#demo', 'CSS'),
('How do you select elements with class name "test"?', '#test', '.test', 'test', '*test', '.test', 'CSS'),
('How do you make each word in a text start with a capital letter?', 'text-transform: capitalize', 'transform: capitalize', 'text-style: capitalize', 'font-transform: capitalize', 'text-transform: capitalize', 'CSS'),
('Which property is used to change the font of an element?', 'font-style', 'text-style', 'font-family', 'text-family', 'font-family', 'CSS'),
('How do you display a border like this: "Solid red border 1px wide"?', 'border: 1px solid red;', 'border: red 1px solid;', 'border: solid 1px red;', 'All of the above', 'All of the above', 'CSS'),
('Which property is used to change the left margin of an element?', 'margin-left', 'padding-left', 'indent', 'left-margin', 'margin-left', 'CSS');

-- Python Questions
INSERT INTO questions (question, option1, option2, option3, option4, correct_answer, question_type) VALUES
('What is Python?', 'A markup language', 'A programming language', 'A database language', 'A styling language', 'A programming language', 'Python'),
('Which of the following is the correct extension of the Python file?', '.python', '.py', '.p', '.pt', '.py', 'Python'),
('Who developed Python programming language?', 'Wick van Rossum', 'Rasmus Lerdorf', 'Guido van Rossum', 'Niene Stom', 'Guido van Rossum', 'Python'),
('Which type of programming does Python support?', 'Object-oriented programming', 'Structured programming', 'Functional programming', 'All of the above', 'All of the above', 'Python'),
('Is Python case sensitive when dealing with identifiers?', 'No', 'Yes', 'Machine dependent', 'None of the above', 'Yes', 'Python'),
('What is the output of print(2**3**2)?', '64', '512', '8', '36', '512', 'Python'),
('How do you create a list in Python?', 'list = []', 'list = list()', 'list = ()', 'Both A and B', 'Both A and B', 'Python'),
('Which built-in function is used to calculate the length of a sequence in Python?', 'count()', 'size()', 'len()', 'length()', 'len()', 'Python'),
('Which of the following is a valid way to comment multiple lines in Python?', '# This is a comment', '/* This is a comment */', 'Triple double quotes comment', 'Triple single quotes comment', 'Triple double quotes comment', 'Python'),
('What is the output of the following code: print(3 * "abc")?', 'abcabcabc', '3abc', 'abc3', 'Error', 'abcabcabc', 'Python');

-- MySQL Questions
INSERT INTO questions (question, option1, option2, option3, option4, correct_answer, question_type) VALUES
('What is MySQL?', 'A programming language', 'A database management system', 'A web server', 'A design tool', 'A database management system', 'MySQL'),
('Which SQL statement is used to extract data from a database?', 'SELECT', 'EXTRACT', 'GET', 'OPEN', 'SELECT', 'MySQL'),
('Which SQL clause is used to filter the results of a query?', 'FROM', 'WHERE', 'HAVING', 'ORDER BY', 'WHERE', 'MySQL'),
('Which SQL statement is used to update data in a database?', 'SAVE', 'MODIFY', 'UPDATE', 'CHANGE', 'UPDATE', 'MySQL'),
('Which SQL statement is used to delete data from a database?', 'REMOVE', 'DELETE', 'COLLAPSE', 'ERASE', 'DELETE', 'MySQL'),
('Which SQL statement is used to insert new data in a database?', 'ADD', 'INSERT INTO', 'UPDATE', 'INSERT NEW', 'INSERT INTO', 'MySQL'),
('Which of the following is not a valid SQL data type?', 'VARCHAR', 'FLOAT', 'DATE', 'CHARACTER', 'CHARACTER', 'MySQL'),
('How do you create a new database in MySQL?', 'CREATE DATABASE db_name;', 'NEW DATABASE db_name;', 'ADD DATABASE db_name;', 'GENERATE DATABASE db_name;', 'CREATE DATABASE db_name;', 'MySQL'),
('Which MySQL statement is used to create a table?', 'CREATE TABLE', 'BUILD TABLE', 'GENERATE TABLE', 'MAKE TABLE', 'CREATE TABLE', 'MySQL'),
('Which SQL keyword is used to sort the result-set?', 'SORT BY', 'ORDER BY', 'ARRANGE BY', 'ORGANIZE BY', 'ORDER BY', 'MySQL');

-- React.js Quiz Questions (Specific to React, not general JavaScript)
INSERT INTO questions (question, option1, option2, option3, option4, correct_answer, question_type) VALUES 
('What is React.js?', 'A server-side programming language', 'A JavaScript library for building user interfaces', 'A database management system', 'A styling framework like Bootstrap', 'A JavaScript library for building user interfaces', 'ReactJS'),
('Which of the following is used to pass data from parent to child components in React?', 'State', 'Props', 'Context', 'Refs', 'Props', 'ReactJS'),
('What is JSX in React?', 'A JavaScript XML syntax extension', 'A styling library', 'A state management tool', 'A testing framework', 'A JavaScript XML syntax extension', 'ReactJS'),
('Which hook is used to perform side effects in a React functional component?', 'useState', 'useEffect', 'useContext', 'useReducer', 'useEffect', 'ReactJS'),
('What is the purpose of React Fragments?', 'To optimize rendering performance', 'To group multiple elements without adding extra nodes to the DOM', 'To create reusable components', 'To handle form validation', 'To group multiple elements without adding extra nodes to the DOM', 'ReactJS'),
('How do you create a controlled component in React?', 'By using refs to manage the component', 'By using state to manage form input values', 'By using context API', 'By using Redux', 'By using state to manage form input values', 'ReactJS'),
('What is the purpose of the key prop when rendering lists in React?', 'It improves accessibility', 'It helps React identify which items have changed, been added, or removed', 'It adds styling to the list items', 'It determines the order of elements', 'It helps React identify which items have changed, been added, or removed', 'ReactJS'),
('What is React\'s Virtual DOM?', 'A lightweight copy of the actual DOM that React uses for performance optimization', 'An alternative to CSS styling', 'A browser plugin for React development', 'A state management library', 'A lightweight copy of the actual DOM that React uses for performance optimization', 'ReactJS'),
('Which of the following is NOT a lifecycle method in React class components?', 'componentDidMount', 'componentWillUpdate', 'useEffect', 'render', 'useEffect', 'ReactJS'),
('What is the purpose of the useCallback hook in React?', 'To memoize functions to prevent unnecessary re-renders', 'To handle form submissions', 'To create stateful logic', 'To connect to APIs', 'To memoize functions to prevent unnecessary re-renders', 'ReactJS');

-- Ruby Programming Quiz Questions
INSERT INTO questions (question, option1, option2, option3, option4, correct_answer, question_type) VALUES 
('What is Ruby?', 'A markup language', 'A styling framework', 'A dynamic, object-oriented programming language', 'A database system', 'A dynamic, object-oriented programming language', 'Ruby'),
('How do you define a method in Ruby?', 'function method_name() { }', 'def method_name() end', 'method method_name() { }', 'procedure method_name() end', 'def method_name() end', 'Ruby'),
('Which symbol is used for string interpolation in Ruby?', '{{ }}', '{% %}', '${variable}', '#{variable}', '#{variable}', 'Ruby'),
('What does the Ruby method "map" do?', 'Creates a hashmap', 'Returns a new array with the results of running a block for each element', 'Connects to a database', 'Maps memory allocation', 'Returns a new array with the results of running a block for each element', 'Ruby'),
('In Ruby, what is a Symbol?', 'A lightweight immutable string', 'A type of debugging tool', 'A mathematical operator', 'A class instance', 'A lightweight immutable string', 'Ruby'),
('What is the Ruby gem bundler used for?', 'Managing application dependencies', 'Compressing files', 'Creating UI components', 'Testing code', 'Managing application dependencies', 'Ruby'),
('Which of the following is NOT a valid Ruby data type?', 'String', 'Integer', 'HashMap', 'Float', 'HashMap', 'Ruby'),
('How do you comment a single line in Ruby?', '// This is a comment', '/* This is a comment */', '# This is a comment', '-- This is a comment', '# This is a comment', 'Ruby'),
('What does the "attr_accessor" method do in Ruby?', 'Automatically generates getter and setter methods for instance variables', 'Restricts access to a class', 'Creates a database accessor', 'Controls variable scope', 'Automatically generates getter and setter methods for instance variables', 'Ruby'),
('What are Ruby blocks?', 'Code blocks enclosed in curly braces or do-end', 'Memory blocks allocated for Ruby variables', 'Sections of web page elements', 'Database table sections', 'Code blocks enclosed in curly braces or do-end', 'Ruby');

-- Rust Programming Quiz Questions
INSERT INTO questions (question, option1, option2, option3, option4, correct_answer, question_type) VALUES 
('What is Rust?', 'A game engine', 'A systems programming language focused on safety and performance', 'A web development framework', 'A database system', 'A systems programming language focused on safety and performance', 'Rust'),
('What is ownership in Rust?', 'A way to track who created a variable', 'A set of rules that govern how memory is managed', 'A feature for authenticating users', 'A way to restrict access to modules', 'A set of rules that govern how memory is managed', 'Rust'),
('How do you declare an immutable variable in Rust?', 'immut x = 5;', 'const x = 5;', 'let x = 5;', 'var x = 5;', 'let x = 5;', 'Rust'),
('What are Rust\'s "lifetimes"?', 'The duration of a program\'s execution', 'Annotations that tell the compiler how long references should be valid', 'A measure of code quality', 'How long a crate will be maintained', 'Annotations that tell the compiler how long references should be valid', 'Rust'),
('What symbol is used to indicate a reference in Rust?', '*', '&', '@', '#', '&', 'Rust'),
('What is a Rust "trait"?', 'A way to define shared behavior', 'A security feature', 'A type of error handling', 'A memory optimization technique', 'A way to define shared behavior', 'Rust'),
('What does the "Option" enum in Rust represent?', 'Optional parameters in functions', 'A value that might be something or nothing', 'Different compile options', 'Command-line arguments', 'A value that might be something or nothing', 'Rust'),
('What is Cargo in Rust?', 'A data structure for handling concurrent operations', 'Rust\'s package manager and build system', 'A library for network communications', 'A memory allocation system', 'Rust\'s package manager and build system', 'Rust'),
('How is error handling typically done in Rust?', 'Using exceptions and try-catch blocks', 'Using the Result and Option types', 'Using callbacks', 'Using error codes', 'Using the Result and Option types', 'Rust'),
('What is a "crate" in Rust?', 'A module or package of Rust code', 'A data structure for large datasets', 'A compilation error', 'A runtime environment', 'A module or package of Rust code', 'Rust');

-- C# Programming Quiz Questions
INSERT INTO questions (question, option1, option2, option3, option4, correct_answer, question_type) VALUES 
('What is C#?', 'A markup language', 'A database query language', 'A general-purpose, multi-paradigm programming language', 'A scripting language', 'A general-purpose, multi-paradigm programming language', 'CSharp'),
('What is a namespace in C#?', 'A way to organize code and prevent name collisions', 'A special class that cannot be instantiated', 'A memory management technique', 'A type of variable', 'A way to organize code and prevent name collisions', 'CSharp'),
('What does the "using" statement do in C#?', 'Imports namespaces', 'Creates a loop', 'Defines interfaces', 'Creates objects', 'Imports namespaces', 'CSharp'),
('What is the difference between "ref" and "out" parameters in C#?', 'ref requires the variable to be initialized before passing, out does not', 'ref is for passing value types, out is for reference types', 'ref is readonly, out can be modified', 'There is no difference', 'ref requires the variable to be initialized before passing, out does not', 'CSharp'),
('What is an interface in C#?', 'A graphical user interface', 'A contract that classes implement', 'A special class for handling exceptions', 'A type of enum', 'A contract that classes implement', 'CSharp'),
('What are C# events?', 'Methods that run at specific times', 'A way for objects to notify other objects when something happens', 'Exception handlers', 'Compiler directives', 'A way for objects to notify other objects when something happens', 'CSharp'),
('What is LINQ in C#?', 'A database management system', 'A graphical library', 'Language Integrated Query - a feature for querying data', 'A networking protocol', 'Language Integrated Query - a feature for querying data', 'CSharp'),
('What is the purpose of the "virtual" keyword in C#?', 'To create abstract methods', 'To allow methods to be overridden in derived classes', 'To make variables volatile', 'To create static members', 'To allow methods to be overridden in derived classes', 'CSharp'),
('What is a delegate in C#?', 'A special class for database connections', 'A reference type that represents a method with a specific signature', 'A way to handle exceptions', 'A placeholder for user interface elements', 'A reference type that represents a method with a specific signature', 'CSharp'),
('What does the "async/await" pattern do in C#?', 'Creates multi-threaded code', 'Simplifies asynchronous programming by making code look synchronous', 'Handles exceptions automatically', 'Optimizes memory usage', 'Simplifies asynchronous programming by making code look synchronous', 'CSharp'); 