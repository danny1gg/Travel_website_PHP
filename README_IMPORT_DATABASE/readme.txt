Travel website made with PHP- PDO

To start using this project you will need the database with the tables and colums, 
you will find them in the 'db_travel_sql'. Just follow the steps below:


========= Create database  ============
1. Create a database named 'db_travel',
========= Import tables and columns =====
2. In the folder named 'README_IMPORT_DATABASE', you will find the file 'db_travel.sql'.
3. Open MySQL Workbench / OR go to phpMyAdmin, 
4. select the new database created at step 1 (db_travel.sql), 
5.1 If you chosed to use MYSQL Workbench:
	-> Open MYSQL Workbench, 
	-> open your localhost connection or default connection, 
	-> select the database 'db_travel' (doblue click on the database from the left sidebar)
	-> on the navigatinvar-> server ->Data Import, 
	-> Import from Self->Contained File 
	-> select your the sql file from: 'README_IMPORT_DATABASE/db_travel_sql', depending on where is it stored
	-> Default Target Schema: db_travel
	->Start Import
5.2 If you chose phpMyAdmin 
	-> select database db_travel,
	-> import
	-> click on the 'Chose your file' button,
	-> select your the sql file from: 'README_IMPORT_DATABASE/db_travel_sql', depending on where is it stored
	->click on the button 'Go' (from bottom right).

=========== Set your database password ================
6. Go to the folder 'db',
7. open the file 'connection.php' with a texteditor,
8. on line 4 enter your database password between the double qoutes.

FINISH! You can now use this project with its database.

