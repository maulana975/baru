# Deploying to GitHub Pages (static-only)

Important: GitHub Pages only serves static files (HTML/CSS/JS). A Laravel application requires PHP for routes, controllers, and server-side rendering — those features will NOT run on GitHub Pages. The workflow below publishes the contents of the `public/` directory to the `gh-pages` branch so GitHub Pages can serve static assets.

When to use this option
- If you only need to publish a static front-end (pre-rendered HTML, CSS, JS) placed in `public/`.
- If your Laravel app is purely static (no server-side routes, no database, no PHP requirements).

What the workflow does
- On push to `main` (or manually via workflow_dispatch), a GitHub Action will copy `public/` to a `gh-pages` branch. GitHub Pages can be configured to serve that branch.

Local build steps (PowerShell)
1. Install PHP/Composer dependencies (if you need to build assets locally):

```powershell
composer install --no-dev --optimize-autoloader
cp .env.example .env
php artisan key:generate
```

2. Build frontend assets:

```powershell
npm install
npm run build
```

3. Ensure the files you want to publish are in `public/`. Note: `index.php` is a PHP entrypoint — it will not execute on GitHub Pages. If you want a working static site, replace or add an `index.html` in `public/` containing the static entry point.

Publishing steps
1. Create a GitHub repository and push your code to the `main` branch.

```powershell
git add .
git commit -m "Initial commit"
git branch -M main
git remote add origin https://github.com/<your-username>/<repo>.git
git push -u origin main
```

2. After pushing, the workflow `.github/workflows/deploy-gh-pages.yml` will run and create/update the `gh-pages` branch with the contents of `public/`.

3. Configure GitHub Pages in the repository settings:
- Go to `Settings` → `Pages`.
- Under `Source`, select `gh-pages` branch and `/ (root)` folder (or the option GitHub provides for that branch).
- Save — GitHub will provide the site URL (typically `https://<your-username>.github.io/<repo>`).

Custom domain
- To use a custom domain, create a `CNAME` file with your domain in `public/` (it will be published to the `gh-pages` branch). Then set the DNS A/CNAME records as GitHub Pages docs show.

If you need a full Laravel deployment (dynamic PHP + database)
- Use a PHP-capable host (Render, DigitalOcean App Platform, Azure App Service, Heroku buildpacks, Railway, or a VPS) and deploy with GitHub Actions or the provider's GitHub integration. If you'd like, I can prepare a GitHub Actions example for Render or Docker-based deploy.

Troubleshooting
- If the site shows raw PHP code or you get a 404: GitHub Pages cannot run PHP — you need a static index.html or use a proper PHP host.
- If assets don't load: check paths in HTML/CSS and ensure compiled assets are present under `public/`.

Questions? Reply if you want me to:
- Prepare an alternative GitHub Actions workflow for a PHP host (Render example).
- Add a simple `public/index.html` starter that points to your built assets so the site is viewable on GitHub Pages.
