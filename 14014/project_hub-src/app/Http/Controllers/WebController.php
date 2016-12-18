<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Route;
use App\Project;
use Carbon\Carbon;

class WebController extends Controller
{
    public function index(){
        $expired_time = Carbon::today()->subDays(30);
        Project::where('created_at', '<', $expired_time)->delete();

        $projects = Project::orderBy('id', 'DESC')->select(
            'id', 'title', 'fee', 'duration', 'description', 'contact'
        )->paginate(5);
    
        return view('home')->withProjects($projects);
    }

    public function store(Request $request){
        Project::create($request->all());
        return redirect()->action('WebController@index');
    }

    public function show($id){
        $project = Project::findOrFail($id);
        return view('detail')->withProject($project);
    }

    public function create(){
        return view('new');
    }

    public function search(Request $request){
        $search_term = $request->input('search');
        
        $projects = Project::orderBy('id', 'DESC')->where(
            'title', 'LIKE', "%$search_term%"
        )->orWhere(
            'description', 'LIKE', "%$search_term%"
        )->select(
            'id', 'title', 'fee', 'duration', 'description', 'contact'
        )->paginate(5);

        return view('home')->withProjects($projects);
    }

    public function about(){
        return view('about');
    }
}
