# ComfyKure Alerts Engine 🚨

A premium Laravel package that catches real-time controller crashes and sends instant diagnostic email alerts to developers managed via a built-in Tailwind CSS CRUD dashboard.

---

## 🚀 One-Step Installation Guide

Run these commands step-by-step in your main Laravel project terminal to completely install and set up the package:

### 1. Install the Package via Composer
Bash: 
composer require ahmadishtiaq/comfykure-alerts
Publish the Migration File:
php artisan vendor:publish --provider="AhmadIshtiaq\ComfykureAlerts\ComfykureAlertsServiceProvider" --tag="comfykure-migrations"
Run the Database Migration:
php artisan migrate
