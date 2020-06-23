# Bet 36o Pro installation guide

1. There is a .env.example in the folder root. Duplicate it and name it .env
2. Set Up your database. Get the database host, name, user, password and put them in the DB_HOST, DB_NAME, DB_USER, DB_PASSWORD .env file
    ### For example
    > DB_CONNECTION=mysql
    > DB_HOST=127.0.0.1
    > DB_PORT=3306
    > DB_DATABASE=betpro360blog
    > DB_USERNAME=liu
    > DB_PASSWORD=DFAFADR$#$

3. In your ssh client, type **php artisan migrate --seed**
4. [Sign Up](https://cloudinary.com/users/register/free) for a cloudinary account.
5. In the account details of cloudinary, you will see the details for the include them in the .env file as CLOUDINARY
    ### For example
    > CLOUDINARY_API_BASE_URL=https://api.cloudinary.com/v1_1/betpro369
    > CLOUDINARY_BASE_URL=http://res.cloudinary.com/betpro360
    > CLOUDINARY_SECURE_URL=https://res.cloudinary.com/betpro360
    > CLOUDINARY_CLOUD_NAME=betpro360
    > CLOUDINARY_API_KEY=38546748434343
    > CLOUDINARY_API_SECRET=6DhN7G4l44k4jLVMXq78s0s