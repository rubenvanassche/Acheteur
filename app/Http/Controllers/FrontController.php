<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\Email;
use App\Exceptions\NotEnoughStockException;
use App\Order;
use App\Page;
use App\Product;
use App\Providers\SectionTypes;
use App\Section;
use App\Shift;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Blade;
use Collective\Html\FormFacade as Form;
use Illuminate\Support\Facades\Mail;

class FrontController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page($pageSlug){
        $page = Page::where('slug', $pageSlug)->where('event_id', Configuration::eventId())->first();
        $eventSlug = Configuration::event()->slug;

        Blade::directive('title', function() {
            return '<?php echo($page->title); ?>';
        });

        Blade::directive('openform', function() {
            return '<?php echo(Form::open(array("action" => ["FrontController@order"], "method" => "post"))); ?>';
        });

        Blade::directive('closeform', function() {
            $out  = '<?php echo(Form::close()); ?>';

            return $out;
        });

        Blade::directive('submit', function($text) {
            $text = substr($text,1,-1);
            $out  = '<?php echo(Form::submit("'.$text.'")); ?>';

            return $out;
        });

        Blade::directive("field", function($type) {
            if($type == '(name)'){
                return '<?php echo(Form::text("name")); ?>';
            }else if($type == '(email)'){
                return '<?php echo(Form::email("email")); ?>';
            }else if($type == '(comments)'){
                return '<?php echo(Form::textarea("comments")); ?>';
            }else{
                return "";
            }
        });

        Blade::directive('product', function($productSlug) {
            $productSlug = substr($productSlug,1,-1);
            $product = Product::findBySlugOrFail($productSlug);

            return '<?php echo(Form::number("product'.$product->id.'", "0")); ?>';
        });

        Blade::directive('shifts', function() {
            $shifts = Shift::where('event_id', Configuration::eventId())->get();

            $out = '';
            foreach($shifts as $shift){
                $out .= '<?php echo(Form::radio("shift", '.$shift->id.')); ?>';
                $out .= '<?php echo(Form::label('.$shift->beautify().')); ?>';
            }

            return $out;
        });

        Blade::directive('content', function($sectionSlug) use ($page) {
            return '<?php
            $sectionSlug = substr("'.$sectionSlug.'",1,-1);
            $section = $page->sections()->where("slug", $sectionSlug)->first();
            $sectionObj = \App\Providers\SectionTypes::createInstance($section->type);

            echo($sectionObj->render($section->content));
            ?>';

        });

        Blade::directive('asset', function($path) use($eventSlug) {
            $path = substr($path,1,-1);

            return '<?php echo(url("events/'.$eventSlug.'/'.$path.'")) ?>';
        });

        //


        return view($page->getFrontView(), array('page' => $page));
    }

    public function home(){
        return $this->page(Page::getHomePageSlug());
    }

    public function order(Requests\Order\CreateOrderRequest $request){
        $products = Product::where('event_id', Configuration::eventId())->get();
        $hasShifts = Configuration::event()->hasShifts();
        $event = Configuration::event();

        // Check if available for all
        foreach($products as $product){
            if((($product->stock($request->shift) - intval($request->input('product'.$product->id, 0))) < 0) == true){
                throw new NotEnoughStockException($product->name. " not enough in stock");
            }
        }

        // Create order
        $order = new Order();
        $order->name = $request->name;
        $order->event_id = Configuration::eventId();
        $order->email = $request->email;
        $order->comments = $request->comments;
        if($hasShifts == true){
            $order->shift_id = $request->shift;
        }else{
            $order->shift_id = $event->shifts()->first()->id;
        }
        $order->save();


        foreach($products as $product){
            $amount = $request->input('product'.$product->id, 0);

            // Create orderlists
            $order->orderlists()->create([
                'product_id' => $product->id,
                'amount' => $amount
            ]);

            // Update availability of products
            $product->sell($amount, $request->shift);
        }



        // send email
        Blade::directive('content', function($expression) use($order) {
            $expression = substr($expression,1,-1);
            if($expression == 'name'){
                return '<?php echo($order->name); ?>';
            }else if($expression == 'price'){
                return '<?php echo($order->cost()); ?>';
            }else if($expression == 'ordered'){
                return '<?php
                foreach($order->orderlists()->get() as $orderlist){
                    $out = $orderlist->amount . " X " . $orderlist->product->name . "<br />";
                }
                ?>';
            }
        });



        $emailView = Email::view('orderconfirmation');
        $emailAddress = Configuration::event()->email;
        $emailName = Configuration::event()->name;

        Mail::send($emailView,['order' => $order], function ($message) use ($emailAddress, $emailName, $order){
            $message->from($emailAddress, $emailName);
            $message->to($order->email, $order->name)->subject('Order complete');
        });


        return redirect(url(Configuration::event()->slug.'/'.Page::findOrFail(Configuration::event()->after_order_page_id)->slug));
    }

}
