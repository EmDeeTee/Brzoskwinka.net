<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class SearchTest extends TestCase
{
    // Feature test for all the search functionality
    public function setUp(): void {
        parent::setUp();
        // This is being run per every test. Not gud
        $this->artisan('migrate:fresh --seed');
    }
    public function test_search_with_no_result(): void {
        $res = $this->get('/products/search/something%20really%20invalid');
        $res->assertInertia(fn (Assert $page) => $page
            ->has('errorMsg')
            ->has('products', 0)
        );
    }

    public function test_search_with_1_result(): void {
        $res = $this->get('/products/search/dell%20inspiron%201525');
        $res->assertInertia(fn (Assert $page) => $page
            ->where('errorMsg', null)
            ->has('products', 1)
        );
    }

    public function test_search_with_2_results(): void {
        $res = $this->get('/products/search/dell%20inspiron');
        $res->assertInertia(fn (Assert $page) => $page
            ->where('errorMsg', null)
            ->has('products', 2)
        );
    }

    public function test_search_listings_by_user(): void {
        $res = $this->get('/products/search/!user=Papkin'); //Papkin is seeded with ID=1
        $res->assertInertia(fn (Assert $page) => $page
            ->where('errorMsg', null)
            ->hasAny('products')
        );
    }

    public function test_search_listings_by_nonexistent_user(): void {
        $res = $this->get('/products/search/!user=ImAGhostIDontExist'); 
        $res->assertInertia(fn (Assert $page) => $page
            ->has('errorMsg')
            ->has('products', 0)
        );
    }
}
