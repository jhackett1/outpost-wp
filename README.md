# 🌍 WP Outpost

A WordPress plugin implementing the [OpenReferral UK](https://openreferraluk.org/) data standard with custom post types, taxonomies and API endpoints.

## 🎁 Features

### Custom post types, taxonomies and fields

It will set up a number of new post types and taxonomies:

- **Organisations**, which group services together
- **Services**, which can be part of Taxonomies
- **Locations**, physical locations where a service can be accessed, holding address and accessibility information.
- **Contacts**, who are particular individuals or points of contact for a service
- **Fees**, how much it costs to access a service
- **Schedules**, start and end datetimes for a service

It will also create extra fields for adding information to each of these.

You can use built-in WordPress features like user roles, approval workflows and revisions to keep on top of this contwent

### API endpoints

It also adds new API endpoints compliant with the [Open Referral UK](https://openreferraluk.org/) standard:

- `GET /wp-json/outpost/v1/services` to show a list of services
- `GET /wp-json/outpost/v1/services/:id` to show a specific service

The list endpoint recognises these parameters

- `page`
- `per_page`
- `text` - standard WordPress text search
- `location` - which will be turned into a latitude and longitude using [Google's geocoding service](https://developers.google.com/maps/documentation/geocoding/overview), and results will then be sorted by distance from it
- `latitude` and `longitude` - directly sort results by distance
- `taxonomy` = provide the names of servicetaxonomies you'd like to filter by

### Geo search

It enhances [`WP_Query`](https://developer.wordpress.org/reference/classes/wp_query/) with a new parameter `geo_query`, which you can use to order services by distance from a user-supplied point.

This is used internally by the API endpoints, but you can also use it in your own templates:

```
new WP_Query(array(
    "post_type" => "service",
    "geo_query" = array(
        "latitude" => 51.5045,
        "longitude" => -0.0886887
    )
));
```

If you provide the `geo_query` parameter, your results will come back with extra latitude, longitude and distance keys.

Distance is miles by default. If you need kilometres you can multiply the output by 1.61.

Services with more than one location will appear multiple times in the results: once for each location's distance from the search.

## 💻 Installation

It should work with any modern WordPress website.

It needs the free [Advanced Custom Fields](https://www.advancedcustomfields.com/) plugin to be activated.

You need to [provide a Google API key](https://developers.google.com/maps/documentation/javascript/get-api-key) for geocoding features to work. It needs access to the Maps JavaScript API, Geocoding API and Places API.

Add a line like this to your `wp-config.php` before the `/* That's all, stop editing! Happy publishing. */` line:

```
define("GOOGLE_CLIENT_KEY", "your api key here");
```

## 🏃‍♀️ Performance

Because the OpenReferral standard recommends splitting information across many post types, the database queries used by the API endpoints can become slow if your dataset is very large, or if you're applying lots of filters.

You can improve this by using an API caching plugin, though some filtered requests are too rare to be effectively cached.

In very large or complex applications, it might be worthwhile to build an Elasticsearch index ([example](https://kinsta.com/knowledgebase/wordpress-elasticsearch/)) and query that instead.


## 🥙 Serving suggestion

| Plugin                                                  | Why?                                                                                                                                                                                                      |
|---------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| [Relevanssi](https://wordpress.org/plugins/relevanssi/) | By default, WordPress searches post title and content using the simple LIKE operator, and sorts by publication date. Relevanssi lets you sort by relevance and include custom field values in the search. |
| [Members](https://wordpress.org/plugins/members/)       | If you want to use the site to encourage service providers to manage their own listings, you might need to define custom user roles, which this plugin does well.                                         |

Other features that might be interesting to add:

- Adding coverage areas to services, rather than just point locations
- Adding admin notes and end-user reviews to services