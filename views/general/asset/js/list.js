$(function(){

	$('#chkAll').click(function(){
	
		if ($(this).attr('checked'))
		{
			// check all
			$('.chkId').attr('checked', 'checked');
		}
		else
		{
			$('.chkId').removeAttr('checked');
		}
	
	});
	
	$('.chkId').click(function(){
	
		totalChk		= $('.chkId').length;
		totalChecked	= $('.chkId:checked').length;
		
		if (totalChk == totalChecked)
		{
			$('#chkAll').attr('checked', 'checked');
		}
		else
		{
			$('#chkAll').removeAttr('checked');
		}
	
	});

	$('#add_new_btn').click(function(){
	
		window.location.href = $(this).attr('rel');
	
	});
	
	$('#delete_btn').click(function(){
	
		if ($('.chkId:checked').length)
		{
			url = $(this).attr('rel');
			ids = new Array;
	
			$('.chkId:checked').each(function(i, el){
				ids.push($(el).val());
			});
			
			if (confirm('Are you sure you want to delete selected items?'))
			{
				window.location.href = url + '?ids=' + ids;
			}
			
		}
	
	});
	
	$('.delete_link').click(function(e){
		
		if (confirm('Are you sure you wanto to delete selected item?'))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	});

});