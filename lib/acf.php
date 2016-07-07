<? 
/*********************************************************
ADVANCED CUSTOM FIELDS
*********************************************************/

if(function_exists('acf_add_options_page')) { 
 
	acf_add_options_page(array(
		'page_title' 	=> 'Opzioni',
		'menu_title'	=> 'Opzioni Generali',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Opzioni Footer',
		'menu_title'	=> 'Opzioni Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Opzioni Social',
		'menu_title'	=> 'Opzioni Social',
		'parent_slug'	=> 'theme-general-settings',
	));

}

if( function_exists('get_field') ) {

	function getAcfImage($post_id, $acf_name, $thumbSize) {
		$img = get_field($acf_name, $post_id);
		if (isset($img['sizes'][$thumbSize]) && !empty($img['sizes'][$thumbSize])) {
			return $img['sizes'][$thumbSize];
		}
		if (isset($img['url']) && !empty($img['url'])) {
			return $img['url'];
		}
		return "";
	}
	
	function getAcfGallery($post_id, $acf_name, $thumbSize) {
		$gall = get_field($acf_name, $post_id);
		$ret = array();
		foreach($gall as $item) {
			if (isset($item['sizes'][$thumbSize]) && !empty($item['sizes'][$thumbSize])) {
				$ret[] = $item['sizes'][$thumbSize];
			}
			else if (isset($item['url']) && !empty($item['url'])) {
				$ret[] = $item['url'];
			}
		}
		return $ret;
	}

}

