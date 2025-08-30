# Travel Packages

##  Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd travel-packages-api
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node.js Dependencies
```bash
npm install
```

### 4. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure Database
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travel_packages
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Run Migrations and Seeders
```bash
php artisan migrate
php artisan db:seed
```

### 7. Build Frontend Assets
```bash
npm run build
```

### 8. Start Development Server
```bash
# Start Laravel development server
php artisan serve

# In another terminal, start Vite dev server
npm run dev
```

## 📁 Project Structure

```
travel-packages-api/
├── app/
│   ├── Http/
│   │   ├── Controllers/Api/
│   │   │   └── PackageController.php
│   │   └── Resources/
│   │       └── PackageResource.php
│   └── Models/
│       └── Package.php
├── database/
│   ├── migrations/
│   │   └── create_packages_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── PackageSeeder.php
├── resources/
│   ├── js/
│   │   ├── components/
│   │   │   ├── Filters.vue
│   │   │   ├── Loader.vue
│   │   │   └── PackageCard.vue
│   │   ├── views/
│   │   │   ├── PackageList.vue
│   │   │   └── PackageDetail.vue
│   │   ├── services/
│   │   │   └── api.js
│   │   ├── router/
│   │   │   └── index.js
│   │   ├── App.vue
│   │   └── app.js
│   ├── css/
│   │   └── app.css
│   └── views/
│       └── app.blade.php
├── routes/
│   ├── api.php
│   └── web.php
└── config/
    └── cors.php
```

## 🔧 API Endpoints

### Packages
- `GET /api/packages` - Get all packages with optional filters
- `GET /api/packages/{id}` - Get specific package details
- `GET /api/packages/cities` - Get unique departure cities

### Query Parameters for Filtering
- `price_range`: `<50000`, `50000-100000`, `>100000`
- `duration`: `3-5`, `6-10`, `>10`
- `departure_city`: City name
- `start_date`: YYYY-MM-DD format
- `end_date`: YYYY-MM-DD format
- `search`: Search in package titles

### Example API Calls
```bash
# Get all packages
GET /api/packages

# Filter by price range
GET /api/packages?price_range=<50000

# Search packages
GET /api/packages?search=Bali

# Multiple filters
GET /api/packages?price_range=50000-100000&duration=6-10&departure_city=Jakarta
```

## 🎨 Frontend Features

### Package Listing Page
- Responsive grid layout
- Real-time filtering
- Search functionality
- Loading states
- Error handling

### Package Detail Page
- Full package information
- Beautiful image display
- Responsive design
- Navigation back to listing

### Components
- **PackageCard**: Compact package display
- **Filters**: Advanced filtering interface
- **Loader**: Loading spinner component