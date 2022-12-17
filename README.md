## Larapost

A simple blog API that provides connection for the frontend. This is just a simple test to understand building API in Laravel as an assessment test for a confidential company. This API consist of:

- Basic Auth using Bearer token.
- 3 user levels: admin, manager, and poster.
- Poster can only manage its own posts.
- Manager can CRUD all posts.
- Admin can manage all posts and users.

To install this API, you need to do the following steps:

- Install all dependencies by running `composer install`
- Copy `.env.example` file as `.env`, and adjust its DB connection
- Run migrations and seeders
- Cheers

## License

You are free to copy, edit, or even distribute it for whatever reasons :)