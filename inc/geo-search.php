<?php

function handle_geo_select($select_clause, $query) {
    if($query->get("geo_query")){

        $lat = $query->get("geo_query")["latitude"];
        $lng = $query->get("geo_query")["longitude"];

        $radius = 3959;

        $select_clause = "
            wp_posts.*,
            wp_geo.latitude AS latitude,
            wp_geo.longitude AS longitude,
            ( $radius * acos(
                cos( radians( $lat ) )
                * cos( radians( latitude ) )
                * cos( radians( longitude ) - radians( $lng ) )
                + sin( radians( $lat ) )
                * sin( radians( latitude ) )
                ) )
                AS distance
        ";
    }
	return $select_clause;	
}
add_filter('posts_fields','handle_geo_select', 10, 2);

function handle_geo_joins($join_clause, $query) {
    if($query->get("geo_query")){
        $join_clause = "       
            INNER JOIN wp_postmeta AS services_locations
            ON wp_posts.ID = services_locations.meta_value

            INNER JOIN wp_posts AS locations
            ON services_locations.post_id = locations.ID

            INNER JOIN wp_geo
            ON locations.id = wp_geo.post_id
        ";
    }
	return $join_clause;	
}
add_filter('posts_join_paged','handle_geo_joins', 10, 2);

function handle_geo_orderby($orderby_clause, $query) {
    if($query->get("geo_query")){
        $orderby_clause = "distance ASC";
    }
    return $orderby_clause;
}
add_filter('posts_orderby', 'handle_geo_orderby', 10, 2);