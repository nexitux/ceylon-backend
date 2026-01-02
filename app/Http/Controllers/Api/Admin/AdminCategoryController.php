<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Category::with('subCategories')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
        ]);

        // Temporarily set slug without ID
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);

        $images = ['image', 'image2', 'image3', 'image4'];
        foreach ($images as $imgField) {
            if ($request->hasFile($imgField)) {
                $file = $request->file($imgField);
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('categories', $filename, 'public');
                $validated[$imgField] = $path;
            }
        }

        $category = Category::create($validated);
        
        // Update slug with ID
        $category->slug = \Illuminate\Support\Str::slug($validated['name']) . '-' . $category->id;
        $category->save();

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $decodedId = $this->decodeId($id);
        $category = Category::with('subCategories')->find($decodedId);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $decodedId = $this->decodeId($id);
        $category = Category::find($decodedId);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
        ]);

        if (isset($validated['name'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']) . '-' . $category->id;
        }

        $images = ['image', 'image2', 'image3', 'image4'];
        foreach ($images as $imgField) {
            if ($request->hasFile($imgField)) {
                // Delete old image if exists
                if ($category->$imgField && \Illuminate\Support\Facades\Storage::disk('public')->exists($category->$imgField)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($category->$imgField);
                }
                $file = $request->file($imgField);
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('categories', $filename, 'public');
                $validated[$imgField] = $path;
            }
        }

        $category->update($validated);

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $decodedId = $this->decodeId($id);
        $category = Category::find($decodedId);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }

    /**
     * Encode ID to base64.
     *
     * @param int $id
     * @return string
     */
    private function encodeId(int $id): string
    {
        return base64_encode($id);
    }

    /**
     * Decode base64 ID to integer.
     *
     * @param string $encodedId
     * @return int
     */
    private function decodeId(string $encodedId): int
    {
        return (int) base64_decode($encodedId);
    }
}
