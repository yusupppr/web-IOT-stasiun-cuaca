# 🧪 TESTING CHECKLIST - LOCAL VERIFICATION

**Before pushing to production, verify everything works locally!**

---

## ✅ BASIC FUNCTIONALITY TESTS

### Home Page
```bash
curl http://localhost:8000
# Expect: Homepage loads with navbar, no errors
```

### Kursus/Pembelajaran Pages
```
1. Visit: http://localhost:8000/kursus
   Expected: Page shows course cards from database
   Check: Images load, course titles display, buttons work

2. Visit: http://localhost:8000/pembelajaran
   Expected: Same course list displayed
   Check: Click course name works

3. Click on any course
   Expected: Detail page loads with PDF download option
   Check: All course information displays
```

### Database Queries
```bash
# Login to MySQL
mysql -u root -p terobos

# Check TopikPembelajaran records
SELECT id, judul, slug FROM topik_pembelajaran;

# Check News records
SELECT id, judul, slug FROM news;

# Check User records
SELECT id, email FROM users;
```

### Media Files
```
1. Check PDF accessible:
   http://localhost:8000/storage/pdf/iot-stasiun-mini.pdf

2. Check images accessible:
   http://localhost:8000/storage/thumbnails/[filename].png
   http://localhost:8000/storage/news-thumbnails/[filename].png
   http://localhost:8000/storage/product-photos/[filename].png
   http://localhost:8000/storage/project-thumbnails/[filename].png

Expected: All files load correctly, no 404 errors
```

### Filament Admin
```
1. Visit: http://localhost:8000/admin
2. Login with: admin@terobos.com / admin123456
3. Expected: Admin dashboard loads
4. Check: Can see TopikPembelajaran, News, Customers, Users in menu
```

---

## 🔍 CODE QUALITY CHECKS

### PHP Syntax Check
```bash
cd "d:\hibah\repo web\terobos 2"
php -l app/Http/Controllers/*.php
php -l app/Models/*.php
```

### Laravel Artisan Checks
```bash
# Check for errors
php artisan route:list

# Run service provider checks
php artisan config:cache

# Clear and cache config
php artisan cache:clear
php artisan config:clear
```

### Database Migrations
```bash
# Test migrations from scratch
php artisan migrate:refresh
php artisan db:seed

# Should see no errors, database populated
```

---

## 🔐 SECURITY TESTS

### Environment Variables
```
✅ Check: .env NOT in git (only .env.example)
✅ Check: No secrets in code files
✅ Check: Firebase credentials in storage/app/firebase/
✅ Check: All config uses env() for sensitive data
```

### Database Credentials
```
✅ Check: DB credentials in .env, not in code
✅ Check: DB user has limited permissions (not root)
✅ Check: Database name doesn't contain password
```

### File Permissions
```bash
# Check storage writable
php artisan tinker
> Storage::put('test.txt', 'test');
> Storage::delete('test.txt');
# Should work without errors
```

---

## 🚀 PERFORMANCE TESTS

### Page Load Time
```bash
# Check home page load time
time curl http://localhost:8000

# Should be < 500ms for local

# Check database queries (enable query logging in .env)
DB_LOG=true
# View storage/logs/laravel.log for query count
```

### Asset Loading
```
1. Open http://localhost:8000
2. Developer Tools (F12) > Network tab
3. Check:
   - CSS files load (no 404)
   - JS files load (no 404)
   - All images load (no 404)
   - Total page size reasonable (< 5MB)
```

---

## 📝 GIT STATUS VERIFICATION

### Before Committing
```bash
# Check what's uncommitted
git status

# Should show:
# - No .env file
# - No vendor/ or node_modules/
# - All source code files

# Check git log
git log --oneline

# Should show your commits
```

### Before Pushing
```bash
# Check remotes
git remote -v

# Should show: origin -> github.com/yusupppr/web-IOT-stasiun-cuaca

# Check branch
git branch

# Should show: * main (current branch)

# Check what will be pushed
git log origin/main..main

# If nothing shows, already pushed
```

---

## 🔧 TROUBLESHOOTING

### If `php artisan migrate` fails
```
1. Check MySQL is running
2. Check .env DB credentials
3. Check database exists: CREATE DATABASE terobos;
4. Check user permissions
5. Try: php artisan migrate:refresh --seed
```

### If images don't load
```
1. Check storage symlink exists: public/storage -> storage/app/public
2. Try: php artisan storage:link
3. Check file permissions: ls -la storage/app/public/
4. Check Storage::url() in blade templates returns correct path
```

### If admin login fails
```
1. Check users table has admin@terobos.com
2. Check password hash correct
3. Try: php artisan db:seed
4. Check APP_DEBUG=true for error details
```

### If CSS/JS not loading
```
1. Check files exist in resources/css/ and resources/js/
2. Try: npm run dev (development) or npm run build (production)
3. Check public/build/ directory created
4. Clear browser cache (Ctrl+Shift+Delete)
```

---

## ✅ FINAL CHECKLIST BEFORE GITHUB PUSH

```
Local Development Environment:
- [ ] PHP version 8.1+ installed
- [ ] MySQL 8.0+ running
- [ ] Composer installed
- [ ] Node.js/npm installed
- [ ] Git installed

Project Setup:
- [ ] Dependencies installed: composer install, npm install
- [ ] .env created from .env.example
- [ ] APP_KEY generated: php artisan key:generate
- [ ] Database created: CREATE DATABASE terobos;
- [ ] Migrations run: php artisan migrate
- [ ] Seeders run: php artisan db:seed
- [ ] Storage symlink: php artisan storage:link

Code Quality:
- [ ] No PHP syntax errors
- [ ] All artisan routes check pass
- [ ] Config caching works
- [ ] Database queries run correctly

Functionality:
- [ ] Home page loads
- [ ] Kursus page shows courses
- [ ] Course detail pages work
- [ ] PDF downloads work
- [ ] Admin panel accessible
- [ ] All images load correctly
- [ ] No console errors (F12 > Console tab)

Security:
- [ ] .env file NOT committed
- [ ] No secrets in code
- [ ] .gitignore properly configured
- [ ] Database credentials secure

Git Status:
- [ ] git status shows clean working tree
- [ ] All meaningful files committed
- [ ] All secrets NOT committed
- [ ] Ready to push to GitHub

Final Check:
- [ ] All 9 media files tracked
- [ ] All migrations included
- [ ] All seeders working
- [ ] README.md complete
- [ ] DEPLOYMENT_READINESS.md reviewed
```

---

## 🎉 READY FOR GITHUB?

When all checkboxes above are marked, you're ready to:

```bash
git push origin main

# GitHub will now have:
✅ All source code
✅ All configurations (except .env)
✅ All media files
✅ All database migrations
✅ All documentation

# Next developer can simply:
git clone https://github.com/yusupppr/web-IOT-stasiun-cuaca.git
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm run dev
php artisan serve
```

---

*Last Updated: December 8, 2025*
