<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $team = $user->teams()
            ->with(['members', 'department'])
            ->first();

        if (! $team) {
            return view('student.file_upload', [
                'team' => null,
                'project' => null,
                'files' => collect(),
                'totalSizeMB' => 0,
                'storagePercent' => 0,
            ]);
        }

        $project = Project::where('team_id', $team->id)->first();

        if (! $project) {
            return view('student.file_upload', [
                'team' => $team,
                'project' => null,
                'files' => collect(),
                'totalSizeMB' => 0,
                'storagePercent' => 0,
            ]);
        }

        $files = File::where('project_id', $project->id)
            ->with('uploader')
            ->orderBy('id', 'desc')
            ->get();

        $totalSizeMB = round($files->sum('size') / 1024 / 1024, 2);
        $storagePercent = min(100, round(($totalSizeMB / 1024) * 100));

        return view('student.file_upload', compact(
            'team',
            'project',
            'files',
            'totalSizeMB',
            'storagePercent'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:51200',
            'is_final_submission' => 'nullable|boolean',
        ]);

        $user = Auth::user();

        $team = $user->teams()->first();

        if (! $team) {
            return back()->withErrors([
                'file' => 'يجب إنشاء فريق أو الانضمام لفريق أولاً قبل رفع الملفات.',
            ]);
        }

        $project = Project::where('team_id', $team->id)->first();

        if (! $project) {
            return back()->withErrors([
                'file' => 'يجب إنشاء مشروع أولاً قبل رفع الملفات.',
            ]);
        }

        $uploadedFile = $request->file('file');

        $path = $uploadedFile->store('project_files', 'public');

        $version = File::where('project_id', $project->id)
            ->where('filename', $uploadedFile->getClientOriginalName())
            ->count() + 1;

        File::create([
            'project_id' => $project->id,
            'filename' => $uploadedFile->getClientOriginalName(),
            'path' => $path,
            'size' => $uploadedFile->getSize(),
            'version' => $version,
            'is_final_submission' => $request->boolean('is_final_submission'),
            'uploaded_by' => $user->id,
        ]);

        return back()->with('success', 'تم رفع الملف بنجاح.');
    }

    public function download(File $file)
    {
        $user = Auth::user();
        $team = $user->teams()->first();

        if (! $team || ! $file->project || $file->project->team_id !== $team->id) {
            abort(403);
        }

        if (! Storage::disk('public')->exists($file->path)) {
            return back()->withErrors([
                'file' => 'الملف غير موجود في التخزين.',
            ]);
        }

        return Storage::disk('public')->download($file->path, $file->filename);
    }

    public function destroy(File $file)
    {
        $user = Auth::user();
        $team = $user->teams()->first();

        if (! $team || ! $file->project || $file->project->team_id !== $team->id) {
            abort(403);
        }

        if (Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        $file->delete();

        return back()->with('success', 'تم حذف الملف بنجاح.');
    }
    
    public function preview(File $file)
{
    $user = Auth::user();
    $team = $user->teams()->first();

    if (! $team || ! $file->project || $file->project->team_id != $team->id) {
        abort(403);
    }

    if (! Storage::disk('public')->exists($file->path)) {
        return back()->withErrors([
            'file' => 'الملف غير موجود في التخزين.',
        ]);
    }

    return response()->file(storage_path('app/public/' . $file->path));
}
    
}