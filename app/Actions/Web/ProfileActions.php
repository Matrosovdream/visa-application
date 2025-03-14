<?php
namespace App\Actions\Web;

class ProfileActions {


    public function edit($request)
    {
        return [
            'user' => $request->user()
        ];
    }

    public function update($request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

    }

}