<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Note;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $user_id = auth()->user()->id;
        // $user = User::find($user_id);
        // return view('dashboard')->with('notes', $user->notes);
        $month = date('m');
        $year = date('Y');

        $user_id = auth()->user()->id;
        $notes = Note::where('user_id', '=', $user_id)
        ->whereRaw('MONTH(created_at) = '.$month)
        ->whereRaw('YEAR(created_at) = '.$year)
        ->orderBy('created_at','desc')->paginate(2);
        //->get();
        $data = array(
            'notes' => $notes,
            'month' => $month,
            'year' => $year,

        );
        return view('dashboard')->with($data);
        
    }

    public function search(Request $request)
    {   
        $user_id = auth()->user()->id;
        $term = $request->term;

        
        if((stristr('january',$term))||(stristr('januari',$term))){
            $term = 1;
        }
        if((stristr('february',$term))||(stristr('februari',$term))){
            $term = 2;
        }
        if((stristr('march',$term))||(stristr('mac',$term))){
            $term = 3;
        }
        if(stristr('april',$term)){
            $term = 4;
        }
        if((stristr('may',$term))||(stristr('mei',$term))){
            $term = 5;
        }
        if(stristr('june',$term)){
            $term = 6;
        }
        if((stristr('july',$term))||(stristr('julai',$term))){
            $term = 7;
        }
        if((stristr('august',$term))||(stristr('ogos',$term))){
            $term = 8;
        }
        if(stristr('september',$term)){
            $term = 9;
        }
        if((stristr('october',$term))||(stristr('oktober',$term))){
            $term = 10;
        }
        if(stristr('november',$term)){
            $term = 11;
        }
        if((stristr('december',$term))||(stristr('disember',$term))){
            $term = 12;
        }
        
        $news = Note::where('user_id', '=', $user_id)
            ->where('notes_news','LIKE','%'.$term.'%')->get();
        
        $currency = Note::where('user_id', '=', $user_id)
            ->where('notes_currency','LIKE','%'.$term.'%')->get();
        
        $timestamp = Note::where('user_id', '=', $user_id)
            ->where('created_at','LIKE','%'.$term.'%')->get();
        
        
        if(count($news)>0){
            foreach($news as $notes){
                $result[] = $notes->notes_news;
            }
            
        }
        else if(count($currency)>0){
            foreach($currency as $notes){
                $result[] = $notes->notes_currency .' - '.$notes->notes_news;
            }
        }

        else if(count($timestamp)>0){
            foreach($timestamp as $notes){
                $result[] = $notes->created_at->format('d M Y').' - '.$notes->notes_news;
                //$result[] = $notes->notes_news.' - '.$notes->notes_news;
            }
        }

        else{
            $result[] =  "No news found";    
        }

        return $result;
        // return $result;
        // return $availableTags = [
        //     "ActionScript",
        //     "AppleScript",
        //     "Asp",
        //     "BASIC",
        //     "C",
        //     "C++",
        //     "Clojure",
        //     "COBOL",
        //     "ColdFusion",
        //     "Erlang",
        //     "Fortran",
        //     "Groovy",
        //     "Haskell",
        //     "Java",
        //     "JavaScript",
        //     "Lisp",
        //     "Perl",
        //     "PHP",
        //     "Python",
        //     "Ruby",
        //     "Scala",
        //     "Scheme"
        //   ];
    }
}
