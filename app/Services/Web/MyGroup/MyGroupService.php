<?php

namespace App\Services\Web\MyGroup;

use App\Exceptions\RepositoryException;
use App\Exceptions\ServiceException;
use App\Http\Requests\Web\IndexRequest;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\Web\MyGroup\MyGroupRepository;

class MyGroupService extends BaseService
{
    public function __construct(MyGroupRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request): ResourceCollection
    {
        return collect([]);
    }

    public function setFilter(IndexRequest $request, Builder $query): void
    {
        $this->filter = [
        ];
    }
	
	//GALLERY INVITATION FEATURE
	
	public function updateUserProfileForGallery($data, $groupId, $userId){
		
		$this->repository->updateUserProfileGallery($data, $groupId, $userId);
		
		return true;
		
	}
}
