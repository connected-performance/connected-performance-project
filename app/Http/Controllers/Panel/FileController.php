<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FileRoom;
use Illuminate\Support\Facades\File;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file = FileRoom::get();
        $breadcrumbs = [
            ['link' => url("/file"), 'name' => 'Dashboard'],
            ['link' => url("/panel/file/"), 'name' => 'File'],
            ['name' => __('File Room')],
        ];
        return view('content.file.file',compact('file','breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $file = $request->file;
        $filename = $file->getClientOriginalName();
        $filenametime = time() . '-' . $filename;
        // dd($filenametime);
        $file = new FileRoom();
        $file->user_id =Auth::user()->id;
        $request->file->move(public_path('/uploadedfiles'), $filename);
        $file->file = $filename;
        $file->save();
        return redirect()->route('file.room');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        $file = FileRoom::findorfail($id);
        unlink(public_path('uploadedfiles/'. $file->file));
        // File::delete($filename);
        $file->delete();
        return redirect()->route('file.room');
    }
}
