<?php

namespace App\JsonApi\V1\Nodes;

use App\Models\Node;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\DateTime;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Number;
use LaravelJsonApi\Eloquent\Fields\Relations\BelongsTo;
use LaravelJsonApi\Eloquent\Fields\Relations\HasMany;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Filters\Has;
use LaravelJsonApi\Eloquent\Filters\WhereIdIn;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class NodeSchema extends Schema
{

    /**
     * The model the schema corresponds to.
     *
     * @var string
     */
    public static string $model = Node::class;

    protected ?array $defaultPagination = [
        'number' => 1,
        'size' => 10,
    ];

    /**
     * Get the resource fields.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            ID::make(),
            //owner_id
            Number::make('owner_id'),
            Str::make('uuid'),
            Str::make('title'),
            Str::make('slug'),
            Str::make('content'),
            Str::make('excerpt'),

            Str::make('status'), // draft, published
            Str::make('type'), // restaurant, hotel

            Str::make('reservation_required'),
            Str::make('reservation_note'),

            Str::make('review_note'),
            Str::make('review_status'),

            Str::make('phone'),
            Str::make('phone_secondary'),
            Str::make('phone_tertiary'),

            Str::make('email'),

            Str::make('address'),

            Str::make('latitude'),
            Str::make('longitude'),

            Str::make('open_time'),
            Str::make('close_time'),

            Str::make('price_from'),
            Str::make('price_to'),

            Str::make('recommended'),
            Str::make('featured'),

            Str::make('currency'),
            Str::make('capacity')->sortable(),
            Str::make('rating'),

            Str::make('website'),

            Str::make('facebook'),
            Str::make('twitter'),
            Str::make('instagram'),
            Str::make('youtube'),
            Str::make('tiktok'),

            // belongsTo
            BelongsTo::make('owner')->type('users')->readOnly(),
            HasMany::make('menuCategories')->type('menu-categories')->readOnly(),


            DateTime::make('createdAt')->sortable()->readOnly(),
            DateTime::make('updatedAt')->sortable()->readOnly(),
        ];
    }

    /**
     * Get the resource filters.
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            WhereIdIn::make($this),
        ];
    }

    /**
     * Get the resource paginator.
     *
     * @return Paginator|null
     */
    public function pagination(): ?Paginator
    {
        return PagePagination::make();
    }
}
