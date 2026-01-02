<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class AdminSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(SubCategory::with('category')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        // Temporarily set slug without ID
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);

        $subCategory = SubCategory::create($validated);
        
        // Update slug with ID
        $subCategory->slug = \Illuminate\Support\Str::slug($validated['name']) . '-' . $subCategory->id;
        $subCategory->save();

        return response()->json($subCategory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $decodedId = $this->decodeId($id);
        $subCategory = SubCategory::with('category')->find($decodedId);

        if (!$subCategory) {
            return response()->json(['message' => 'SubCategory not found'], 404);
        }

        return response()->json($subCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $decodedId = $this->decodeId($id);
        $subCategory = SubCategory::find($decodedId);

        if (!$subCategory) {
            return response()->json(['message' => 'SubCategory not found'], 404);
        }

        $validated = $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'name' => 'sometimes|string|max:255',
            'status' => 'boolean',
        ]);

        if (isset($validated['name'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']) . '-' . $subCategory->id;
        }

        $subCategory->update($validated);

        return response()->json($subCategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $decodedId = $this->decodeId($id);
        $subCategory = SubCategory::find($decodedId);

        if (!$subCategory) {
            return response()->json(['message' => 'SubCategory not found'], 404);
        }

        $subCategory->delete();

        return response()->json(['message' => 'SubCategory deleted']);
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
