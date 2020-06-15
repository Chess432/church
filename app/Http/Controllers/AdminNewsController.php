<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\News;

class AdminNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $news = News::orderBy('created_at','desc')->paginate(2);
        
        return view('pages.news')->with('news', $news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.createnews');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Form Information
        $this->validate($request,[
            'subject' => 'required',
            'date' => 'required',
            'venue' => 'required',
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
            $path = $request->file('cover_image')->storeAs('public/news_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create a new Event
        $news = new News;
        $news->user_id = auth()->user()->id;
        $news->subject = $request->input('subject');
        $news->date = $request->input('date');
        $news->venue = $request->input('venue');
        $news->description = $request->input('description');
        $news->photo = $fileNameToStore;
        $news->save();

        return redirect('/news')->with('success', 'Event created successfully');
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
        // $news = News::orderBy('id','desc')->get();
        // return response()->json([
        //     'success' => true,
        //     'posts' => $news
        // ]);
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
        $news = News::find($id);
        return view('pages.editnews')->with('news', $news);
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
            'venue' => 'required',
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
            $path = $request->file('cover_image')->storeAs('public/news_images', $fileNameToStore);
        } 

        // Create a new license
        $news = News::find($id);
        $news->user_id = auth()->user()->id;
        $news->subject = $request->input('subject');
        $news->date = $request->input('date');
        $news->venue = $request->input('venue');
        $news->description = $request->input('description');
        if($request->hasFile('cover_image')){
            $news->photo = $fileNameToStore;
        }
        $news->save();

        return redirect('/news')->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);

        //Check if event exists before deleting
        if (!isset($news)){
            return redirect('/news')->with('error', 'No Event Found');
        }

        // Check for correct user
        // if(auth()->user()->id !==$news->user_id){
        //     return redirect('/news')->with('error', 'Unauthorized Page');
        // }


        if($news->photo != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/news_images/'.$news->photo);
        }


        $news->delete();
        return redirect('/news')->with('success', 'Item removed successfully');
    }
}
