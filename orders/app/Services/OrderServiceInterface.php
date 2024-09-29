<?php

namespace App\Services;

    interface OrderServiceInterface
    {
        public function createOrder($user_id);

        public function updateOrderStatus($order_id, $status);
    }
