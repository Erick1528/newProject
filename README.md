# PHP MVC Project with SCSS and JS

This project template is a PHP MVC (Model-View-Controller) application that integrates SCSS for stylesheets and JavaScript. It requires Node.js and Composer to manage dependencies and build assets.

## Setup

### Prerequisites

Before you begin, ensure you have the following installed on your system:

- [Node.js](https://nodejs.org/) (for managing JavaScript dependencies and running build scripts)
- [Composer](https://getcomposer.org/) (for managing PHP dependencies)

### Installation Steps

1. **Clone the Repository**

   Clone this repository to your local machine:
```
git clone <repository-url>
```
### Install PHP Dependencies

Navigate to the project directory and install PHP dependencies using Composer:

```
composer install
```
### Install Node.js Dependencies

Install Node.js packages required for SCSS and JS compilation:

```
npm install
```

### Development
Compiling SCSS and JS
During development, you can compile SCSS and JS files using npm:

```
npm run dev
```

This command compiles SCSS files from src/scss to public/build/css and JavaScript files from src/js to public/build/js.

## Running the Project

To run the project locally, you'll need a PHP-capable server. Since the project is structured to serve files from the `public` directory, navigate there first:

1. **Navigate to the `public` Directory**

   Open your terminal or command prompt, navigate to your project  directory, and then change directory to `public`:

   ```
   cd public
   ```

   Start the PHP server in the public directory:
    ```
    php -S localhost:3000
    ```
Access the Project

Open your web browser and go to http://localhost:3000 to view the project.

# Notes  
Ensure your web server is configured to serve PHP files correctly.
Customize SCSS and JS files in resources/ and recompile using 
```
npm run dev 
```   
as needed.

This README provides comprehensive instructions on setting up the PHP MVC project with SCSS and JS, compiling assets, running the project locally, and additional notes for customization. Adjust the `<repository-url>` in the clone command to match your project's Git repository URL.
