<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use App\Models\Product;

use Tests\TestCase;

class ProductTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * Setup method.
     *
     * @return void
     */
   
    public function setUp() :void{
        parent::setUp();
        $this->products = Product::factory()->count(10)->create();
        $this->product = Product::factory()->create(['make' => 'Ferrari','model' => 'California']);
    }

    /**
     * Test 'products' table exist and fields are of the right type.
     *
     * @return void
     */
    public function test_table_product()
    {
       
       // Assert given email was inserted
        $this->assertDatabaseHas('products', ['make' => $this->product->make, 'model' => $this->product->model]);
        // Assert all entries were inserted
        $this->assertDatabaseCount('products', 11);
       
    }

    /**
     * Test route 'products/search, controller function search() and model local scope search()..
     *
     * @return void
     */
    public function test_route_products_search()
    {
        // Call route with parameter 'search'=>'' to request.
        $request = $this->call('GET', '/products/search', ['search'=>'']);

        // Assert the call returns an array of products.
        $this->assertIsArray($request['data']);

        // As we are searching empty string, it should return all the entries in table
        $this->assertCount(Product::count(), $request['data']); 

        // Call product model scope Search() passing product make
        $product = Product::search($this->product->make)->orderBy('make')->paginate(20)->toArray();

        // Assert right data is retrieved
        $this->assertContains($this->product->make, $product['data'][0]);
        $this->assertEquals($this->product->model, $product['data'][0]['model']);  
        $request->assertSee(['make' => 'Ferrari', 'model' => 'California']);     
       
    }

    /**
     * Test route 'products/{product} and controller function show().
     *
     * @return void
     */

    public function test_route_products_product()
     {
         
         $id = $this->product->id;

         // Call route.
         $request = $this->call('GET', '/products/'.$id);

        //  Assert return value is the correct one.
         $request->assertSee(['make' => 'Ferrari', 'model' => 'California']);   
         
    }
    
}
