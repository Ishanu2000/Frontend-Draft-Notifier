jQuery(document).ready(function($) {
    if (fdnData.draftCount > 0) {
        const btn = $('<div id="fdn-draft-button"></div>');
        btn.addClass(fdnData.position);
        btn.text(fdnData.draftCount + ' Drafts');
        btn.on('click', () => {
            window.open(fdnData.draftUrl, '_blank');
        });
        $('body').append(btn);
    }
});
