<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use Bmatovu\MtnMomo\Products\Collection;
class CheckPaymentStatus extends Command
{
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    protected $signature = 'payment:check-status {referenceId?}';
    protected $description = 'Check the status of payment requests';

    public function handle()
    {
        $referenceId = $this->argument('referenceId');

        if ($referenceId) {
            $this->checkSingleSubscription($referenceId);
        } else {
            $this->checkAllSubscriptions();
        }
    }

    private function checkSingleSubscription($ref)
    {
        $subscriptions = Subscription::whereNotIn('status', ['SUCCESSFUL', 'FAILED'])
            ->where('reference_id', $ref)
            ->get();
        
        if ($subscriptions->isEmpty()) {
            $this->info("No subscriptions found with reference ID: $ref");
            return;
        }

        foreach ($subscriptions as $subscription) {
            $this->info("Subscription ID: {$subscription->id}, Status: {$subscription->status}");
            
            

            try {
                $collection = new Collection();
                $response = $collection->getTransactionStatus($subscription->ref);
                if ($response && isset($response['status'])) {
                    $newStatus = $response['status'];
                    $subscription->status = $newStatus;
                    $subscription->save();
                    
                    $this->info("Updated Subscription ID: {$subscription->id}, New Status: $newStatus");
                } else {
                    $this->error("Failed to retrieve the status for Subscription ID: {$subscription->id}");
                }
            } catch(CollectionRequestException $e) {
                do {
                    printf("\n\r%s:%d %s (%d) [%s]\n\r", 
                        $e->getFile(), $e->getLine(), $e->getMessage(), $e->getCode(), get_class($e));
                } while($e = $e->getPrevious());
            }
            
            
        }

        $finalStatuses = ['SUCCESSFUL', 'FAILED'];
        
        $allFinal = $subscriptions->every(function ($subscription) use ($finalStatuses) {
            return in_array($subscription->status, $finalStatuses);
        });


        if ($allFinal) {
            $this->info("All subscriptions for reference ID $ref have reached a final state.");
        } else {
            $this->info("Not all subscriptions have reached a final state.");
        }
    }

    private function checkAllSubscriptions()
    {
        $subscriptions = Subscription::whereNotIn('status', ['SUCCESSFUL', 'FAILED'])->get();

        if ($subscriptions->isEmpty()) {
            $this->info("No subscriptions found with 'PENDING' status.");
            return;
        }

        foreach ($subscriptions as $subscription) {
            $this->info("Subscription ID: {$subscription->id}, Status: {$subscription->status}");
            try {
                $collection = new Collection();
                $response = $collection->getTransactionStatus($subscription->ref);
                
                if ($response && isset($response['status'])) {
                    $newStatus = $response['status'];
                    $subscription->status = $newStatus;
                    $subscription->save();
                    
                    $this->info("Updated Subscription ID: {$subscription->id}, New Status: $newStatus");
                } else {
                    $this->error("Failed to retrieve the status for Subscription ID: {$subscription->id}");
                }

            } catch(CollectionRequestException $e) {
                do {
                    printf("\n\r%s:%d %s (%d) [%s]\n\r", 
                        $e->getFile(), $e->getLine(), $e->getMessage(), $e->getCode(), get_class($e));
                } while($e = $e->getPrevious());
            }
        }

        $finalStatuses = ['SUCCESSFUL', 'FAILED'];
        $allFinal = $subscriptions->every(function ($subscription) use ($finalStatuses) {
            return in_array($subscription->status, $finalStatuses);
        });

        if ($allFinal) {
            $this->info("All subscriptions have reached a final state.");
        } else {
            $this->info("Not all subscriptions have reached a final state.");
        }
    }

}
