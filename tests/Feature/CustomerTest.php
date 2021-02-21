<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use App\Models\Customer;

use Tests\TestCase;

class CustomerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

     /**
     * Set up method.
     *
     * @return void
     */
    public function setUp() :void{
        parent::setUp();
       $this->customers = Customer::factory()->count(10)->create();
        $this->customer = Customer::factory()->create(['email' => 'tom@example.com']);
    }

    /**
     * Test 'customers' table exist and fields are of the right type.
     *
     * @return void
     */
    public function test_table_customer()
    {
       
       // Assert given email was inserted
        $this->assertDatabaseHas('customers', ['email' => $this->customer->email]);
        // Assert all entries were inserted
        $this->assertDatabaseCount('customers', 11);
       
    }

    /**
     * Test route 'customers/search, controller function search() and model local scope search().
     *
     * @return void
     */
    public function test_route_customers_search()
    {
        // Call route with parameter 'search'=>''.
        $request = $this->call('GET', '/customers/search', ['search'=>'']);

        // Assert the call return an array of customers.
        $this->assertIsArray($request['data']);

        // As we are searching empty string, it should return all the entries in table
        $this->assertCount(Customer::count(), $request['data']); 

        // Call Customer model scope Search() passing customer email
        $customer = Customer::search($this->customer->email)->orderBy('email')->paginate(20)->toArray();

        // Assert right data is retrieved
        $this->assertContains($this->customer->email, $customer['data'][0]);
        $this->assertEquals($this->customer->email, $customer['data'][0]['email']);  
        $request->assertSee(['email' => 'tom@example.com']);     
       
    }

     /**
     * Test route 'customers/{customre} and controller function show.
     *
     * @return void
     */

    public function test_route_customers_customer()
     {
         
         $id = $this->customer->id;

         // Call route.
         $request = $this->call('GET', '/customers/'.$id);

        //  Assert return value is the correct one.
         $request->assertSee(['email' => 'tom@example.com']);   
         
    }
    
}
