<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'sort' => 'nullable|in:latest,oldest,az,za',
        ]);

        $categoriesQuery = Category::where('user_id', auth()->id())
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%');
            });

        match ($request->sort) {
            'oldest' => $categoriesQuery->oldest(),
            'az' => $categoriesQuery->orderBy('name'),
            'za' => $categoriesQuery->orderByDesc('name'),
            default => $categoriesQuery->latest(),
        };

        $categories = $categoriesQuery->paginate(5)->withQueryString();

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'nullable|string|max:20',
        ]);

        Category::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'color' => $request->color ?? '#2563EB',
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function update(Request $request, Category $category)
    {
        abort_if($category->user_id !== auth()->id(), 403);

        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'nullable|string|max:20',
        ]);

        $category->update([
            'name' => $request->name,
            'color' => $request->color ?? '#2563EB',
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        abort_if($category->user_id !== auth()->id(), 403);

        if ($category->expenses()->exists()) {
            return back()->with('error', 'This category has expenses and cannot be deleted.');
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }
}
