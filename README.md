# URL-Shortner!
#### So short that even the word has been *Shortened*!
(Note): You can visit le site live here: https://shortner.fr/

## What is it?
**Shortner** is a URL shortening service and a link management platform. The homepage includes a form which is used to submit a long URL for shortening. For each URL entered, the server  responds with a short URL redirecting to the source URL.

## Specifics and Images

 - MySQL (what is stored)
	 - Users:
		 - Username (as plain texted).
		 - Password (hashed).
		 - UUID (unique ID of user, using UUID()).
		 - Register date (date of when registered, using TIMESTAMP).
	 - Links:
		 - Owner (unique ID that created the link).
		 - Link Key (key for the shortened link).
		 - Link (Source URL).
		 - Uses (Number of times the shortened link was travelled to).
		 - Active (Boolean wether the link is active or not, 0 or 1).
		 - Register date (When the shortened link was created).
 - Travel using shortened links:
	 - Use the given link: https://shortner.fr/key
	 - Use with key: https://shortner.fr/?key=?key
	 - Use with the v.php file: https://shortner.fr/v.php?key=key

**Login Page**
![Login Page](https://i.imgur.com/30oRWXp.png)

**Links Page**
	![Links Page](https://i.imgur.com/HGk6nGo.png)

**404 Page**
![404 Page](https://i.imgur.com/ItZXYcR.png)
