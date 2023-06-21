<?php
return [
	// Page headings
	'title' => 'Pārvaldīt lietotājus',	
	// Table headings
    'ID' => 'Lietotāja ID',
	'email' => 'Lietotāja e-pasts',
	'name' => 'Lietotāja vārds, uzvārds',
	'blocked' => 'Bloķēts?',
	'bl-yes' => 'Jā',
	'bl-no' => 'Nē',
	'role' => 'Lietotāja loma',
	'ass-rest' => 'Restorāns (ja restorāna konts)',
	'actions' => 'Darbības',
	// User roles
	'user' => 'Lietotājs',
	'restaurant' => 'Restorāns',
	'courier' => 'Kurjers',
	'admin' => 'Administrators',
	// Options
	'block' => 'Bloķēt lietotāju',
	'unblock' => 'Atbloķēt lietotāju',
	'chrole' => 'Mainīt lomu',
	
	// Block users prompt
	'blockt' => 'Bloķēt lietotāju :name',
	'are-u-sure' => 'Vai tu vēlies bloķēt lietotāju :name?',
	'yes' => 'Jā',
	'no' => 'Nē',
	
	// Block explanation
	'explintro' => 'Veicot šo darbību:',
		// For user block
		'loseaccess' => 'Lietotājam tiks liegtas tiesības izmantot delivery.lv pakalpojumus,',
		// For restaurant block
		'restlose' => 'Restorāns zaudēs tiesības apstrādāt pasūtījumus, kā arī izveidot/labot/dzēst ēdienus',
		'delorders' => 'Visi šī restorāna pasūtījumi, kas nebūs nodoti piegādei, tiks dzēsti',
		'unavdish' => 'Lietotāji nevarēs pasūtīt ēdienus no šī restorāna',
		'unavvdish' => 'Lietotāji nevarēs redzēt ēdienus no ši restorāna piedāvājumā',
		// For courier block
		'courlose' => 'Kurjers zaudēs tiesības piegādāt pasūtījumus',
		'movorders' => 'Visi pasūtījumi, kas bija nodoti piegādei šim kurjeram un nav piegādāti, tiks atgriezti atpakaļ restorānam, lai nodotu piegādei citam kurjeram',
		// For admin block - which is not possible :)
		'block-admin' => 'Kā tu šeit tiki? Tu nevari bloķēt administratoru! Poga "Jā" tiks atspējota!',
	
	// Change user data
	'chutitle' => 'Mainīt lietotāja :name informāciju',
	'yname' => 'Jūsu vārds, uzvārds',
	'yemail' => 'Jūsu e-pasta adrese',
	'yrole' => 'Jūsu loma sistēmā',
	'confirm' => 'Mainīt informāciju',
	'chp' => 'Mainīt paroli',
	'np' => 'Jaunā parole',
	'cp' => 'Apstipriniet paroli',
	'return' => 'Atgriezties',
	'namereq' => 'Lauks "Vārds" nevar būt tukšs!',
	
	'chrolet' => 'Mainīt lomu lietotājam :name',
	'usercode' => 'Lietotāja ID - :id',
	'currrole' => 'Pašreizējā loma - :role',
	'chroleq' => 'Uz kuru lomu jūs vēlaties mainīt?',
	'cannotchange' => 'Nav iespējams mainīt lomu šim lietotājam!',
	
	'crrest' => 'Izveidot restorānu',
	'crreste' => 'Tā kā jūs vēlaties piešķirt Restorāna lomu lietotājam :name, 
	jums ir jāizveido restorāns',
	'crname' => 'Restorāna nosaukums',
	'craddr' => 'Restorāna adrese',
	'crman' => 'Restorāna konta īpašnieks',
	'crconf' => 'Veicot šo darbību, šis konts mainīs lomu uz "Restorāns". Šo darbību nevarēs atsaukt!',
	'crconf2' => 'Vai jūs vēlaties turpināt?',
];