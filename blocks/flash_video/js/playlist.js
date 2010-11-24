YAHOO.util.Event.onDOMReady(playlistInit);

var playlistdisplaydiv;

function playlistInit() {
	
	// This populates the playlist display with the videos in the current playlist
	displayPlaylist('');

}

function displayPlaylist(playlist) {
	playlistdisplaydiv = document.getElementById('playlistdisplay');
	
	var courseid = document.getElementById('id').value;
	var instanceid = document.getElementById('instanceid').value;
	var sUrl = 'ajax/playlist.php?id='+courseid+'&instanceid='+instanceid+'&action=showplaylist';

	if(playlist != '') {
		sUrl += '&playlist='+playlist;
	}

	var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, initPlaylistCallback);	
}

var onGetPlayListSuccess = function(o){
	var json_object = eval( "(" + o.responseText + ")" );
	if(json_object['result'] == true){
		playlistdisplaydiv.innerHTML = json_object['html'];
	}else{
		playlistdisplaydiv.innerHTML = "An error occurred. Playlist cannot be displayed";
	}
}

var onGetPlayListFailure = function(o){
	var json_object = eval( "(" + o.responseText + ")" );
	if(json_object['result'] == false){
		playlistdisplaydiv.innerHTML = json_object['error'];
	}else{
		playlistdisplaydiv.innerHTML = "An error occurred. Playlist cannot be displayed";
	}
}

var initPlaylistCallback =
{
  success: onGetPlayListSuccess,
  failure: onGetPlayListFailure,
};

function addToPlaylist(videoid, videotitle) {
	var playlist_el = document.getElementById('playlist');
	var playlist = '';
	if(playlist_el.value == '') {
		playlist = videoid;
	} else {
		playlist = playlist_el.value;
		playlist += ','+videoid;
	}
	playlist_el.value = playlist;
	displayPlaylist(playlist)
}

function removeFromPlaylist(videoposition) {
	var playlist_el = document.getElementById('playlist');
	var playlist = '';
	if(playlist_el.value == '') {
		playlist = '';
	} else {
		playlist = playlist_el.value;
		new_playlist = [];
		playlist_array = playlist.split(',');
		for (var i = 0; i < playlist_array.length; i++) {
			if(i == videoposition) {
				continue;
			} else {
				new_playlist[new_playlist.length] = playlist_array[i];
			}
		}
	}
	new_playlist_str = new_playlist.join(',');
	playlist_el.value = new_playlist_str;
	displayPlaylist(new_playlist_str);
}

