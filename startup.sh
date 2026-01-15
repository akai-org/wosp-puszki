#!/bin/bash

# Function to check if a command is available
function check_command() {
  if ! command -v $1 &> /dev/null; then
    echo "$1 is not installed. Please install it before running this script."
    exit 1
  fi
}

# Step 1: Check for required tools ✅
echo "Step 1: Checking for required tools..."
check_command "npm"
check_command "node"
check_command "yarn"
check_command "php"
check_command "composer"
check_command "psql"
echo "All required tools are installed."

# Step 2: Navigate to the server directory 📂
echo "Step 2: Navigating to the server directory..."
if [ -d "server" ]; then
  cd server || { echo "Server directory not found."; exit 1; }
else
  echo "Server directory does not exist. Exiting."
  exit 1
fi

# Step 3: Run server setup commands 🖥️
echo "Step 3: Running server setup commands..."
composer install
vendor/bin/bdi detect drivers
php artisan key:generate
php artisan migrate
sudo chmod -R 755 storage/
npm install
npm run build

# Step 4: Navigate to the client directory 📂
echo "Step 4: Navigating to the client directory..."
if [ -d "../client" ]; then
  cd ../client || { echo "Client directory not found."; exit 1; }
else
  echo "Client directory does not exist. Exiting."
  exit 1
fi

# Step 5: Run client setup commands 🖥️
echo "Step 5: Running client setup commands..."
yarn
yarn run build

# Step 6: Configure Nginx with nginx.conf 🛠️
echo "Step 6: Configuring Nginx..."
if [ -f "../nginx.conf" ]; then
  sudo cp ../nginx.conf /etc/nginx/sites-available/default
  sudo nginx -t && sudo systemctl reload nginx
  echo "Nginx has been configured and reloaded successfully."
else
  echo "nginx.conf file not found in the current directory. Skipping Nginx configuration."
fi

# Step 7: Display message ☕
echo "Step 7: All done! Smacznej kawusi!"