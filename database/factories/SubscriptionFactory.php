<?php
namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition()
    {
        return [
            'ref' => $this->faker->unique()->word,
            'customer_id' => $this->createUser(),
            'payment_plan_id' => $this->createPaymentPlan(),
            'status' => $this->faker->randomElement(['new', 'canceled', 'delivered', 'pending']),
            'product_id' => $this->createProduct(),
            'currency' => $this->faker->currencyCode,
        ];
    }

    private function createUser()
    {
        return app(UserFactory::class)->create()->id;
    }

    private function createPaymentPlan()
    {
        return app(PaymentPlanFactory::class)->create()->id;
    }

    private function createProduct()
    {
        return app(ProductFactory::class)->create()->id;
    }
}

