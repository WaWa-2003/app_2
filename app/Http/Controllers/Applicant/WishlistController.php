<?php

namespace App\Http\Controllers\Applicant;

use App\Models\Applicant\Wishlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishlist_add(Request $request)
    {
        $user_id = auth()->user()->id; // can also use $request->user_id;
        $opportunity_id = $request->opportunity_id;

        Wishlist::updateOrCreate(
            [
                'user_id' => $user_id,
                'opportunity_id' => $opportunity_id,
            ],
            [
                'status' => true,
            ]
        );

        return redirect()->route('opportunity.show',$opportunity_id)
                         ->with('messageWishlist', 'Added to Wishlist');
    }

    public function wishlist_remove(Request $request)
    {
        $user_id = auth()->user()->id; // can also use $request->user_id;
        $opportunity_id = $request->opportunity_id;

        $wishlist = Wishlist::where([
            ['user_id', $user_id],
            ['opportunity_id', $opportunity_id],
        ])->first();

        if ($wishlist) {
            $wishlist->status = false;
            $wishlist->save();
        }

        return redirect()->route('opportunity.show',$opportunity_id)
                         ->with('messageWishlist', 'Removed from Wishlist');
    }
}
