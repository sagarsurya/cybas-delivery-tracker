# Delivery Tracker API

## Setup Instructions

1. Clone the repository: `git clone https://github.com/sagarsurya/cybas-delivery-tracker.git`
2. Install dependencies: `composer install`
3. Set up `.env` file with database and OpenWeatherMap API key.
4. Run migrations: `php artisan migrate`
5. Start the server: `php artisan serve`

## API Endpoints

-   `POST /delivery` - Create a delivery point
-   `GET /delivery` - List all delivery points with live weather
-   `GET /delivery/{id}` - View a delivery point with weather details
