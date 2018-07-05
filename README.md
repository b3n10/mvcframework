# MVC Framework from Scratch

#### Purpose:
- To learn mvc by creating framework from sratch

#### Timeline:
- Start: June 23, 2018
- End: July 5, 2018

#### Reminders:
##### For error to be logged, make sure it has write permissions:
```sh
chmod 777 logs/
```

##### For redirect to work:
- For 500 internal error, make sure to run: sudo a2enmod rewrite
- Then add these lines on apache2.conf or sites-available/xxx.conf if enabled:

```
<Directory directory>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
```
- where directory could be /var/www/ or the directory in your sites-available/xxx.conf

##### Create .htaccess (where index.php is located) and add these lines:

```
RewriteEngine On

# base URL
RewriteBase /public

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f

RewriteRule ^(.*)$ index.php?$1 [L,QSA]
```

##### Procfile
```
web: vendor/bin/heroku-php-apache2 public/
```

##### composer.json
```json
{
	"require": {
		"php": "~7.1.18"
	}
}
```
