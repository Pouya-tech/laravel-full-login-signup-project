<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تست بوت‌استرپ V</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>

    <!-- نوار ناوبری -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5">
        <div class="container">
            <a class="navbar-brand" href="#">پروژه V</a>
        </div>
    </nav>

    <!-- بدنه اصلی -->
    <div class="container">
        <h1 class="text-primary mb-4">بوت‌استرپ با موفقیت نصب شد!</h1>
        <p>اگر رنگ تیتر قرمزه (یا همون رنگی که توی متغیر $primary ست کردی)، یعنی SCSS کامپایل شده.</p>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">کارت اول</h5>
                        <p class="card-text">این یک تست ساده برای گرید بوت‌استرپ است.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">کارت دوم</h5>
                        <p class="card-text">اگر سایه‌ها (shadow) رو می‌بینی، یعنی کار درسته.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
