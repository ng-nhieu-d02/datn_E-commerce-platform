<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\map;

class seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'username'  => 'member',
            'password'  => Hash::make('member'),
            'phone'     => '0888800033',
            'email'     => 'nguyennhieu1507.2002@gmail.com',
            'name'      => 'Dev Universe',
            'money'     => 0,
            'gender'    => 'man',
            'status'    => 3
        ]);
        DB::table('user_address')->insert([
            'user_id'  => 1,
            'address'   => 'Phường Đông Hưng Thuận',
            'district'  => 'Quận 12',
            'city'  => 'Hồ Chí Minh',
            'name'  => 'Nguyễn Nhiều',
            'phone' => '0888800032',
            'email' => 'nguyennhieu1507.2902@gmail.com',
            'status'    => '0'
        ]);
        DB::table('user_address')->insert([
            'user_id'  => 1,
            'address'   => 'Thôn Hương Vân, Xã Đạ lây',
            'district'  => 'Huyện đạ tẻh',
            'city'  => 'Lâm Đồng',
            'name'  => 'Nguyễn Nhiều',
            'phone' => '0888800032',
            'email' => 'nguyennhieu1507.2902@gmail.com',
            'status'    => '1'
        ]);
        DB::table('users')->insert([
            'username'  => 'admin',
            'password'  => Hash::make('admin'),
            'phone'     => '0888800032',
            'email'     => 'nguyennhieu1507.2k2@gmail.com',
            'name'      => 'Administrator',
            'money'     => 1000000000,
            'gender'    => 'man',
            'permission'    => '1',
            'status'    => 3
        ]);

        DB::table('store')->insert([
            'name'      => 'Five Bees Store',
            'slug'      => 'five-bees-store',
            'address'   => 'Phường Tân Hưng Thuận',
            'district'  => '12',
            'city'      => 'Hồ Chí Minh',
            'status'    => 1
        ]);

        DB::table('store')->insert([
            'name'      => 'Store Test',
            'slug'      => 'store-test',
            'address'   => 'Phường Tân Hưng Thuận',
            'district'  => '12',
            'city'      => 'Hồ Chí Minh',
            'status'    => 1
        ]);

        DB::table('store_cate')->insert([
            'id_store'  => 2,
            'name'      => 'Thời trang',
            'slug'      => 'thoi-trang',
        ]);

        DB::table('store_cate')->insert([
            'id_store'  => 1,
            'name'      => 'Thực phẩm',
            'slug'      => 'thuc-pham',
        ]);

        DB::table('store_cate')->insert([
            'id_store'  => 1,
            'name'      => 'Làm đẹp',
            'slug'      => 'lam-dep',
        ]);

        DB::table('store_cate')->insert([
            'id_store'  => 1,
            'name'      => 'Thời trang',
            'slug'      => 'thoi-trang',
        ]);

        DB::table('ticket_create_store')->insert([
            'id_user'   => 1,
            'id_store'  => 1,
            'status'    => 1
        ]);

        DB::table('ticket_create_store')->insert([
            'id_user'   => 1,
            'id_store'  => 2,
            'status'    => 1
        ]);

        DB::table('permission_store')->insert([
            'id_store'      => 1,
            'id_user'       => 1,
            'permission'    => '0'
        ]);
        DB::table('permission_store')->insert([
            'id_store'      => 2,
            'id_user'       => 1,
            'permission'    => '0'
        ]);

        DB::table('category_product')->insert([
            'name'   => 'thời trang nam',
            'slug'  => 'thoi-trang-nam',
            'parent_id' => 0,
            'path'      => '1_',
            'create_by'    => 2,
            'avatar'    => '687f3967b7c2fe6a134a2c11894eea4b_tn.png',
            'title' => 'Thời trang nam',
            'keyword'   => 'Thời trang nam, lifeStyle',
            'status'    => '0'
        ]);
        DB::table('category_product')->insert([
            'name'   => 'Áo khoác',
            'slug'  => 'ao-khoac',
            'parent_id' => 1,
            'path'      => '1_2',
            'create_by'    => 2,
            'avatar'    => '687f3967b7c2fe6a134a2c11894eea4b_tn.png',
            'title' => 'Áo khoác',
            'keyword'   => 'Thời trang nam, Áo khoác',
            'status'    => '0'
        ]);
        DB::table('category_product')->insert([
            'name'   => 'Áo Vest và Blazer',
            'slug'  => 'ao-vest-va-blazer',
            'parent_id' => 1,
            'path'      => '1_3',
            'create_by'    => 2,
            'avatar'    => '687f3967b7c2fe6a134a2c11894eea4b_tn.png',
            'title' => 'Áo Vest và Blazer',
            'keyword'   => 'Thời trang nam, Áo Vest và Blazer',
            'status'    => '0'
        ]);
        DB::table('category_product')->insert([
            'name'   => 'Áo Hoodie, Áo Len & Áo Nỉ',
            'slug'  => 'ao-hoodie-ao-len-ao-ni',
            'parent_id' => 1,
            'path'      => '1_4',
            'create_by'    => 2,
            'avatar'    => '687f3967b7c2fe6a134a2c11894eea4b_tn.png',
            'title' => 'Áo Hoodie, Áo Len & Áo Nỉ',
            'keyword'   => 'Thời trang nam, Áo Hoodie, Áo Len & Áo Nỉ',
            'status'    => '0'
        ]);
        DB::table('category_product')->insert([
            'name'   => 'Quần Jeans',
            'slug'  => 'quan-jeans',
            'parent_id' => 1,
            'path'      => '1_5',
            'create_by'    => 2,
            'avatar'    => '687f3967b7c2fe6a134a2c11894eea4b_tn.png',
            'title' => 'Quần Jeans',
            'keyword'   => 'Thời trang nam, Quần Jeans',
            'status'    => '0'
        ]);

        DB::table('product')->insert([
            'id_store'   => 1,
            'create_by'  => 1,
            'name'  => 'Rey Nylon Backpack',
            'slug'      => 'rey-nylon-backpack-' . time(),
            'description'    => 'Fashion is a form of self-expression and autonomy at a particular period and place and in a specific context, of clothing, footwear, lifestyle, accessories, makeup, hairstyle, and body posture.',
            'long_description' => 'The patented eighteen-inch hardwood Arrowhead deck --- finely mortised in, makes this the strongest and most rigid canoe ever built. You cannot buy a canoe that will afford greater satisfaction.The St. Louis Meramec Canoe Company was founded by Alfred Wickett in 1922. Wickett had previously worked for the Old Town Canoe Co from 1900 to 1914. Manufacturing of the classic wooden canoes in Valley Park, Missouri ceased in 1978.',
            'type' => '0',
            'category_path' => '1_2',
            'category_id' => 2,
            'thumb'   => '1/17.7701cf9446a6b588de67.png',
            'brand' => 'Hàng Việt Nam',
            'origin'    => 'Việt Nam',
            'title' => 'Rey Nylon Backpack',
            'keyword'   => 'Rey Nylon Backpack, Rey Nylon Backpack, on top sale',
            'status'    => '0'
        ]);

        DB::table('product')->insert([
            'id_store'   => 2,
            'create_by'  => 1,
            'name'  => 'Round Buckle 1" Belt',
            'slug'      => 'round-buckle-1-belt-' . time(),
            'description'    => 'Fashion is a form of self-expression and autonomy at a particular period and place and in a specific context, of clothing, footwear, lifestyle, accessories, makeup, hairstyle, and body posture.',
            'long_description' => 'The patented eighteen-inch hardwood Arrowhead deck --- finely mortised in, makes this the strongest and most rigid canoe ever built. You cannot buy a canoe that will afford greater satisfaction.The St. Louis Meramec Canoe Company was founded by Alfred Wickett in 1922. Wickett had previously worked for the Old Town Canoe Co from 1900 to 1914. Manufacturing of the classic wooden canoes in Valley Park, Missouri ceased in 1978.',
            'type' => '0',
            'category_path' => '1_5',
            'category_id' => 5,
            'thumb'   => '2/2.0fda32f45e4cd5e368ea.png',
            'brand' => 'Hàng Việt Nam',
            'origin'    => 'Việt Nam',
            'title' => 'Round Buckle 1" Belt',
            'keyword'   => 'Round Buckle 1" Belt, Round Buckle 1" Belt, on top sale',
            'status'    => '0'
        ]);

        DB::table('product')->insert([
            'id_store'   => 1,
            'create_by'  => 1,
            'name'  => 'Waffle Knit Beanie',
            'slug'      => 'waffle-knit-beanie-' . time(),
            'description'    => 'Fashion is a form of self-expression and autonomy at a particular period and place and in a specific context, of clothing, footwear, lifestyle, accessories, makeup, hairstyle, and body posture.',
            'long_description' => 'The patented eighteen-inch hardwood Arrowhead deck --- finely mortised in, makes this the strongest and most rigid canoe ever built. You cannot buy a canoe that will afford greater satisfaction.The St. Louis Meramec Canoe Company was founded by Alfred Wickett in 1922. Wickett had previously worked for the Old Town Canoe Co from 1900 to 1914. Manufacturing of the classic wooden canoes in Valley Park, Missouri ceased in 1978.',
            'type' => '0',
            'category_path' => '1_5',
            'category_id' => 5,
            'thumb'   => '3/16.5ed8bd8a65af67fd6c5c.png',
            'brand' => 'Hàng Việt Nam',
            'origin'    => 'Việt Nam',
            'title' => 'Waffle Knit Beanie',
            'keyword'   => 'Waffle Knit Beanie, Waffle Knit Beanie, on top sale',
            'status'    => '0'
        ]);

        DB::table('product')->insert([
            'id_store'   => 2,
            'create_by'  => 1,
            'name'  => 'Travel Pet Carrier',
            'slug'      => 'travel-pet-carrier-' . time(),
            'description'    => 'Fashion is a form of self-expression and autonomy at a particular period and place and in a specific context, of clothing, footwear, lifestyle, accessories, makeup, hairstyle, and body posture.',
            'long_description' => 'The patented eighteen-inch hardwood Arrowhead deck --- finely mortised in, makes this the strongest and most rigid canoe ever built. You cannot buy a canoe that will afford greater satisfaction.The St. Louis Meramec Canoe Company was founded by Alfred Wickett in 1922. Wickett had previously worked for the Old Town Canoe Co from 1900 to 1914. Manufacturing of the classic wooden canoes in Valley Park, Missouri ceased in 1978.',
            'type' => '0',
            'category_path' => '1_5',
            'category_id' => 5,
            'thumb'   => '4/4.7342ded3cf1426f3ce5e.png',
            'brand' => 'Hàng Việt Nam',
            'origin'    => 'Việt Nam',
            'title' => 'Travel Pet Carrier',
            'keyword'   => 'Travel Pet Carrier, Travel Pet Carrier, on top sale',
            'status'    => '0'
        ]);

        DB::table('product')->insert([
            'id_store'   => 1,
            'create_by'  => 1,
            'name'  => 'Leather Gloves',
            'slug'      => 'leather-gloves-' . time(),
            'description'    => 'Fashion is a form of self-expression and autonomy at a particular period and place and in a specific context, of clothing, footwear, lifestyle, accessories, makeup, hairstyle, and body posture.',
            'long_description' => 'The patented eighteen-inch hardwood Arrowhead deck --- finely mortised in, makes this the strongest and most rigid canoe ever built. You cannot buy a canoe that will afford greater satisfaction.The St. Louis Meramec Canoe Company was founded by Alfred Wickett in 1922. Wickett had previously worked for the Old Town Canoe Co from 1900 to 1914. Manufacturing of the classic wooden canoes in Valley Park, Missouri ceased in 1978.',
            'type' => '0',
            'category_path' => '1_5',
            'category_id' => 5,
            'thumb'   => '5/5.9ddc0dff360795c6f5b5.png',
            'brand' => 'Hàng Việt Nam',
            'origin'    => 'Việt Nam',
            'title' => 'Leather Gloves',
            'keyword'   => 'Leather Gloves, Leather Gloves, on top sale',
            'status'    => '0'
        ]);

        DB::table('product')->insert([
            'id_store'   => 2,
            'create_by'  => 1,
            'name'  => 'Hoodie Sweatshirt',
            'slug'      => 'hoodie-sweatshirt-' . time(),
            'description'    => 'Fashion is a form of self-expression and autonomy at a particular period and place and in a specific context, of clothing, footwear, lifestyle, accessories, makeup, hairstyle, and body posture.',
            'long_description' => 'The patented eighteen-inch hardwood Arrowhead deck --- finely mortised in, makes this the strongest and most rigid canoe ever built. You cannot buy a canoe that will afford greater satisfaction.The St. Louis Meramec Canoe Company was founded by Alfred Wickett in 1922. Wickett had previously worked for the Old Town Canoe Co from 1900 to 1914. Manufacturing of the classic wooden canoes in Valley Park, Missouri ceased in 1978.',
            'type' => '0',
            'category_path' => '1_5',
            'category_id' => 5,
            'thumb'   => '6/6.ed4616e785835c927ad1.png',
            'brand' => 'Hàng Việt Nam',
            'origin'    => 'Việt Nam',
            'title' => 'Hoodie Sweatshirt',
            'keyword'   => 'Hoodie Sweatshirt, Hoodie Sweatshirt, on top sale',
            'status'    => '0'
        ]);

        DB::table('product')->insert([
            'id_store'   => 1,
            'create_by'  => 1,
            'name'  => 'Wool Cashmere Jacket',
            'slug'      => 'wool-cashmere-jacket-' . time(),
            'description'    => 'Fashion is a form of self-expression and autonomy at a particular period and place and in a specific context, of clothing, footwear, lifestyle, accessories, makeup, hairstyle, and body posture.',
            'long_description' => 'The patented eighteen-inch hardwood Arrowhead deck --- finely mortised in, makes this the strongest and most rigid canoe ever built. You cannot buy a canoe that will afford greater satisfaction.The St. Louis Meramec Canoe Company was founded by Alfred Wickett in 1922. Wickett had previously worked for the Old Town Canoe Co from 1900 to 1914. Manufacturing of the classic wooden canoes in Valley Park, Missouri ceased in 1978.',
            'type' => '0',
            'category_path' => '1_5',
            'category_id' => 5,
            'thumb'   => '7/9.838d27ae66ef44d4a73b.png',
            'brand' => 'Hàng Việt Nam',
            'origin'    => 'Việt Nam',
            'title' => 'Wool Cashmere Jacket',
            'keyword'   => 'Wool Cashmere Jacket, Wool Cashmere Jacket, on top sale',
            'status'    => '0'
        ]);

        DB::table('product')->insert([
            'id_store'   => 1,
            'create_by'  => 1,
            'name'  => 'Ella Leather Tote',
            'slug'      => 'ella-leather-tote-' . time(),
            'description'    => 'Fashion is a form of self-expression and autonomy at a particular period and place and in a specific context, of clothing, footwear, lifestyle, accessories, makeup, hairstyle, and body posture.',
            'long_description' => 'The patented eighteen-inch hardwood Arrowhead deck --- finely mortised in, makes this the strongest and most rigid canoe ever built. You cannot buy a canoe that will afford greater satisfaction.The St. Louis Meramec Canoe Company was founded by Alfred Wickett in 1922. Wickett had previously worked for the Old Town Canoe Co from 1900 to 1914. Manufacturing of the classic wooden canoes in Valley Park, Missouri ceased in 1978.',
            'type' =>   '0',
            'category_path' => '1_5',
            'category_id' => 5,
            'thumb'   => '8/8.cb062df1bb925627f03d.png',
            'brand' => 'Hàng Việt Nam',
            'origin'    => 'Việt Nam',
            'title' => 'Ella Leather Tote',
            'keyword'   => 'Ella Leather Tote, Ella Leather Tote, on top sale',
            'status'    => '0'
        ]);

        for ($i = 1; $i < 9; $i++) {
            DB::table('product_detail')->insert([
                'id_product'   => $i,
                'color_value'  => '#b047e1',
                'attribute'  => 'Size',
                'attribute_value' => 'M',
                'weight' => 200,
                'quantity'      => 43,
                'price' =>   310000,
                'sale' => 30000,
                'sold' => rand(1,20),
                'url_image' => '1/17.7701cf9446a6b588de67.png',
                'status'    => '0'
            ]);
            DB::table('product_detail')->insert([
                'id_product'   => $i,
                'color_value'  => '#b047e1',
                'attribute'  => 'Size',
                'attribute_value' => 'X',
                'weight' => 200,
                'quantity'      => 32,
                'price' =>   320000,
                'sale' => 20000,
                'sold' => rand(1,30),
                'url_image' => '1/17.7701cf9446a6b588de67.png',
                'status'    => '0'
            ]);
            DB::table('product_detail')->insert([
                'id_product'   => $i,
                'color_value'  => '#b047e1',
                'attribute'  => 'Size',
                'attribute_value' => 'XL',
                'weight' => 200,
                'quantity'      => 23,
                'price' =>   330000,
                'sale' => 25000,
                'sold' => rand(1,10),
                'url_image' => '1/17.7701cf9446a6b588de67.png',
                'status'    => '0'
            ]);

            DB::table('product_detail')->insert([
                'id_product'   => $i,
                'color_value'  => '#abe826',
                'attribute'  => 'Size',
                'attribute_value' => 'M',
                'weight' => 200,
                'quantity'      => 42,
                'price' =>   310000,
                'sale' => 20000,
                'sold' => rand(20,30),
                'url_image' => '1/17.7701cf9446a6b588de67.png',
                'status'    => '0'
            ]);

            DB::table('product_detail')->insert([
                'id_product'   => $i,
                'color_value'  => '#abe826',
                'attribute'  => 'Size',
                'attribute_value' => 'X',
                'weight' => 200,
                'quantity'      => 47,
                'price' =>   320000,
                'sale' => 20000,
                'sold' => rand(20,47),
                'url_image' => '1/17.7701cf9446a6b588de67.png',
                'status'    => '0'
            ]);

            DB::table('product_detail')->insert([
                'id_product'   => $i,
                'color_value'  => '#abe826',
                'attribute'  => 'Size',
                'attribute_value' => 'XL',
                'weight' => 200,
                'quantity'      => 48,
                'price' =>   330000,
                'sale' => 20000,
                'sold' => rand(20,48),
                'url_image' => '1/17.7701cf9446a6b588de67.png',
                'status'    => '0'
            ]);

            DB::table('product_detail')->insert([
                'id_product'   => $i,
                'color_value'  => '#16e4f3',
                'attribute'  => 'Size',
                'attribute_value' => 'M',
                'weight' => 200,
                'quantity'      => 74,
                'price' =>   310000,
                'sale' => 20000,
                'sold' => rand(10,74),
                'url_image' => '1/17.7701cf9446a6b588de67.png',
                'status'    => '0'
            ]);

            DB::table('product_detail')->insert([
                'id_product'   => $i,
                'color_value'  => '#16e4f3',
                'attribute'  => 'Size',
                'attribute_value' => 'X',
                'weight' => 200,
                'quantity'      => 71,
                'price' =>   320000,
                'sale' => 20000,
                'sold' => rand(10,74),
                'url_image' => '1/17.7701cf9446a6b588de67.png',
                'status'    => '0'
            ]);

            DB::table('product_detail')->insert([
                'id_product'   => $i,
                'color_value'  => '#16e4f3',
                'attribute'  => 'Size',
                'attribute_value' => 'XL',
                'weight' => 200,
                'quantity'      => 74,
                'price' =>   330000,
                'sale' => 20000,
                'sold' => rand(20,74),
                'url_image' => '1/17.7701cf9446a6b588de67.png',
                'status'    => '0'
            ]);

            for($x = 0; $x < 50; $x ++) {
                DB::table('comment_product')->insert([
                    'create_by'   => 2,
                    'id_store'  => 1,
                    'id_product'  => $i,
                    'message'      => 'Very nice feeling sweater. I like it better than a regular hoody because it is tailored to be a slimmer fit. Perfect for going out when you want to stay comfy. The head opening is a little tight which makes it a little.',
                    'rate' => rand(1,5),
                    'parent_id'     => 0,
                    'parent_path'   => $x.'_',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
            for($x = 0; $x < 5; $x ++) {
                DB::table('product_images')->insert([
                    'id_product'   => $i,
                    'url'   => 'detail1.f45e3a4d9bfeafd2f70b.jpg'
                ]);
            }
        }
    }
}
