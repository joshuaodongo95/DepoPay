<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\PaymentPlan;

class PaymentPlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_duration_label_attribute()
    {
        $paymentPlan = PaymentPlan::factory()->create(['duration' => 'weekly']);

        $this->assertEquals('WEEKLY', $paymentPlan->duration_label);
    }
}
