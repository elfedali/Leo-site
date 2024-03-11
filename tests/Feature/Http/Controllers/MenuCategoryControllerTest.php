<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MenuCategoryController
 */
final class MenuCategoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $menuCategories = MenuCategory::factory()->count(3)->create();

        $response = $this->get(route('menu-category.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MenuCategoryController::class,
            'store',
            \App\Http\Requests\MenuCategoryStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $uuid = $this->faker->uuid();
        $owner_id = $this->faker->numberBetween(-100000, 100000);
        $position = $this->faker->numberBetween(-10000, 10000);
        $title = $this->faker->sentence(4);
        $status = $this->faker->word();
        $node_id = $this->faker->numberBetween(-100000, 100000);

        $response = $this->post(route('menu-category.store'), [
            'uuid' => $uuid,
            'owner_id' => $owner_id,
            'position' => $position,
            'title' => $title,
            'status' => $status,
            'node_id' => $node_id,
        ]);

        $menuCategories = MenuCategory::query()
            ->where('uuid', $uuid)
            ->where('owner_id', $owner_id)
            ->where('position', $position)
            ->where('title', $title)
            ->where('status', $status)
            ->where('node_id', $node_id)
            ->get();
        $this->assertCount(1, $menuCategories);
        $menuCategory = $menuCategories->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $menuCategory = MenuCategory::factory()->create();

        $response = $this->get(route('menu-category.show', $menuCategory));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MenuCategoryController::class,
            'update',
            \App\Http\Requests\MenuCategoryUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $menuCategory = MenuCategory::factory()->create();
        $uuid = $this->faker->uuid();
        $owner_id = $this->faker->numberBetween(-100000, 100000);
        $position = $this->faker->numberBetween(-10000, 10000);
        $title = $this->faker->sentence(4);
        $status = $this->faker->word();
        $node_id = $this->faker->numberBetween(-100000, 100000);

        $response = $this->put(route('menu-category.update', $menuCategory), [
            'uuid' => $uuid,
            'owner_id' => $owner_id,
            'position' => $position,
            'title' => $title,
            'status' => $status,
            'node_id' => $node_id,
        ]);

        $menuCategory->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($uuid, $menuCategory->uuid);
        $this->assertEquals($owner_id, $menuCategory->owner_id);
        $this->assertEquals($position, $menuCategory->position);
        $this->assertEquals($title, $menuCategory->title);
        $this->assertEquals($status, $menuCategory->status);
        $this->assertEquals($node_id, $menuCategory->node_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $menuCategory = MenuCategory::factory()->create();

        $response = $this->delete(route('menu-category.destroy', $menuCategory));

        $response->assertNoContent();

        $this->assertModelMissing($menuCategory);
    }
}
