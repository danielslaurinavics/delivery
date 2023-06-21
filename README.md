### Team of Developers
There is a one student participating in the development of the system:
-	Daniels Laurinavičs, dl22029 (design, business logic development, user interface design, programming of controllers and models.
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
-	List of dishes with a search box, done
-	View for creating new orders, done
-	View for restaurants adding new dishes, done
-	View for restaurants editing existing dishes, done
-	View for restaurants deleting existing dishes (used as confirmation prompt), done
-	View for giving ratings about the order (the ratings for restaurants (quality) and couriers (performance) are separate), done
-	Views for watching ratings (restaurants see their quality rating, couriers - their performance rating), done
-	View for editing user information, partially complete
-	View for admins to manage users, partially complete
-	View for admins to block users (used as confirmation prompt), done
#### Controllers:
-	LocaleController with methods of setting up the application language during the session.
-	DishController with methods for retrieving and showing list of dishes, creating and storing new dishes, returning a list of dishes filtered by search string in name of the dish.
-	OrderController with methods for retrieving and showing list of orders, creating and storing new orders, updating the order status, returning a list of pending orders to restaurants.
-	CourierController with methods of retrieving and showing list of orders ready for delivery or en route, but being delivered by the courier user.
-	RatingController with methods of assigning ratings to the order which is complete.
-	UserController with methods of editind/blocking users, changing roles of users, as well as creating restaurants and assigning them to a user, whose role is Restaurant.
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
-	Viewing their performance (restaurant rating).
#### Courier:
-	Viewing orders, which are ready for delivery,
-	Selecting orders which will be delivered,
-	Changing the order status to mark that the order is on its way/has been delivered,
-	Viewing their performance (courier rating).
#### Administrators:
-	Block users:
	- Administrators can't block administrators,
	- Blocking a user will block access to any site's services,
	- Blocking a restaurant user will delete all orders, which are not handed to delivery,
	  - Dishes from a blocked restaurant will not be available for ordering,
	- Blocking a courier will set all undelivered orders to status 'ready for delivery' (handed back to restaurant),
	  - If the restaurant is blocked as well, then the order is deleted,
-	Change user's role (initially registered users have a user role, the admin assigns the other roles)
-	Create a new restaurant and assign a restaurant account to it.
-	Viewing information about the orders.
### User Authentication
For the user authentication, it is only possible to use the local registration system.
