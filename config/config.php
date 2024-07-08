<?php 
	function base_url($path = '') {
		echo "/company_profile_rawa_jaya/" . $path;
	}

	function base_url_return($path = '') {
		return "/company_profile_rawa_jaya/" . $path;
	}

    date_default_timezone_set("Asia/Bangkok");
	
	DEFINE("SITE_NAME", "Website Rawa Jaya");
	DEFINE("SITE_NAME_SHORT", "Rawa Jaya");
	DEFINE("SITE_NAME_SHORT_ALTERNATIVE", "Desa Rawa Jaya");
?>