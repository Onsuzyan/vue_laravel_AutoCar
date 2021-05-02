<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_images')->insert([
            ['product_id' => '1','image_link' => 'https://5.imimg.com/data5/JE/CK/MY-55835756/car-head-light-500x500.jpg'],
            ['product_id' => '2','image_link' => 'https://imgaz.staticbg.com/thumb/large/oaupload/banggood/images/9E/06/f22ea52b-6f01-4998-88b7-ce4851472115.jpeg'],
            ['product_id' => '3','image_link' => 'https://d3mvlb3hz2g78.cloudfront.net/wp-content/uploads/2016/09/thumb_720_450_Car_Brakes_Featured_xl_37877111_(Custom).jpg'],
            ['product_id' => '4','image_link' => 'https://www.atlantictireonline.com/wp-content/uploads/2019/08/anti-lock-brakes.jpg'],
            ['product_id' => '5','image_link' => 'https://5.imimg.com/data5/MK/BG/MY-50783968/swift-door-handle-chrome-plated-500x500.jpg'],
            ['product_id' => '6','image_link' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMXQxqw_A3B0gY12JvwXIIYr0TTpV1RZiAgg&usqp=CAU'],
            ['product_id' => '7','image_link' => 'https://m.media-amazon.com/images/I/51cX7KIyBaL.jpg'],
            ['product_id' => '7','image_link' => 'https://i.pinimg.com/originals/9d/48/a3/9d48a350dfac5429e237e329c6c4a7bc.jpg'],
            ['product_id' => '7','image_link' => 'https://i1.adis.ws/i/washford/508694?w=620&h=480&qlt=75&fmt=webp&v=1'],
            ['product_id' => '7','image_link' => 'https://images-na.ssl-images-amazon.com/images/I/71FsQO9D28L._AC_SX425_.jpg']
        ]);
    }
}
