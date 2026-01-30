<?php

namespace App\Console\Commands;


use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Console\Command;

class DeleteAllMedias extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete all medias - all associated files will be deleted as well';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (Media::all() as $media) {
            $media->delete();
        }
    }
}
