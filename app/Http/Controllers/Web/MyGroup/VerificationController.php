<?php

namespace App\Http\Controllers\Web\MyGroup;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use App\Enums\VerifiedStatus;
use Exception;
use App\Exceptions\ServiceException;
use App\Exceptions\MailException;
use App\Http\Controllers\Web\BaseController;
use App\Enums\ExhibitType;
use App\Enums\Status as EnumStatus;
use App\Models\Group;
use App\Models\Exhibit;
use App\Models\UserProfile;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Web\MyGroup\Verification\IndexRequest;
use App\Http\Requests\Web\MyGroup\Verification\UpdateRequest;
use App\Services\Web\MyGroup\VerificationService;
use Carbon\Carbon;


class VerificationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Web\MyGroup\Verification\IndexRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return Renderable
     */
    public function index(IndexRequest $request, Group $myGroup)
    {
        $filter = $request->input('filter', VerifiedStatus::PENDING);
        return view('my-group.verification.index', [
            'myGroup' => $myGroup, 'filter'=>$filter
        ]);
    }

    /**
     * confirm the verififaction of the specified exhibit.
     *
     * @param App\Http\Requests\Web\MyGroup\Verification\UpdateRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\Exhibit $exhibit
     *
     * @return void
     */
    public function update(UpdateRequest $request,  Group $myGroup, Exhibit $exhibit){
        try {        
            $exhibit->fill([
                'verified_status' => $request->input('verified_status'),
                'verified_at' => Carbon::now(),
                'verifier_id' => $myGroup->id
            ])->save();
        
            return back()->withSuccess(__('my-group-verification.message.success.exhibit-updated'));
        } catch (ValidationException $e) {
            // Validation failed, Laravel will handle the redirection and errors
            // You can add additional logic if needed
            return back()->withErrors($e->validator->errors());
        } catch (Exception $e) {
            // Handle other exceptions
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\Group $myGroup
     * @param App\Models\Exhibit $myExhibit
     *
     * @return Renderable
     */
    public function show(Request $request, Group $myGroup, Exhibit $exhibit)
    {
        return view('my-group.verification.show', [
            'myGroup' => $myGroup,
            'exhibit' => $exhibit,
        ]);
    }
   
}

