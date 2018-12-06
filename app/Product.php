<?php

namespace App;

use App\Facades\FancyService;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'upc', 'name', 'description',
    ];

    /**
     * Look up the product by UPC. If the product is not in database,
     * then query Fancy Service for the data and store it before
     * returning.
     * 
     * @param  string  $upc
     * @return self
     */
    public static function lookup(string $upc) : self
    {
        Validator::make(['upc' => $upc], ['upc' => 'string|between:1,20'])
            ->validate();

        $product = self::where('upc', $upc)->first();

        if (is_null($product)) {
            $results = FancyService::submit($upc);

            $product = self::create([
                'upc' => $upc,
                'name' => $results['prod_name'] ?? '',
                'description' => $results['prod_description'] ?? '',
            ]);
        }

        return $product;
    }
}
