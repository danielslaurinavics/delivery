# This is an experimental PHP + Laravel web application. Please, do not use it!
### Team of Developers
There is a one student participating in the development of the system:
-	Daniels Laurinavičs (design, business logic development, user interface design, programming of controllers and models.
### Development Environment
It is planned to develop this system in PHP 8.2 environment using Laravel 10 library. It is planned to use MySQL database for data storage. The code will be stored in the GitHub system.
### Main Functionality
Within the framework of the practical assignment, it is planned to develop a food delivery service system.
It will be possible for users to make food orders. The system will allow to select a specific dish from a specific restaurant and receive it from a courier to a specific address given by the user.
### Data Registry
The most significant concepts in this system: user, restaurant, dish, order, rating.
The system consists of orders, whose author is one of the users. Each order consists of information about the dish ordered and the restaurant who makes this dish. Only one restaurant can prepare that order.
The order is assigned to one courier, who is an another user. The restaurant is assigned to another user, who is its manager.
### MVC
The system will be implemented following an MVC paradigm. The system will be distributed into the following components:
#### Models:
-	User,
-	Dish,
-	Order,
-	Restaurant,
-	Rating.
#### Views:
-	List of dishes with a search box,
-	View for creating new orders,
-	View for restaurants adding new dishes,
-	View for restaurants editing existing dishes,
-	View for restaurants deleting existing dishes (used as confirmation prompt),
-	View for giving ratings about the order (the ratings for restaurants (quality) and couriers (performance) are separate),
-	Views for watching ratings (restaurants see their quality rating, couriers - their performance rating),
-	View for editing user information,
-	View for admins to manage users,
-	View for admins to block users (used as confirmation prompt).
#### Controllers:
-	LocaleController with methods of:
	- setting up the application language during the session.
-	DishController with methods for:
	- retrieving and showing list of dishes,
	- creating and storing new dishes,
    - editing, deleting dishes,
	- returning a list of dishes filtered by search string in name of the dish.
-	OrderController with methods for:
	- retrieving and showing list of orders,
	- creating and storing new orders,
	- returning a list of pending orders:
	  - for restaurants:
		- orders, which are pending, in preparation and ready for delivery,
		- ability to change status: pending => preparation, preparation => ready for delivery,
		- only orders from the restaurant the user is logged in from are seen.
	  - for couriers:
		- orders, which are ready for delivery and en route to delivery address,
		- ability to change status: ready for delivery => en route, en route => delivered (completed).
		- the courier user is only able to see:
		  - orders which are ready for delivery (can be chosen),
		  - orders which are being delivered by him/her (assigned to courier).
-	RatingController with methods for
	- assigning ratings to the orders which are complete.
	- viewing average quality rating for restaurants and average performance ratings for couriers.
-	UserController with methods for:
    - editing users,
	- blocking users,
	- editing user information,
	- changing user's password (in case the user is logged in),
	- changing roles of users,
	- creating restaurants for users whose role is changed to Restaurant.
-	Laravel standard RegisterController and LoginController.
### User Roles
The system supports a number of user roles – (registered) user, restaurant, courier, administrator. Each user has different operations available in the system.
#### User:
-	Viewing dishes available for ordering,
-	Making orders and checking their status,
-	Viewing the information about the order,
-	Add a rating about the order the user made.
#### Restaurant:
-	Add new, edit and delete existing dishes available to users,
-	Viewing pending orders for a particular restaurant,
-	Viewing the information about the order,
-	Changing the order status to mark that the order is being prepared/given to delivery,
-	Viewing their performance (restaurant quality rating).
#### Courier:
-	Viewing orders, which are ready for delivery,
-	Selecting orders which will be delivered,
-	Changing the order status to mark that the order is on its way/has been delivered,
-	Viewing their performance (courier performance rating).
#### Administrators:
-	Block users:
	- Administrators can't block administrators,
	- Blocking a user will block access to any site's services,
	- Blocking a restaurant user will delete all orders, which are not handed to delivery,
	  - Dishes from a blocked restaurant will not be available for ordering,
	- Blocking a courier will set all undelivered orders to status 'ready for delivery' (handed back to restaurant),
	  - If the restaurant is blocked as well, then the order is deleted,
-	Change user's role (initially registered users have a user role, the admin assigns the other roles)
	- Restaurants and administrators can't be assigned to a different role,
	- It's not possible to assign to administrator,
	- When a user is assigned to a Restaurant role, a new restaurant is established.
### User Authentication
For the user authentication, it is only possible to use the local registration system.
