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
      $locations = get_field('locations', $post_id);
      if($locations){
        $list = array_map(function ($post){
          return "<a href='" . get_edit_post_link($post) . "'>" . get_the_title($post) . "</a>";
        }, $locations);
        echo join(", ", $list);
      } else {
        echo "—";
      }
      break;

    case 'contacts':
      $contacts = get_field('contacts', $post_id);
      if($contacts){
        $list = array_map(function ($post){
          return "<a href='" . get_edit_post_link($post) . "'>" . get_the_title($post) . "</a>";
        }, $contacts);
        echo join(", ", $list);
      } else {
        echo "—";
      }
      break;

    case 'schedules':
      $schedules = get_field('schedules', $post_id);
      if($schedules){
        $list = array_map(function ($post){
          return "<a href='" . get_edit_post_link($post) . "'>" . get_the_title($post) . "</a>";
        }, $locations);
        echo join(", ", $list);
      } else {
        echo "—";
      }
      break;

    case 'fees':
      $fees = get_field('fees', $post_id);
      if($fees){
        $list = array_map(function ($post){
          return "<a href='" . get_edit_post_link($post) . "'>" . get_the_title($post) . "</a>";
        }, $locations);
        echo join(", ", $list);
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