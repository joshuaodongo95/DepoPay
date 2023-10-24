<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use App\Models\Business;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_belongs_to_a_category()
    {
        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create();
        $product->category()->attach($category);

        $this->assertInstanceOf(ProductCategory::class, $product->category->first());
        $this->assertEquals($category->id, $product->category->first()->id);
    }

    public function test_it_belongs_to_a_tag()
    {
        $tag = ProductTag::factory()->create();
        $product = Product::factory()->create();
        $product->tag()->attach($tag);

        $this->assertInstanceOf(ProductTag::class, $product->tag->first());
        $this->assertEquals($tag->id, $product->tag->first()->id);
    }

    public function test_it_belongs_to_a_business()
    {
        $business = Business::factory()->create();
        $product = Product::factory()->create(['bisiness_id' => $business->id]);

        $this->assertInstanceOf(Business::class, $product->bisiness);
        $this->assertEquals($business->id, $product->bisiness->id);
    }

    // public function test_it_has_photo_attribute()
    // {
    //     // Create a Product using a factory
    //     $product = Product::factory()->create();

    //     // Attach media files to the product using Spatie's MediaLibrary
    //     $media = $product->addMediaFromUrl('https://media.istockphoto.com/id/684062636/photo/hand-writing-inscription-free-sample-with-marker-concept.jpg?s=612x612&w=0&k=20&c=4DIoRyju5Xe1GglZZZuTShtUAmOLotD6suo_F6MLyLo=')->toMediaCollection('product_photo');

    //     // Retrieve the product's photos
    //     $photos = $product->photo;

    //     $this->assertInstanceOf(\Illuminate\Support\Collection::class, $photos);
    //     $this->assertCount(1, $photos); // Check if there's one photo attached
    //     $this->assertEquals($media->first()->getUrl(), $photos[0]['url']); // Check if the URL matches the attached media URL
    // }

}
