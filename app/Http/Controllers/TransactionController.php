<?php

namespace App\Http\Controllers;

use App\Services\InventoryService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function __construct(
        private InventoryService $inventoryService
    ) {}

    public function show(Request $request, int $itemId)
    {
        $transactions = $this->inventoryService->getItemTransactions($itemId);
        
        return Inertia::render('Transactions/Show', [
            'transactions' => $transactions,
            'item' => $transactions->first()?->item ?? null,
        ]);
    }
}