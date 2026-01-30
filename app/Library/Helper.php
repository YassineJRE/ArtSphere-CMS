<?php

namespace App\Library;

class Helper
{
    /**
     * Get Youtube video ID from URL
     *
     * @param string $url
     * @return string|bool Youtube video ID or FALSE if not found
     */
    public static function getYouTubeVideoIdFromUrl($url): string | bool
    {
        $pattern = '%^
            (?:https?://)?                     # optional scheme
            (?:www\.)?                        # optional www
            (?:                              # group of allowed domains
                youtube\.com                 # youtube.com domain
                | youtu\.be                  # youtu.be domain
                | youtube-nocookie\.com      # youtube-nocookie.com domain
            )
            /?                               # optional slash
            (?:                              # path prefixes for id
                watch\?v=                   # watch?v=videoid
                | embed/                    # embed/videoid
                | v/                        # v/videoid
                | .*v=                      # other query params before v=
                |                           # or directly on youtu.be/
            )
            ([a-zA-Z0-9_-]{11})              # the 11 char video id
            (?:\S+)?                        # optional other query params
            $%x';

        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }

        return false;
    }

    /**
     * Get Vimeo video ID from URL
     *
     * @param string $url
     * @return string|bool Vimeo video ID or FALSE if not found
     */
    public static function getVimeoIdFromUrl($url): string | bool
    {
        $regex = '~
            # Match Vimeo link and embed code
            (?:<iframe [^>]*src=")?              # If iframe match up to first quote of src
            (?:                                  # Group vimeo url
                    https?:\/\/                  # Either http or https
                    (?:[\w]+\.)*                 # Optional subdomains
                    vimeo\.com                   # Match vimeo.com
                    (?:[\/\w:]*(?:\/videos)?)?   # Optional video sub directory this handles groups links also
                    \/                           # Slash before Id
                    ([0-9]+)                     # $1: VIDEO_ID is numeric
                    [^\s]*                       # Not a space
            )                                    # End group
            "?                                   # Match end quote if part of src
            (?:[^>]*></iframe>)?                 # Match the end of the iframe
            (?:<p>.*</p>)?                       # Match any title information stuff
            ~ix';

        preg_match($regex, $url, $match);

        return $match[1] ?? false;
    }

    /**
     * Generate YouTube embed URL from video ID
     *
     * @param string $videoId
     * @return string
     */
    public static function generateYouTubeUrl($videoId): string
    {
        return "//www.youtube.com/embed/{$videoId}?&autohide=1&showinfo=0&modestbranding=1&controls=0&mute=0&rel=0&enablejsapi=1";
    }

    /**
     * Generate Vimeo embed URL from video ID
     *
     * @param string $videoId
     * @return string
     */
    public static function generateVimeoUrl($videoId): string
    {
        return "https://player.vimeo.com/video/{$videoId}?&loop=1&title=0&byline=0&portrait=0&muted=1&";
    }
}
