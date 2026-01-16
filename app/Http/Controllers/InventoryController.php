<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemsRequest;
use App\Http\Requests\BulkStockRequest;
use App\Services\InventoryService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventoryController extends Controller
{
    public function __construct(
        private InventoryService $inventoryService
    ) {}

    public function index(Request $request)
    {
        $query = $request->get('search', '');
        $items = $this->inventoryService->searchItems($query);
        
        return Inertia::render('Inventory/Index', [
            'items' => $items,
            'search' => $query,
        ]);
    }

    public function create()
    {
        $units = $this->inventoryService->getUnits();
        
        return Inertia::render('Inventory/Create', [
            'units' => $units,
        ]);
    }

    public function store(CreateItemsRequest $request)
    {
        $items = $this->inventoryService->createItems($request->validated()['items']);
        
        return redirect()->route('inventory.index')
            ->with('success', 'Items created successfully!');
    }

    public function addStock()
    {
        $items = $this->inventoryService->searchItems();
        
        return Inertia::render('Inventory/AddStock', [
            'items' => $items,
        ]);
    }

    public function storeAddStock(BulkStockRequest $request)
    {
        $success = $this->inventoryService->bulkAddStock($request->validated()['operations']);
        
        if ($success) {
            return redirect()->route('inventory.index')
                ->with('success', 'Stock added successfully!');
        }
        
        return back()->with('error', 'Failed to add stock. Please try again.');
    }

    public function deductStock()
    {
        $items = $this->inventoryService->searchItems();
        
        return Inertia::render('Inventory/DeductStock', [
            'items' => $items,
        ]);
    }

    public function storeDeductStock(BulkStockRequest $request)
    {
        $errors = $this->inventoryService->bulkDeductStock($request->validated()['operations']);
        
        if (empty($errors)) {
            return redirect()->route('inventory.index')
                ->with('success', 'Stock deducted successfully!');
        }
        
        return back()->withErrors($errors);
    }
}