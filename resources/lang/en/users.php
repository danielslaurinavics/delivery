<?php
return [
	// Page headings
	'title' => 'Manage users',	
	// Table headings
    'ID' => 'User ID',
	'email' => 'User e-mail address',
	'name' => 'User name, surname',
	'blocked' => 'Blocked?',
	'bl-yes' => 'Yes',
	'bl-no' => 'No',
	'role' => 'User role',
	'ass-rest' => 'Assigned restaurant (if restaurant role)',
	'actions' => 'Actions',
	// User roles
	'user' => 'User',
	'restaurant' => 'Restaurant',
	'courier' => 'Courier',
	'admin' => 'Administrator',
	// Options
	'block' => 'Block user',
	'unblock' => 'Unblock user',
	'chrole' => 'Switch role',
	
	// Block users prompt
	'blockt' => 'Block user :name',
	'are-u-sure' => 'Are you sure to block user :name?',
	'yes' => 'Yes',
	'no' => 'No',
	
	// Block explanation
	'explintro' => 'By doing this:',
		// For user block
		'loseaccess' => 'The user will lose rights to use all delivery.lv services',
		// For restaurant block
		'restlose' => 'Restaurant will lose rights to process orders, as well as add/edit/delete dishes',
		'delorders' => 'All orders, which have not been handed to delivery, will be deleted',
		'unavdish' => 'Users will not be able to order dishes from this restaurant',
		'unavvdish' => 'Users will not see dishes made by that restaurant',
		// For courier block
		'courlose' => 'Courier will lose rights to deliver orders',
		'movorders' => 'All orders, which were handed in to the blocked courier and have not been completed, will be handed back to the restaurant for another courier to deliver',
		// For admin block - which is not possible :)
		'block-admin' => 'How did you get here? You cannot block an administrator! The option "Yes" has been disabled!',
		
	// Change user data
	'chutitle' => 'Change information of user :name',
	'yname' => 'Your name, surname',
	'yemail' => 'Your e-mail address',
	'yrole' => 'Your role in the system',
	'confirm' => 'Change information',
	'chp' => 'Change password',
	'chpe' => 'The new password must be at least 8 characters long!',
	'op' => 'Current password',
	'np' => 'New password',
	'cp' => 'Confirm password',
	'return' => 'Return',
	'namereq' => 'The "Name" field cannot be empty!',
	
	'opreq' => 'You have not entered the current password!',
	'npreq' => 'You have not entered the new password!',	
	'npconf' => 'The new password and its confirmation does not match!',
	'npmin' => 'The new password must be at least 8 characters long!',
	'opw' => 'The current password is incorrect!',
	
	'chrolet' => 'Change role for user :name',
	'usercode' => 'User ID - :id',
	'currrole' => 'Current role - :role',
	'chroleq' => 'To which role you want to switch that user to?',
	'cannotchange' => 'It is not possible to change the role for this user!',
	
	'crrest' => 'Create a restaurant',
	'crreste' => 'Since you want to assign the Restaurant role to user :name, 
	you must create a restaurant!',
	'crname' => 'Name of the restaurant',
	'craddr' => 'Address of the restaurant',
	'crman' => 'Manager of the restaurant',
	'crconf' => 'By doing this, the role of that user will be changed to "Restaurant". This action cannot be undone.',
	'crconf2' => 'Do you want to continue?',
];