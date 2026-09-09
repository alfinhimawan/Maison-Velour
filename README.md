# MAISON VELOUR — Haute Parfumerie E-Commerce

Maison Velour is a premium, luxury fragrance e-commerce web application. Designed with a **Brutalist Minimalist** aesthetic, the platform delivers a sophisticated, editorial-style shopping experience for high-end clientele.

## 💎 Key Features

- **Editorial UI/UX Design**: High-contrast, monochromatic palette with seamless micro-animations and smooth scrolling.
- **Dynamic Product Catalog**: Browse collections with real-time filtering (by category, price) and sorting capabilities.
- **Masonry Lookbook Gallery**: A responsive, asymmetrical masonry grid showcasing brand ambassadors and campaign imagery.
- **User Authentication System**: Secure account registration and login architecture.
- **Interactive Cart Drawer**: Non-intrusive, slide-out shopping cart overlay.
- **Internationalization (i18n) Ready**: Dynamic currency conversion and language localization UI elements.

## 🛠 Tech Stack

- **Frontend**: HTML5, Vanilla CSS3, JavaScript (ES6+), jQuery (for legacy plugins)
- **Styling Libraries**: Bootstrap (Grid System), Slick Carousel (Sliders), NoUiSlider (Price Range)
- **Backend**: PHP (Core/Native)
- **Database**: MySQL (MariaDB)
- **Server Environment**: XAMPP / Apache

## 📁 Architecture (Component-Based)

The project utilizes a modular directory structure adhering to modern software engineering best practices:

```text
/ecommerce
├── /config/               # Database & Environment Configuration
│   ├── config.php         # Global configuration & session handler
│   └── db.php             # Database connection setup
│
├── /components/           # Reusable UI Partials
│   ├── header.php         # Main navigation & cart popup
│   ├── footer.php         # Site footer & links
│   ├── body.php           # Main catalog gallery section
│   ├── login_form.php     # Login modal logic & UI
│   ├── register_form.php  # Registration modal logic & UI
│   └── newslettter.php    # Newsletter subscription section
│
├── /images/               # Visual Assets
│   ├── /products/         # Product catalog imagery (perfume_*.jpg)
│   └── /lookbook/         # Editorial banners (hero_*.jpg)
│
├── /css/                  # Stylesheets
│   ├── style.css          # Main aesthetic engine
│   └── (bootstrap, slick, nouislider, etc)
│
├── /js/                   # Client-side interactivity logic
│   └── (app.js, main.js, script.js, etc)
│
├── /fonts/                # Local typography (FontAwesome & Slick fonts)
│
├── index.php              # Main Landing Page (Home)
├── collection.php         # Lookbook / Campaign Gallery
├── about.php              # Brand Story & Heritage Page
└── account.php            # User Dashboard & Order History
```

## 🚀 How to Run Locally

1. **Install Server Environment**: Download and install [XAMPP](https://www.apachefriends.org/index.html).
2. **Clone/Move Repository**: Place the `ecommerce` folder inside the local server directory:
   - Windows: `C:\xampp\htdocs\ecommerce`
   - Mac: `/Applications/XAMPP/xamppfiles/htdocs/ecommerce`
3. **Start Servers**: Open XAMPP Control Panel and start **Apache** and **MySQL**.
4. **Database Setup**:
   - Go to `http://localhost/phpmyadmin`
   - Create a new database named `db_ecommerce`
   - Import the provided SQL schema (if applicable) or ensure the tables (`register`, `shipping_countries`, `products`) exist.
5. **Launch Application**: Open your browser and navigate to:
   `http://localhost/ecommerce`

## ⚖️ License
© 2026 Maison Velour. All Rights Reserved. Proprietary software for internal and commercial use only.
