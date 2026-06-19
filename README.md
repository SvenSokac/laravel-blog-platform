# Spezia - Full Stack Blogging Platform

Spezia is a modern full-stack blogging platform built with Laravel, providing a complete content management solution for writers and readers.

The application includes secure authentication, blog management, threaded comments, emoji reactions, newsletter subscriptions, an administration dashboard, and responsive design.

This project was developed to demonstrate modern web development practices using the Laravel ecosystem and follows the MVC architectural pattern.

---

## Features

### Public Website

- Browse published blog posts
- Responsive homepage
- Blog categories
- Rich blog content
- Reading time estimation
- Emoji reactions
- Threaded comments
- Newsletter subscription
- Contact page
- About page

### Authentication

- User registration
- Secure login
- Password hashing (bcrypt)
- Session authentication
- Email verification
- Protected routes
- Role-based administration

### Admin Dashboard

- Create, edit and delete blog posts
- Manage comments
- Manage newsletter subscriptions
- Manage contact messages
- Manage users
- Search and filtering
- Rich text editor

---

## Technologies

### Backend

- PHP 8
- Laravel
- Laravel Jetstream
- Filament Admin
- Eloquent ORM

### Frontend

- Blade Templates
- Tailwind CSS
- Alpine.js
- JavaScript
- AJAX

### Database

- MySQL

### Development Tools

- Composer
- Node.js
- Vite
- Git
- Visual Studio Code

---

## Architecture

The application follows the MVC (Model-View-Controller) architecture and includes additional layers for maintainability and scalability.

- Models
- Controllers
- Blade Views
- Middleware
- Service Layer
- Repository Pattern
- Events & Listeners

---

## Key Features

### Authentication

- Secure registration
- Login
- Session management
- Password hashing
- Route protection

### Blog Management

- Full CRUD functionality
- Rich text editor
- Categories
- Featured images
- Publication status

### Interactive Features

- Emoji reactions using AJAX
- Live reaction updates
- Nested comments
- Comment likes
- Newsletter subscriptions

### Database Design

- Normalised relational database
- Foreign key relationships
- Indexed queries
- Optimised comment hierarchy

---

## Security

- CSRF protection
- Password hashing using bcrypt
- Server-side validation
- SQL injection protection
- Secure session handling
- Authentication middleware
- File upload validation

---

## Performance

- Eloquent eager loading
- Database indexing
- Optimised queries
- AJAX updates without page reload
- Responsive UI
- Mobile-first design

---

## Skills Demonstrated

- Full Stack Development
- Laravel Framework
- PHP
- MVC Architecture
- Authentication & Authorization
- RESTful Development
- Database Design
- MySQL
- AJAX
- JavaScript
- Tailwind CSS
- Responsive Design
- CRUD Operations
- Security Best Practices
- Object-Oriented Programming
- Software Testing

---

## Future Improvements

- Email notifications
- Real-time updates with WebSockets
- Social login (OAuth)
- Analytics dashboard
- Cloud storage
- API rate limiting
- SEO optimisation
- AI-assisted content recommendations

---

## Installation

```bash
git clone https://github.com/yourusername/spezia-blog-platform.git

cd spezia-blog-platform

composer install

npm install

cp .env.example .env

php artisan key:generate

php artisan migrate --seed

npm run dev

php artisan serve
```

---

## Author

**Sven Sokac**

First Class Honours Graduate  
Higher Diploma in Science in Computing (Software Development)  
National College of Ireland
