<?php
/*
Plugin Name: Taxideal-Search
Plugin URI: http://amalesh.net/
Description: A taxi search plugin.
Version: 1.0
Author: Amalesh Debnath
Author URI: http://amalesh.net
*/

//Hooks a function to a filter action, 'the_content' being the action, 'hello_world' the function.


//Callback function
function taxideal_search($content)
{
    $search_content = <<<EOT
    <div class="col span_12 light center">
	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" data-using-bg="true" class="vc_col-sm-12 banner_home wpb_column column_container col no-extra-padding" style=" background-color: rgba(0,0,0,0.6); ">
		<div class="wpb_wrapper">

	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<div class="divider" style="height: 100px;"></div>
<h1 style="text-align: center;">Empowering the Taxi Industry</h1>
<div class="divider" style="height: 15px;"></div>
<h4 style="text-align: center;">Here you can advertise your taxi and make your fleet perform better</h4>
<div class="divider" style="height: 10px;"></div>

		</div>
	</div>
	<div style="padding-top: 0px; padding-bottom: 0px; " class="wpb_row vc_row-fluid vc_row standard_section   " data-bg-mobile-hidden="" id="fws_558f8c4674523"><div class="row-bg-wrap"> <div style="height: 1159.2px; margin-top: -579.6px;" class="row-bg   "></div> </div><div class="col span_12  ">
	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-2 wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

		</div>
	</div>

	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-8 home_banner_form wpb_column column_container col centered-text no-extra-padding">
		<div class="wpb_wrapper">
			<div lang="en-US" dir="ltr" id="wpcf7-f941-p42-o1" class="wpcf7" role="form">
<div class="screen-reader-response"></div>
<form novalidate="novalidate" class="wpcf7-form" method="post" action="/dev-site/?module=taxideal-search#wpcf7-f941-p42-o1" name="">
<div style="display: none;">
<input type="hidden" value="941" name="_wpcf7">
<input type="hidden" value="4.2" name="_wpcf7_version">
<input type="hidden" value="en_US" name="_wpcf7_locale">
<input type="hidden" value="wpcf7-f941-p42-o1" name="_wpcf7_unit_tag">
<input type="hidden" value="a8fb9a8bdb" name="_wpnonce">
</div>
<p style="padding-bottom: 0px;"><span class="wpcf7-form-control-wrap menu-600"><select aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required banner_dropdown_area" name="menu-600"><option value="select location">select location</option><option value="Barishal">Barishal</option><option value="Chittagong">Chittagong</option><option value="Dhaka">Dhaka</option><option value="Khulna">Khulna</option></select></span> <span class="wpcf7-form-control-wrap menu-165"><select aria-invalid="false" aria-required="true" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required banner_dropdown_item" name="menu-165"><option value="drivers / taxi deals / plates">drivers / taxi deals / plates</option><option value="Drivers Wanted">Drivers Wanted</option><option value="Taxi Deals">Taxi Deals</option><option value="Plates Lease/Sale">Plates Lease/Sale</option></select></span> <input type="submit" class="wpcf7-form-control wpcf7-submit banner_submit" value="SEARCH"><img class="ajax-loader" src="http://taxideals.com.au/dev-site/wp-content/plugins/contact-form-7/images/ajax-loader.gif" alt="Sending ..." style="visibility: hidden;"></p>
<div class="wpcf7-response-output wpcf7-display-none"></div></form></div>
		</div>
	</div>

	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-2 wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

		</div>
	</div>
</div></div>
		</div>
	</div>
</div>
<div class="col span_12 dark left">
	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-12 wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

	<div data-interval="0" class="wpb_content_element  tab-control">
		<div class="wpb_wrapper tabbed clearfix">
			<ul class="wpb_tabs_nav ui-tabs-nav clearfix"><li><a href="#tab-drivers-wanted" class="">Drivers Wanted</a></li><li><a href="#tab-taxi-deals" class="">Taxi Deals!</a></li><li><a href="#tab-plates-leasesale" class="active-tab">Plates Lease/sale</a></li></ul>


			<div class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide clearfix" id="tab-drivers-wanted" style="visibility: hidden; position: absolute; opacity: 0; left: -9999px; display: none;">

	<div style="padding-top: 0px; padding-bottom: 0px; " class="wpb_row vc_row-fluid vc_row standard_section   " data-bg-mobile-hidden="" id="fws_558f8b37aecf4"><div class="row-bg-wrap"> <div style="" class="row-bg   "></div> </div><div class="col span_12  ">
	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-12 search-box-control wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">
			<div lang="en-US" dir="ltr" id="wpcf7-f942-p42-o2" class="wpcf7" role="form">
<div class="screen-reader-response"></div>
<form novalidate="novalidate" class="wpcf7-form" method="post" action="/dev-site/#wpcf7-f942-p42-o2" name="">
<div style="display: none;">
<input type="hidden" value="942" name="_wpcf7">
<input type="hidden" value="4.2" name="_wpcf7_version">
<input type="hidden" value="en_US" name="_wpcf7_locale">
<input type="hidden" value="wpcf7-f942-p42-o2" name="_wpcf7_unit_tag">
<input type="hidden" value="fe806bc7b9" name="_wpnonce">
</div>
<p><span class="wpcf7-form-control-wrap text-396"><input type="text" aria-invalid="false" class="wpcf7-form-control wpcf7-text" size="40" value="Search" name="text-396"></span></p>
<div class="wpcf7-response-output wpcf7-display-none"></div></form></div>
		</div>
	</div>
</div></div><div class="divider" style="height: 23px;"></div>
	<div style="padding-top: 0px; padding-bottom: 0px; " class="wpb_row vc_row-fluid vc_row standard_section    " data-bg-mobile-hidden="" id="fws_558f8b37b0977"><div class="row-bg-wrap"> <div style="" class="row-bg   "></div> </div><div class="col span_12  ">
	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-8 paragraph-text wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

	<div class="wpb_text_column wpb_content_element  tab-paragraph-text">
		<div class="wpb_wrapper">
			<p style="text-align: left;"><span style="color: #767676;">The operator area or once logged in (profile page) should have a dashboard kind of page where every options can be seen easily such as Manage profile, Public Information, Profiles of taxi added, History of ads with number of hits etc and each expanding if possible. The operator area or once logged in (profile page) should have a dashboard kind of page where.</span></p>

		</div>
	</div>
		</div>
	</div>

	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-4 wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<h3><span style="color: #e75f27;"><strong>Name&nbsp; : (Operator name)</strong></span></h3>
<p><span style="color: #767676;">Mob&nbsp;&nbsp; &nbsp;: 0434 XXX XXX [captcha button]</span><br>
<span style="color: #767676;"> Address&nbsp;&nbsp; &nbsp;: (Operator Address)</span></p>

		</div>
	</div>
		</div>
	</div>
</div></div><div class="divider-border" style="margin-top: 25px; margin-bottom: 25px;"></div>
	<div style="padding-top: 0px; padding-bottom: 0px; " class="wpb_row vc_row-fluid vc_row standard_section   " data-bg-mobile-hidden="" id="fws_558f8b37b1db6"><div class="row-bg-wrap"> <div style="" class="row-bg   "></div> </div><div class="col span_12  ">
	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-8 paragraph-text wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

	<div class="wpb_text_column wpb_content_element  tab-paragraph-text">
		<div class="wpb_wrapper">
			<p style="text-align: left;"><span style="color: #767676;">The operator area or once logged in (profile page) should have a dashboard kind of page where every options can be seen easily such as Manage profile, Public Information, Profiles of taxi added, History of ads with number of hits etc and each expanding if possible. The operator area or once logged in (profile page) should have a dashboard kind of page where.</span></p>

		</div>
	</div>
		</div>
	</div>

	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-4 wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<h3><span style="color: #e75f27;"><strong>Name&nbsp; : (Operator name)</strong></span></h3>
<p><span style="color: #767676;">Mob&nbsp;&nbsp; &nbsp;: 0434 XXX XXX [captcha button]</span><br>
<span style="color: #767676;"> Address&nbsp;&nbsp; &nbsp;: (Operator Address)</span></p>

		</div>
	</div>
		</div>
	</div>
</div></div><div class="divider-border" style="margin-top: 25px; margin-bottom: 25px;"></div><div class="divider" style="height: 15px;"></div>
			</div>
			<div class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide clearfix" id="tab-taxi-deals" style="visibility: hidden; position: absolute; opacity: 0; left: -9999px; display: none;">

	<div style="padding-top: 0px; padding-bottom: 0px; " class="wpb_row vc_row-fluid vc_row standard_section   " data-bg-mobile-hidden="" id="fws_558f8b37b3521"><div class="row-bg-wrap"> <div style="" class="row-bg   "></div> </div><div class="col span_12  ">
	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-12 search-box-control wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">
			<div lang="en-US" dir="ltr" id="wpcf7-f942-p42-o3" class="wpcf7" role="form">
<div class="screen-reader-response"></div>
<form novalidate="novalidate" class="wpcf7-form" method="post" action="/dev-site/#wpcf7-f942-p42-o3" name="">
<div style="display: none;">
<input type="hidden" value="942" name="_wpcf7">
<input type="hidden" value="4.2" name="_wpcf7_version">
<input type="hidden" value="en_US" name="_wpcf7_locale">
<input type="hidden" value="wpcf7-f942-p42-o3" name="_wpcf7_unit_tag">
<input type="hidden" value="fe806bc7b9" name="_wpnonce">
</div>
<p><span class="wpcf7-form-control-wrap text-396"><input type="text" aria-invalid="false" class="wpcf7-form-control wpcf7-text" size="40" value="Search" name="text-396"></span></p>
<div class="wpcf7-response-output wpcf7-display-none"></div></form></div>
		</div>
	</div>
</div></div><div class="divider" style="height: 23px;"></div>
	<div style="padding-top: 0px; padding-bottom: 0px; " class="wpb_row vc_row-fluid vc_row standard_section   " data-bg-mobile-hidden="" id="fws_558f8b37b4a2c"><div class="row-bg-wrap"> <div style="" class="row-bg   "></div> </div><div class="col span_12  ">
	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-4 wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">
			<div class="img-with-aniamtion-wrap left"><img width="100%" height="100%" alt="" src="http://taxideals.com.au/dev-site/wp-content/uploads/2015/06/car-icon.png" data-animation="fade-in" data-delay="0" class="img-with-animation tab-image" style="opacity: 1;"></div>
	<div class="wpb_text_column wpb_content_element  tab-image-text">
		<div class="wpb_wrapper">
			<p style="text-align: left;"><span style="color: #767676;">Date&nbsp; : ?</span><br>
<span style="color: #767676;"> Tiem : Morning/Afternoon</span><br>
<span style="color: #767676;"> Taxi Number&nbsp;&nbsp; &nbsp;: ?</span><br>
<span style="color: #767676;"> Taxi Network&nbsp;&nbsp; &nbsp;:</span></p>

		</div>
	</div>
		</div>
	</div>

	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-4 wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<p><span style="color: #767676;">Car type&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; : ?</span><br>
<span style="color: #767676;"> Fuel Type&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;: ?</span><br>
<span style="color: #767676;"> Shift Rate&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;: $, Comment</span></p>

		</div>
	</div>
		</div>
	</div>

	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-4 wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<h3><span style="color: #e75f27;"><strong>Name&nbsp; : (Operator name)</strong></span></h3>
<p><span style="color: #767676;">Mob&nbsp;&nbsp; &nbsp;: 0434 XXX XXX [captcha button]</span><br>
<span style="color: #767676;"> Address&nbsp;&nbsp; &nbsp;: (Operator Address)</span></p>

		</div>
	</div>
		</div>
	</div>
</div></div><div class="divider-border" style="margin-top: 25px; margin-bottom: 25px;"></div>
	<div style="padding-top: 0px; padding-bottom: 0px; " class="wpb_row vc_row-fluid vc_row standard_section   " data-bg-mobile-hidden="" id="fws_558f8b37b705f"><div class="row-bg-wrap"> <div style="" class="row-bg   "></div> </div><div class="col span_12  ">
	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-4 wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">
			<div class="img-with-aniamtion-wrap left"><img width="100%" height="100%" alt="" src="http://taxideals.com.au/dev-site/wp-content/uploads/2015/06/car-icon.png" data-animation="fade-in" data-delay="0" class="img-with-animation tab-image" style="opacity: 1;"></div>
	<div class="wpb_text_column wpb_content_element  tab-image-text">
		<div class="wpb_wrapper">
			<p style="text-align: left;"><span style="color: #767676;">Date&nbsp; : ?</span><br>
<span style="color: #767676;"> Tiem : Morning/Afternoon</span><br>
<span style="color: #767676;"> Taxi Number&nbsp;&nbsp; &nbsp;: ?</span><br>
<span style="color: #767676;"> Taxi Network&nbsp;&nbsp; &nbsp;:</span></p>

		</div>
	</div>
		</div>
	</div>

	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-4 wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<p><span style="color: #767676;">Car type&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; : ?</span><br>
<span style="color: #767676;"> Fuel Type&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;: ?</span><br>
<span style="color: #767676;"> Shift Rate&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;: $, Comment</span></p>

		</div>
	</div>
		</div>
	</div>

	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-4 wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<h3><span style="color: #e75f27;"><strong>Name&nbsp; : (Operator name)</strong></span></h3>
<p><span style="color: #767676;">Mob&nbsp;&nbsp; &nbsp;: 0434 XXX XXX [captcha button]</span><br>
<span style="color: #767676;"> Address&nbsp;&nbsp; &nbsp;: (Operator Address)</span></p>

		</div>
	</div>
		</div>
	</div>
</div></div>
	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">

		</div>
	</div> <div class="divider-border" style="margin-top: 25px; margin-bottom: 25px;"></div><div class="divider" style="height: 15px;"></div>
			</div>
			<div class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide clearfix" id="tab-plates-leasesale" style="visibility: visible; position: relative; opacity: 1; left: 0px; display: block;">

	<div style="padding-top: 0px; padding-bottom: 0px; " class="wpb_row vc_row-fluid vc_row standard_section   " data-bg-mobile-hidden="" id="fws_558f8b37b96cc"><div class="row-bg-wrap"> <div style="" class="row-bg   "></div> </div><div class="col span_12  ">
	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-12 search-box-control wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">
			<div lang="en-US" dir="ltr" id="wpcf7-f942-p42-o4" class="wpcf7" role="form">
<div class="screen-reader-response"></div>
<form novalidate="novalidate" class="wpcf7-form" method="post" action="/dev-site/#wpcf7-f942-p42-o4" name="">
<div style="display: none;">
<input type="hidden" value="942" name="_wpcf7">
<input type="hidden" value="4.2" name="_wpcf7_version">
<input type="hidden" value="en_US" name="_wpcf7_locale">
<input type="hidden" value="wpcf7-f942-p42-o4" name="_wpcf7_unit_tag">
<input type="hidden" value="fe806bc7b9" name="_wpnonce">
</div>
<p><span class="wpcf7-form-control-wrap text-396"><input type="text" aria-invalid="false" class="wpcf7-form-control wpcf7-text" size="40" value="Search" name="text-396"></span></p>
<div class="wpcf7-response-output wpcf7-display-none"></div></form></div>
		</div>
	</div>
</div></div><div class="divider" style="height: 23px;"></div>
	<div style="padding-top: 0px; padding-bottom: 0px; " class="wpb_row vc_row-fluid vc_row standard_section    " data-bg-mobile-hidden="" id="fws_558f8b37babde"><div class="row-bg-wrap"> <div style="" class="row-bg   "></div> </div><div class="col span_12  ">
	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-8 paragraph-text wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

	<div class="wpb_text_column wpb_content_element  tab-paragraph-text">
		<div class="wpb_wrapper">
			<p style="text-align: left;"><span style="color: #767676;">The operator area or once logged in (profile page) should have a dashboard kind of page where every options can be seen easily such as Manage profile, Public Information, Profiles of taxi added, History of ads with number of hits etc and each expanding if possible. The operator area or once logged in (profile page) should have a dashboard kind of page where.</span></p>

		</div>
	</div>
		</div>
	</div>

	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-4 wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<h3><span style="color: #e75f27;"><strong>Name&nbsp; : (Operator name)</strong></span></h3>
<p><span style="color: #767676;">Mob&nbsp;&nbsp; &nbsp;: 0434 XXX XXX [captcha button]</span><br>
<span style="color: #767676;"> Address&nbsp;&nbsp; &nbsp;: (Operator Address)</span></p>

		</div>
	</div>
		</div>
	</div>
</div></div><div class="divider-border" style="margin-top: 25px; margin-bottom: 25px;"></div>
	<div style="padding-top: 0px; padding-bottom: 0px; " class="wpb_row vc_row-fluid vc_row standard_section   " data-bg-mobile-hidden="" id="fws_558f8b37bbfc0"><div class="row-bg-wrap"> <div style="" class="row-bg   "></div> </div><div class="col span_12  ">
	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-8 paragraph-text wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

	<div class="wpb_text_column wpb_content_element  tab-paragraph-text">
		<div class="wpb_wrapper">
			<p style="text-align: left;"><span style="color: #767676;">The operator area or once logged in (profile page) should have a dashboard kind of page where every options can be seen easily such as Manage profile, Public Information, Profiles of taxi added, History of ads with number of hits etc and each expanding if possible. The operator area or once logged in (profile page) should have a dashboard kind of page where.</span></p>

		</div>
	</div>
		</div>
	</div>

	<div data-delay="0" data-animation="" data-hover-bg="" data-padding-pos="all" class="vc_col-sm-4 wpb_column column_container col no-extra-padding">
		<div class="wpb_wrapper">

	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<h3><span style="color: #e75f27;"><strong>Name&nbsp; : (Operator name)</strong></span></h3>
<p><span style="color: #767676;">Mob&nbsp;&nbsp; &nbsp;: 0434 XXX XXX [captcha button]</span><br>
<span style="color: #767676;"> Address&nbsp;&nbsp; &nbsp;: (Operator Address)</span></p>

		</div>
	</div>
		</div>
	</div>
</div></div><div class="divider-border" style="margin-top: 25px; margin-bottom: 25px;"></div><div class="divider" style="height: 15px;"></div>
			</div>
		</div>
	</div>
		</div>
	</div>
</div>
EOT;

    return isset($_GET['module']) && strcmp($_GET['module'], 'taxideal-search') == 0 ? $content . $search_content : $content;
}

add_filter('the_content','taxideal_search');