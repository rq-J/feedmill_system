# feedmill_system
a feedmill system for specific company
paired with dashboard(another project, for security)

instructions:
composer update/install
database/seeders/userseeder
php artisan migrate
php artisan serve

delete composer.lock
composer update
cp .env.example .env

ROOT_DOMAIN=http://10.10.0.70
PROFILE_URL_SLUG="/user/profile"
MASTER_LOGIN=http://10.10.0.70
USERS_API_SLUG="/api/users/xxx/"
USER_DETAILS_SLUG="/api/user/get-details/"
FARMS_API_SLUG="/api/farms/query-get"
FARM_DETAILS_SLUG="/api/farm/get-details/"
DEPARTMENTS_API_SLUG="/api/departments/query-get"
DEPARTMENT_DETAILS_SLUG="/api/department/get-details/"
SECTIONS_API_SLUG="/api/sections/query-get"
SECTION_DETAILS_SLUG="/api/section/get-details/"
