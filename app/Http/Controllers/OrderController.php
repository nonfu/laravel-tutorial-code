<?php

namespace App\Http\Controllers;

use App\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private $orders;

    public function __construct(OrderRepositoryInterface $orders)
    {
        $this->orders = $orders;
    }

    public function getRecent()
    {
        $recent = $this->orders->getMostRecent(Auth::user());
        return view('orders.recent', compact('recent'));
    }
}
