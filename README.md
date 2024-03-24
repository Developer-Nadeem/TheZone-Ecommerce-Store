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
- [Credits](#credits)
- [Team Members](#team-members)

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

8. Move the cloned project files to the 'htdocs' directory in your XAMPP installation folder. (Path: 'C:\xampp\htdocs')

9. Now the website is ready for local use

10. While XAMPP is running visit the following link to access the website's homepage: http://localhost/TheZone/index.php



## Database Sample Data

The database is fed with its own sample data, that being products along with their product images and other attributes.

Once you import the SQL file into the new database you create on [PhpMyAdmin](http://localhost/phpmyadmin) the SQL file executes and the data is fed to the local website.

The data includes products, product images, prices, stock and so no.


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

Scripts Used:

- https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js
- https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js
- https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js
- https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js


Links to External Stylesheets Used:

- https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css
- https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css

## Team Members

- Name: HAMZA ABDULLA,  ID: 220202983 (Backend Developer)
- Name: FARES HASSAN, ID: 220203784 (Frontend Developer)
- Name: KHIZZER HUSSAIN, ID: 210062922 (Backend Developer)
- Name: MOHAMMED HUSSAIN, ID: 220038500 (Full Stack Developer)
- Name: ZAIN HUSSAIN, ID: 210057951 (Frontend Developer)
- Name: MUHAMMAD IBRAHIM, ID: 220118581 (Frontend Developer)
- Name: AMAAN IKRAM, ID: 220183741 (Full Stack Developer)