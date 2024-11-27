<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','order_date','payment_method' , 'total_amount' , 'delivery_address', 'copen_code' ,  'copen_reason','final_price','birth_date',"copen_status"];





    public function customer() {
        return $this->belongsTo(Customer::class);
   }
   
    public function products() {
        return $this->belongsToMany(Product::class)->withPivot(columns: ['product_id' , "quantity" , 'price']);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    

    public function isState($state) {
         switch($state)
         {
             case 'paid' : 
            return $state = 'paid';
             case 'pending' : 
                return $state = 'pending';

                case 'delivered' : 
                    return $state = 'delivered';
    
                    case 'shipped' : 
                        return $state = 'shipped';
        
                    case 'cancelled' : 
                        return $state = 'cancelled';
        
                        default : 
                        return "not found" ;
                         

         }
    }
  

}
