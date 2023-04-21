### First symfony project after long time: Simple Warehouse.  

-----

composer require symfony/ux-twig-component  

git update-index --assume-unchanged .env   

php bin/console make:user; 
php bin/console make:auth;  

composer require orm-fixtures --dev  
php bin/console make:fixtures // UserFixtures  
php bin/console doctrine:fixtures:load  

doctrine:migrations:status
doctrine:migrations:latest
doctrine:migrations:migrate 

**php bin/console debug:router**  

php bin/console make:registration  
