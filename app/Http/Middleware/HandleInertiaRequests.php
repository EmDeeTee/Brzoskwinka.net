<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Auth;

use function PHPUnit\Framework\isInstanceOf;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    private function getCartIfAvailable(User|null $u) {
        if ($u) {
            return Cart::firstWhere(['user_id' => Request()->user()->id]);
        } else {
            return null;
        }
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'cart' => $this->getCartIfAvailable($request->user())
            ]
        ];
    }
}
