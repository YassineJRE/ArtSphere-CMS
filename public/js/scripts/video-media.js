/* ----------------- Start Functions ----------------- */
function getYouTubeVideoIdFromUrl(url) {
    // Our regex pattern to look for a youTube ID
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    //Match the url with the regex
    const match = url.match(regExp);
    //Return the result
    return match && match[2].length === 11 ? match[2] : undefined;
};
function getVimeoIdFromUrl(url) {
    // Look for a string with 'vimeo', then whatever, then a
    // forward slash and a group of digits.
    const match = /vimeo.*\/(\d+)/i.exec(url);
    // If the match isn't null (i.e. it matched)
    if (match) {
        // The grouped/matched digits from the regex
        return match[1];
    }
};
function generateYouTubeUrl(videoId) {
    return `//www.youtube.com/embed/${videoId}?&autohide=1&showinfo=0&modestbranding=1&controls=0&mute=0&rel=0&enablejsapi=1`;
};
function generateVimeoUrl(videoId) {
    return `https://player.vimeo.com/video/${videoId}?&loop=1&title=0&byline=0&portrait=0&muted=1&`;
};
function isValidHttpUrl(string) {
    let url;
    try {
        url = new URL(string);
    } catch (_) {
        return false;  
    }
    return url.protocol === "http:" || url.protocol === "https:";
}
/* ----------------- End Functions ----------------- */

/* ----------------- Start Document ----------------- */
(function($){
    "use strict";

    $(document).ready(function(){

        $(function() {

        });
    });
})(this.jQuery);
/* ----------------- End Document ----------------- */