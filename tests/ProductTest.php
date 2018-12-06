<?php

use App\Product;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    public function test_build()
    {
        $product = new Product([
            'upc' => '1234567890',
            'name' => 'china cymbal',
            'description' => 'it crashes',
        ]);

        $this->assertEquals('1234567890', $product->upc);
        $this->assertEquals('china cymbal', $product->name);
        $this->assertEquals('it crashes', $product->description);
    }

    public function test_lookup_cold()
    {
        $product = Product::lookup('1234567890');

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('1234567890', $product->upc);
        $this->assertInternalType('string', $product->name);
        $this->assertInternalType('string', $product->description);

        $this->seeInDatabase('products', ['upc' => '1234567890']);
    }

    public function test_lookup_bad_upc()
    {
        $this->expectException(ValidationException::class);

        Product::lookup('WayTooLongOfAUPCCodeToBeValid');
    }
}
