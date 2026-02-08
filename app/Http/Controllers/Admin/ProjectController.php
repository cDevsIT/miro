<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order', 'asc')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'intro' => 'nullable|string',
            'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'info_location' => 'nullable|string|max:255',
            'info_client' => 'nullable|string|max:255',
            'info_year' => 'nullable|string|max:255',
            'info_photographs' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('feature_image')) {
            $validated['feature_image'] = $request->file('feature_image')->store('projects/features', 'public');
        }

        $sections = [];
        if ($request->has('sections')) {
            foreach ($request->sections as $index => $section) {
                $sectionData = ['type' => $section['type'], 'order' => $index];
                if ($section['type'] === 'full_image') {
                    if (isset($section['image']) && $section['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $sectionData['image'] = $section['image']->store('projects/sections', 'public');
                    }
                } elseif ($section['type'] === 'double_image') {
                    if (isset($section['image_1']) && $section['image_1'] instanceof \Illuminate\Http\UploadedFile) {
                        $sectionData['image_1'] = $section['image_1']->store('projects/sections', 'public');
                    }
                    if (isset($section['image_2']) && $section['image_2'] instanceof \Illuminate\Http\UploadedFile) {
                        $sectionData['image_2'] = $section['image_2']->store('projects/sections', 'public');
                    }
                } elseif ($section['type'] === 'text') {
                    $sectionData['title'] = $section['title'] ?? '';
                    $sectionData['text'] = $section['text'] ?? '';
                } elseif (in_array($section['type'], ['right_image', 'left_image'])) {
                    $sectionData['title'] = $section['title'] ?? '';
                    $sectionData['text'] = $section['text'] ?? '';
                    if (isset($section['image']) && $section['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $sectionData['image'] = $section['image']->store('projects/sections', 'public');
                    }
                }
                $sections[] = $sectionData;
            }
        }
        $validated['sections'] = $sections;
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'intro' => 'nullable|string',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'info_location' => 'nullable|string|max:255',
            'info_client' => 'nullable|string|max:255',
            'info_year' => 'nullable|string|max:255',
            'info_photographs' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('feature_image')) {
            if ($project->feature_image) {
                Storage::disk('public')->delete($project->feature_image);
            }
            $validated['feature_image'] = $request->file('feature_image')->store('projects/features', 'public');
        }

        $sections = [];
        if ($request->has('sections')) {
            foreach ($request->sections as $index => $section) {
                $sectionData = ['type' => $section['type'], 'order' => $index];
                if ($section['type'] === 'full_image') {
                    if (isset($section['image']) && $section['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $sectionData['image'] = $section['image']->store('projects/sections', 'public');
                    } elseif (isset($section['existing_image'])) {
                        $sectionData['image'] = $section['existing_image'];
                    }
                } elseif ($section['type'] === 'double_image') {
                    if (isset($section['image_1']) && $section['image_1'] instanceof \Illuminate\Http\UploadedFile) {
                        $sectionData['image_1'] = $section['image_1']->store('projects/sections', 'public');
                    } elseif (isset($section['existing_image_1'])) {
                        $sectionData['image_1'] = $section['existing_image_1'];
                    }
                    if (isset($section['image_2']) && $section['image_2'] instanceof \Illuminate\Http\UploadedFile) {
                        $sectionData['image_2'] = $section['image_2']->store('projects/sections', 'public');
                    } elseif (isset($section['existing_image_2'])) {
                        $sectionData['image_2'] = $section['existing_image_2'];
                    }
                } elseif ($section['type'] === 'text') {
                    $sectionData['title'] = $section['title'] ?? '';
                    $sectionData['text'] = $section['text'] ?? '';
                } elseif (in_array($section['type'], ['right_image', 'left_image'])) {
                    $sectionData['title'] = $section['title'] ?? '';
                    $sectionData['text'] = $section['text'] ?? '';
                    if (isset($section['image']) && $section['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $sectionData['image'] = $section['image']->store('projects/sections', 'public');
                    } elseif (isset($section['existing_image'])) {
                        $sectionData['image'] = $section['existing_image'];
                    }
                }
                $sections[] = $sectionData;
            }
        }
        $validated['sections'] = $sections;
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        if ($project->feature_image) {
            Storage::disk('public')->delete($project->feature_image);
        }
        if ($project->sections) {
            foreach ($project->sections as $section) {
                if (isset($section['image'])) {
                    Storage::disk('public')->delete($section['image']);
                }
                if (isset($section['image_1'])) {
                    Storage::disk('public')->delete($section['image_1']);
                }
                if (isset($section['image_2'])) {
                    Storage::disk('public')->delete($section['image_2']);
                }
            }
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');
    }
}
