<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\User\SearchService;

class SearchController extends Controller
{
     /**
     * @var SearchService
     */
    private $searchService;

    /**
     * SearchController constructor.
     *
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }
    /**
     * Displays home website.
     *
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        return view('user.search', $this->searchService->search($request));
    }
}
