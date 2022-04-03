<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaytabsInvoice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'result', 'response_code', 'pt_invoice_id','amount', "currency", "transaction_id", "card_brand", "card_first_six_digits", "card_last_four_digits"
    ];


}
