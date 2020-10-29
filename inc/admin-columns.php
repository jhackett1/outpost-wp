<?php 

function op_set_organisation_columns($columns) {
  unset($columns["date"]);
  $columns['services'] = 'Services';
  $columns['date'] = 'Date';
  return $columns;
}
add_filter( 'manage_organisation_posts_columns', 'op_set_organisation_columns' );

function op_set_service_columns($columns) {
  unset($columns["date"]);
  $columns['organisation'] = 'Parent organisation';
  $columns['locations'] = 'Locations';
  $columns['contacts'] = 'Contacts';
  $columns['fees'] = 'Fees';
  $columns['schedules'] = 'Schedules';
  $columns['date'] = 'Date';
  return $columns;
}
add_filter( 'manage_service_posts_columns', 'op_set_service_columns' );

function op_add_parent_service_column($columns) {
  unset($columns["date"]);
  $columns['parent_service'] = 'Parent service';
  $columns['date'] = 'Date';
  return $columns;
}
add_filter( 'manage_location_posts_columns', 'op_add_parent_service_column' );
add_filter( 'manage_schedule_posts_columns', 'op_add_parent_service_column' );
add_filter( 'manage_cost_option_posts_columns', 'op_add_parent_service_column' );
add_filter( 'manage_contact_posts_columns', 'op_add_parent_service_column' );


function nested_object_list($post_type, $service_id){
  $list = array_map(function ($post){
    return "<a href='" . get_edit_post_link($post) . "'>" . get_the_title($post) . "</a>";
  }, posts_belonging_to_service($post_type, $service_id));
  echo join(", ", $list);
}

function op_custom_admin_columns( $column, $post_id ) {
  switch ( $column ) {

    case 'organisation':
      $parent = get_field('organisation', $post_id);
      if(get_post($parent)){
        echo "<a href='" . get_edit_post_link($parent) . "'>" . get_the_title($parent) . "</a>";
      } else {
        echo "—";
      }
      break;

    case 'locations':
      nested_object_list("location", $post_id);
      break;

    case 'contacts':
      nested_object_list("contact", $post_id);
      break;

    case 'schedules':
      nested_object_list("schedule", $post_id);
      break;

    case 'cost_option':
      nested_object_list("cost_option", $post_id);
      break;

    case 'parent_service':
      $parent = get_field('service', $post_id);
      if(get_post($parent)){
        echo "<a href='" . get_edit_post_link($parent) . "'>" . get_the_title($parent) . "</a>";
      } else {
        echo "—";
      }
      break;

    case 'services':
      $query = new WP_Query(array(
        "post_type" => "service",
        "meta_query" => array(
          array(
            "key" => "organisation",
            "value" => $post_id
          )
        )
      ));
      $list = array_map(function ($post){
        return "<a href='" . get_edit_post_link($post) . "'>" . get_the_title($post) . "</a>";
      }, $query->get_posts());
      echo join(", ", $list);
      break;
  }
}
add_action( 'manage_posts_custom_column' , 'op_custom_admin_columns', 10, 2 );