# Vercel Deployment Guide for Laravel

## Prerequisites
- GitHub, GitLab, or Bitbucket account
- Vercel account (free at vercel.com)
- Your Laravel project pushed to a Git repository

## Deployment Steps

### 1. Generate Application Key
Before deploying, ensure your Laravel app has an encryption key:
```bash
php artisan key:generate
```
Update your `.env` file with the generated `APP_KEY`.

### 2. Set Up Environment Variables in Vercel
In your Vercel dashboard, go to your project settings and add these environment variables:

**Required:**
- `APP_KEY` - Generate one locally and copy the value
- `APP_URL` - Your Vercel deployment URL (e.g., https://your-app.vercel.app)
- `APP_ENV` - Set to `production`
- `APP_DEBUG` - Set to `false`

**Database (if using external DB):**
- `DB_CONNECTION` - mysql, postgres, etc.
- `DB_HOST` - Your database host
- `DB_PORT` - Your database port
- `DB_DATABASE` - Your database name
- `DB_USERNAME` - Database username
- `DB_PASSWORD` - Database password

### 3. Configure Database Connection
**Note:** Vercel doesn't include built-in databases. You have options:

**Option A: Using PlanetScale (MySQL)**
1. Create a free account at planetscale.com
2. Create a new database
3. Get connection credentials and add them as environment variables

**Option B: Using Supabase (PostgreSQL)**
1. Create a free account at supabase.com
2. Create a new project
3. Copy connection string to `DB_*` environment variables

**Option C: Using a different database service**
- AWS RDS, DigitalOcean, Railway, or any external database provider

### 4. Configure Storage (File Uploads)
Vercel's serverless function storage is ephemeral. For file uploads, use:
- **AWS S3** - Add `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`, `AWS_BUCKET`
- **Cloudinary** - Configure through Laravel
- **Or another cloud storage provider**

### 5. Run Migrations on Deployment
Add a deployment script to run migrations:

Create `vercel-build.sh`:
```bash
#!/bin/bash
set -e

echo "Installing dependencies..."
composer install --no-dev

echo "Building frontend assets..."
npm install
npm run build

echo "Running migrations..."
php artisan migrate --force

echo "Build complete!"
```

Then update `vercel.json` `buildCommand`:
```json
"buildCommand": "bash vercel-build.sh"
```

### 6. Deploy to Vercel

**Via Web UI:**
1. Go to vercel.com and sign in
2. Click "New Project"
3. Connect your Git repository
4. Select your repository
5. Keep default settings or customize as needed
6. Add environment variables in the "Environment Variables" section
7. Click "Deploy"

**Via Vercel CLI:**
```bash
npm install -g vercel
vercel
```

### 7. Verify Deployment
After deployment:
1. Visit your Vercel deployment URL
2. Check the Deployment tab for logs if there are any issues
3. Test all routes and functionality

## Common Issues & Solutions

### Issue: "Class 'PDO' not found"
**Solution:** Add to `vercel.json`:
```json
"functions": {
  "api/index.php": {
    "runtime": "php:8.2",
    "memory": 3008
  }
}
```

### Issue: 500 Internal Server Error
1. Check Vercel deployment logs
2. Ensure all environment variables are set
3. Check database connectivity
4. Verify `APP_KEY` is set

### Issue: Assets not loading
Ensure `npm run build` completes successfully and assets are in the `public` directory.

### Issue: Database Migrations Not Running
Use the `vercel-build.sh` approach and ensure `APP_KEY` is set before migrations run.

## Performance Tips

1. **Cache Configuration:** Set `CACHE_DRIVER=file` or use Redis if available
2. **Session Storage:** Use `SESSION_DRIVER=file` for sessions
3. **Queue Jobs:** Set `QUEUE_CONNECTION=sync` for synchronous processing
4. **Database Connection:** Use connection pooling for better performance

## Production Checklist

- [ ] APP_KEY is set
- [ ] APP_DEBUG is false
- [ ] APP_ENV is production
- [ ] Database is configured and accessible
- [ ] Storage solution configured (S3, etc.)
- [ ] Environment variables all set in Vercel
- [ ] Tested all main routes
- [ ] Migrations run successfully
- [ ] Error logging configured
- [ ] CORS settings configured if needed

## Monitoring

1. Visit Vercel dashboard to monitor deployments
2. Check "Functions" tab for execution time and logs
3. Set up error tracking (e.g., Sentry) for better error monitoring

## Rollback

If something goes wrong:
1. Go to your project on Vercel
2. Click "Deployments" tab
3. Select a previous successful deployment
4. Click "Promote to Production"

## Useful Links

- [Vercel PHP Documentation](https://vercel.com/docs/functions/serverless-functions/runtimes/php)
- [Laravel Deployment](https://laravel.com/docs/9.x/deployment)
- [PlanetScale Documentation](https://docs.planetscale.com)
- [Supabase Documentation](https://supabase.com/docs)
