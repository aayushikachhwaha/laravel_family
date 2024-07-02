# laravel_family
Laravel project to add families with one person as family head. [family details, add more member, add more hobbies, image upload, validations]

# Problem Statement
The client wants to collect family information about his community. Please develop a form which should

1. There should be one head of the family. 
Name
Surname
Birthdate - Only accept if this is above 21 years
Mobile No
Address
State <drop down>
City  <drop down>
Pincode
Marital Status
 - Is Married  -  If Yes, then ask for the Wedding date 
 - Is Unmarried  - Then do nothing
Hobbies 
- Allow adding multiple hobbies with Add Hobby button
Photo

Then add family members  - Can add any number of a family member
- Name
- Birthdate 
- Marital Status 
- Is Married  -  If Yes, then ask for the Wedding date 
 - Is Unmarried  - Then do nothing
Education
Photo 

Display family head List with family member's count and click on count display family details. 

# Installation steps:- 

# install dependencies
composer install

npm install

# env
copy envexample file to a new env file on root

# create database
create database named 'myfamily'

# generate tables
run 'php artisan migrate' to add tables to the database

# add data to tables
To add data to the tables, run seeders - 
php artisan db:seed --class=StateSeeder
php artisan db:seed --class=CitySeeder
php artisan db:seed --class=FamilySeeder

# run the application
run 'npm run dev' 
run 'php artisan serve' to run the application
