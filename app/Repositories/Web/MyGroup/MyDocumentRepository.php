<?php

namespace App\Repositories\Web\MyGroup;

use App\Models\Document;
use App\Repositories\Web\BaseRepository;
use App\Exceptions\RepositoryException;
use Exception;
use Illuminate\Support\Facades\DB;

class MyDocumentRepository extends BaseRepository
{
    /**
     * get instance Document Model.
     *
     * @return App\Models\Document
     */
    public function getModel()
    {
        return new Document();
    }

    /**
     * Change position
     *
     * @param App\Models\Document $document
     * @param int              $position  New position
     *
     * @return App\Models\Document
     */
    public function changePosition(Document $document, int $position): Document
    {
        try {
            $document = DB::transaction(function () use ($document, $position) {
                $documents = $document->owner->documents()->where('id','<>',$document->id)->orderBy('order_column')->get();
                $order_column = 1;
                $documentsOrdered = [];
                $documentsOrdered[$position] = $document;
                foreach ($documents as $currentDocument) {
                    if ($order_column == $position) {
                        $order_column++;
                    }
                    $documentsOrdered[$order_column++] = $currentDocument;
                }
                foreach ($documentsOrdered as $currentPosition => $currentDocument) {
                    parent::update($currentDocument, ['order_column' => $currentPosition]);
                }
                return $document;
            });

            return $document;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
}
