# TheZone-Ecommerce-Store

The Zone Ecommerce store is a clothing website targetted towards 18-25 year olds, 
it sells a unique style of clothing that fits the taste of the aforementioned demographic.

## Sections

- [Project Description](#project-description)
- [Important Links](#important-links)
- [Features](#features)
- [Running Website Locally](#running-website-locally)
- [Database Sample Data](#database-sample-data)
- [Contributing](#contributing)

## Project Description

The website showcases an array of clothing products for sale. The purpose of the project is to develop 
a professional website that meets the assigned functional and non-functional requirements effectively and efficiently.

## Important Links

- [Link to Deployed Website](http://220038500.cs2410-web01pvm.aston.ac.uk/TheZone/)
- [Link to Project Version Control Repository](https://github.com/0fficialNadeem/TheZone-Ecommerce-Store.git)
- [Link to Install XAMPP to Run Website Locally](https://www.apachefriends.org/download.html)

## Features

Customer Side (Summary): 

1. Registering and creating an account
2. Logging into your created account
3. Browsing through categories of clothing products
4. Viewing Different products
5. Choosing products to buy by adding to the cart
6. Purchasing the chosen products 
7. Completing a full order of chosen products


Admin Side (Summary):

1. Register and sign in as an admin
2. View, edit, add and remove from each of the following:
    2.1. Inventory (Products)
    2.2. Registered Users (Customers)
    2.3. Orders (Orders placed by customers)
3. Access an overview of recent orders made, current orders being processed and stock level 
4. Navigate and view the website normally, as a customer would

## Running Website Locally

1. Install the XAMPP Application - [Link to Install XAMPP](https://www.apachefriends.org/download.html)

2. Clone the repository:
```bash
git clone https://github.com/0fficialNadeem/TheZone-Ecommerce-Store
```

3. Once XAMPP Installation concludes, execute and open the application

4. Start running {Apache} and {MySQL}

5. Visit PhpMyAdmin using the link: [PhpMyAdmin](http://localhost/phpmyadmin)

6. Open a new database and name it {theZone_db}

7. Import the [Database SQL File](thezone_db.sql) into the database you created

8. Now the website is ready for local use

9. While XAMPP is running visit the following link to access the website's homepage: http://localhost/TheZone/index.php



## Database Sample Data

The database is fed with its own sample data, that being products along with their product images and other attributes.

Once you import the SQL file into the new database you create on [PhpMyAdmin](http://localhost/phpmyadmin) the SQL file executes and the data is fed to the local website.


## Contributing

If you would like to contribute to the project, please follow these steps:

1. Fork the repository
2. Create a new branch (`git checkout -b feature/your-feature`)
3. Make your changes
4. Commit your changes (`git commit -am 'Add new feature'`)
5. Push to the branch (`git push origin feature/your-feature`)
6. Create a new Pull Request

## Credits

The Zone website project uses the following external resources and libraries

    - Bootstrap (HTML Framework)
    - Freepik (For product photos)