function changePage(num) {
		var totalPages = $('.data-page').length;
		var activePage = $('.data-block .active').attr('id');
		if(!activePage) {
			activePage='page0';
		}
		var page=(isNaN(num))? this.className : 'page'+num ;
		var newPageNumber = page.replace('page','');
		if($(this).hasClass('pager-dir')){
			var dir = $(this).hasClass('previous') ? -1: 1;
			newPageNumber = activePage.replace('page','');
			newPageNumber = parseInt(newPageNumber) + dir;
			if (newPageNumber<=0) {newPageNumber=1;}
			if (newPageNumber>totalPages) {newPageNumber=totalPages;}
			page='page'+newPageNumber;
		}
		
		if(activePage!=page) {
			$('.data-block .active').removeClass('active');
			$('#'+page).addClass('active');
			$('.pager .active').removeClass('active');
			$('.'+page).addClass('active');
			$('.actualPage').text(newPageNumber+' ');
			(newPageNumber<totalPages)? $('.next').removeClass('disabled') : $('.next').addClass('disabled');
			(newPageNumber>1)? $('.previous').removeClass('disabled') : $('.previous').addClass('disabled');
		}
}
$(document).ready( function() {
		$('.pager li').click(changePage);
});
