# PHP Web Services & REST APIs Training

A hands-on backend training project focused on learning how to consume, build, secure, and document RESTful APIs using PHP and Laravel.

This repository contains the practical work completed during the Web Services & APIs course, covering API consumption with cURL and Guzzle, as well as building a secure RESTful API with JWT authentication.

---

# Course Overview

The training was divided into two main parts:

## Day 1 — API Consumption & Integration

Learned how to consume external APIs using PHP.

### Topics Covered

* HTTP fundamentals
* REST APIs
* JSON handling
* cURL requests
* Guzzle HTTP Client
* Composer dependency management
* API integration workflows

### Practical Work

Built two Product Catalog Dashboard applications consuming external APIs:

#### cURL Application

* Fetch products from external API
* Display products in responsive cards
* Product details page
* JSON parsing using `json_decode`

#### Guzzle Application

* Consume APIs using `GuzzleHttp`
* Cleaner and more professional HTTP requests
* Reusable API integration structure

### API Used

https://dummyjson.com/products

---

## Day 2 — Building & Securing APIs

Learned how to build secure RESTful APIs using Laravel.

### Topics Covered

* RESTful API design
* CRUD operations
* JWT authentication
* Middleware protection
* Authorization
* Validation
* Error handling
* Standardized JSON responses
* API security concepts

### Practical Work

Built a secure Posts Management REST API using Laravel and JWT authentication.

### Features

* User authentication using JWT
* Protected API routes
* CRUD operations for posts
* Authorization policies
* Validation handling
* Standardized API responses
* Professional error handling

---

# Technologies Used

* PHP
* Laravel
* MySQL
* Composer
* cURL
* GuzzleHttp
* JWT Authentication
* REST APIs
* JSON
* Postman

---

# Repository Structure

```bash
.
├── curl-app/
├── guzzle-app/
├── posts-api/
└── README.md
```

---

# How to Run Projects

# 1. Clone Repository

```bash
git clone https://github.com/YOUR_USERNAME/YOUR_REPOSITORY.git
```

```bash
cd YOUR_REPOSITORY
```

---

# Day 1 — cURL Application

```bash
cd curl-app
php -S localhost:8000
```

Open:

```text
http://localhost:8000
```

---

# Day 1 — Guzzle Application

```bash
cd guzzle-app
composer install
php -S localhost:8001
```

Open:

```text
http://localhost:8001
```

---

# Day 2 — Laravel Secure REST API

## Install Dependencies

```bash
cd posts-api
composer install
```

---

## Configure Environment

Create `.env` file and configure database settings.

Example:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=posts_api
DB_USERNAME=root
DB_PASSWORD=
```

---

## Generate Application Key

```bash
php artisan key:generate
```

---

## Generate JWT Secret

```bash
php artisan jwt:secret
```

---

## Run Migrations

```bash
php artisan migrate
```

---

## Start Server

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

---

# API Endpoints

## Public Routes

| Method | Endpoint        | Description     |
| ------ | --------------- | --------------- |
| GET    | /api/posts      | Get all posts   |
| GET    | /api/posts/{id} | Get single post |

---

## Protected Routes

| Method | Endpoint        | Description |
| ------ | --------------- | ----------- |
| POST   | /api/posts      | Create post |
| PUT    | /api/posts/{id} | Update post |
| DELETE | /api/posts/{id} | Delete post |

---

# Authentication

JWT authentication is used for protected routes.

Example Header:

```http
Authorization: Bearer YOUR_TOKEN
```

---

# Git Workflow

This repository follows a branch-based workflow:

| Branch | Description                    |
| ------ | ------------------------------ |
| day1   | API Consumption & Integration  |
| day2   | Secure RESTful API Development |

---

# Learning Outcomes

By completing this training, the following concepts were practiced:

* RESTful API design
* API consumption using PHP
* External API integration
* Secure authentication using JWT
* Middleware protection
* Validation & error handling
* Professional backend structure
* Git & GitHub workflows
* Clean code practices

---

# Notes

This repository was built for educational and training purposes as part of backend development practice.

The focus was on:

* understanding APIs deeply
* implementing clean backend logic
* practicing real-world backend workflows
* building GitHub-ready projects

---

# Author

Backend Development Training Project
Built during Web Services & APIs practical sessions.
