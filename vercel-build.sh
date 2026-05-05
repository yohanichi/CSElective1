#!/bin/bash
set -e

echo "🔨 Installing Composer dependencies..."
composer install --no-dev --prefer-dist

echo "📦 Installing npm dependencies..."
npm install --production

echo "🏗️ Building frontend assets..."
npm run build

echo "✅ Build completed successfully!"
