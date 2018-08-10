# OOI Data Team Portal

The OOI Data Team portal was developed to support the OOI Data Team's efforts to review and annotate the official datasets provided by the [Ocean Observatories Initiative](https://oceanobservatories.org), through the official [OOI data portal](https://oceanobservatories.org/data-portal/).  This portal provides access to much of the same metadata information available in OOI Net, though the metadata information is loaded independently from various GitHub repositories via a number of python scripts, available at [datateam-portal-backend](https://github.com/ooi-data-review/datateam-portal-backend).

The portal was developed using CakePHP


 app with a number of Python scripts to update the content in a MySQL database.  Currently, the site takes up 377MB, but about 75% of that is logs and tmp files.  The database is roughly 350MB.

## Key Features

* Intuitive display of OOI Assets (Arrays, Sites, Notes, and Instruments loaded from [datateam-portal-backend](https://github.com/ooi-data-review/datateam-portal-backend))
* Information on data streams and parameters available for each instrument (from [preload-database](https://github.com/oceanobservatories/preload-database))
* Information on Assets, Calibrations, Cruises and Deployments (from [asset-management](https://github.com/ooi-integration/asset-management))
* Information on Ingestions (from [ingestion-csvs](https://github.com/ooi-integration/ingestion-csvs))
* Data Annotations (loaded directly from the data portal)
* Visual display of Daily and Monthly data availability at all levels of the system, down to the stream level
* Deployment and Annotation timelines
* Support for Cruise Reviews, Deployment Reviews, and Team Notes entered by Data Team members

## Installation & Configuration

1. Clone the repository into your intended web directory.
2. Install [Composer](https://getcomposer.org/download/) into the directory (if it's not available globally).
3. Install application dependancies using composer.  Run `./composer.phar install`
4. Open `config/app.php`
  1. Remember to set `debug` to false in a production environment.  (I'd suggest leaving it set to true during initial setup.)
  2. Add `'title' => 'Data Team Portal'` inside the 'App' variable
  3. Update your email server info in 'EmailTransport' if necessary (see the [docs](https://book.cakephp.org/3.0/en/core-libraries/email.html#configuration))
  4. Update your MySQL database info in 'Datasources'
  5. Add the following to the bottom of the file (before the last ']')
```    
    // Default login info to acccess the OOInet API
    'Uframe' => [
        'username' => '',
        'token' => ''
    ]
```
5. Install the database by running `bin/cake migrations migrate`
6. Manually add the first user to the database (specify the username and email) with the role set to 'admin'. Use the password reset feature on the site's login to set the password.

At this point, the initial setup of the portal is complete.  Now all you need to do is load in the metadata.  See [datateam-portal-backend](https://github.com/ooi-data-review/datateam-portal-backend) for instructions on how to load in update the database.


## Updating Your Server
You can update your site with the latest code using the following steps.
1. Run ```git pull```
2. If you need to update dependancies, run `./composer.phar install`
3. To see if there have been any database updates, run `bin/cake migrations status`
4. If database updates are needed, run `bin/cake migrations migrate` and then clear the cache `bin/cake schema_cache clear` (Note, you may need to delete cache files manually in /tmp/cache/models if you run into permissions problems.)


## Credits

Developed by Sage Lichtenwalner, Rutgers University
With help from the OOI Data Team: Mike Vardaro, Leila Belabassi, Lori Garzio, Friedrich Knuth,  Michael Smith & Michael Crowley

©2018 OOI Data Team, Rutgers University
