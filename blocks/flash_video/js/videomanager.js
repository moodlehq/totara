YAHOO.util.Event.onDOMReady(videoManagerDialogInit);

var videoManagerDialog;
var resultstablediv;

function videoManagerDialogInit() {
	
	// This populates the results table with the list of available of videos when the page first loads
	populateResultsTable();

	// This sets up the video manager dialog pop up
	videoManagerDialog = new YAHOO.widget.Dialog("videomanager", 
			{ width : "700px",
			  fixedcenter : true,
			  visible : false, 
			  constraintoviewport : true,
			  hideaftersubmit: false,
			  modal: false,
			  buttons : [ { text:"Close", handler:handleVideoManagerClose } ]
			 } );
	videoManagerDialog.callback.success = onSearchVideoSuccess;
	videoManagerDialog.callback.failure = onSearchVideoFailure;
	videoManagerDialog.render();
}

var handleVideoManagerSearch = function() {
	this.submit();
};

var handleVideoManagerClose = function() {
	this.cancel();
};

var onSearchVideoSuccess = function(o){
	if(o.responseText !== undefined){
		resultstablediv.innerHTML = o.responseText;
	}
}

var onSearchVideoFailure = function(o){
	if(o.responseText !== undefined){
		resultstablediv.innerHTML = "An error occurred. Results cannot be displayed";
	}
}

var initVideosCallback =
{
  success: onSearchVideoSuccess,
  failure: onSearchVideoFailure,
};

function populateResultsTable() {
	var sUrl = "ajax/searchvideo.php";
	resultstablediv = document.getElementById('resultstable');
	var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, initVideosCallback);	
}

function showVideoManagerDialog() {
	videoManagerDialog.show();
}

