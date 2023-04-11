# Fruit-Test
Test that follows the guidelines of using PSR-12 for PHP and JavaScript Standard Style for JS, with Symfony for the backend and VueJS for the frontend

## Installation and startup requirements.
- Install PHP8.1 or higher
- Install Composer
- install Symfony CLI(install scoop)

# Setting up Symfony Backend Part

- git clone
- composer install 

------DataBase Setting up----------

- env
MAILER_DSN=sendmail://default

- env.local
DATABASE_URL="mysql://<username>:<password>@127.0.0.1:3306/<database name>?serverVersion=8&charset=utf8mb4"
For example : DATABASE_URL="mysql://test:test@127.0.0.1:3306/test?serverVersion=8&charset=utf8mb4"

-Install nelmio cors-bundle package for cors issue

composer require nelmio/cors-bundle


- php bin\console doctrine:migrations:migrate
- php bin\console fruit:fetch
- symfony server:start

# Setting up Vue(TypeScript + TailwindCSS) Front-End Part

- npm install
- npm run dev

# Run and Build

"dev": "npm run frontend:dev & npm run backend:dev",
"build": "npm run frontend:build && npm run backend:build",
"frontend:dev": "cd Fruit-app && npm run dev",
"frontend:build": "cd Fruit-app && npm run build",
"backend:dev": "cd Fruit-backend && symfony server:start -d",
"backend:build": "cd Fruit-backend && composer install --no-dev --optimize-autoloader"

npm run build
npm run dev