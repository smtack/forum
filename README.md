# Forum

This is a simple forum application developed with CodeIgniter4. It includes an admin panel and moderator roles.

## Setup

1. Clone the repository
2. Run `composer install`
3. Copy the `.env.example` file to `.env` and update for your database
4. Run `ln -s $(pwd)/writable/uploads/avatars $(pwd)/public/avatars` to create a symlink from the uploads folder to serve user avatars
5. Run `php spark migrate` to run migrations
6. Run `php spark db:seed AdminSeeder` to create the Admin user
7. Run `php spark serve` to start the development server