# Pakistan Student Toolkit (PHP)

Free calculators for students in Pakistan. Built with **HTML/CSS/JS + PHP**. No database required.

## Features
- GPA, CGPA, Zakat, Fee Installment (EMI), Percentage→CGPA, Grade Target Planner, Merit Estimator
- Progressive enhancement: JS computes live; PHP computes on POST (works without JS)
- Lightweight, single-host deploy; SEO-friendly static pages
- Ready for AdSense placements on calculator and blog pages

## Structure
```
/includes      # header/footer
/assets        # CSS, JS, logo
/calculators   # individual calculator pages (PHP + JS)
index.php
calculators.php
scholarships.php
blog.php
contact.php
```

## Deploy
1. Upload the whole folder to your PHP host (or into repo and deploy to a PHP server).
2. Update `contact.php` recipient email (`$to`).
3. (Optional) Add your Google Analytics and AdSense snippets in `includes/header.php` and `includes/footer.php`.
4. Ensure `.php` is allowed and `mail()` works on your host. If not, integrate SMTP (e.g., PHPMailer) later.

## Local test (PHP 8)
```bash
php -S localhost:8080
# then open http://localhost:8080/index.php
```

## License
MIT
