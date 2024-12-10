<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Attribute;
use App\Models\Copen;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class Payment
{
    /** @param  array{}  $args */

    public function payment($root, array $args, GraphQLContext $context) {
     /*  if (!Auth::check())
      {
        throw new \Exception("User is not authenticated."); 
       } */
         $customer_id = 2;
         $cartData = $args['cartData'];
         $userCode = $args['copen_code'] ?? null ; 
         $totalPrice = 0;
         $finalPrice = 0 ;


         foreach ($cartData as $item) {
             $product = Product::find($item['id']);
             $order = Order::create(['order_date' => now() , 'customer_id' => 2, 'total_amount' => $totalPrice , 'final_price' => $finalPrice]);

                   $order->products()->attach($item['id'],
                    [ 
                      'quantity' => $item['quantity'],
                      'price' => $item['price'],
                   ]
                   );

                   $product->inventory -= $item['quantity'];
                   if($product->inventory < 0 )
                      $product->inventory = 0 ; 
                 
                   $product->save();
     
               if (!$product)
                { 
                  throw new \Exception("Product with ID {$item['id']} does not exist.");
                }  

              if($item['quantity'] > $product->inventory)
               {
                   throw new \Exception("Product with ID {$item['id']}does not have sufficient stock."); 
               } 

               /* foreach ($item['attributes'] as $attributeName => $attributeValue) 
               {
                 return $attributeName;
                 $attribute = Attribute::where('name', $attributeName)->first(); 
                 if (!$attribute) 
                 { 
                  throw new \Exception("Attribute {$attributeName} does not exist."); 
                 }
                  $productAttribute = $product->attributes() ->where('attribute_id', $attribute->id)->wherePivot('value', $attributeValue)->first(); 
                  if (!$productAttribute) { throw new \Exception("Invalid attribute value for {$attributeName}.");
                   } 
                } */

                 $price = $product->dis_price ?? $product->price;
           

                $totalPrice += $price * $item['quantity'];
        }

               $discountAmount = 0;
              if ($userCode)
               { 
                $code = Copen::query()->
                where('code' , $userCode)
               ->where('state' , 'unexpire')
               ->where('end_date', '>' ,now())
               ->first() ??  null;


                  if ($code) 
                  { 
                    $discountAmount = $totalPrice * ($code->discount_value / 100); 
                    $finalPrice = $totalPrice - $discountAmount;
                  } 
                  else 
                   { 
                    $finalPrice = $totalPrice ;
                   }
               }
               else 
                $finalPrice = $totalPrice;
          
              return $this->copenValidation( $code , $userCode , $order,$finalPrice);
    }

      public function copenValidation($code ,$userCode,$order,$disPrice){
        $customer = Customer::find($order->customer_id);

        if ($customer->orders->count() != 0) {

            foreach ($customer->orders as $item) {

                if ($item->where('copen_code', $code->code ??null)
                ->where('customer_id' , $customer->id)->count() >= 1) {
                    // copen code is already used
                    $order->update([
                        "copen_code" => null ,
                        "copen_reason" =>  null,
                        "copen_status" =>  0,
                        "final_price" => $order->total_amount
                    ]);
                }
               else
               {
                  $order->update([
                      "copen_code" => $userCode ,
                      "copen_reason" => 'کد تخفیف',
                      "copen_status" =>  1,
                      "final_price" => $disPrice
                  ]);
               }
            }
        }
      }
}
