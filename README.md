# MAISON VELOUR — Haute Parfumerie E-Commerce

Maison Velour is a premium, luxury fragrance e-commerce web application. Designed with a **Brutalist Minimalist** aesthetic, the platform delivers a sophisticated, editorial-style shopping experience for high-end clientele.

## 💎 Key Features

- **Editorial UI/UX Design**: High-contrast, monochromatic palette with seamless micro-animations and smooth scrolling.
- **Dynamic Product Catalog**: Browse collections with real-time filtering (by category, price) and sorting capabilities.
- **Masonry Lookbook Gallery**: A responsive, asymmetrical masonry grid showcasing brand ambassadors and campaign imagery.
- **User Authentication System**: Secure account registration and login architecture using Modal Pop-ups.
- **Interactive Cart Drawer**: Non-intrusive, slide-out shopping cart overlay.
- **Internationalization (i18n) Ready**: Dynamic currency conversion and language localization UI elements.

## 🛠 Tech Stack

- **Frontend**: HTML5, Vanilla CSS3, JavaScript (ES6+), jQuery (for legacy plugins)
- **Styling Libraries**: Bootstrap (Grid System), Slick Carousel (Sliders), NoUiSlider (Price Range)
- **Backend**: PHP (Core/Native)
- **Database**: MySQL (MariaDB) - Featuring Bcrypt Hashing and Audit Triggers
- **Server Environment**: XAMPP / Apache

## 📁 Architecture (Clean Architecture / Domain-Driven)

The project utilizes a highly organized directory structure adhering to modern software engineering best practices (MVC-lite):

```text
/ecommerce
├── /app/                  # Backend Logic & Core Engine (Protected)
│   ├── /config/           # Database & Environment Configuration (db.php)
│   ├── /components/       # Reusable UI Partials (header.php, login_form.php)
│   ├── /services/         # Business Logic APIs (api_products.php)
│   └── /helpers/          # Utility functions
│
├── /assets/               # Frontend Visual Assets (Public)
│   ├── /css/              # Stylesheets (style.css, index.css)
│   ├── /js/               # Client-side scripts (shop.js, main.js)
│   ├── /images/           # Product and Lookbook imagery
│   └── /fonts/            # Local typography
│
├── /admin/                # Secure Back-Office Zone (Isolated Login & Dashboard)
│
├── /user/                 # Secure Zone for Advanced Customer Operations (Checkout, etc)
│
├── index.php              # Main Landing Page (Home)
├── shop.php               # Dynamic Fragrance Catalog
├── collection.php         # Lookbook / Campaign Gallery
├── about.php              # Brand Story & Heritage Page
└── account.php            # User Dashboard (Orders & Wishlist)
```

## 🚀 How to Run Locally

1. **Install Server Environment**: Download and install [XAMPP](https://www.apachefriends.org/index.html).
2. **Clone/Move Repository**: Place the `ecommerce` folder inside the local server directory:
   - Windows: `C:
mpp\htdocscommerce`
   - Mac: `/Applications/XAMPP/xamppfiles/htdocs/ecommerce`
3. **Start Servers**: Open XAMPP Control Panel and start **Apache** and **MySQL**.
4. **Database Setup**:
   - Go to `http://localhost/phpmyadmin` (or use DBeaver)
   - Create a new database named `db_ecommerce`
   - Import the SQL schema to initialize the database. The current foundation relies on core tables (like `users`, `admins`, `products`, etc.) and will dynamically expand to include transaction tables (`orders`, `payments`) as development progresses.
5. **Launch Application**: Open your browser and navigate to:
   `http://localhost/ecommerce`

## ⚖️ License

© 2026 Maison Velour. All Rights Reserved. Proprietary software for internal and commercial use only.