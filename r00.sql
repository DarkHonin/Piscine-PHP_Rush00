
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(60) NOT NULL,
  `Catagory` enum('Mundane','Special','Exceptional','Elderich') NOT NULL DEFAULT 'Mundane'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `products` (`id`, `Name`, `Description`, `price`, `image`, `Catagory`) VALUES
(1, 'Ring Cat', 'The king of the ring. Beware, all attemts to seperate this creature from his ring will result in sadness.', 50, 'ring_cat.jpg', 'Special'),
(2, 'Sneaks Version 2', 'He sneak, he ran, but more than ever! He fam.', 125.5, 'Sneaks_Version_2.jpg', 'Exceptional'),
(3, 'Fire King', 'He commands the blue flames and does not agree with the King of the Ring. They were once close but now never talk.', 45, 'Fire_King.jpg', 'Mundane'),
(4, 'Flopter Swopter', 'Bestowd with godly abilities to easily dispatch of all flying insects. Beware the splash zone.', 200, 'Flopter_Swopter.jpg', 'Elderich');

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `md5` varchar(255) NOT NULL,
  `SessionToken` varchar(255) NOT NULL,
  `email` varchar(67) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `md5`, `SessionToken`, `email`) VALUES
(1, 'geff', '5f4dcc3b5aa765d61d8327deb882cf99', '5f4dcc3b5aa765d61d8327deb882cf99', 'new@email.com'),
(2, 'heck', '5f4dcc3b5aa765d61d8327deb882cf99', '5f4dcc3b5aa765d61d8327deb882cf99', 'heck@email.com');


ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

