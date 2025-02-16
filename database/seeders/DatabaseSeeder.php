<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(CategoryProductTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(ArticleCategoriesTableSeeder::class);
        $this->call(AttributesTableSeeder::class);
        $this->call(AttributeValuesTableSeeder::class);
        $this->call(AttributeProductTableSeeder::class);
        $this->call(CopensTableSeeder::class);
        $this->call(CopenCustomerTableSeeder::class);
        $this->call(OrderProductTableSeeder::class);
        $this->call(SupportTicketsTableSeeder::class);
        $this->call(SupportMessagesTableSeeder::class);
        $this->call(DiscountsTableSeeder::class);
    }
}
