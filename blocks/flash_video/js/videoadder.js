YAHOO.util.Event.onDOMReady(videoAdderDialogInit);

var videoAdderDialog;
var videoUploadingMessaagePanel;

function videoAdderDialogInit() {
	
	// This sets up the video adder dialog pop up
	videoAdderDialog = new YAHOO.widget.Dialog("videoadder", 
			{ width : "500px",
			  fixedcenter : true,
			  visible : false, 
			  constraintoviewport : true,
			  modal: true,
			  buttons : [ { text:"Submit", handler:handleVideoAdderSubmit, isDefault:true },
						  { text:"Cancel", handler:handleVideoAdderCancel } ]
			 } );
	videoAdderDialog.callback.upload = onAddVideoUpload;
	videoAdderDialog.render();

	// This sets up a loading message that will be displayed while a video is uploading
	videoUploadingMessaagePanel = new YAHOO.widget.Panel("wait",  
											{ width:"240px", 
											  fixedcenter:true, 
											  close:false, 
											  draggable:false, 
											  modal:true,
											  visible:false 
											} 
										);

	videoUploadingMessaagePanel.setHeader("Uploading, please wait...");
	videoUploadingMessaagePanel.setBody('<img src="pix/loading.gif" />');
	videoUploadingMessaagePanel.render('videoadder');
			
}

var handleVideoAdderSubmit = function() {
	videoUploadingMessaagePanel.show();
	this.submit();
};

var handleVideoAdderCancel = function() {
	this.cancel();
};

var onAddVideoUpload = function(o) {
	
	videoUploadingMessaagePanel.hide();

	var json_object = eval( "(" + o.responseText + ")" );
	
	if(json_object['result'] == true) {
		addToPlaylist(json_object['videoid'], json_object['videotitle']);
		videoManagerDialog.cancel();
	} else {
		alert(json_object['error']);
		//alert("A problem occurred. Please try again.");
	}
};

function showAddVideoDialog() {
	videoAdderDialog.show();
}

