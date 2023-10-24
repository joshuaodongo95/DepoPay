<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Subscription;
use App\Models\User;
use App\Models\PaymentPlan;
use App\Models\Product;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_belongs_to_a_customer()
    {
        $user = User::factory()->create();
        $subscription = Subscription::factory()->create(['customer_id' => $user->id]);

        $this->assertInstanceOf(User::class, $subscription->customer);
        $this->assertEquals($user->id, $subscription->customer->id);
    }

    public function test_it_belongs_to_a_payment_plan()
    {
        $paymentPlan = PaymentPlan::factory()->create();
        $subscription = Subscription::factory()->create(['payment_plan_id' => $paymentPlan->id]);

        $this->assertInstanceOf(PaymentPlan::class, $subscription->paymentPlan);
        $this->assertEquals($paymentPlan->id, $subscription->paymentPlan->id);
    }

    public function test_it_belongs_to_a_product()
    {
        $product = Product::factory()->create();
        $subscription = Subscription::factory()->create(['product_id' => $product->id]);

        $this->assertInstanceOf(Product::class, $subscription->product);
        $this->assertEquals($product->id, $subscription->product->id);
    }

    public function test_it_returns_status_label_attribute()
    {
        $subscription = Subscription::factory()->create(['status' => 'new']);

        $this->assertEquals('new', $subscription->status_label);
    }
}
