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
	'np' => 'New password',
	'cp' => 'Confirm password',
	'return' => 'Return',
	'namereq' => 'The "Name" field cannot be empty!',
];