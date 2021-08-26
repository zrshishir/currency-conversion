# P2P Wallet (Pay) System
    A Simple app that convert currencies from USD to EUR and vice-versa.

# Overview:
    The app goal is to build a simple P2P wallet (Pay) system.

## Scenario:
    There are two registered users with a single currency based wallet. User
    A has a USD and user B has a EUR wallet. User A can send any amount of money
    to user B in USD currency. This USD amount will be converted to EUR and
    transferred to user B wallet. In the meantime, a confirmation email will be sent to
    user B.

    You will find detailed requirements below. To be successful you don’t have to follow
    them strictly. Invest reasonable time depending on your free time and don’t worry if
    you can’t finish it all. Focus on the quality of your code, not on the number of
    tasks. Make it readable, expandable and production-ready. Make sure you deal
    with possible errors etc. Please read the requirements and additional
    requirements carefully.

    Feel free to ask any questions. Write down any significant problems you
    encountered. Let us know how you solved them or how you would tackle them if you
    had more time.

## Requirements:
    ❖ Use Laravel / Lumen RESTful
        API to develop this currency conversion application.
    ❖ Using Passport authentication feature to make API secure.
    ❖ Each user will have only one single currency based wallet.
    ❖ The system should also display the following stats:
        ❏ User who used most conversion.
        ❏ The total amount converted for a particular user.
        ❏ Show the third highest amount of transactions for a particular user
            (must use subquery).
    ❖ Have to calculate and store data in the database to show stats properly.
    ❖ Prefer to use a MySQL database for storing user’s data and stats.
    ❖ For interface design using any appropriate responsive design template.
    ❖ In the backend, using an external API to get the currency rates (https://openexchangerates.org).
    ❖ Trying to use any design pattern with the latest Laravel features.
    ❖ Trying to follow SOLID design principles for your coding.
    ❖ Make sure to write a PHPUnit test for the application.

## Additional Requirement for currency exchange rate: 
    ❖ Currency rates APIs:
        ❏ https://openexchangerates.org

## Tech Specifications
	- "php": "^7.4|^8.0".
    - "laravel/framework": "^8.56".


### Features
	1. Passport Generated Token
		- token validation checking and responses through middleware
	2. Database migration
	3. Authentication
		- all possible responses
		- Validation for login
		- all possible responses for invalid login and signup
	4. https://openexchangerates.org api integration
    5. Currency Conversion
    6. Reports
### Diagrams
    * System diagram:
![system diagram](/screenshots/system_architecture.png)

    * Database diagram:
![database diagram](/screenshots/database_diagram.png)

## Working Procedure
        - By default users are created when we run the command `php artisan db:seed`.
        - User will log into the system and convert currency to another user.
                * System will check all validations and request to `https://openexchangerates.org` with app id set on `config/currency_rate.php` to get all updated currency rate based on `USD`.
        - User will see the reports without authentication.

## Attachment
	- Json file of postman api collection in the root directory named `currency convert.postman_collection.json`

## Project setup
	Project setup details are described below step by step: The front end project for this project is https://github.com/zrshishir/currency-conversion-frontend. First, follow these steps then front end  steps
		1. Download or clone the project from [currency conversion](git@github.com:zrshishir/currency-conversion.git).. 
		2. Go to the project's root directory and run the command `composer install` or `composer update`.
		3. After successfully composer updation set up your database credentials on .env file.
        4. Set your app_id for currency rates api from https://openexchangerates.org.
        5. Set you smtp email configuration on .env file from https://mailtrap.io/ to send confirmation email
		6. Run the command `php artisan migrate`
		7. Run the command `php artisan passport:install`
		8. Run the command `php artisan passport:key`
		9. Run the command `php artisan db:seed`
		10. If you need to rollback the database, just run the command `php artisan migrate:rollback`
		11. If you are using LEMP stack then follow proper steps [here](https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-ubuntu-18-04) and if you are using other then run the command `php artisan serve` to get the domain name or service url that will have to be assigned in the [frontend code](git@github.com:zrshishir/) `/src/api/product-frontend.js` ROOT_URL const.


### Screenshots of project setup procedure details
	The working procedure is described below with screenshots:
	1. To install this project you will have composer installed. You can install this project two ways
		- Download the zip file from the repository and extract it on your pc

		- clone the project using git and the command is `git clone git@github.com:zrshishir/currency-conversion.git`. 

![git clone](/screenshots/project_config/git_clone.png)

	2. Go to the project's root directory 

![go to root directory](/screenshots/project_config/go_to_project.png)

	3. run the command `composer update` or `composer install` and configure your database on .env file

![composer upate](/screenshots/project_config/composer_update.png)

![db set up](/screenshots/project_config/database_config.png)

    4. api credentials for https://openexchangerates.org to get updated currency rates. To do so, edit 'config/currency_rate.php'
![currency rate config](/screenshots/project_config/config_currency_rate.png)

	5. edit your .env file to complete smtp mail server setup

![smtp configuration](/screenshots/project_config/smtp_config.png)

    6. Run the command `php artisan migrate`

![migration](/screenshots/project_config/migrate.png)

    7. Run the command `php artisan passport:install`

![passport installation](/screenshots/project_config/passport_install.png)

    8. Run the command `php artisan passport:key`

![passport key](/screenshots/project_config/passport_key.png)

    9. Run the command to seed database `php artisan db:seed`

![database seeding](/screenshots/project_config/db_seed.png)

	10. Run the command `php artisan serve` and use this link on the postman url

### Some screenshots of the project postman api: As I use LEMP stack for my local server environment, I have used domain name in the url
#### you can use localhost or ip. I have attached postman json file for the project. You can use it also.
	1. Login field validation response

![Login field validation response](/screenshots/api_details/login_field_validation.png)

	2. Login email validation response

![Login email validation response](/screenshots/api_details/login_email_validation.png)

	3. Login user not exist response

![Login user not exist response](/screenshots/api_details/login_user_not_exist.png)

	4. Login successfull response

![Login successfull response](/screenshots/api_details/login_successfull.png)

	5. Logout successfull response

![Logout successfull response](/screenshots/api_details/logout_successfull.png)

    6. Currency Conversion: Response for invalid receiver ID

![Response for invalid receiver ID](/screenshots/api_details/cc_invalid_receiver_id.png)

    7. Currency Conversion: Response for checking balance availability

![Response for checking balance availability](/screenshots/api_details/cc_check_balance.png)

    8. Currency Conversion: Response for invalid app id for open exchange rate api call

![Response for invalid app id for open exchange rate api call](/screenshots/api_details/cc_invalid_appid_exchange_rate.png)

    9. Currency Conversion: Response for successfully currency conversion

![Response for successfully currency conversion](/screenshots/api_details/cc_conversion_successfull.png)

    10. Currency Conversion: Confirmation email on mailtrap.io inbox

![Confirmation email on mailtrap.io inbox](/screenshots/api_details/mailtrap_email_inbox.png)

    11. Currency Conversion: Open Exchange Rate API Status `https://openexchangerates.org/`

![Open Exchange Rate API Status](/screenshots/api_details/openexchangerate_api_activity.png)

    12. Transaction: Transaction api with data

![Transaction api with data](/screenshots/api_details/transaction_with_data.png)

    13. Transaction: Transaction api without data

![Transaction api without data](/screenshots/api_details/transaction_without_data.png)

    14. Currency Conversion Report: Reports on most conversion and total amount converted for a particaular receiver

![Reports 1](/screenshots/api_details/report_data_1.png)

![Reports 2](/screenshots/api_details/report_data_2.png)

    15. Currency Conversion Report: Reports on third highest amount of transactions for a particular user

![Reports 3](/screenshots/api_details/report_data_3.png)

    16. Running test script

![Running test script](/screenshots/running_test_command.png)
