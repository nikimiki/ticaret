$(document).ready(function() { 

	(function ($) { 
		$('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
		
		$('.tab ul.tabs li a').click(function (g) { 
			var tab = $(this).closest('.tab'), 
				index = $(this).closest('li').index();
			
			tab.find('ul.tabs > li').removeClass('current');
			$(this).closest('li').addClass('current');
			
			tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
			tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
			
			g.preventDefault();
		} );
	})(jQuery);

	(function ($) {
		$('.cnt ul.cntTabs').addClass('activeTab').find('> li:eq(0)').addClass('currentTab');

		$('.cnt ul.cntTabs li a').click(function (f) {
			var tab = $(this).closest('.cnt'),
				index = $(this).closest('li').index();

			tab.find('ul.cntTabs > li').removeClass('currentTab');
			$(this).closest('li').addClass('currentTab');

			tab.find('.cnt_content').find('div.cnt_item').not('div.cnt_item:eq(' + index + ')').slideUp();
			tab.find('.cnt_content').find('div.cnt_item:eq(' + index + ')').slideDown();

			f.preventDefault();
		});
	})(jQuery);

});