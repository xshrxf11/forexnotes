<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Note;
use App\User;
use Yajra\DataTables\Datatables;
use DB;
use Helper;

class NotesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$user_id = auth()->user()->id;
        //$user = User::find($user_id);

        // $notes = Note::where('user_id', '=', $user_id)
        // ->orderBy('created_at','desc')->paginate(5);
        // //->get();
        // return view('notes.index')->with('notes',$notes);
        //return view('notes.index')->with('user',$user);
        //return $user;
        return view('notes.index');
        
    }

    public function getNotes()
    {
        $user_id = auth()->user()->id;
        // $notes = Note::all();
        $notes = Note::where('user_id', '=', $user_id);
        return Datatables::of($notes)
        ->addColumn('Action', 'notes.action')
        //  ->addColumn('Action', function ($notes) {
        //     return '<a href="/notes/'.$notes->notes_id.'" class="btn btn-xs btn-primary">Open</a> '.
        //             '<a href="/notes/'.$notes->notes_id.'/edit" class="btn btn-xs btn-warning">Edit</a> '.
        //             '<a class="btn btn-xs btn-danger">Delete</a>';
        // })
        ->editColumn('created_at', function(Note $notes) {
            return $notes->created_at->format('d/m/Y H:i A');
        })
        ->rawColumns(['Action'])
        ->toJson();
        //->make(true);
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'news' => 'required',
            'currency' => 'required',
            'moving_market' => 'required',
            'previous' => 'required',
            'constant' => 'required',
            'bloomberg_status' => 'required',
            'summary' => 'required',
            'before_image' => 'image|nullable|max:1999',
            'after_image' => 'image|nullable|max:1999',
        ]);
        
        $fileNameToStore_before = 'noimage.jpg';
        $fileNameToStore_after = 'noimage.jpg';

        //Handle File Upload
        if($request->hasFile('before_image')){
            //Get filename with extension
            $filenameWithExt_before = $request->file('before_image')->getClientOriginalName();
            //Get filename
            $filename_before = pathinfo($filenameWithExt_before, PATHINFO_FILENAME);
            //Get ext
            $extension_before = $request->file('before_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore_before = $filename_before.'_'.time().'.'.$extension_before;
            //Upload image
            $path = $request->file('before_image')->storeAs('public/before_images', $fileNameToStore_before); 
        }

        if($request->hasFile('after_image')){
            //Get filename with extension
            $filenameWithExt_after = $request->file('after_image')->getClientOriginalName();
            //Get filename
            $filename_after = pathinfo($filenameWithExt_after, PATHINFO_FILENAME);
            //Get ext
            $extension_after = $request->file('after_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore_after = $filename_after.'_'.time().'.'.$extension_after;
            //Upload image
            $path = $request->file('after_image')->storeAs('public/after_images', $fileNameToStore_after); 
        } 

        //Create Note
        $note = new Note;
        $note->notes_news = $request->input('news');
        $note->notes_currency = $request->input('currency');
        $note->notes_moving_market = $request->input('moving_market');
        $note->notes_prev = $request->input('previous');
        $note->notes_const = $request->input('constant');
        $note->notes_before_image = $fileNameToStore_before;
        $note->notes_after_image = $fileNameToStore_after;
        $note->notes_bloomberg_status = $request->input('bloomberg_status');
        
        $note->notes_summary = $request->input('summary');
        $note->user_id = auth()->user()->id;
        $note->save();
        return redirect('/dashboard')->with('success','Notes created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $note =  Note::find($id);
        
        //check if authorized user
        if(auth()->user()->id !== $note->user_id){
            return redirect('/notes')->with('error','Unauthorized Page');
        }

        return view('notes.show')->with('note',$note);
        // $note =  DB::select('SELECT * FROM notes WHERE notes_id = '.$id);
        // return view('notes.show')->with('note',$note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = Note::find($id);
        
        //check if authorized user
        if(auth()->user()->id !== $note->user_id){
            return redirect('/notes')->with('error','Unauthorized Page');
        }

        return view('notes.edit')->with('note',$note);
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
        $this->validate($request, [
            'news' => 'required',
            'currency' => 'required',
            'moving_market' => 'required',
            'previous' => 'required',
            'constant' => 'required',
            'bloomberg_status' => 'required',
            'summary' => 'required',
        ]);

        //Handle File Upload
        if($request->hasFile('before_image')){
            //Get filename with extension
            $filenameWithExt_before = $request->file('before_image')->getClientOriginalName();
            //Get filename
            $filename_before = pathinfo($filenameWithExt_before, PATHINFO_FILENAME);
            //Get ext
            $extension_before = $request->file('before_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore_before = $filename_before.'_'.time().'.'.$extension_before;
            //Upload image
            $path = $request->file('before_image')->storeAs('public/before_images', $fileNameToStore_before); 
        }

        if($request->hasFile('after_image')){
            //Get filename with extension
            $filenameWithExt_after = $request->file('after_image')->getClientOriginalName();
            //Get filename
            $filename_after = pathinfo($filenameWithExt_after, PATHINFO_FILENAME);
            //Get ext
            $extension_after = $request->file('after_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore_after = $filename_after.'_'.time().'.'.$extension_after;
            //Upload image
            $path = $request->file('after_image')->storeAs('public/after_images', $fileNameToStore_after); 
        }

        

        //Update Note
        $note = Note::find($id);
        $note->notes_news = $request->input('news');
        $note->notes_currency = $request->input('currency');
        $note->notes_moving_market = $request->input('moving_market');
        $note->notes_prev = $request->input('previous');
        $note->notes_const = $request->input('constant');
        
        if($request->hasFile('before_image')){
            $note->notes_before_image = $fileNameToStore_before;
        }

        if($request->hasFile('before_image')){
            $note->notes_after_image = $fileNameToStore_after;
        }

        
        $note->notes_bloomberg_status = $request->input('bloomberg_status');;
        
        $note->notes_summary = $request->input('summary');
        $note->save();
        return redirect('/dashboard')->with('success','Notes updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);

        //check if authorized user
        if(auth()->user()->id !== $note->user_id){
            return redirect('/notes')->with('error','Unauthorized Page');
        }

        if($note->notes_before_image != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/before_images/'.$note->notes_before_image);
        }

        if($note->notes_after_image != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/after_images/'.$note->notes_after_image);
        }

        $note->delete();
        return redirect('/dashboard')->with('success','Notes removed');
    }
}
