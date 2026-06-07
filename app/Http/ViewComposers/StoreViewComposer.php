<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class StoreViewComposer
{
    /**
     * Bind store to all views that use seller layout.
     */
    public function compose(View $view): void
    {
        $user = auth()->user();

        if ($user && $user->store) {
            $view->with('store', $user->store);
        }
    }
}