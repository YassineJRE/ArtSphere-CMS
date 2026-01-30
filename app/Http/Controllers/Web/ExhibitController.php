<?php

namespace App\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Models\Exhibit;
use App\Services\Web\ExhibitService;

class ExhibitController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ExhibitService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        $randomExhibitIds = $request->filled('ids') ? 
            Exhibit::find(explode(',', $request->get('ids')))->pluck('id') :
            $this->service->getRandomIds();
        $request->session()->put('randomExhibitIds', $randomExhibitIds);
        $first = Exhibit::find($randomExhibitIds->first());

        return redirect()->route('app.exhibits.show',[
            'exhibit' => $first,
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\Exhibit $exhibit
     *
     * @return Renderable
     */
    public function show(Request $request, Exhibit $exhibit)
    {
        if ($request->session()->has('randomExhibitIds')) {
            $randomExhibitIds = Exhibit::find($request->session()->get('randomExhibitIds',[]))->filter()->pluck('id');
        } else {
            $randomExhibitIds = $this->service->getRandomIds();
        }
        
        $exhibitsRemovedFromDB = app('profile.session')->getModelsRemovedFromDB()
            ->where('model_type', Exhibit::class)
            ->pluck('model_id');
        $randomExhibitIds = $randomExhibitIds->diff($exhibitsRemovedFromDB)->values();
        $request->session()->put('randomExhibitIds', $randomExhibitIds);
        $previousExhibitId = $randomExhibitIds->get($randomExhibitIds->search($exhibit->id) - 1);
        $nextExhibitId = $randomExhibitIds->get($randomExhibitIds->search($exhibit->id) + 1);

        if ( !$randomExhibitIds->contains($exhibit->id) ) {
            return redirect()->route('app.exhibits.show',[
                'exhibit' => $nextExhibitId,
            ]);
        }

        return view('exhibit.show', [
            'previousExhibitId' => $previousExhibitId ?? $randomExhibitIds->last(),
            'exhibit' => $exhibit,
            'nextExhibitId' => $nextExhibitId ?? $randomExhibitIds->first(),
        ]);
    }
}
