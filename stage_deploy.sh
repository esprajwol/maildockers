#!/bin/bash
set -e

echo "Deployment started for Stage Server..."

# Get the current date in YYYY-MM-DD format
current_date=$(date +"%Y-%m-%d")

# Concatenate to create the filename
log_filename="laravel-$current_date.log"

echo "Log filename: $log_filename"

# Enter maintenance mode or return true
# if already is in maintenance mode
# (php artisan down) || true

# Check for uncommitted changes
if [[ -n $(git status --porcelain) ]]; then
    echo "Uncommitted changes detected. Committing changes locally."

    git add -A

    if ! git commit -m "Auto-commit: Changes before deployment"; then
        echo "Error: git commit failed."
        exit 1
    fi

    echo "Changes committed successfully."
else
    echo "No uncommitted changes detected. Proceeding with deployment."
fi

# Pull the latest changes from the stage branch
echo "Pulling latest changes from the stage branch."
if ! git pull origin stage; then
    echo "Error: Git pull failed."
    exit 1
fi

# Check for merge conflicts
if [[ $(git ls-files -u | wc -l) -gt 0 ]]; then
    echo "Merge conflicts detected. Resolving conflicts by accepting all incoming changes."

    git checkout --theirs .

    if ! git add -A; then
        echo "Error: git add after resolving conflicts failed."
        exit 1
    fi

    if ! git commit -m "Resolved merge conflicts by accepting all incoming changes"; then
        echo "Error: git commit after resolving conflicts failed."
        exit 1
    fi
fi

# Clear and cache configurations and routes
php artisan migrate
php artisan db:seed --class=CountriesTableSeeder   
php artisan db:seed --class=CountryStateSeeder   
php artisan db:seed --class=CurrencyTableSeeder   
php artisan db:seed --class=LanguagesTableSeeder   
php artisan db:seed --class=LocalizationsTableSeeder 
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan route:clear
php artisan view:clear
php artisan view:cache


# Clear the queue
php artisan queue:flush
php artisan queue:clear

# Restart services
# sudo systemctl restart nginx
# sudo systemctl restart php8.1-fpm
sudo systemctl restart supervisor
# sudo systemctl restart redis-server
# Restart services
if ! sudo systemctl restart nginx; then
    echo "Error: Failed to restart Nginx."
    exit 1
fi

# Exit maintenance mode
# php artisan up

echo "Deployment finished!"
