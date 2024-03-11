<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuCategoryStoreRequest;
use App\Http\Requests\MenuCategoryUpdateRequest;
use App\Http\Resources\MenuCategoryCollection;
use App\Http\Resources\MenuCategoryResource;
use App\Models\MenuCategory;
use App\Models\Node;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MenuCategoryController extends Controller
{
    public function index(
        Request $request,
        Node $node
    ): MenuCategoryCollection {


        $menuCategories = $node->menuCategories;


        return new MenuCategoryCollection($menuCategories);
    }

    public function store(MenuCategoryStoreRequest $request, Node $node): MenuCategoryResource
    {

        $menuCategory = MenuCategory::create(
            array_merge(
                $request->validated(),
                [
                    'owner_id' => $request->user()->id,
                    'node_id' => $node->id
                ]
            )
        );


        return new MenuCategoryResource($menuCategory);
    }

    public function show(Request $request, MenuCategory $menuCategory): MenuCategoryResource
    {
        return new MenuCategoryResource($menuCategory);
    }

    public function update(MenuCategoryUpdateRequest $request, MenuCategory $menuCategory): MenuCategoryResource
    {
        $menuCategory->update($request->validated());

        return new MenuCategoryResource($menuCategory);
    }

    public function destroy(Request $request, Node $node, MenuCategory $menuCategory): Response
    {
        //$this->authorize('delete', $menuCategory);
        if ($request->user()->id !== $menuCategory->owner_id) {
            return response()->noContent();
        }
        // todo: check if the menu category belongs to the node
        if ($node->id !== $menuCategory->node_id) {
            return response()->noContent();
        }
        $menuCategory->delete();

        return response()->noContent();
    }
}
