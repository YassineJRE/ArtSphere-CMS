<?php

namespace App\Http\Controllers\Web;

use App\Exceptions\ServiceException;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Http\Requests\Web\Media\DestroyRequest;
use App\Services\Web\MediaService;

class MediaController extends BaseController
{
    public function __construct(MediaService $service)
    {
        $this->service = $service;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\Media\DestroyRequest $request
     * @param Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @return Response
     */
    public function destroy(DestroyRequest $request, Media $media)
    {
        try {

            $this->service->destroy($media);

            return response()->json([
                'status' => 'success',
                'message' => __('media.message.success.file-deleted-success')
            ]);
        } catch (ServiceException $e) {
            return response()->json([
                'status' => 'error', 
                'message' => $e->getMessage()
            ]);
        }
    }
}
