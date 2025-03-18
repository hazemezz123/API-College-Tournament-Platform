#!/bin/bash

# Colors for terminal output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${BLUE}==================================================${NC}"
echo -e "${BLUE}      Student Tournament Platform Setup           ${NC}"
echo -e "${BLUE}==================================================${NC}"

# Check if npm is installed
if ! [ -x "$(command -v npm)" ]; then
  echo -e "${RED}Error: npm is not installed.${NC}" >&2
  echo -e "${YELLOW}Please install Node.js and npm first:${NC}"
  echo -e "${YELLOW}https://nodejs.org/en/download/${NC}"
  exit 1
fi

# Check if PHP is installed
if ! [ -x "$(command -v php)" ]; then
  echo -e "${RED}Error: PHP is not installed.${NC}" >&2
  echo -e "${YELLOW}Please install PHP first:${NC}"
  echo -e "${YELLOW}https://www.php.net/downloads${NC}"
  exit 1
fi

# Check if MySQL is installed
if ! [ -x "$(command -v mysql)" ]; then
  echo -e "${RED}Warning: MySQL might not be installed or not in PATH.${NC}" >&2
  echo -e "${YELLOW}You'll need MySQL to run the application properly.${NC}"
  echo -e "${YELLOW}https://dev.mysql.com/downloads/${NC}"
fi

echo -e "${GREEN}All prerequisites satisfied. Setting up project...${NC}"

# Install npm dependencies
echo -e "${BLUE}Installing npm dependencies...${NC}"
npm install

# Build CSS files
echo -e "${BLUE}Building CSS files...${NC}"
npm run build:prod

# Setup database prompt
echo -e "${YELLOW}Do you want to set up the database now? (y/n)${NC}"
read -r setup_db

if [ "$setup_db" = "y" ] || [ "$setup_db" = "Y" ]; then
  echo -e "${BLUE}Setting up database...${NC}"
  echo -e "${YELLOW}Please enter your MySQL username (default: root):${NC}"
  read -r db_user
  db_user=${db_user:-root}
  
  echo -e "${YELLOW}Please enter your MySQL password:${NC}"
  read -rs db_pass
  
  # Create database and import schema
  echo -e "${BLUE}Creating database and importing schema...${NC}"
  mysql -u "$db_user" -p"$db_pass" -e "CREATE DATABASE IF NOT EXISTS students_tournament;"
  mysql -u "$db_user" -p"$db_pass" students_tournament < database_setup.sql
  
  # Update config file with provided credentials
  echo -e "${BLUE}Updating configuration file with database credentials...${NC}"
  sed -i "s/define('DB_USER', 'root');/define('DB_USER', '$db_user');/" includes/config.php
  sed -i "s/define('DB_PASSWORD', '');/define('DB_PASSWORD', '$db_pass');/" includes/config.php
  
  echo -e "${GREEN}Database setup complete!${NC}"
else
  echo -e "${YELLOW}Skipping database setup. You'll need to set it up manually later.${NC}"
fi

# Start the application
echo -e "${BLUE}==================================================${NC}"
echo -e "${GREEN}Setup complete! Starting the application...${NC}"
echo -e "${BLUE}==================================================${NC}"

echo -e "${YELLOW}What would you like to do?${NC}"
echo -e "${YELLOW}1. Start development server${NC}"
echo -e "${YELLOW}2. Exit${NC}"
read -r choice

case $choice in
  1)
    echo -e "${GREEN}Starting development server...${NC}"
    echo -e "${BLUE}You can access the application at:${NC} http://localhost:8000"
    npm run dev
    ;;
  *)
    echo -e "${GREEN}Setup complete! To start the server later, run:${NC}"
    echo -e "${BLUE}npm run dev${NC}"
    exit 0
    ;;
esac 