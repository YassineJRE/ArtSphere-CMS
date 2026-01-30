<?php

namespace Tests\Unit;

use App\Library\Helper;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    /** @test */
    public function it_can_extract_youtube_video_id_from_various_urls()
    {
        $urls = [
            'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'http://youtube.com/embed/dQw4w9WgXcQ',
            'https://youtu.be/dQw4w9WgXcQ',
            'www.youtube.com/watch?v=dQw4w9WgXcQ',
            'youtube.com/watch?v=dQw4w9WgXcQ',
        ];

        foreach ($urls as $url) {
            $this->assertSame('dQw4w9WgXcQ', Helper::getYouTubeVideoIdFromUrl($url));
        }

        // Test invalid url returns false
        $this->assertFalse(Helper::getYouTubeVideoIdFromUrl('https://notyoutube.com/watch?v=12345678901'));
        $this->assertFalse(Helper::getYouTubeVideoIdFromUrl('randomstring'));
    }

    /** @test */
    public function it_can_extract_vimeo_video_id_from_various_urls()
    {
        $urls = [
            'https://vimeo.com/123456789',
            'http://player.vimeo.com/video/123456789',
            '<iframe src="https://player.vimeo.com/video/123456789" width="640" height="360"></iframe>',
            'https://vimeo.com/channels/staffpicks/123456789',
        ];

        foreach ($urls as $url) {
            $this->assertSame('123456789', Helper::getVimeoIdFromUrl($url));
        }

        // Test invalid url returns false
        $this->assertFalse(Helper::getVimeoIdFromUrl('https://notvimeo.com/123456789'));
        $this->assertFalse(Helper::getVimeoIdFromUrl('randomstring'));
    }

    /** @test */
    public function it_generates_correct_youtube_embed_url()
    {
        $videoId = 'dQw4w9WgXcQ';
        $expected = "//www.youtube.com/embed/dQw4w9WgXcQ?&autohide=1&showinfo=0&modestbranding=1&controls=0&mute=0&rel=0&enablejsapi=1";
        $this->assertSame($expected, Helper::generateYouTubeUrl($videoId));
    }

    /** @test */
    public function it_generates_correct_vimeo_embed_url()
    {
        $videoId = '123456789';
        $expected = "https://player.vimeo.com/video/123456789?&loop=1&title=0&byline=0&portrait=0&muted=1&";
        $this->assertSame($expected, Helper::generateVimeoUrl($videoId));
    }
}
