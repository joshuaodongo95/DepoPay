### DepoPay

#### Problem Statement

Many individuals/organizations desire to acquire quality items for their day to day activities yet have less money at hand to pay in a lump sum amount and therefore opt for the cheaper less quality options in the market.

#### Objective

DepoPay seeks to provide individuals/organizations with a platform where they can deposit money to purchase goods at 3 or 4 partial payment installments from known suppliers.
Overview
The admin lists supplier items eligible for partial payment arrangements on the platform
The clients browse through the list of available items to make a subscribe order.
To make a Subscribe order & Save subscription:
• Client finds a subscribe eligible item.
• Client selects preferred quantity
• Client selects the Subscribe & Save option and selects Subscribe Now.
• Client reviews order details.
• Client selects available payment plan for their subscription order
• Client confirms subscription order.
The client keeps depositing money on the suppliers’ wallet to complete the order payment
The order will be delivered after completion of the payments. The client will be unsubscribed from item after delivery of item.

#### Features

1. User registration, authentication and authorization:
   Allow users to register using their mobile numbers and passwords.
   Allow admin to add suppliers
   Implement authentication and authorization to secure user accounts.

2. Inventory:
   Allow admin to manage products, listings, categories and prices

3. Balance Check:
   Fetch and display users account balance

4. Deposit Money:
   Allow users to deposit money on supplier’s wallet using generated QR code or payment link
5. Receive Money:
   Enable supplier to initiate payment or generate a QR code or a payment link for to receive deposit money from client

6. Transaction History:
   List of recent transactions
   Details like transaction type, date, and amount, balance due

#### Implementation

1. MoMo API integration:
   Implementation of API calls for balance check, deposit money, receive money, and transaction history.
   Handle API responses and errors

2. Notifications:
   Send push notifications for successful transactions and other important updates.

3. Security:
   Implementation of secure token-based authentication for API requests.
   Encryption of sensitive user data stored in the app.

4. User authentication:
   Implementation of user registration and login functionality
   Use of token based authentication for API requests

5. QR Code generation:
   Integration of a QR code generator library to create QR codes for receiving money.

6. Error handling:
   Provide meaningful error messages for failed transactions or API errors.

7. Testing:
   App testing on different devices and scenarios.
   Debugging and fixing of any issues.

8. Web/mobile user interfaces:
   These will enable users to browse through to find eligible items to subscribe for partial payment plan.
   Admin to manage the vendors/manufacturers, users and products listings.
   Supplier to manage account profile and product subscriptions.
   User to manage account profile and subscriptions.
   React framework will be used for web frontend.
   Flutter for mobile clients.

9. Data storage:
   Data storage will be implemented with MySQL or PostgreSQL

10. Backend API:
    PHP Laravel framework or NodeJs will be used for handling data logic and API endpoints.

11. Version Control:
    Git and GitHub for version control

#### Applications

-   Purchase of personal accessories e.g. phones, laptops,
-   Purchase of household items e.g. TV’s, Sound
-   Purchase of company equipment e.g. cars, computers

#### Revenue

-   Transaction fees
-   Sales commissions

#### Installation

Clone the project `git clone git@github.com:joshuaodongo95/DepoPay.git`

Run `cp .env.example .env` file to copy example file to `.env`

Then edit your `.env` file with DB credentials and other settings.

Run `composer install` command

Run `php artisan migrate --seed` command.

Notice: seed is important, because it will create the first admin user for you.
Run php artisan key:generate command.

If you have file/photo fields, `run php artisan storage:link` command.

Default credentials

`Username: admin@admin.com`

`Password: password`
