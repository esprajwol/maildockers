#!/bin/bash
set -e

echo "Deployment started ..."

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

# Pull the latest changes from the master branch
echo "Pulling latest changes from the master branch."
if ! git pull origin master; then
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

# Function to run artisan command with error handling
run_artisan_command() {
    if ! php artisan "$1" --force; then
        echo "Error: Failed to run php artisan $1"
        exit 1
    fi
    echo "Successfully ran: php artisan $1"
}
# Clear and cache configurations and routes
run_artisan_command "migrate"
run_artisan_command "config:clear"
run_artisan_command "cache:clear"
run_artisan_command "config:cache"
run_artisan_command "route:cache"
run_artisan_command "route:clear"
run_artisan_command "view:clear"
run_artisan_command "view:cache"
#run_artisan_command "queue:flush"

# Clear the queue
#php artisan queue:flush
#php artisan queue:clear

# Restart services
# sudo systemctl restart nginx
# sudo systemctl restart php8.1-fpm
#sudo systemctl restart supervisor
if ! sudo systemctl restart supervisor; then
    echo "Error: Failed to sudo systemctl restart supervisor"
    exit 1
fi
# sudo systemctl restart redis-server
# Restart services
if ! sudo systemctl restart nginx; then
    echo "Error: Failed to restart Nginx."
    exit 1
fi

# Exit maintenance mode
# php artisan up

echo "Deployment finished!"
