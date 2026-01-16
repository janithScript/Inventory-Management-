<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    public function searchItems(string $query = ''): Collection
    {
        return Item::with('unit')
            ->when($query, function ($builder) use ($query) {
                return $builder->where('name', 'like', "%{$query}%");
            })
            ->orderBy('name')
            ->get();
    }

    public function createItems(array $items): array
    {
        $created = [];
        
        DB::transaction(function () use ($items, &$created) {
            foreach ($items as $itemData) {
                $item = Item::create([
                    'name' => $itemData['name'],
                    'unit_id' => $itemData['unit_id'],
                    'quantity' => $itemData['quantity'] ?? 0,
                ]);

                if (($itemData['quantity'] ?? 0) > 0) {
                    $item->addStock($itemData['quantity']);
                }

                $created[] = $item->load('unit');
            }
        });

        return $created;
    }

    public function bulkAddStock(array $additions): bool
    {
        try {
            DB::transaction(function () use ($additions) {
                foreach ($additions as $addition) {
                    $item = Item::findOrFail($addition['item_id']);
                    $item->addStock($addition['quantity']);
                }
            });
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function bulkDeductStock(array $deductions): array
    {
        $errors = [];
        
        try {
            DB::transaction(function () use ($deductions, &$errors) {
                foreach ($deductions as $deduction) {
                    $item = Item::findOrFail($deduction['item_id']);
                    
                    if (!$item->canDeduct($deduction['quantity'])) {
                        $errors[] = "Insufficient stock for {$item->name}. Available: {$item->quantity}";
                        throw new \Exception('Insufficient stock');
                    }
                }

                foreach ($deductions as $deduction) {
                    $item = Item::findOrFail($deduction['item_id']);
                    $item->deductStock($deduction['quantity']);
                }
            });
        } catch (\Exception $e) {
            // Errors are already collected
        }

        return $errors;
    }

    public function getItemTransactions(int $itemId): Collection
    {
        return Item::findOrFail($itemId)
            ->transactions()
            ->with('item.unit')
            ->get();
    }

    public function getUnits(): Collection
    {
        return Unit::orderBy('name')->get();
    }
}