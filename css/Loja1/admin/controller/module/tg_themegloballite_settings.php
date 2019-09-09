<?php

class ControllerModuleTgthemegloballiteSettings extends Controller {
	
	private $error = array(); 
	
	public function index() {   
	
		//Load the language file for this module
		$this->language->load('module/tg_themegloballite_settings');

		//Set the title from the language file $_['heading_title'] string
		$this->document->setTitle('TG Themeglobal Pro Theme Options');
		
		//Load the settings model. You can also add any other models you want to load here.
		$this->load->model('setting/setting');
		
		$config_data = array(
			'main_layout',
			'page_width',
			'max_width',
			'add_to_compare_text',
			'add_to_wishlist_text',
			'add_to_cart_text',
			'mycart_text',
			'welcome_text',
			'more_details_text',
			'category_text',
			'search_text',
			'sale_text',
			'product_per_pow',
			'product_per_pow2',
			'product_scroll_latest',
			'product_scroll_featured_category',
			'product_scroll_featured',
			'product_scroll_bestsellers',
			'product_scroll_specials',
			'product_scroll_related',
			'display_text_sale',
			'type_sale',
			'display_rating',
			'display_add_to_compare',
			'display_add_to_wishlist',
			'display_add_to_cart',
			'quick_view',
			'category_page_display_quickview',
			'category_page_display_add_to_wishlist',
			'product_image_effect',
			'default_list_grid',
			'refine_search_style',
			'refine_image_width',
			'refine_image_height',
			'refine_search_number',
			'product_image_zoom',
			'position_image_additional',
			'product_social_share',	
			'customfooter',	
			'colors_status',
			'body_font_text',
			'body_font_links',
			'body_font_links_hover',
			'body_price_text',
			'body_price_old_text',
			'headlines_product_strong_text_color',
			'headlines_active_text_color',
			'product_name_text_color',
			'product_name_text_color_hover',
			'body_background_color',
			'top_bar_backgroud',
			'top_bar_border',
			'top_menu_links_hover',
			'top_menu_color',
			'top_menu_links',
			'top_search_icon_background',
			'menu_links_hover',
			'menu_links',
			'menu_submenu_links',
			'menu_submenu_links_hover',
			'menu_border',
			'mobile_icon_background',
			'mobile_icon_text',
			'mobile_menu_links',
			'mobile_menu_links_hover',
			'mobile_submenu_links', 
			'mobile_submenu_links_hover',
			'mobile_menu_background',
			'mobile_menu_border',
			'slider_bullet_color',
			'slider_bullet_hover_color',
			'column_text_color',
			'column_headlines_color',
			'column_text_color',
			'column_hover_text_color',
			'breadcrumb_text_color',
			'breadcrumb_hover_text_color',
			'sale_color_text',
			'sale_border',
			'sale_background',
			'to_top_color_text',
			'to_top_background',
			'ratings_background',
			'ratings_active_background',
			'buttons_color_text',
			'buttons_background',
			'buttons_border',
			'buttons_hover_color_text',
			'buttons_hover_background',
			'buttons_hover_border',
			'carousel_bullets_background',
			'carousel_active_bullets_background',
			'customfooter_color_text',
			'customfooter_hover_color_text',
			'customfooter_color_heading',
			'customfooter_icon_color',
			'customfooter_border_color',
			'customfooter_background_color',
			'social_icon_background',
			'social_icon_color',
			'social_border_color',
			'social_hover_icon_background',
			'social_hover_icon_color',
			'social_hover_border_color',
			
			'widget_facebook_background',
			'widget_twitter_background',
			'widget_custom_background',

			'background_status',
			'body_background',
			'body_background_background',
			'body_background_subtle_patterns',
			'body_background_position',
			'body_background_repeat',
			'body_background_attachment',
						
			'font_status',
			'categories_bar',
			'categories_bar_weight',
			'categories_bar_px',
			'headlines',
			'headlines_weight',
			'headlines_px',
			'headlines_px_medium',
			'footer_headlines',
			'footer_headlines_weight',
			'footer_headlines_px',
			'footer_column',
			'footer_column_weight',
			'footer_column_px',
			'body_font',
			'body_font_px',
			'body_font_weight',
			
			'top_header_font',
			'top_header_font_px',
			'top_header_font_weight',

			'product_name',
			'product_name_weight',
			'product_name_px',
			'button_font',
			'button_font_weight',
			'button_font_px',
			'custom_price',
			'custom_price_weight',
			'custom_price_px',
			'custom_price_px_old_price',
			
			'product_image_zoom',
			
			'product_scroll_latest',
			'product_scroll_featured',
			'product_scroll_bestsellers',
			'product_scroll_specials',
			'product_scroll_related',
			
			'custom_code_css_status',
			'custom_code_css',
			'custom_code_javascript_status',
			'custom_code_js',
			
			'refine_image_width',
			'refine_image_height',
			
			'payment_status',
			'payment',
			
			'widget_facebook_status',
			'widget_facebook_id',
			'widget_facebook_position',
			'widget_twitter_status',
			'widget_twitter_id',
			'widget_twitter_user_name',
			'widget_twitter_position',
			'widget_twitter_limit',
			'widget_custom_status',
			'widget_custom_content',
			'widget_custom_position'
		);
		
		foreach ($config_data as $conf) {
			$data[$conf] = false;
		}

		function removeDir($path) { 
			$dir = new DirectoryIterator($path); 
			foreach ($dir as $fileinfo) { 
				if ($fileinfo->isFile() || $fileinfo->isLink()) { 
					unlink($fileinfo->getPathName()); 
				} elseif (!$fileinfo->isDot() && $fileinfo->isDir()) { 
					removeDir($fileinfo->getPathName()); 
				} 
			} 
			rmdir($path); 
		}
		
  		// themegloballite MUTLI STORE
  		
			if (isset($this->request->post['store_id'])) {
				$data['store_id'] = $this->request->post['store_id'];
			} else {
				$data['store_id'] = $this->config->get('d_store_id');
			}

			$data['stores'] = array();
			
			$this->load->model('setting/store');
			
			$results = $this->model_setting_store->getStores();
			
			$data['stores'][] = array(
				'name' => 'Default',
				'href' => '',
				'store_id' => 0
			);
				
			foreach ($results as $result) {
				$data['stores'][] = array(
					'name' => $result['name'],
					'href' => $result['url'],
					'store_id' => $result['store_id']
				);
			}		
			
			
			if(isset($_GET['store_id'])) {
				$data['store_id'] = $_GET['store_id'];
			} else {
				if (isset($_GET['submit'])) {
					$data['store_id'] = $data['store_id'];
				} else {
					if (isset($this->request->post['store_id'])) {
						$data['store_id'] = $this->request->post['store_id'];
					} else {
						$data['store_id'] = 0;
					}
				}
			}
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
				$data['array'] = array(
					'd_store_id' => $this->request->post['store_id']
				);
				$this->model_setting_setting->editSetting('d_id_store', $data['array']);	
			}
			
		// END MULTISTORE
		
		$data['setting_skin'] = $this->model_setting_setting->getSetting('themegloballite_skin', $data['store_id']);
		
		if($data['store_id'] == 0) {
			$data['edit_skin_store'] = 'default';
		} else {
			$data['edit_skin_store'] = $data['store_id'];
		}

		if(isset($data['setting_skin']['themegloballite_skin'])) {
			$data['active_skin'] = $data['setting_skin']['themegloballite_skin'];
		} else {
			$data['active_skin'] = 'default';
		}
		
		if(!file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin'].'')) {
			$data['active_skin'] = false;
		}

		if(file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/')) {
			$data['skins'] = array();
			$dir = opendir(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/');
			while(false !== ($file = readdir($dir))) {
				if(is_dir(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$file) && $file != '.' && $file != '..')  {
					$data['skins'][] = $file;
				}
			}
		}

		if(isset($data['setting_skin']['themegloballite_skin'])) {
			$data['active_skin_edit'] = $data['setting_skin']['themegloballite_skin'];
		} else {
			$data['active_skin_edit'] = 'default';
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if(isset($_POST['button-edit']) || isset($_POST['button-delete'])){
				$data['active_skin_edit'] = $this->request->post['skin'];
			}
		}
		
		if(isset($this->request->post['save_skin']) && !isset($_POST['button-edit']) && !isset($_POST['button-delete'])) {
			$data['active_skin_edit'] = $this->request->post['save_skin'];
		}
		
		if(isset($_GET['skin_edit'])) {
			$data['active_skin_edit'] = $_GET['skin_edit'];
		}
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if(isset($_POST['button-active'])){
				$save_themegloballite_skin = array(
					'themegloballite_skin' => $this->request->post['skin']
				);
				$this->model_setting_setting->editSetting('themegloballite_skin', $save_themegloballite_skin, $this->request->post['store_id']);	
				$this->session->data['success'] = $this->language->get('text_success');
	            $this->response->redirect($this->url->link('module/tg_themegloballite_settings&submit=true', 'token=' . $this->session->data['token'], 'SSL'));
            }
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if(isset($_POST['add-skin'])){
				if(is_writable(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/') && (is_writable(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/') || !file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'))) {
				
					if(file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/') && filetype(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/') == 'dir') {
					} else {
						mkdir(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/', 0777);
					}
					
			
					if($this->request->post['add-skin-name'] != '') {	
						if(!file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$this->request->post['add-skin-name'].'/')) {
							mkdir(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$this->request->post['add-skin-name'].'/', 0777);
							file_put_contents(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$this->request->post['add-skin-name'].'/settings.json', json_encode($config_data));
							mkdir(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$this->request->post['add-skin-name'].'/js/', 0777);
							file_put_contents(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$this->request->post['add-skin-name'].'/js/custom_code.js', ' ');
							mkdir(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$this->request->post['add-skin-name'].'/css/', 0777);
							file_put_contents(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$this->request->post['add-skin-name'].'/css/custom_code.css', ' ');
							$this->session->data['success'] = $this->language->get('text_success');
							$this->response->redirect($this->url->link('module/tg_themegloballite_settings&submit=true', 'token=' . $this->session->data['token'], 'SSL'));
						}
					}  
				}

				$this->session->data['error_warning'] = 'You need to set CHMOD 777 for all folder and subfolder in catalog/view/theme/' . $this->config->get('config_template') . '/skins!';
		        $this->response->redirect($this->url->link('module/tg_themegloballite_settings&submit=true', 'token=' . $this->session->data['token'], 'SSL'));
		    }
		}
		
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if(isset($_POST['button-save'])){
				if(is_writable(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins') && is_writable(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store']) && is_writable(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'])) {
				
					if(file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/') && filetype(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/') == 'dir' && file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'')) {
						
						file_put_contents(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/settings.json', json_encode($this->request->post));  
						
						// Custom js
						file_put_contents(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/js/custom_code.js', $this->request->post['custom_code_js']);  
						
						// Custom css
						file_put_contents(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/css/custom_code.css', $this->request->post['custom_code_css']);  
						

						$this->session->data['success'] = $this->language->get('text_success');
						$this->response->redirect($this->url->link('module/tg_themegloballite_settings&submit=true&skin_edit=' . $data['active_skin_edit'] . '', 'token=' . $this->session->data['token'], 'SSL'));
					}
				}
				
				$this->session->data['error_warning'] = 'You need to set CHMOD 777 for all folder and subfolder in catalog/view/theme/' . $this->config->get('config_template') . '/skins!';
				$this->response->redirect($this->url->link('module/tg_themegloballite_settings&submit=true', 'token=' . $this->session->data['token'], 'SSL'));
			}
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if(isset($_POST['button-delete'])){
				if(is_writable(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins')) {
				
					if(file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/') && filetype(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/') == 'dir' && file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'')) {
						
						if($data['active_skin_edit'] != $data['active_skin']) {
							removeDir(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'');
							
							$this->session->data['success'] = $this->language->get('text_success');
							$this->response->redirect($this->url->link('module/tg_themegloballite_settings&submit=true', 'token=' . $this->session->data['token'], 'SSL'));		
						}
					}
				} else {
					$this->session->data['error_warning'] = 'You need to set CHMOD 777 for all folder and subfolder in catalog/view/theme/' . $this->config->get('config_template') . '/skins!';
					$this->response->redirect($this->url->link('module/tg_themegloballite_settings&submit=true', 'token=' . $this->session->data['token'], 'SSL'));
				}
				
				$this->session->data['error_warning'] = $this->language->get('text_warning2');
				$this->response->redirect($this->url->link('module/tg_themegloballite_settings&submit=true', 'token=' . $this->session->data['token'], 'SSL'));
			}
		}
		
		if(file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/settings.json')) {
			$template = json_decode(file_get_contents(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/settings.json'), true);
			if(isset($template)) {
				foreach ($template as $option => $value) { 
					if($option != 'store_id') {
						$data[$option] = $value;
					}
				}
			}
		}
				
		if(file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/js/custom_code.js')) {
			$data['custom_code_js'] = file_get_contents(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/js/custom_code.js');
		}
		
		if(file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/css/custom_code.css')) {
			$data['custom_code_css'] = file_get_contents(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/css/custom_code.css');
		}
		
		$data['text_image_manager'] = 'Image manager';
		$data['token'] = $this->session->data['token'];		
		
		$text_strings = array('heading_title');
		
		foreach ($text_strings as $text) {
			$data[$text] = $this->language->get($text);
		}
		
			
			// Revolution slider
			if(isset($_POST['install_tg_tglite_revolution_slider'])){
				$dir = '../data_sample/themegloballite/tg_tglite_revolution_slider.php'; 
				
				function mb_unserialize($serial_str) {
				    $out = preg_replace('!s:(\d+):"(.*?)";!se', 
				"'s:'.strlen('$2').':\"$2\";'", $serial_str );
				    return unserialize($out);
				}	
				
				if( is_file($dir) ){
					$data = mb_unserialize(file_get_contents( $dir ));
		
					if( is_array($data) ){
						$output = array();
						$output["tg_tglite_revolution_slider_module"] = $data; 
						$this->model_setting_setting->editSetting( "tg_tglite_revolution_slider", $output );	
					}
				}	
				
				include '../data_sample/themegloballite/tg_tglite_revolution_slider_query.php'; 
				
				$this->session->data['success'] = $this->language->get('text_success');
				$this->response->redirect($this->url->link('module/tg_themegloballite_settings', 'token=' . $this->session->data['token'], 'SSL'));
				
			}
			
			// OpenCart Default Module
			if(isset($_POST['install_tg_other_module'])){
			
					// LATEST INSTALL
					$query = $this->db->query("
						INSERT INTO `".DB_PREFIX."module` (`module_id`, `name`, `code`, `setting`) VALUES
						(34, 'Home Page Content Top', 'latest', 'a:5:{s:4:\"name\";s:21:\"Home Page Content Top\";s:5:\"limit\";s:2:\"10\";s:5:\"width\";s:3:\"200\";s:6:\"height\";s:3:\"200\";s:6:\"status\";s:1:\"1\";}'),
						(35, 'Category Page Column Left', 'latest', 'a:5:{s:4:\"name\";s:25:\"Category Page Column Left\";s:5:\"limit\";s:1:\"8\";s:5:\"width\";s:2:\"60\";s:6:\"height\";s:2:\"60\";s:6:\"status\";s:1:\"1\";}'),
						(36, 'Home Page Content Bottom', 'carousel', 'a:5:{s:4:\"name\";s:24:\"Home Page Content Bottom\";s:9:\"banner_id\";s:1:\"8\";s:5:\"width\";s:3:\"100\";s:6:\"height\";s:3:\"100\";s:6:\"status\";s:1:\"1\";}');
					");
					
					$query = $this->db->query("
						INSERT INTO `".DB_PREFIX."layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
						(100, 1, 'latest.34', 'content_top', 0), 
						(101, 3, 'latest.35', 'column_left', 2)
					");		
					
							
					// INFORMATION INSTALL
					$output["information_status"] = 1; 
					$this->model_setting_setting->editSetting( "information", $output );
					$query = $this->db->query("
							INSERT INTO `".DB_PREFIX."layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
							(102, 3, 'information', 'column_left', 4);
							");	
					
					// CATEGORY INSTALL
					$output["category_status"] = 1; 
					$this->model_setting_setting->editSetting( "category", $output );
					$query = $this->db->query("
							INSERT INTO `".DB_PREFIX."layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
							(103, 3, 'category', 'column_left', 0),
							(104, 2, 'category', 'column_left', 0),
							(105, 5, 'category', 'column_left', 0),
							(106, 1, 'carousel.36', 'content_bottom', 0);
							");	
				
				
				$this->session->data['success'] = $this->language->get('text_success');
				$this->response->redirect($this->url->link('module/tg_themegloballite_settings', 'token=' . $this->session->data['token'], 'SSL'));
				
			}

		
		if (isset($this->session->data['error_warning'])) {
			$data['error_warning'] = $this->session->data['error_warning'];
			unset($this->session->data['error_warning']);
 		} elseif(isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
        if (isset($this->session->data['success'])) {
        	$data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
			$data['success'] = '';
        }

		$data['action'] = $this->url->link('module/tg_themegloballite_settings', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['breadcrumbs'] = array();
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		$data['breadcrumbs'][] = array(
			'text' => 'Modules',
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);
				
		$data['breadcrumbs'][] = array(
			'text' => 'ThemeGlobal Theme Options',
			'href' => $this->url->link('module/beamstore', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		// Multilanguage
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		
		// No image
		$this->load->model('tool/image');
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		//Send the output.
		$this->response->setOutput($this->load->view('module/tg_themegloballite_settings.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/tg_themegloballite_settings')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
	
	
	public function install() {
		$this->load->model('extension/extension');
		$this->load->model('setting/setting');
		$this->load->model('design/layout');
		$this->load->model('user/user_group');
		$this->model_extension_extension->uninstall('module', 'slideshow');
		$this->model_extension_extension->uninstall('module', 'banner');
		$this->model_extension_extension->uninstall('module', 'carousel');
		$this->model_extension_extension->uninstall('module', 'featured');
		$this->model_extension_extension->uninstall('module', 'html');
		$this->model_extension_extension->install('module', 'tg_tglite_revolution_slider');
		$this->model_extension_extension->install('module', 'carousel');
		$this->model_extension_extension->install('module', 'information');
		$this->model_extension_extension->install('module', 'latest');
		$this->model_extension_extension->install('module', 'category');
		$this->model_extension_extension->install('module', 'tg_tglite_filter_product');
		$this->model_extension_extension->install('module', 'tg_themegloballite_megamenu');

		$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout_module
						");	
		
		$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "module
						");	
		
		
		

		$this->model_setting_setting->editSettingValue('config', 'config_image_thumb_width', 400);	
		$this->model_setting_setting->editSettingValue('config', 'config_image_thumb_height', 400);	
		
		$this->model_setting_setting->editSettingValue('config', 'config_image_popup_width', 400);
		$this->model_setting_setting->editSettingValue('config', 'config_image_popup_height', 400);
		
		$this->model_setting_setting->editSettingValue('config', 'config_image_category_width', 200);	
		$this->model_setting_setting->editSettingValue('config', 'config_image_category_height', 200);	
		
		$this->model_setting_setting->editSettingValue('config', 'config_image_product_width', 200);	
		$this->model_setting_setting->editSettingValue('config', 'config_image_product_height', 200);	
		
		$this->model_setting_setting->editSettingValue('config', 'config_image_related_width', 200);
		$this->model_setting_setting->editSettingValue('config', 'config_image_related_height', 200);

		$this->model_setting_setting->editSettingValue('config', 'config_template', 'themegloballite');	
		
		$this->model_user_user_group->addPermission(1,'modify','module/tg_tglite_revolution_slider');	
		$this->model_user_user_group->addPermission(1,'access','module/tg_tglite_revolution_slider');
		
		$this->model_user_user_group->addPermission(1,'modify','module/tg_themegloballite_megamenu');	
		$this->model_user_user_group->addPermission(1,'access','module/tg_themegloballite_megamenu');
		
		$this->model_user_user_group->addPermission(1,'modify','module/tg_tglite_filter_product');	
		$this->model_user_user_group->addPermission(1,'access','module/tg_tglite_filter_product');

	}
	

	
	public function uninstall() {
		$this->load->model('extension/extension');
		$this->model_extension_extension->uninstall('module', 'tg_tglite_revolution_slider');
		$this->model_extension_extension->uninstall('module', 'tg_themegloballite_megamenu');
		$this->model_extension_extension->uninstall('module', 'tg_tglite_filter_product');
		$this->model_extension_extension->uninstall('module', 'category');
		$this->model_extension_extension->uninstall('module', 'information');
		$this->model_extension_extension->uninstall('module', 'featured');
		$this->model_extension_extension->uninstall('module', 'latest');
		$this->model_extension_extension->uninstall('module', 'carousel');
		$this->model_setting_setting->editSettingValue('config', 'config_template', 'default');	
		$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout_module
						");	
		
		$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "module
						");	
		$query = $this->db->query("
			DELETE FROM " . DB_PREFIX . "tg_tglite_revolution_slider
		");


		$this->model_setting_setting->deleteSetting( "featured");	
		$this->model_setting_setting->deleteSetting( "latest");
		$this->model_setting_setting->deleteSetting( "carousel");
		$this->model_setting_setting->deleteSetting( "information");		
		$this->model_setting_setting->deleteSetting( "tg_tglite_revolution_slider");
		$this->model_setting_setting->deleteSetting( "category");

	}

}
?>