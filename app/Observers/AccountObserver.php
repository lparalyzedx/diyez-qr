<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Locale;

class AccountObserver
{
    /**
     * Handle the Account "created" event.
     *
     * @param  \App\Models\Account  $account
     * @return void
     */
    public function created(Account $account)
    {
        Locale::create([
            'name' => 'Türkçe',
            'language_code' => 'tr',
            'flag' => 'locales/tr.png',
            'is_default' => true,
            'status' => true,
            'account_id' => $account->id
        ]);
    }
}
