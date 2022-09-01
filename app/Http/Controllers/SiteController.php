<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Queries\QueryBuilderPages;
use App\Queries\QueryBuilderSites;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(QueryBuilderSites $sites)
    {
        $user_id = Auth::user()->id;

        return Inertia::render(
            'Sites',
            [
                'sites' => $sites->getSitesUserById($user_id),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
        ]);

        $user_id = Auth::id();

        User::find($user_id)->sites()->create([
            'name' => $request->name,
            'url' => $request->url,
            'last_check' => NULL,
            'status' => false
        ]);

        if (Site::where('url', '!=', $request->url)) {
            return Redirect::route('sites.index')->with('success', 'Запись успешно добавлена');
        }

        return back()->with('error', 'Ошибка добавления');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show(QueryBuilderPages $pages, $id)
    {
        return Inertia::render(
            'Pages',
            [
                'pages' => $pages->getPagesToSiteById($id)
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(QueryBuilderSites $sites, $id)
    {
        $sites->deleteSite($id);
    }
}