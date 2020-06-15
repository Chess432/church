<?php

namespace App\Http\Controllers;
use App\Sermon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class AdminSermonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sermons = Sermon::orderBy('created_at','desc')->paginate(2);
        
        return view('pages.sermons')->with('sermons', $sermons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.createsermons');
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
         // Validate Form Information
         $this->validate($request,[
            'subject' => 'required',
            'date' => 'required',
            'text' => 'required',
            'scripture' => 'required',
            'speaker' => 'required',
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
            $path = $request->file('cover_image')->storeAs('public/sermons_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create a new sermon
        $sermons = new Sermon;
        $sermons->user_id = auth()->user()->id;
        $sermons->subject = $request->input('subject');
        $sermons->date = $request->input('date');
        $sermons->text = $request->input('text');
        $sermons->speaker = $request->input('speaker');
        $sermons->scripture = $request->input('scripture');
        $sermons->image = $fileNameToStore;
        $sermons->save();

        return redirect('/sermons')->with('success', 'Sermon created successfully');
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
        $sermon = Sermon::find($id);
        return view('pages.editsermon')->with('sermon', $sermon);
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
        
         // Validate Form Information
         $this->validate($request,[
            'subject' => 'required',
            'date' => 'required',
            'text' => 'required',
            'scripture' => 'required',
            'speaker' => 'required',
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
            $path = $request->file('cover_image')->storeAs('public/sermons_images', $fileNameToStore);
        } 

        // Create a new license
        $sermons = Sermon::find($id);
        $sermons->user_id = auth()->user()->id;
        $sermons->subject = $request->input('subject');
        $sermons->date = $request->input('date');
        $sermons->text = $request->input('text');
        $sermons->speaker = $request->input('speaker');
        $sermons->scripture = $request->input('scripture');
        if($request->hasFile('cover_image')){
            $sermons->image = $fileNameToStore;
        }
        $sermons->save();

        return redirect('/sermons')->with('success', 'Sermon updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sermon = Sermon::find($id);

        //Check if event exists before deleting
        if (!isset($sermon)){
            return redirect('/sermons')->with('error', 'No sermon Found');
        }

        // Check for correct user
        // if(auth()->user()->id !==$sermon->user_id){
        //     return redirect('/sermons')->with('error', 'Unauthorized Page');
        // }


        if($sermon->image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/sermons_images/'.$sermon->image);
        }


        $sermon->delete();
        return redirect('/sermons')->with('success', 'Sermon removed successfully');
    }
}
