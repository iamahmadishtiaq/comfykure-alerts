# ComfyKure Alerts Engine 🚨

A premium Laravel package that catches real-time controller crashes and sends instant diagnostic email alerts to developers, managed via a built-in Tailwind CSS CRUD dashboard.

---

## 🚀 Complete Setup Guide

Run these three commands step-by-step in your main Laravel project terminal:

```bash
composer require ahmadishtiaq/comfykure-alerts

php artisan vendor:publish --provider="AhmadIshtiaq\ComfykureAlerts\ComfykureAlertsServiceProvider" --tag="comfykure-migrations"

php artisan migrate
