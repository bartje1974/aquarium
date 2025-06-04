<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Aquarium Project

A web-based aquarium management system built with Laravel.

## Description

This project is a digital aquarium management system that helps track water parameters, maintenance schedules, and fish inventory.

## Features

- Water parameter tracking (pH, temperature, nitrates, etc.)
- Fish inventory management
- Maintenance schedule and reminders
- Visual representation of tank status

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
