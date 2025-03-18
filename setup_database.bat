@echo off
title Database Setup

echo =================================================
echo       Student Tournament Database Setup           
echo =================================================

REM Check if MySQL is installed
where mysql >nul 2>nul
if %errorlevel% neq 0 (
    echo Error: MySQL is not installed or not in PATH.
    echo Please install MySQL first:
    echo https://dev.mysql.com/downloads/
    goto :exit
)

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
    goto :exit
)

del temp_setup.sql

echo.
echo Database setup completed successfully!
echo.
echo The database "students_tournament" has been created with all required tables and sample data.
echo Quiz questions for PHP, JavaScript, HTML, CSS, Python, and MySQL have been added.
echo.
echo To start the PHP development server, run: php -S localhost:8000 -t public
echo.

:exit
pause 