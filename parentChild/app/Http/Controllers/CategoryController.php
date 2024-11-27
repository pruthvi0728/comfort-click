<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('category.index');
    }

    public function create()
    {
        $listOfCategories = Category::with('parent')->get();
        // Return the edit view with the category data
        return view('category.create', compact('listOfCategories'));
    }

    public function store(CategoryStoreRequest $request)
    {
        Category::create([
            "name" => $request->validated("name"),
            "parent_id" => $request->validated("parent_id")
        ]);

        // Redirect back with a success message
        return redirect()->route('categories.index')->with('success', 'Category added successfully!');
    }

    public function edit($id)
    {
        // Fetch category by ID
        $category = Category::findOrFail($id);
        $listOfCategories = Category::with('parent')->whereNot('id', $id)->get();
        // Return the edit view with the category data
        return view('category.create', compact('category', 'listOfCategories'));
    }

    public function update(CategoryStoreRequest $request, $id)
    {
        // Find the category by ID and update it
        $category = Category::findOrFail($id);

        $category->update([
            "name" => $request->validated('name'),
            'parent_id' => $request->validated('parent_id')
        ]);

        // Redirect back with a success message
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        // Find the category by ID and delete it
        $category = Category::findOrFail($id);
        if($category->hasChild()) {
            $category->child()->update([
                "parent_id" => $category->parent_id
            ]);
        }
        $category->delete();

        return response()->json([
            'sucess' => true,
            'message' => "Deleted successfully"
        ], 200);
    }
}
