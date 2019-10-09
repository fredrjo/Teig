Teig (TEIG Environment Interface Glorifier)
===========================================
Install this program as an overlay to connect to the database after installing TEIG.

Clone to a directory and install with composer (composer install).

It will automatically ask for your database settings while installing, but can also be manually configured in 

Teig/app/config/parameters.yml.dist.

Also change path to outputfile and locations of TEIG in the following files:

- Teig/src/Acme/GrabBundle/Controller/AlarmController.php

- Teig/src/Acme/GrabBundle/Controller/ExportscheduleController.php 

- Teig/src/Acme/GrabBundle/Controller/GrabberController.php 

- Teig/src/Acme/GrabBundle/Controller/MeterController.php 

The overlay can be run on the inbuilt server with 

php \<Your directory path\>/Teig/app/console server:run 0.0.0.0:8000


