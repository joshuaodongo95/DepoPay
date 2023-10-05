<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'auth_profile_edit',
            ],
            [
                'id'    => 2,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 3,
                'title' => 'permission_create',
            ],
            [
                'id'    => 4,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 5,
                'title' => 'permission_show',
            ],
            [
                'id'    => 6,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 7,
                'title' => 'permission_access',
            ],
            [
                'id'    => 8,
                'title' => 'role_create',
            ],
            [
                'id'    => 9,
                'title' => 'role_edit',
            ],
            [
                'id'    => 10,
                'title' => 'role_show',
            ],
            [
                'id'    => 11,
                'title' => 'role_delete',
            ],
            [
                'id'    => 12,
                'title' => 'role_access',
            ],
            [
                'id'    => 13,
                'title' => 'user_create',
            ],
            [
                'id'    => 14,
                'title' => 'user_edit',
            ],
            [
                'id'    => 15,
                'title' => 'user_show',
            ],
            [
                'id'    => 16,
                'title' => 'user_delete',
            ],
            [
                'id'    => 17,
                'title' => 'user_access',
            ],
            [
                'id'    => 18,
                'title' => 'business_create',
            ],
            [
                'id'    => 19,
                'title' => 'business_edit',
            ],
            [
                'id'    => 20,
                'title' => 'business_show',
            ],
            [
                'id'    => 21,
                'title' => 'business_delete',
            ],
            [
                'id'    => 22,
                'title' => 'business_access',
            ],
            [
                'id'    => 23,
                'title' => 'wallet_create',
            ],
            [
                'id'    => 24,
                'title' => 'wallet_edit',
            ],
            [
                'id'    => 25,
                'title' => 'wallet_show',
            ],
            [
                'id'    => 26,
                'title' => 'wallet_delete',
            ],
            [
                'id'    => 27,
                'title' => 'wallet_access',
            ],
            [
                'id'    => 28,
                'title' => 'payment_plan_create',
            ],
            [
                'id'    => 29,
                'title' => 'payment_plan_edit',
            ],
            [
                'id'    => 30,
                'title' => 'payment_plan_show',
            ],
            [
                'id'    => 31,
                'title' => 'payment_plan_delete',
            ],
            [
                'id'    => 32,
                'title' => 'payment_plan_access',
            ],
            [
                'id'    => 33,
                'title' => 'subscription_create',
            ],
            [
                'id'    => 34,
                'title' => 'subscription_edit',
            ],
            [
                'id'    => 35,
                'title' => 'subscription_show',
            ],
            [
                'id'    => 36,
                'title' => 'subscription_delete',
            ],
            [
                'id'    => 37,
                'title' => 'subscription_access',
            ],
            [
                'id'    => 38,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 39,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 40,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 41,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 42,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 43,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 44,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 45,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 46,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 47,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 48,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 49,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 50,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 51,
                'title' => 'product_create',
            ],
            [
                'id'    => 52,
                'title' => 'product_edit',
            ],
            [
                'id'    => 53,
                'title' => 'product_show',
            ],
            [
                'id'    => 54,
                'title' => 'product_delete',
            ],
            [
                'id'    => 55,
                'title' => 'product_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
