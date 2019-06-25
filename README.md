# backpack-fullcalendar

This is a package intended to integrate [https://github.com/maddhatter/laravel-fullcalendar](https://github.com/maddhatter/laravel-fullcalendar) with [https://github.com/Laravel-Backpack](https://github.com/Laravel-Backpack)

This is still in very early stages of integration.

Feel free to leave any comments regarding issues or new features.


Dowload this repository and use it in your composer.json as a local dependency.

E.G:

Create a folder packages in your laravel app and download this repository inside of it.

Edit your composer.json and add: 

```
"repositories": [
       {
        {
            "url": "./packages/backpack-fullcalendar",
            "type": "path"
        },
       }
```

Add in required section:

```
"pxpm/backpack-fullcalendar": "dev-master",
```

composer update

php artisan migrate

php artisan vendor:publish '--tag' => 'backpack-fullcalendar'

Create a calendar: https://yourappurl.com/backpack-url/calendar

Create one or more calendar types: https://yourappurl.com/backpack-url/calendareventtype

Add events to calendars: https://yourappurl.com/backpack-url/calendarevent

### Future plans:

- [x] Calendar display.
- [ ] Add hability to entities have their own calendar.
- [ ] Add hability to auto-create calendars from entities (Like a calendar from a tasklist).


