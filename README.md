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
-	List of dishes with a search box,
-	View with information about a particular dish,
-	View for creating new orders,
-	View for restaurants adding new dishes,
-	View for changing status of the order (e.g., pending => order received => order given to delivery => order delivered),
-	View for restaurants deleting existing dishes,
-	View for giving ratings about the order (the ratings for restaurants and couriers are separate),
-	View for blocking users.
#### Controllers:
-	DishController with methods for retrieving and showing list of dishes, creating and storing new dishes, returning a list of dishes filtered by search string in name of the dish.
-	OrderController with methods for retrieving and showing list of orders, creating and storing new orders, updating the order status, returning a list of pending orders to restaurants.
-	CourierController with methods of retrieving and showing list of orders ready for delivery and selecting the order to deliver.
-	RatingController with methods of assigning ratings to the order which is complete.
-	UserController with methods of editing and blocking users, as well as creating restaurants and assigning them to a restaurant role user.
-	Laravel standard RegisterController and LoginController.
### User Roles
The system supports a number of user roles – a visitor, registered user, restaurant, courier, administrator. Each user has different operations available in the system.
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
#### Courier:
-	Viewing orders, which are ready for delivery,
-	Selecting orders which will be delivered,
-	Changing the order status to mark that the order is on its way/has been delivered.
#### Administrators:
-	Block users (admins can't block admins)
-	Change user's role (initially registered users have a user role, the admin assigns the other roles)
-	Create a new restaurant and assign a restaurant account to it.
-	Viewing information about the orders.
### User Authentication
For the user authentication, it is only possible to use the local registration system.
