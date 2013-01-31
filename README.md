#BootCakeStrap

A compilation of some software to start developing in CakePHP environment, with:

[CakePHP](http://www.cakephp.org) 2.3.0 - framework for developing

[Bootstrap](http://twitter.github.com/bootstrap/) - front-end framework

[Bootswatch](http://bootswatch.com/) - Free Themes Gallery.

[TwitterBootstrap](https://github.com/slywalker/TwitterBootstrap) - CakePHP Helpers and for few changes.

[DebugKit](https://github.com/cakephp/debug_kit.git) - Official CakePHP's Plugin to Debug.


##Install

In a webserver path:

	# Clone Repository
	git clone https://github.com/agustim/bootcakestrap.git <myapp>
	cd <myapp>
	cd app
	# Create database
	echo "create database <mydatabase>" | mysql -u root -p
	# Rename config database file
	mv Config/database.php.default Config/database.php
	# Create Table
	Console/cake schema create --file users.php
	# Change 'Security.salt' and 'Security.cipherSeed' in file <myapp>/app/Config/core.php:
 	cd Config
	sed -i -r "s/DYhG93b0qyJfIxfs2guVoUubWwvniR2G0FgaC9mi/`date +%s | md5sum | base64 | head -c 40`/" core.php
	sed -i -r "s/76859309657453542496749683645/`date +%s | md5sum | head -c 29`/" core.php
	cd ..

##Setup

Make an user admin.

[http://&lt;localhost&gt;/&lt;myapp&gt;/users/add](http://<localhost>/<myapp>/users/add)





	


