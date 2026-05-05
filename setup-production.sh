#!/bin/bash
set -e

# This script should be run manually before first deployment
# or as part of your deployment pipeline setup

echo "🔑 Generating APP_KEY..."
php artisan key:generate

echo "🗄️ Running migrations..."
php artisan migrate --force

echo "💾 Caching configuration..."
php artisan config:cache

echo "✨ All setup complete! Ready for deployment."
