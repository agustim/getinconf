#GeTINConf Server

A compilation of some software to start developing in CakePHP environment, with:

[CakePHP](http://www.cakephp.org) 2.3.0 - framework for developing

[Bootstrap](http://twitter.github.com/bootstrap/) - front-end framework

[Bootswatch](http://bootswatch.com/) - Free Themes Gallery.

[TwitterBootstrap](https://github.com/slywalker/TwitterBootstrap) - CakePHP Helpers and for few changes.

[DebugKit](https://github.com/cakephp/debug_kit.git) - Official CakePHP's Plugin to Debug.


##Install

In a webserver path:

	# Clone Repository
	git clone https://github.com/agustim/getinconf.git <myapp>
	cd <myapp>
	cd app
	# Create database
	cp DataBase/getinconf.empty.db DataBase/getinconf.db
	# Rename config database file
	mv Config/database.php.default Config/database.php
	# Change 'Security.salt' and 'Security.cipherSeed' in file <myapp>/app/Config/core.php:
 	cd Config
	sed -i -r "s/YmU1ZDUyMmQyNTg1NjM5ODg3ZDI5MDEyMzJhNTE4/`date +%s | md5sum | base64 | head -c 40`/" core.php
	sed -i -r "s/b6823eb774c58c3954abf52209640/`date +%s | md5sum | head -c 29`/" core.php
	cd ..

##Setup

Make an user admin.

[http://&lt;localhost&gt;/&lt;myapp&gt;/users/add](http://<localhost>/<myapp>/users/add)





	


