<?php

namespace App\Http\Controllers\Web;

use App\Services\Web\ResearchService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResearchController extends BaseController
{
    /**
     * @param ResearchService $researchService
     */
    public function __construct(protected ResearchService $researchService)
    {

    }

    /**
     * Display Search page.
     *
     * @param Request $request
     *
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        return view('research.index', $this->researchService->search($request));
    }

    /**
     * Load a specific carousel via AJAX.
     *
     * @param Request $request
     * @param string $type
     *
     * @return Renderable|JsonResponse
     */
    public function loadCarousel(Request $request, string $type): Renderable | JsonResponse
    {
        $types = ResearchService::getTypes();

        if (!array_key_exists($type, $types)) {
            return response()->json(['error' => 'Invalid carousel type'], 400);
        }

        $data = $this->researchService->search($request, [$type]);
        $view = $types[$type]['view'];

        return view($view, [$type => $data[$type]]);
    }
}
