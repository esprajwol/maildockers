# LegalMe
Email's Messages into an Organized Document


## Required Commands for Redis
``` redis-server ```

## Running the queue worker:
``` php artisan queue: work ```

## Clearing the cache. After each pdf creation, the the following command needs to be executted to clear the cache:
``` php artisan cache:clear ```

## Currencies table seeder
``` php artisan db:seed --class=CurrencyTableSeeder ```

## Countries Table Seeder
``` php artisan db:seed --class=CountriesTableSeeder ```

## Languages Table Seeder
``` php artisan db:seed --class=LanguagesTableSeeder ```

## Localizations Table Seeder
``` php artisan db:seed --class=LocalizationsTableSeeder ```
