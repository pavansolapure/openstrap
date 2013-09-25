jQuery(document).ready( function($) {
  	var image_uploader;
	
	$('#widgets-right').ajaxComplete( function(event, XMLHttpRequest, ajaxOptions) {

	$( '#widgets-right .widget-sortable' ).sortable({
		connectWith: '.connected',
		update: function( event, ui ){ updateData(event, ui) }
	});
	
	$("#widgets-right .widget-checkbox").change(function(){
		if (this.checked) {
			$(this).parent().addClass('tab-selected');			
		}
		else {
			$(this).parent().removeClass('tab-selected');			
		}
	});
	$("#widgets-right .media-upload-btn").click(function(e){
		mediaUploader( e );
	});	
	$("#widgets-right .media-upload-del").click(function(e){
		mediaClear( e );
	});	
		
	});

	$( '#widgets-right .widget-sortable' ).sortable({
		connectWith: '.connected',
		update: function( event, ui ){ updateData(event, ui) }
	});
	
	function updateData(event, ui) {
		var $target = $(event.target);
		
		var $data = $target.sortable('serialize');
		
		if ( $target.is('#widget-nav-tabs') ) {
			$target.parent().children('.advantagedata').val( $data );
		}
	}

	function mediaClear( e ) {
        e.preventDefault();
		image_url = $(e.target).siblings('.media-upload-url');
		image_url.val( '' );
		wpWidgets.save( image_url.closest('div.widget'), 0, 1, 0 );
	}

	function mediaUploader( e ) {
        e.preventDefault();

		image_url = $(e.target).siblings('.media-upload-url');
		
        if (image_uploader) {
            image_uploader.open();
            return;
        }
        image_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        image_uploader.on('select', function() {
            attachment = image_uploader.state().get('selection').first().toJSON();
            image_url.val( attachment.id );			
			wpWidgets.save( image_url.closest('div.widget'), 0, 1, 0 );
        });
 
        image_uploader.open();		
	}
	
	$("#widgets-right .widget-checkbox").change(function(){
		if (this.checked) {
			$(this).parent().addClass('tab-selected');			
		}
		else {
			$(this).parent().removeClass('tab-selected');			
		}
	});

	$("#widgets-right .media-upload-btn").click(function(e){
		mediaUploader( e );
	});	
	$("#widgets-right .media-upload-del").click(function(e){
		mediaClear( e );
	});	
});

