<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AiController extends Controller
{
    /**
     * Very simple rule-based AI answerer for site FAQs and flows.
     * No external APIs; safe to run offline.
     */
    public function chat(Request $request)
    {
        $q = trim((string) $request->input('message', ''));
        if ($q === '') {
            return response()->json(['reply' => "Please type your question. For example: 'How to register?', 'What is Shop Nest?', 'Delivery time?'" ]);
        }

        $reply = $this->answer($q);
        return response()->json(['reply' => $reply]);
    }

    protected function answer(string $q): string
    {
        $text = Str::lower($q);

        // Greetings
        if ($this->hasAny($text, ['hi', 'hello', 'salam', 'assalam'])) {
            return "Hi! I’m ShopNest AI. I can help with: account (login/register), customer vs shopkeeper features, products, orders, delivery, payments. Ask me anything.";
        }

        // What is ShopNest
        if ($this->hasAny($text, ['what is shopnest', 'shop nest', 'about', 'platform'])) {
            return "ShopNest is a hyperlocal commerce platform that connects customers with nearby shops for fast delivery and easy shopping.";
        }

        // Registration / Login
        if ($this->hasAny($text, ['register', 'sign up', 'join'])) {
            return "To register: click Register on the top bar or go to /register. Create an account as customer or shopkeeper.";
        }
        if ($this->hasAny($text, ['login', 'sign in'])) {
            return "Click Login in the top bar or open /login and enter your credentials.";
        }

        // Roles
        if ($this->hasAny($text, ['customer', 'buyer'])) {
            return "Customer features: browse products, add to cart, place orders, track status, and view your order history in the customer dashboard.";
        }
        if ($this->hasAny($text, ['shopkeeper', 'seller', 'vendor', 'merchant'])) {
            return "Shopkeeper features: manage products, view and process orders, analytics, customers, and profile in the shopkeeper dashboard.";
        }

        // Products
        if ($this->hasAny($text, ['product', 'catalog', 'inventory'])) {
            return "Products can be added and managed by shopkeepers in Dashboard → Products. Customers can browse products from the customer dashboard.";
        }

        // Orders & delivery
        if ($this->hasAny($text, ['order', 'delivery', 'deliver', 'track'])) {
            return "Orders flow: customer places order → shopkeeper accepts → preparing → out for delivery → delivered. Typical delivery time target is under 2 hours (varies by location).";
        }

        // Payments / security
        if ($this->hasAny($text, ['payment', 'secure', 'security'])) {
            return "Payments are secured. You can view order totals and track status. Refunds/cancellations depend on order stage.";
        }

        // Contact / help
        if ($this->hasAny($text, ['help', 'support', 'contact'])) {
            return "Need help? Tell me your question here, or contact the shopkeeper from your orders list. For account issues, try logging out and in again.";
        }

        // Default fallback
        return "I’m not fully trained on that yet. Try asking about: register, login, customer features, shopkeeper features, products, orders, delivery, or payments.";
    }

    protected function hasAny(string $text, array $needles): bool
    {
        foreach ($needles as $n) {
            if (Str::contains($text, Str::lower($n))) {
                return true;
            }
        }
        return false;
    }
}
