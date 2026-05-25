# Posts Management API (Laravel + JWT)

A secure RESTful API for managing posts with JWT authentication.

## Features

- CRUD for posts
- JWT authentication (tymon/jwt-auth)
- Consistent JSON responses
- Form Request validation
- Proper authorization (only owners can update/delete)

## Requirements

- PHP 8.2+
- Composer
- Database (MySQL, PostgreSQL, or SQLite)

## Setup

1. Install dependencies:
    - `composer install`
2. Copy environment file and set database credentials:
    - `cp .env.example .env`
3. Generate app key and JWT secret:
    - `php artisan key:generate`
    - `php artisan jwt:secret`
4. Run migrations:
    - `php artisan migrate`
5. Start server:
    - `php artisan serve`

## Authentication

- Login endpoint: `POST /api/auth/login`
- Use `Authorization: Bearer <TOKEN>` for protected endpoints.

## API Endpoints

### Auth

- `POST /api/auth/login` (public)
- `POST /api/auth/logout` (protected)
- `POST /api/auth/refresh` (protected)
- `GET /api/auth/me` (protected)

### Posts

- `GET /api/posts` (public)
- `GET /api/posts/{id}` (public)
- `POST /api/posts` (protected)
- `PUT /api/posts/{id}` (protected)
- `DELETE /api/posts/{id}` (protected)

## Response Format

**Success**

```json
{
    "success": true,
    "data": {},
    "message": "Operation successful"
}
```

**Error**

```json
{
    "success": false,
    "message": "Validation Failed",
    "errors": {}
}
```

## Example Requests

### Login

```bash
curl -X POST http://127.0.0.1:8000/api/auth/login \
	-H "Content-Type: application/json" \
	-d '{"email":"user@example.com","password":"password"}'
```

**Response**

```json
{
    "success": true,
    "data": {
        "token": "<JWT_TOKEN>",
        "token_type": "Bearer",
        "expires_in": 3600
    },
    "message": "Login successful"
}
```

### Create Post

```bash
curl -X POST http://127.0.0.1:8000/api/posts \
	-H "Authorization: Bearer <JWT_TOKEN>" \
	-H "Content-Type: application/json" \
	-d '{"title":"First Post","content":"Hello world"}'
```

**Response**

```json
{
    "success": true,
    "data": {
        "id": 1,
        "title": "First Post",
        "content": "Hello world",
        "user_id": 1,
        "created_at": "2026-05-25T10:00:00.000000Z",
        "updated_at": "2026-05-25T10:00:00.000000Z"
    },
    "message": "Post created successfully"
}
```

### Update Post

```bash
curl -X PUT http://127.0.0.1:8000/api/posts/1 \
	-H "Authorization: Bearer <JWT_TOKEN>" \
	-H "Content-Type: application/json" \
	-d '{"title":"Updated","content":"Updated content"}'
```

### Delete Post

```bash
curl -X DELETE http://127.0.0.1:8000/api/posts/1 \
	-H "Authorization: Bearer <JWT_TOKEN>"
```

## Authorization Rules

- Users can create posts.
- Users can update/delete only their own posts.
- Others receive `403 Forbidden`.

## Notes

- Ensure users exist in your database before logging in.
- You can create users via Tinker or a seeder.

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
