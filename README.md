# 414Video
![alt text](http://scottschmeling.com/414Video/img/logo.png)


A php site made for a class. The project was for a fictional Video Rental Store

For the project, no frameworks, CMS, or Javascript was allowed to be used.

Also included is DDL and Insert statements to view how the Database is structured.
Removed passwords and encryption methods.

## [Site in function](http://scottschmeling.com/414Video/)

## Business Case:
414 Video (414) is a small video rental store on the southside of Milwaukee. 414 has a large collection of DVD’s and Blu-rays available for the customers to rent; some of which are rare or not offered on most streaming services. 414 keeps records of their stock in a spreadsheet. Customers often call 414 to check availability of movies and reserve them.  

There have been complaints from customers and staff. Staff complains that they answer the phone too much to answer simple questions, and that it hinders them from doing other work. The customers complain that they have no way to know what’s in-stock and when they try to call, the phone line is often busy and they cannot get a hold of the store. When they do get a hold of 414 and reserve a movie, the movie reservation is often not kept because 414 does not have an official way of recording reservations.  

The owner of 414 wants to update their website with a system to keep track of their stock and reservations. They want a way for customers to check the available movies and to reserve them. The staff needs a way to look up all reservations, and to be able to add movies to the inventory. 414’s revenue is derived almost entirely from movie rentals, increasing the ease to rent movies will increase the likelihood of continued rentals and quantity of rentals. 

## System Manuel
### Cusomors:
The first level of user, the customer has the least ability in the system. Customers are the only user level not employed by the system owners and therefore lack the ability to affect the backend of the system. They have the ability to independently sign up and use the reservation system with the following actions: create account, change password, search movie, reserve movie, and cancel reservation. 

#### Create Account:   
To create a new account, click the “Account” link on the header. A login form will appear on screen. Under the “Login” button, there is a link with the text “Don’t have an account?”. Clicking the link will open the registration form.   
Once on the registration form, enter all the required information, then click the “Register” button. If any form is left blank, the username is already taken, or the passwords did not match; the registration process must be restarted.  

#### Login:   
To login, click the “Account” link on the header. The login form will appear on screen. Enter a username and password of a created account and click the "login” button. If the username and password are correct, the account will be logged in.  

#### Logout:   
To logout, an account must be logged in first. Click the “Account” link on the header. The Account Settings will appear on screen. Under the “Hello FirstName” there is a “logout here” link. Click the link to log out.  

#### Change Password:
To change the password, an account must be logged in first. Click the “Account” link on the header. The Account Settings will appear on screen. On the left side, under the “Hello” message; there is a change password form.  
Enter the old password of the account, and enter the new one and confirm it. If everything was entered correctly, a message “Your password has been updated” will appear above the form.  

#### Search Movie:   
To search, click the "Search” link on the header. A screen with a search bar and a list of the movies will appear on the screen.  
The list can be filtered by title, genre, or platform. To filter by title, type text into the search bar. To filter by genre or platform, there are two drop down menus next to the search bar. Click “Filter by Genre” to view the possible options that can be selected and select the desired option. Do the same for “Filter by Platform”. Once all of the filters are filled out, click the “Enter” button to search and filter the list.  

#### Reserve Movie:   
To reserve a movie, click the "Search” link on the header. You can either select one of the movies from the list or can perform a search to narrow down the selection. Once a movie is selected, click the “View Availability” link next to the movie that was selected.  
The link will open a page that will list the dvd’s or blu-rays of the movie that are available to reserve. It will display  “Sorry None Available” if no item is available to reserve. If there are any available items, click the “Reserve Movie” link next to the item to reserve that item.   
The link will reserve the movie for the user and display “Congrats, you reserved the movie”. There is a limit of three movies per user and an user must be logged in to reserve a movie.  

#### Cancel Reservation:   
To cancel the reservation, an user must be logged in. Click the “Account” link on the header. The Account Settings will appear on screen. On the right side of the screen, there is a list of movies that the user has reserved or rented. If the movie is reserved, it will have a “cancel” link next to it. Click the link to cancel the reservation for the movie. Rented movies cannot be cancelled by customers. 

### Staff 
The second level of user, the staff has a moderate ability in the system. Staff are the workforce of the system and are the most common users with access to the backend of the system. They have the ability to perform all actions of customers as well as manipulate transactions and movies with the following actions: create movie, update movie, and update transaction.

#### Create Movie:
To create a new movie to add to the inventory, click the “Staff” link on the header. This will load the Staff Control Panel. On the right side of the screen, there is an “Add Movie” form. Fill out all the information to add the movie to the inventory. The YouTube link should be to the trailer of the movie. Once all of the information has been entered, click the “Add Movie” button. If all of the information was filled out, the system will load the availability page for that movie, displaying the new movie that was just added.

#### Update Movie:   
To update a movie, go to the search page and click the “view availability” link of the movie that needs the edit. On the availability page, there is a “change” link next to the “Reserve Movie”. Click the “Change” link to load the Update Movie form. The link only appears if a staff member or admin is logged in.  
The form is already filled out with the movie’s information. Change any of the information shown for it to be updated. Click the “Update Movie” button to commit the update. The changes only happen if all the information is filled out and there has been at least one change.  

#### Update Transaction:   
To update a transaction, click the “Staff” link on the header. This will load the Staff Control Panel. On the left side of the screen. There is a list of all reserved and rented transactions. On the right ride of the list, there are 2 links. Depending on the state of the transaction, the first link will be different.   
If the transaction is reserved, the link will be “rent”; if the transaction is rented, the link will be “return”. Clicking the "rent” link, will update the transaction from reserved to rented and the link will change to “return” on the list. Clicking the "return” link, will update the transaction from rented to returned and the transaction will be removed from the list because the transaction has been completed.  
The second link on the right side of the list is “cancel”. Clicking the “cancel” link will cancel the transaction and remove it from the list because the transaction no longer exists.

### Administrator 
The third level of user, the administrator has the highest ability in the system. Administrators regulate the staff in the system and have the responsibility of control over the system. They have the ability to perform all actions of staff as well as manipulate users with the following actions: add user and update user. 

#### Add User:   
To add a new staff or admin user, click the “Admin” link on the header. The Admin Page will load. On the left side of the screen, there is an “Add User” form. This process is very similar to registering a new account. All the information would need to be filled out so the user can be added. The main difference is that there is a drop down menu for user type at the top of the form. There “customer”, “staff”, or “admin” can be selected, selecting one of those will make the new account that type of user. Once all the information has been filled out, click the “Add User” button. If everything was a success, the user should appear on the list to the right of the screen.  

#### Update User:   
To update a user, click the “Admin” link on the header. The Admin Page will load. On the right side of the page, there is a list of all the registered users. Each user a “edit” link on the right side of the list. Clicking the “edit” link will load a page with a form to edit that user.  
The form is already filled out with information of the user. Change the information filled out to update that information. There is a drop down menu with the selection of different user types, change the selected user type to change the current type of the user. Once all of the information has been entered, click the “update user” button to commit the changes of the user. The list should be updated with the user’s new information. 
