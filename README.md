# WP Outpost

A WordPress plugin implementing the [Open Referral UK](https://openreferraluk.org/) data standard with custom post types, taxonomies and API endpoints.

## Installation

It should work with any modern WordPress website.

It needs the free [Advanced Custom Fields](https://www.advancedcustomfields.com/) plugin to be activated.

You need to [provide a Google API key](https://developers.google.com/maps/documentation/javascript/get-api-key) for geocoding features to work. It needs access to the Maps JavaScript API, Geocoding API and Places API.

Add a line like this to your `wp-config.php` before the `/* That's all, stop editing! Happy publishing. */` line:

```
define("GOOGLE_CLIENT_KEY", "your api key here");
```
