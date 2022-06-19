<?php

namespace App\Models;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'code', 'amount'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generateInvoice()
    {
        $pdf = PDF::loadView('orders.invoice', ['order' => $this])->setOptions(['defaultFont' => 'Vazir']);
        return $pdf->save(storage_path('app/public/invoices/') . $this->id . '.pdf');
    }
}
