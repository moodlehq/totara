// Search for the given terms and display a list of the matching objectives
function search_objectives(curriculum, revid) {

    var searchterms = getobject('searchterms' + curriculum);

    var urlparams = 'curriculum=' + curriculum + '&revid=' + revid
        + '&searchterms=' + encodeURIComponent(searchterms.value);

    document.body.style.cursor = 'wait';
    sendjsonrequest('search.json.php', urlparams,
                    function (data) {
                        // Fix focus
                        var searchbutton = getobject('searchobj' + curriculum);
                        searchbutton.focus();
                        searchbutton.blur();

                        close_divgroup(null);

                        var searchresults = getobject('searchresults' + curriculum);
                        searchresults.innerHTML = data['data'];

                        var clearbutton = getobject('clearresults' + curriculum);
                        clearbutton.style.display = '';

                        // IE6 needs this delay hack :(
                        setTimeout( function() { document.location.hash = 'searchresults_' + curriculum + "_a"; }, 100);
                        document.body.style.cursor = 'auto';

                    },
                    function (errormsg) {
                        alert(errormsg);
                    });
}

// Clear the old search results
function clear_search_results(curriculum) {
    // Fix focus
    var clearbutton = getobject('clearresults' + curriculum);
    clearbutton.focus();
    clearbutton.blur();

    var searchresults = getobject('searchresults' + curriculum);
    searchresults.innerHTML = '';

    var searchterms = getobject('searchterms' + curriculum);
    searchterms.value = '';

    clearbutton.style.display = 'none';
}
