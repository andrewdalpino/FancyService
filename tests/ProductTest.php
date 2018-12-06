<?php

use App\Product;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    public function test_lookup_cold()
    {
        $product = Product::lookup('1234567890');

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('1234567890', $product->upc);
        $this->assertInternalType('string', $product->name);
        $this->assertInternalType('string', $product->description);
    }

    public function test_lookup_bad_upc()
    {
        $this->expectException(ValidationException::class);

        Product::lookup('WayTooLongOfAUPCCodeToBeValid');
    }
}
