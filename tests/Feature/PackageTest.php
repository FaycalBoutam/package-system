<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Package;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PackageTest extends TestCase
{
    use RefreshDatabase;

    public function test_packages_page_is_displayed_for_admin()
    {
        $user = User::factory()->create(['role' => 2]);
        $admin = User::factory()->create(['role' => 0]);
        Package::factory()->create(['user_id' => $user->id]);

        $this
            ->actingAs($admin)
            ->get(route('packages.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $assert) => $assert
                ->component('Package/Index')
                ->where('packages.data.0.user.first_name', $user->first_name)
            );
    }

    public function test_packages_page_is_displayed_for_staff()
    {
        $user = User::factory()->create(['role' => 2]);
        $staff = User::factory()->create(['role' => 1]);
        Package::factory()->create(['user_id' => $user->id]);

        $this
            ->actingAs($staff)
            ->get(route('packages.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $assert) => $assert
                ->component('Package/Index')
                ->where('packages.data.0.user.first_name', $user->first_name)
            );
    }

    public function test_packages_page_is_displayed_for_user_that_has_packages()
    {
        $user = User::factory()->create(['role' => 2]);
        $admin = User::factory()->create(['role' => 0]);
        Package::factory()->create(['user_id' => $user->id]);
        
        $this
            ->actingAs($user)
            ->get(route('packages.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $assert) => $assert
                ->component('Package/Index')
                ->where('packages.data.0.user.first_name', $user->first_name)
            );
    }

    public function test_packages_page_is_displayed_for_user_with_no_packages()
    {
        $user = User::factory()->create(['role' => 2]);
    
        $this
            ->actingAs($user)
            ->get(route('packages.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $assert) => $assert
                ->component('Package/Index')
                ->where('packages.data', [])
            );
    }
}
