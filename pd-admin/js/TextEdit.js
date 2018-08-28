bkLib.onDomLoaded(function() {
    new nicEditor({maxHeight : 250}).panelInstance('area');
    new nicEditor({fullPanel : true,maxHeight : 250}).panelInstance('area1');
});