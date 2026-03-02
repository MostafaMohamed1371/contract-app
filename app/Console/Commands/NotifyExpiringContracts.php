<?php

namespace App\Console\Commands;

use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotifyExpiringContracts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contracts:notify-expiring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'يسجل في السجل العقود التي ستنتهي خلال عدد الأيام المحدد للتنبيه';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $today = Carbon::today();

        $contracts = Contract::whereNotNull('end_date')
            ->get()
            ->filter(function (Contract $contract) use ($today) {
                $daysBefore = $contract->notify_before_days ?? 30;
                $targetDate = $today->copy()->addDays($daysBefore);

                return $contract->end_date === $targetDate->toDateString();
            });

        foreach ($contracts as $contract) {
            Log::info('Contract expiring soon', [
                'id' => $contract->id,
                'contract_number' => $contract->contract_number,
                'end_date' => $contract->end_date,
            ]);
        }

        $this->info('تم فحص العقود، عدد العقود التي سينتهي عقدها بعد فترة التنبيه: ' . $contracts->count());

        return self::SUCCESS;
    }
}

