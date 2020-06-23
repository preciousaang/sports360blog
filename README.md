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

6. Check the config list below and replace in value of the config key in the .env file where necessary.

    - APP_DEBUG:                false
    - APP_KEY:                  base64:jfNQGQN9ifOXqO1s2N2bW2G+R51nt1D4zQmcRIl/Asw=
    - APP_NAME:                 "Bet Pro 360 Blog"
    - APP_POST_URL:             https://bet360pro.herokuapp.com/post/ >> This should be changed to your domain /post/

    ### For Example
    > APP_POST_URL=http://betpro360blog.com/post/

    - BROADCAST_DRIVER:         pusher    
    - FACEBOOK_ACCESS_TOKEN:    EAAEaHZBC8jsoBACzZAf9uKLcETqgHIABZB7NvuazmQbZBjuQP3Fg9Ure9NZCetgZBlGUc5IZAke3PZCwtOrd8eV7uUpk9CtZCUq1bfXfxGzZA8wrOXDVZCEZBFvIyPYkZAZAAvEkqsznHCgXQ7eAUBLMd5vYBEFZAsBZBRaeZCAJaHBkJLdZAKZCh7XbNGUjlBvFWadjwlrZB6EZD
    - FACEBOOK_APP_ID=310199193472714
    - FACEBOOK_APP_SECRET=5e70f1aa285bc59f71650f0f8792397f    
    - MAIL_DRIVER=smtp
    - MAIL_ENCRYPTIONnull=
    - MAIL_FROM_ADDRESS=contact@betpro360.com
    - MAIL_FROM_NAME=BetPro360
    - MAIL_HOST=mtp.sendgrid.net
    - MAIL_PASSWORD=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
    - MAIL_PORT=587
    - MAIL_USERNAME=apikey
    - MIX_PUSHER_APP_CLUSTER=eu
    - MIX_PUSHER_APP_KEY=0adf5c59e67306d7842a
    - NPM_CONFIG_PRODUCTION=false
    - PUSHER_APP_CLUSTER=eu
    - PUSHER_APP_ID=1021612
    - PUSHER_APP_KEY=0adf5c59e67306d7842a
    - PUSHER_APP_SECRET:=fa1b2f49669b3ec55df8
    - SANCTUM_STATEFUL_DOMAINS=bet360pro.herokuapp.com >> This should be changed to your domain
    ### For example
    > SANCTUM_STATEFUL_DOMAINS=betpro360blog.com >> ** Note no http:// in front of the url ***
    - SESSION_DRIVER=cookie
    - SESSION_LIFETIME=240

7. Go into the folder resources >> js , edit the bootstrap.js file change the window.axios.defaults.baseURL value to https://your-domain/api
    ### For Example
    > window.axios.defaults.baseURL="https://betpro360.com/api"
