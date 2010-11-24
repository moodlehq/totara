YAHOO.util.Event.onDOMReady(videoEditorDialogInit);

var videoEditorDialog;

function videoEditorDialogInit() {
	
	// This sets up the video editor dialog pop up
	videoEditorDialog = new YAHOO.widget.Dialog("videoeditor", 
			{ width : "400px",
			  fixedcenter : true,
			  visible : false, 
			  constraintoviewport : true,
			  modal: true,
			  buttons : [ { text:"Submit", handler:handleVideoEditorSubmit, isDefault:true },
						  { text:"Cancel", handler:handleVideoEditorCancel } ]
			 } );
	videoEditorDialog.callback.success = onEditVideoSuccess;
	videoEditorDialog.callback.failure = onEditVideoFailure;
	videoEditorDialog.render();
}

var handleVideoEditorSubmit = function() {
	this.submit();
};

var handleVideoEditorCancel = function() {
	this.cancel();
};

var onEditVideoSuccess = function(o){
	var json_object = eval( "(" + o.responseText + ")" );

	if(json_object['result'] == true) {
		alert('Update was successful');
		videoManagerDialog.submit();
	} else {
		alert('Update failed');
	}
}

var onEditVideoFailure = function(o){
	alert("An error occurred.");
}

var onPopulateVideoFieldsSuccess = function(o){
	var json_object = eval( "(" + o.responseText + ")" );

	if(json_object['result'] == true) {
		document.getElementById('edit_videoid').value = json_object['videoid'];
		document.getElementById('edit_videotitle').value = json_object['videotitle'];
		document.getElementById('edit_videodescription').value = json_object['videodescription'];
		document.getElementById('edit_videotags').value = json_object['videotags'];
	} else {
		alert(json_object['error']);
		//alert("A problem occurred. Please try again.");
	}
}

var onPopulateVideoFieldsFailure = function(o){
	alert("An error occurred.");
}

var populateVideoFieldsCallback =
{
  success: onPopulateVideoFieldsSuccess,
  failure: onPopulateVideoFieldsFailure,
};

var onConfirmDeleteVideoSuccess = function(o){
	var json_object = eval( "(" + o.responseText + ")" );

	if(json_object['result'] == true) {
		var confirmation = confirm(json_object['playlist_links_msg'] + "\n\nAre you sure that you want to delete this video?");
		if(confirmation) {
			deleteVideo(json_object['videoid']);
		}
	} else {
		alert('Delete failed');
	}
}

var onConfirmDeleteVideoFailure = function(o){
	alert("An error occurred.");
}

var confirmDeleteVideoCallback =
{
  success: onConfirmDeleteVideoSuccess,
  failure: onConfirmDeleteVideoFailure,
};

var onDeleteVideoSuccess = function(o){
	var json_object = eval( "(" + o.responseText + ")" );

	if(json_object['result'] == true) {
		alert('Delete was successful');
		videoManagerDialog.submit();
	} else {
		alert('Delete failed');
	}
}

var onDeleteVideoFailure = function(o){
	alert("An error occurred.");
}

var deleteVideoCallback =
{
	success: onDeleteVideoSuccess,
	failure: onDeleteVideoFailure,
};

function populateVideoFields(videoid) {
	var sUrl = "ajax/editvideo.php?id="+videoid+"&action=getfields";
	var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, populateVideoFieldsCallback);	
}

function showEditVideoDialog(videoid) {
	videoEditorDialog.show();
	populateVideoFields(videoid);
}

function confirmDeleteVideo(videoid) {
	var sUrl = "ajax/editvideo.php?id="+videoid+"&action=confirmdelete";
	var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, confirmDeleteVideoCallback);
}

function deleteVideo(videoid) {
	var sUrl = "ajax/editvideo.php?id="+videoid+"&action=delete";
	var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, deleteVideoCallback);
}



