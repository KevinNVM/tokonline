<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Auth;
use Illuminate\Http\Request;
use Str;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!(Auth::user()->isAdmin ?? true))
            $data = Notification::where('receiver', Auth::user()->username)->orWhere('receiver', '*')->paginate(10);
        else
            $data = Notification::paginate(100);

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!(Auth::user()->isAdmin ?? true)) return abort(404);

        $validated = $request->validate([
            'name' => 'required',
            'body' => 'required',
            'receiver' => 'required'
        ]);

        $validated['body'] = preg_replace('<user>', $validated['body'], $validated['receiver']);

        $validated['slug'] = Str::slug($validated['name']);

        Notification::create($validated);

        return response('', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        if (!(Auth::user()->isAdmin ?? true)) return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        if (!(Auth::user()->isAdmin ?? true)) return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        if (!(Auth::user()->isAdmin ?? true)) return abort(404);
        $notification->delete();
        return response('', 200);
    }
}