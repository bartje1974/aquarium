<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Aquarium Project

A web-based multilingual aquarium management system built with Laravel.

## Description

This project is a digital aquarium management system that helps track water parameters, maintenance schedules, and fish inventory. Available in multiple languages.

## Features

- Multilanguage support:
  - English (en)
  - Dutch (nl)
  - French (fr)
  - German (de)
- Water parameter tracking (pH, temperature, nitrates, etc.)
- Maintenance schedule and reminders
- Visual representation of tank status

All water values ​​for both fresh and salt water and language and water changes can be done in the settings.

## Installation

1. Clone the repository:
```bash
git clone https://github.com/bartje1974/aquarium.git
```

2. Install PHP dependencies via Composer:
```bash
composer install
```

3. Install NPM dependencies:
```bash
npm install
```

4. Configure environment variables:
- Copy `.env.example` to `.env`
- Update the database and other configuration values
- Set your default locale in .env: `APP_LOCALE=en`
- Set available locales in .env: `APP_LOCALES=en,nl,fr,de`
- Generate application key:
```bash
php artisan key:generate
```

5. Set up the database:
```bash
php artisan migrate
```

6. Start the development server:
```bash
php artisan serve
```

7. Compile assets:
```bash
npm run dev
```

## Troubleshooting

### Pending Changes Hang

If you encounter issues with pending changes hanging:

1. Clear NPM cache:
```bash
npm cache clean --force
```

2. Delete node_modules and reinstall:
```bash
rm -rf node_modules
npm install
```

3. Rebuild assets:
```bash
npm run build
```

## Technologies Used

- Frontend: HTML, CSS, JavaScript
- Backend: PHP, Laravel Framework
- Database: MySQL/SQLite
- Other: Chart.js for data visualization

## Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
