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
    echo Setting up database...
    set /p db_user="Please enter your MySQL username (default: root): "
    
    if "%db_user%"=="" (
        set db_user=root
    )
    
    set /p db_pass="Please enter your MySQL password: "
    
    REM Create database and import schema
    echo Creating database and importing schema...
    mysql -u %db_user% -p%db_pass% -e "CREATE DATABASE IF NOT EXISTS students_tournament;"
    mysql -u %db_user% -p%db_pass% students_tournament < database_setup.sql
    
    REM Update config file with provided credentials
    echo Updating configuration file with database credentials...
    powershell -Command "(Get-Content includes/config.php) -replace 'define\(''DB_USER'', ''root''\);', 'define(''DB_USER'', ''%db_user%'');' | Set-Content includes/config.php"
    powershell -Command "(Get-Content includes/config.php) -replace 'define\(''DB_PASSWORD'', ''''\);', 'define(''DB_PASSWORD'', ''%db_pass%'');' | Set-Content includes/config.php"
    
    echo Database setup complete!
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
    call npm run dev
) else (
    echo Setup complete! To start the server later, run:
    echo npm run dev
)

:exit
pause 