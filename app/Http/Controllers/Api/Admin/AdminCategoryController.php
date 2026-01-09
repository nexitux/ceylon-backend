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
                // Sanitize filename: slug of name + timestamp + extension
                $filename = \Illuminate\Support\Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                            . '-' . time() . '.' . $file->getClientOriginalExtension();
                
                $path = $file->storeAs('categories', $filename, 'public');
                
                if ($path) {
                    $validated[$imgField] = $path;
                } else {
                    unset($validated[$imgField]); // or handle error
                }
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
        
        \Illuminate\Support\Facades\Log::info('Update Category Request', [
            'id' => $id,
            'method' => $request->method(),
            'all_files' => $request->allFiles(),
            'has_image3' => $request->hasFile('image3'),
            'image3_error' => $request->file('image3') ? $request->file('image3')->getError() : 'N/A',
        ]);

        foreach ($images as $imgField) {
            if ($request->hasFile($imgField)) {
                $file = $request->file($imgField);
                
                // Sanitize filename
                $filename = \Illuminate\Support\Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) 
                            . '-' . time() . '.' . $file->getClientOriginalExtension();
                
                $path = $file->storeAs('categories', $filename, 'public');
                
                \Illuminate\Support\Facades\Log::info("File upload attempt for $imgField", ['path' => $path]);

                if ($path) {
                    // Delete old image only if new one uploads successfully
                    if ($category->$imgField && $category->$imgField !== '0' && \Illuminate\Support\Facades\Storage::disk('public')->exists($category->$imgField)) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($category->$imgField);
                    }
                    $validated[$imgField] = $path;
                } else {
                     \Illuminate\Support\Facades\Log::error("File upload failed for $imgField");
                    unset($validated[$imgField]); // If storeAs fails, remove from validated
                }
            } else {
                unset($validated[$imgField]);
        
                // FIX: If the current value is "0" (from previous bad state) and we are not uploading a new file,
                // we might ideally want to set it to null, but user might want to keep it?
                // Actually, "0" is invalid for an image path. Let's force fix it to null if it's "0".
                // But only do this if we are doing some cleanup. For now let's just log.
            }
        }
        
        // Auto-fix "0" values if they exist and we aren't updating them?
        // No, let's stick to debugging first.

        $category->update($validated);
        
        // Debug info to verify deployment
        $response = $category->toArray();
        $response['debug_version'] = '1.0-log-enabled';

        return response()->json($response);
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

    /**
     * Delete a specific image from category.
     */
    public function deleteImage(Request $request, string $id)
    {
        $validated = $request->validate([
            'field_name' => 'required|string|in:image,image2,image3,image4',
        ]);

        $decodedId = $this->decodeId($id);
        $category = Category::find($decodedId);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $field = $validated['field_name'];

        if ($category->$field) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($category->$field)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($category->$field);
            }
            
            $category->$field = null;
            $category->save();
        }

        return response()->json([
            'message' => 'Image deleted successfully',
            'data' => $category
        ]);
    }
}
