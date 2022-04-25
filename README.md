# PHPcrud
 PHP CRUD application with connection to a MySQL database using PDO. It uses sessions and POST-REDIRECT in most instances to avoid double actions.

This was the final assignment for my PHP certification on Coursera with the University of Michigan.

I will provide a brief explanation of all the files below:

pdo.php
This contains the database connection string using PDO. PDO is a more advanced library that the regular mysql() and msqli() functions.

index.php
This is the landing page. It first checks for a valid login and if the user is not logged in then the page will display a link to the login page.
If the user is logged in then the page will retreive a list of cars stored in the MySQL database and display it ina table format.

login.php
This is the login script. It first validates the format of the email and if the email and password are correct then the script stores the login details in the account session. The user then redirected to the index.php page.

add.php
Here the user can add a new vehicle to the database. There is some simple validation that checks for the correct data types in the text boxes before it is added to the database.

edit.php
The user can make changes to the entries in the database. The script first retreives the particular entry based on its unique identifier and displays it in textboxes. The user can then make changes to this data before commiting it to the database.

delete.php
The dlete.php script first retreives the details of the entry that the user wants to delete and asks the user to confirm that they indeed want to delete it. If the user clicks on yes then the entry is deleted from the database and the user is redirected to the index.php page.
