<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Response;

class ProjectsController extends Controller
{
    public function index(Request $request){
        $search_term = $request->input('search');
        $limit = $request->input('limit')?$request->input('limit'):5;

        if ($search_term){
            $projects = Project::orderBy('id', 'DESC')->where(
                'title', 'LIKE', "%$search_term%"
            )->orWhere(
                'description', 'LIKE', "%$search_term%"
            )->select(
                'id', 'title', 'fee', 'duration', 'description', 'contact'
            )->paginate($limit);

            $projects->appends(array(            
                'search' => $search_term,
                'limit' => $limit
            ));
        } else {
            $projects = Project::orderBy('id', 'DESC')->select(
                'id', 'title', 'fee', 'duration', 'description', 'contact'
            )->paginate($limit);

            $projects->appends(array(            
                'limit' => $limit
            ));
        }

        return Response::json($this->transformCollection($projects), 200);
    }

    public function show($id){
        $project = Project::find($id);

        if (!$project){
            return Response::json([
                'error' => [
                    'message' => 'Project does not exist!'
                ]
            ], 404);
        } else {
            return Response::json([
                'data' => $this->transform($project)
            ], 200);
        }
    }

    public function store(Request $request){
        if (!$request->title or !$request->fee or !$request->duration or !$request->description or !$request->contact){
            return Response::json([
                'error' => [
                    'message' => 'Please provide all the required information!'
                ]
            ], 422);
        } else {
            $project = Project::create($request->all());

            return Response::json([
                'message' => 'Project successfully created!',
                'data' => $this->transform($project)
            ]);
        }
    }

    public function update(Request $request, $id){
        if (!$request->title or !$request->fee or !$request->duration or !$request->description or !$request->contact){
            return Response::json([
                'error' => [
                    'message' => 'Please provide all the required information!'
                ]
            ], 422);
        } else {
            $project = Project::find($id);

            if (!$project){
                return Response::json([
                    'error' => [
                        'message' => 'Project does not exist!'
                    ]
                ], 404);
            } else {
                $project->title = $request->title;
                $project->fee = $request->fee;
                $project->duration = $request->duration;
                $project->description = $request->description;
                $project->contact = $request->contact;
                $project->save();

                return Response::json([
                    'message' => 'Project successfully updated!',
                    'data' => $this->transform($project)
                ]);
            }
        }
    }

    public function destroy($id){
        $project = Project::find($id);

        if (!$project){
            return Response::json([
                'error' => [
                    'message' => 'Project does not exist!'
                ]
            ], 404);
        } else {
            Project::destroy($id);
            
            return Response::json([
                'message' => 'Project successfully deleted!'
            ]);
        }
    }


    private function transformCollection($projects){
        $projectsArray = $projects->toArray();
        return [
            'total' => $projectsArray['total'],
            'per_page' => intval($projectsArray['per_page']),
            'current_page' => $projectsArray['current_page'],
            'last_page' => $projectsArray['last_page'],
            'next_page_url' => $projectsArray['next_page_url'],
            'prev_page_url' => $projectsArray['prev_page_url'],
            'from' => $projectsArray['from'],
            'to' => $projectsArray['to'],
            'data' => array_map([$this, 'transform'], $projectsArray['data'])
        ];
    }

    private function transform($project){
        return [
            'id' => $project['id'],
            'title' => $project['title'],
            'fee' => $project['fee'],
            'duration' => $project['duration'],
            'description' => $project['description'],
            'contact' => $project['contact']

        ];
    }


}
