# GiftShare - Community Gifting Platform

A Laravel 12 web application where registered users can post items they're giving away for free. Other users can browse, vote, and comment on listings.

## Features

- **User Authentication** - Register, login, and manage your profile
- **Item Listings** - Post items with photos, descriptions, categories, and location
- **Browsing & Filtering** - Search items by title/description, filter by category, city, and status
- **Voting System** - Upvote/downvote items (one vote per user per item)
- **Comments** - Leave comments on listings
- **Real-time Updates** - Livewire-powered interactions without page reloads
- **Responsive Design** - Bootstrap 5 styling that works on all devices

## Tech Stack

- **Backend:** Laravel 12
- **Frontend:** Livewire 3 + Bootstrap 5
- **Database:** MariaDB / MySQL
- **Styling:** SCSS with Bootstrap

## Requirements

- PHP 8.2+
- Composer
- Node.js 20+
- MariaDB / MySQL

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/thestackpilot/gift-share.git
   cd gift-share
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install Node dependencies:**
   ```bash
   npm install
   ```

4. **Create environment file:**
   ```bash
   cp .env.example .env
   ```

5. **Configure your database in `.env`:**
   ```env
   DB_CONNECTION=mariadb
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=giftshare
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

6. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

7. **Create the database:**
   ```bash
   mysql -u root -p -e "CREATE DATABASE giftshare"
   ```

8. **Run migrations:**
   ```bash
   php artisan migrate
   ```

9. **Create storage link:**
   ```bash
   php artisan storage:link
   ```

10. **Seed demo data (optional):**
    ```bash
    php artisan db:seed
    ```
    This creates:
    - 10 categories
    - 20 users (test@example.com / password)
    - 40-80 items with photos
    - Comments and votes

11. **Build frontend assets:**
    ```bash
    npm run build
    ```

12. **Start the development server:**
    ```bash
    php artisan serve
    ```

Visit `http://localhost:8000` in your browser.

## Development

For local development with hot-reloading:

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

## Test Account

After seeding, you can log in with:
- **Email:** test@example.com
- **Password:** password

## Project Structure

```
app/
├── Http/Controllers/
│   └── ItemController.php      # Item CRUD operations
├── Livewire/
│   ├── ItemList.php            # Main listing with pagination
│   ├── ItemCard.php            # Individual item card
│   ├── ItemFilters.php         # Search/filter controls
│   ├── ItemForm.php            # Create/edit form
│   ├── VoteButton.php          # Voting component
│   └── CommentSection.php      # Comments component
├── Models/
│   ├── User.php
│   ├── Item.php
│   ├── Category.php
│   ├── Photo.php
│   ├── Comment.php
│   └── Vote.php
└── Policies/
    └── ItemPolicy.php          # Authorization rules

database/
├── factories/                  # Model factories for seeding
├── migrations/                 # Database schema
└── seeders/
    └── DatabaseSeeder.php      # Demo data seeder

resources/views/
├── auth/                       # Authentication views
├── items/                      # Item pages
├── layouts/                    # App layouts
├── livewire/                   # Livewire component views
└── components/                 # Blade components
```

## Pages

| Route | Description |
|-------|-------------|
| `/` | Landing page (redirects to login) |
| `/dashboard` | Browse all items with filters |
| `/items/create` | Post a new item |
| `/items/{id}` | View item details |
| `/items/{id}/edit` | Edit your item |
| `/items/my` | View your posted items |
| `/profile` | Edit your profile |

## License

MIT
