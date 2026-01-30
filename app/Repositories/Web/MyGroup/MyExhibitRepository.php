<?php

namespace App\Repositories\Web\MyGroup;

use App\Models\Group;
use App\Models\Exhibit;
use App\Models\UserProfile;
use App\Repositories\Web\BaseRepository;
use App\Exceptions\RepositoryException;
use Exception;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MyExhibitRepository extends BaseRepository
{
    /**
     * get instance Exhibit Model.
     *
     * @return App\Models\Exhibit
     */
    public function getModel()
    {
        return new Exhibit();
    }

    /**
     * Transfer to Artist Profile
     *
     * @param App\Models\Exhibit $exhibit
     * @param array              $data  Atributes of Exhibit
     *
     * @return App\Models\Exhibit
     */
    public function transferTo(Exhibit $exhibit, array $data): Exhibit
    {
        try {
            $exhibit = DB::transaction(function () use ($exhibit, $data) {
                parent::update($exhibit, [
                    'transferor_type' => $exhibit->owner_type,
                    'transferor_id' => $exhibit->owner_id,
                    'transferred_at' => Carbon::now(),
                    'owner_id' => $data['user_profile_id'],
                    'owner_type' => UserProfile::class,
                    'special_thanks' => $exhibit->owner->getName()
                ]);

                return $this->read($exhibit->id);
            });

            return $exhibit;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Change position
     *
     * @param App\Models\Exhibit $exhibit
     * @param int              $position  New position
     *
     * @return App\Models\Exhibit
     */
    public function changePosition(Exhibit $exhibit, int $position): Exhibit
    {
        try {
            $exhibit = DB::transaction(function () use ($exhibit, $position) {
                $exhibits = $exhibit->owner->exhibits()->where('id','<>',$exhibit->id)->orderBy('order_column')->get();
                $order_column = 1;
                $exhibitsOrdered = [];
                $exhibitsOrdered[$position] = $exhibit;
                foreach ($exhibits as $currentExhibit) {
                    if ($order_column == $position) {
                        $order_column++;
                    }
                    $exhibitsOrdered[$order_column++] = $currentExhibit;
                }
                foreach ($exhibitsOrdered as $currentPosition => $currentExhibit) {
                    parent::update($currentExhibit, ['order_column' => $currentPosition]);
                }
                return $exhibit;
            });

            return $exhibit;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
}
