# Auction tool

An auctioning tool for adding items to an auction, generating QR codes, and storing bidding records in the database.

##Features
* Upload an image and a starting bid for an item.
* Generate a QR code that links to the respective item's bidding page.
* Place bids.
* Manage items and review bids in the admin panel.

##Project setup

* Create database
* Edit ``.env`` file
* ``composer install``
* ``npm install``
* ``php artisan key:generate``
* ``php artisan migrate``
* ``php artisan storage:link``

Requires **imagick** extension: ``sudo apt install php7.4-imagick``

Create user: ``php artisan create:user``
