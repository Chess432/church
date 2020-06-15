<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Program;

class AdminProgramsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $program = Program::orderBy('created_at','desc')->paginate(2);
        
        return view('pages.programs')->with('programs', $program);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.createprograms');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/programs_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create a new license
        $program = new Program;
        $program->user_id = auth()->user()->id;
        $program->name = $request->input('name');
        $program->description = $request->input('description');
        $program->photo = $fileNameToStore;
        $program->save();

        return redirect('/programs')->with('success', 'Program created successfully');
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
        $program = Program::find($id);
        return view('pages.editprogram')->with('program', $program);
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
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/programs_images', $fileNameToStore);
        } 

        // Create a new license
        $program = Program::find($id);
        $program->user_id = auth()->user()->id;
        $program->name = $request->input('name');
        $program->description = $request->input('description');
        if($request->hasFile('cover_image')){
            $program->photo = $fileNameToStore;
        }
        $program->save();

        return redirect('/programs')->with('success', 'Program updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $program = Program::find($id);

        //Check if event exists before deleting
        if (!isset($program)){
            return redirect('/programs')->with('error', 'No program Found');
        }

        // Check for correct user
        // if(auth()->user()->id !==$program->user_id){
        //     return redirect('/programs')->with('error', 'Unauthorized Page');
        // }


        if($program->photo != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/programs_images/'.$program->photo);
        }


        $program->delete();
        return redirect('/programs')->with('success', 'Item removed successfully');
    }
}
