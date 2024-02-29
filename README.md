<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## About project

this is the books-library-management-api project for making science sweeft Acceleration program, this project contains crud operations of book, search of them and additionally ,authorization functionality, testing them with Pest feture tests, also write custom artisan commands for assign and remove role for user and make middlweare to check user is admin or not.



### Used packages

- **[Sanctum for authorization](https://laravel.com/docs/10.x/sanctum)**
- **[Pest for testing](https://pestphp.com/)**
- **[Pint for code formatting](https://laravel.com/docs/10.x/pint)**


### Project setup

```bash
cp .env.example .env
```
```bash
composer install
```
```bash
php artisan key:generate
```
```bash
php artisan migrate:fresh --seed
```
```bash
php artisan user:assign-role {email} {role}
```
```bash
php artisan serve
```
### Assign and Remove roles for user

```bash
php artisan user:assign-role {email} {role}
```
```bash
php artisan user:remove-role {email}
```

### Running tests

```bash
php artisan test
```
