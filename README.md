## About
It's a packaging system for condos/apartments, the reception office will receive the package, and the receptionist will add the package and assign it to the correct apartment.

Users can only see the packages assigned to them.

Staff can see, create, and edit packages.

Admin can also delete packages, and edit users.

### Built with Laravel 9, Vue 3, Inertia


## Progress
• create Package model/resource

• custom request with custom error messages

• generate resources

• create policy

• factory/seed for users & packages

• CRUD packages

• install @vueform/multiselect

• CRUD staff/users (admin)

• tests

• email

• job/queue

## Requirements
• PHP 8.0 or higher

## How to install?
Clone the repository

`git clone git@github.com:FaycalBoutam/package-system.git`

Cd to the package-system directory

`cd package-system`

Install composer

`composer install`

Create the .env file by duplicating the .env.example file

`cp .env.example .env`

Set the APP_KEY value

`php artisan key:generate`

Clear your cache & config (OPTIONAL)

`php artisan cache:clear && php artisan config:clear`

Run both these cmds

`php artisan serve`

`npm run dev`


User (can only see their packages):

email: user@email.com pass: user123

Staff (can see all packages, add & edit them):

email: staff@email.com pass: staff123

Admin (like staff but can delete packages & edit users):

email: admin@email.com pass: admin123


## To do 
. create middleware for admin for dashboard

