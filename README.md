# eticket_system

CodeIgniter HMVC Module Electronic Repair Ticket System
----------------------------------------------

This module was made with CodeIgniter using the HMVC plugin. It's a basic crud that allows for adding new devices to inventory or updating existing items with new information. This module also includes a label print option that will generate a QRCode with embedded hyperlink back to the item page for use with mobile.

The printer I am using for printing out labels is a Dymo LabelWriter 400 that I picked up on ebay for 10 dollars.

SQL table structure:
           
	SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
	SET time_zone = "+00:00";
	CREATE TABLE IF NOT EXISTS `eticket_system` (
	`id` int(11) NOT NULL,
	`name` varchar(75) NOT NULL,
	`address` varchar(150) NOT NULL,
	`phone` int(11) NOT NULL,
	`ticket_id` varchar(50) NOT NULL,
	`device_make` varchar(75) NOT NULL,
	`device_model` varchar(150) NOT NULL,
	`device_sic` text NOT NULL,
	`date` int(11) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	ALTER TABLE `eticket_system`
	ADD PRIMARY KEY (`id`);

	ALTER TABLE `eticket_system`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

---------------------------------------------------------------------------------------------
This module uses ciqrcode library by Dwi Setiyadi. You can get the library on his page [here](https://github.com/dwisetiyadi/CodeIgniter-PHP-QR-Code)

-------------------------------------
For warranty info, please view [this](https://gist.github.com/badmofo/2d6e66630e4a6748edb7)
