#!/bin/bash
echo "=========================================="
echo "  Portfolio CMS - Update & Setup Script"
echo "=========================================="
echo ""

# Pull latest code
echo "1. Pulling latest code from GitHub..."
git pull origin main

# Install dependencies
echo ""
echo "2. Installing/updating dependencies..."
composer install --no-interaction --prefer-dist

# Clear cache
echo ""
echo "3. Clearing cache..."
php artisan optimize:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan cache:clear

# Rebuild cache
echo ""
echo "4. Rebuilding cache..."
php artisan optimize

# Set permissions
echo ""
echo "5. Setting permissions..."
chmod -R 775 storage bootstrap/cache
chmod -R 775 public

echo ""
echo "=========================================="
echo "  Setup Complete!"
echo "=========================================="
echo ""
echo "Run: php artisan serve"
echo "Then visit: http://localhost:8000"
