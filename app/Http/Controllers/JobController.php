<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use App\Models\Tag;
use Arr;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class JobController extends Controller
{
 
    public function index()
    {
        $jobs = Job::latest()->get()->groupBy('featured');

        return view("Job.index", [
            'featuredJobs' => $jobs[1],
            'jobs' => $jobs[0],
            'tags' => Tag::all(),
        ]);
    }

    public function create()
    {
        return view('Job.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time', 'Contract'])],
            'url' => ['required', 'active_url'],
            'tags'=> ['nullable'],
        ]);

        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if($attributes['tags'] ?? false){
            foreach(explode(',', $attributes['tags']) as $tag){
                $job->tag($tag);
            }
        }
        return redirect('/');
     }
    public function show(Job $job)
    {
        
    }

    public function edit(Job $job)
    {
        
    }

    public function update(UpdateJobRequest $request, Job $job)
    {
        
    }

    public function destroy(Job $job)
    {
        
    }
}
