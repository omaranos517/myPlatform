# المنصة التعليمية (قيد التطوير حالياً)

منصة تعليمية مبنية باستخدام Laravel تهدف إلى تقديم محتوى تعليمي مميز للطلاب في مختلف المراحل الدراسية.

![Laravel Logo](https://laravel.com/img/logomark.min.svg)

## 🚀 المميزات

- نظام تسجيل دخول وتسجيل مستخدمين
- إدارة المحتوى التعليمي (دروس، ملفات، فيديوهات)
- واجهة مستخدم بسيطة وسهلة الاستخدام
- تكامل مع قواعد البيانات ورفع الملفات

## 📦 التقنيات المستخدمة

- Laravel 12
- PHP 8.x
- MySQL
- Blade Templates ( stracks, layouts, views, components )
- Vite

## ⚙️ متطلبات التثبيت

- PHP ≥ 8.1
- Composer
- Node.js + npm
- Git

خادم محلي (Laragon / XAMPP / Apache + MySQL)

## 🛠 التثبيت

```bash
git clone https://github.com/omaranos517/myPlatform.git
cd myPlatform
composer install
cp .env.example .env
php artisan key:generate
npm install
php artisan migrate
php artisan db:seed
npm run dev
```

## 🔐 الترخيص

هذا المشروع مرخّص تحت رخصة MIT.  
راجع ملف [LICENSE](LICENSE).
