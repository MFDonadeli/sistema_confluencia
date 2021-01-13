<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Events\IqOptionValueCreatedEvent;

class ValoresIqOptionCandles extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => IqOptionValueCreatedEvent::class
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public static function boot() 
    {
        parent::boot();

        /**
         * Write code on Method
         *
         * @return response()
         */
        static::creating(function($item) {            
            error_log('Creating event call: '.$item); 
            $item->slug = Str::slug($item->name);
        });

  

        /** 
         * Write code on Method
         *
         * @return response()
         */

        static::created(function($item) {           
            /*

                Write Logic Here

            */ 

  

            error_log('Created event call: '.$item);

        });

  

        /**

         * Write code on Method

         *

         * @return response()

         */

        static::updating(function($item) {            

            error_log('Updating event call: '.$item); 

  

            $item->slug = Str::slug($item->name);

        });

  

        /**

         * Write code on Method

         *

         * @return response()

         */

        static::updated(function($item) {  

            /*

                Write Logic Here

            */    

  

            error_log('Updated event call: '.$item);

        });

  

        /**

         * Write code on Method

         *

         * @return response()

         */

        static::deleted(function($item) {            

            error_log('Deleted event call: '.$item); 

        });

    }
    
}
