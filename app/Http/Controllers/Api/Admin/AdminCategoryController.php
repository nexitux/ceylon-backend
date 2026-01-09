<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
    // Decode ID
    $decodedId = $this->decodeId($id);
    $category = Category::find($decodedId);

    if (!$category) {
        return response()->json(['message' => 'Category not found'], 404);
    }

    /**
     * -----------------------------------------
     * STEP 1: Validate NON-FILE fields only
     * -----------------------------------------
     */
    $validated = $request->validate([
        'name'   => 'sometimes|string|max:255',
        'status' => 'sometimes|boolean',
    ]);

    if (isset($validated['name'])) {
        $validated['slug'] = Str::slug($validated['name']) . '-' . $category->id;
    }

    /**
     * -----------------------------------------
     * STEP 2: Handle FILE uploads safely
     * -----------------------------------------
     */
    $imageFields = ['image', 'image2', 'image3', 'image4'];

    Log::info('Update Category Request', [
        'method'     => $request->method(),
        'files'      => array_keys($request->allFiles()),
        'contentType'=> $request->header('Content-Type'),
    ]);

    foreach ($imageFields as $field) {

        // Validate ONLY if file exists
        if ($request->hasFile($field)) {

            $request->validate([
                $field => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $file = $request->file($field);

            // Safe filename
            $filename = Str::slug(
                pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
            ) . '-' . time() . '.' . $file->getClientOriginalExtension();

            // Store file
            $path = $file->storeAs('categories', $filename, 'public');

            Log::info("File uploaded", [
                'field' => $field,
                'path'  => $path,
            ]);

            // Delete old file if exists
            if ($category->$field && Storage::disk('public')->exists($category->$field)) {
                Storage::disk('public')->delete($category->$field);
            }

            // Save new path
            $validated[$field] = $path;
        }
    }

    /**
     * -----------------------------------------
     * STEP 3: Update database
     * -----------------------------------------
     */
    $category->update($validated);

    /**
     * -----------------------------------------
     * STEP 4: Response
     * -----------------------------------------
     */
    $response = $category->fresh()->toArray();
    $response['debug_version'] = 'final-upload-fix-v1';

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
