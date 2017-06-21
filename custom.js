if(jQuery(".comment-list").length >0){
jQuery(".comment-list").each(function(){
	var $this = jQuery(this);
	var container = $this.data('id');
	var current_page = $this.data('current_page');
	var show_per_page = $this.data('show_per_page');
	var page_navigation = $this.data('navigation');
	var number_of_items = $this.children().size();

	var item_of_page = jQuery(show_per_page).val();
	var number_of_pages = Math.ceil(number_of_items/item_of_page);

	// var navigation_html = '<li><span class="prev page-numbers fa fa-angle-double-left" onclick="previous(\'' + current_page +'\',\'' + container + '\',\'' + show_per_page + '\',' + number_of_pages + ');"></span></li>';
	var navigation_html ='';
	var current_link = 0;
	 while(number_of_pages > current_link){
            navigation_html += '<li><span class="page-numbers page_link" onclick="go_to_page(' + current_link +',\'' + container + '\',\'' + show_per_page + '\', \'' + current_page + '\')" longdesc="' + current_link +'">'+ (current_link + 1) +'</span></li>';
            current_link++;
        }
	// navigation_html += '<li><span onclick="next(\'' + current_page +'\',\'' + container + '\',\'' + show_per_page + '\', ' + number_of_pages + ');" class="next page-numbers fa fa-angle-double-right"></span></li>';

	jQuery(page_navigation).html(navigation_html);

	jQuery(page_navigation + ' .page_link:first').addClass('current');

	$this.children().css('display', 'none');

	//show the first n (show_per_page) items
        $this.children().slice(0, item_of_page).css('display', 'table-row');
        if ( number_of_pages <= 1 ) {
            $this.parent().parent().find('.pagination').remove();
        }

});
}

function previous(current_page, obj, show_per_page, number_of_pages){
    var new_page = parseInt(jQuery(current_page).val()) - 1;
    if ( new_page >= 0 && new_page < number_of_pages){
        go_to_page(new_page, obj, show_per_page, current_page);
    }
}
function next(current_page, obj, show_per_page, number_of_pages){
    var new_page = parseInt(jQuery(current_page).val()) + 1;
    if ( new_page >= 0 && new_page < number_of_pages){
        go_to_page(new_page, obj, show_per_page, current_page);
    }
}

function go_to_page(page_num, obj, show_per_page, current_page){
	//get items per page
    var show_per_page = parseInt(jQuery(show_per_page).val());

    //get element number start
    var start_from = page_num * show_per_page;

    //get the element number end
    var end_on = start_from + show_per_page;

    //hide all item in container, get items in current page to show
    jQuery(obj).children().css('display', 'none').slice(start_from, end_on).css('display', 'table-row');

    /* add current class to current page */
    jQuery('.page_link').removeClass('current');
    jQuery('.page_link[longdesc=' + page_num +']').addClass('current');

    //update the current page
    jQuery(current_page).val(page_num);
}