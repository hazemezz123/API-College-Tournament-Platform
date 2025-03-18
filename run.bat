@echo off
title Student Tournament Platform Setup

echo =================================================
echo       Student Tournament Platform Setup           
echo =================================================

REM Check if npm is installed
where npm >nul 2>nul
if %errorlevel% neq 0 (
    echo Error: npm is not installed.
    echo Please install Node.js and npm first:
    echo https://nodejs.org/en/download/
    goto :exit
)

REM Check if PHP is installed
where php >nul 2>nul
if %errorlevel% neq 0 (
    echo Error: PHP is not installed.
    echo Please install PHP first:
    echo https://www.php.net/downloads
    goto :exit
)

REM Check if MySQL is installed
where mysql >nul 2>nul
if %errorlevel% neq 0 (
    echo Warning: MySQL might not be installed or not in PATH.
    echo You'll need MySQL to run the application properly.
    echo https://dev.mysql.com/downloads/
)

echo All prerequisites satisfied. Setting up project...

REM Install npm dependencies
echo Installing npm dependencies...
call npm install

REM Build CSS files
echo Building CSS files...
call npm run build:prod

REM Setup database prompt
set /p setup_db="Do you want to set up the database now? (y/n): "

if /i "%setup_db%"=="y" (
    echo Setting up the Student Tournament Database...

    REM Get MySQL credentials from user
    set /p DB_USER="Enter MySQL username (default: root): "
    if "%DB_USER%"=="" set DB_USER=root
    
    set /p DB_PASS="Enter MySQL password (default: empty): "
    
    set DB_HOST=localhost
    set DB_NAME=students_tournament
    
    echo.
    echo Database configuration:
    echo Host: %DB_HOST%
    echo User: %DB_USER%
    echo Database: %DB_NAME%
    echo.
    
    REM Create a temporary SQL file with credentials to avoid command line escaping issues
    echo -- Drop database if exists > temp_setup.sql
    echo DROP DATABASE IF EXISTS %DB_NAME%; >> temp_setup.sql
    echo -- Import the main SQL file >> temp_setup.sql
    type database\database_setup.sql >> temp_setup.sql

    REM Run the SQL script with proper error handling
    echo Executing database setup script...
    
    if "%DB_PASS%"=="" (
        mysql -h %DB_HOST% -u %DB_USER% < temp_setup.sql
    ) else (
        mysql -h %DB_HOST% -u %DB_USER% -p%DB_PASS% < temp_setup.sql
    )
    
    if %ERRORLEVEL% NEQ 0 (
        echo.
        echo Error: Failed to execute SQL script. Check your MySQL connection and credentials.
        del temp_setup.sql
        goto :db_error
    )
    
    del temp_setup.sql
    
    echo.
    echo Database setup completed successfully!
    echo.
) else (
    echo Skipping database setup. You'll need to set it up manually later.
)

REM Start the application
echo =================================================
echo Setup complete! Starting the application...
echo =================================================

echo What would you like to do?
echo 1. Start development server
echo 2. Exit
set /p choice="Enter your choice (1 or 2): "

if "%choice%"=="1" (
    echo Starting development server...
    echo You can access the application at: http://localhost:8000
    echo The home page URL is: http://localhost:8000/Home.php
    echo The quiz page URL is: http://localhost:8000/Quiz_PHP.php?question_Type=html
    echo NOTE: Do NOT include /public/ in the URLs as the server root is already set to the public directory
    php -S localhost:8000 -t public
) else (
    echo Setup complete! To start the server later, run:
    echo php -S localhost:8000 -t public
    echo Then access the app at: http://localhost:8000/Home.php
)

goto :exit

:db_error
echo.
echo Database setup encountered errors.
echo Please check your MySQL connection and credentials.
echo.

:exit
pause 