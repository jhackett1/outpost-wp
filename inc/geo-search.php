<?php

function handle_geo_select($select_clause, $query) {
    if($query->get("geo_query")){

        $earth_radius = 3959;

        $lat = $query->get("geo_query")["latitude"];
        $lng = $query->get("geo_query")["longitude"];

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
            JOIN wp_postmeta AS services_locations
            ON wp_posts.ID = services_locations.meta_value

            JOIN wp_geo
            ON services_locations.post_id  = wp_geo.post_id
        ";
    }
	return $join_clause;	
}
add_filter('posts_join_paged','handle_geo_joins', 10, 2);

// function handle_geo_where($where_clause, $query){
//     if($query->get("geo_query") && $query->get("geo_query")["radius"]){

//         $earth_radius = 3959;

//         $lat = $query->get("geo_query")["latitude"];
//         $lng = $query->get("geo_query")["longitude"];
//         $radius = $query->get("geo_query")["radius"];

//         $where_clause .= "AND 
//                     ( $radius * acos(
//                 cos( radians( $lat ) )
//                 * cos( radians( latitude ) )
//                 * cos( radians( longitude ) - radians( $lng ) )
//                 + sin( radians( $lat ) )
//                 * sin( radians( latitude ) )
//                 ) ) < $radius
//         ";
//     }
// 	return $where_clause;	
// }
// add_filter("posts_where", "handle_geo_where", 10, 2);

function handle_geo_orderby($orderby_clause, $query) {
    if($query->get("geo_query")){
        $orderby_clause = "distance ASC";
    }
    return $orderby_clause;
}
add_filter('posts_orderby', 'handle_geo_orderby', 10, 2);