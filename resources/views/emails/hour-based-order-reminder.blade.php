<!DOCTYPE html>
<html>
<head>
  <title>My Sweetie Pie</title>  
  <style>
        @media (max-width: 350px) {
            .header-right {
              font-size:80%;
            }
        }
        th,td{
            text-align:left;
        }
      
  </style>
</head>
<body style="background: #EEE; font-family: sans-serif; padding:0px;margin:0px;min-height:100vh;color:#333;line-height:150%; font-size:16px;">
    <div style="width: 700px;  margin: 0px auto; background:#FFF; min-height:100vh;position:relative;" >
        <div style="text-align: left;background:#FFF; padding:5px 15px; height:75px; border-bottom:1px solid #f591c1; background:#f591c1;"><!-- Header //-->
            <div style="max-width:50%;clear:none;float:left;" >
                <img src="https://sweetiepiebakeco.ca/assets/images/email_logo.png"  style="height:auto; margin-top:-3px; max-width:100%;" alt="SWEETIE PIE - Made with Love" />
            </div>
            <div style="float:right;text-align:right;padding:10px 0;white-space:nowrap;position:absolute; right:10px; top:15px; z-index:25;" class="header-right">
                <img src="https://sweetiepiebakeco.ca/assets/images/ph.png" width="14" height="14"> <a href="tel:+16472453301" style="color:#FFF;font-weight:bold;text-decoration:none;">+1 647-245-3301</a><br/>
                <img src="https://sweetiepiebakeco.ca/assets/images/em.png" width="14" height="14"> <a href="mailto:contact@sweetiepie.ca" style="color:#FFF;font-weight:bold;text-decoration:none;">contact@sweetiepiebakeco.ca</a>
            </div>
        </div><!-- Header //-->
        <div style="padding:15px 25px; letter-spacing:0px;min-height: calc(100vh - 215px);clear:both;"><!-- Main Area //-->
           
               <div>
                  <div >
                     <p style="text-align:center;font-weight:700;font-size:30px;margin-top:10px">Pending Order Reminder</p></div>
                
                        <table  cellpadding="7" cellspacing="0" style="display: flex;justify-content: center;">
                            <tbody>
                                <tr>
                                    <th>
                                        Invoice ID
                                    </th>
                                    <td>
                                        {{$orders->invoice_id}}
                                    </td>
                		        </tr>
                		        <tr>
                    		        <th>
                                         Order Type
                                    </th>
                                    <td>
                                        {{$orders->order_type}}
                                    </td>
                    		    </tr>
                    		    <tr>
                    		        <th>
                                         Ordered At
                                    </th>
                                    <td>
                                        {{$orders->ordered_at}}
                                    </td>
                    		    </tr>
                    		    <tr>
                                    <th>
                                        Cutomer
                                    </th>
                                    <td>
                                        {{$orders->customer}}
                                    </td>
                		        </tr>
                		         <tr>
                                    <th>
                                        Email
                                    </th>
                                    <td>
                                        <a href="mailto:{{$orders->email}}" title="{{$orders->email}}">{{$orders->email}}</a>
                                    </td>
                		        </tr>
                    		    <tr>
                    		        <th>
                                        Phone
                                    </th>
                                    <td>
                                        <a href="tel:+1{{$orders->phone}}" titile="+1{{$orders->phone}}">+1{{$orders->phone}}</a>
                                    </td>
                    		    </tr>
                    		    <tr>
                    		        <th>
                                         Pick Date/Time
                                    </th>
                                    <td>
                                        {{date('d M Y',strtotime($orders->serve_date))}} 
                                        @if($orders->order_type == 'pickup')
                                            - 
                                            <i>{{date('h:i a',strtotime($orders->serve_time))}}</i>
                                        @endif
                                    </td>
                    		    </tr>
                    		    <tr>
                                    <th>
                                        Store
                                    </th>
                                    <td>
                                        {{$orders->store}}
                                    </td>
                		        </tr>
                		         <tr>
                                    <th>
                                        Time Remaining
                                    </th>
                                    <td>
                                       @php
                                        $remainingSeconds = strtotime($orders->serve_date.' '.$orders->serve_time) - time();
                                        $remainingHours = floor($remainingSeconds / 3600);
                                        $remainingMinutes = floor(($remainingSeconds % 3600) / 60);
                                    @endphp
                                    {{ $remainingHours }} hours {{ $remainingMinutes }} minutes
                                    </td>
                		        </tr>
                            </tbody>
                      </table>
                         <br>
                      <div>
                         <table style="width: 100%;" cellpadding="7" cellspacing="0" border="0">
                            <tr>
                               
                               <th style="background: #f3f3f3;text-align: left;"  align="center">
                                  ITEM
                               </th>
                               <th  style="background: #f3f3f3; text-align: center;"  align="center">
                                   RATE
                               </th>
                               <th
                                  style="background: #f3f3f3; text-align: center;"  align="center">
                                  QTY
                               </th>
                               <th
                                  style="background: #f3f3f3; text-align: right;">
                                  SUB TOTOAL
                               </th>
                            </tr>
                            @foreach($orders->orderItems as $items_listing)
                                <tr>
                                   <td style="border-bottom: 1px solid #DDD;  text-align: left;"  valign="middle">
                                        
                                      <strong>{{$items_listing->product_name}}</strong> 
                                      <span>{{$items_listing->variation}}</span>
                                       @if($items_listing->customized_product == 1)
                                      <br>
                                        <div class="">
                                                 <small>Flavor: {{$items_listing->customized_flavor}}</small><br>
                                                <small>Border Color: {{$items_listing->customized_border_color}}, Text Color: {{$items_listing->customized_text_color}}</small><br>
                                                <small>Message: {{$items_listing->customized_message}}</small>
                                            </div>
                                        @endif
                                   </td>
                                   
                                   <td style="border-bottom: 1px solid #DDD;  text-align: center;" valign="middle">
                                       {{getPrice($items_listing->price_amount)}} 
                                   </td>
                                   
                                   <td style="border-bottom: 1px solid #DDD;  text-align: center;" valign="middle">
                                      {{$items_listing->quantity}} 
                                   </td>
                                   
                                   <td style="border-bottom: 1px solid #DDD; text-align: right;" valign="middle">
                                      {{getPrice($items_listing->price_amount * $items_listing->quantity)}}
                                   </td>
                                </tr>
                            @endforeach
                         </table>
                      </div>
                      <p></p>
                      <table class="table table-hover table-striped table-bordered"  align="right">
        				    <tbody class="border-bottom">
        				     <tr>
            		            <td style="text-align:right;">
            				     Subtotal : {{getPrice($orders->subtotal)}}<br/>
            				     @if($orders->shipping_charge > 0)
            				     Shipping Charge : {{getPrice($orders->shipping_charge)}} <br/>
            				     @endif
            				     
            				     @if($orders->tax > 0)
            				     Tax : {{getPrice($orders->tax)}}<br/>
            				     @endif
            				     @if($orders->discount > 0)
            				     Discount: {{getPrice($orders->discount)}}<br/>
            				     @endif
            			         <strong>Grand Total</strong>: {{getPrice($orders->grandtotal)}}<br/>
            			         
            				   </td>
        				    </tr>
        				  
        				    </tbody>
        				</table>
        				
                    
                        
                          <div style="clear:both;float:none;"></div>
                          <table cellpadding="7" cellspacing="0" >
                            <tr>
                		        @if($orders->make_gift == 1)
                			        <td>
                			            <center><big><strong>Greeting Card Message</strong></big></center>
                				        <p class="text-center" style="font-size: 18px;"><i><strong>{{$orders->basket->card_msg}}</strong></i></p>
                			        </td>
                		        @endif
                		    </tr>
                		    <tr>
                		        @if($orders->remarks != NULL)
                			        <td>
                			            <center><big><strong>Order Notes</strong></big></center>
                				        <p class="text-left" style="font-size: 18px;">{{$orders->remarks}}</p>
                			        </td>
                		        @endif
                			</tr>
                			
                          </table>
                    <div style="text-align:center;margin:15px">
                      <a href="http://takeitngo.ca" style="margin:15px auto;padding:7px 10px;border-radius:5px;background-color:#f591c1;color:#fff;opacity:1;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.sweetiepiebakeco.ca/order-inquiry?token%3DcVwPIWp2FXh0tnbjKBPC9yhJbExagfIBxXQWFaXRGSvbF%26invoiceId%3DSWP2310100002%26activatedSession%3D541f5416cb76ff2f1e8b062948f3eac2&amp;source=gmail&amp;ust=1699425167842000&amp;usg=AOvVaw2DCa-fsz1CI-bIj59hq19b">LOGIN TO TNG</a></div>
                     <br>
                      <div style="clear:both;float:none"></div>
                    
                  <div style="clear:both;float:none"></div>
                  <div></div>
               </div>
        </div><!-- Main Area //-->
        <div style="background:#333;height:100px;">
            <div style="padding:5px 10px;color:#FFF;">
                <p style="text-align:center; margin-bottom:5px;"><span style="font-style:italic;">Visit</span>  <a href="https://www.sweetiepiebakeco.ca" style="color:#FFF;">Sweetiepiebakeco.ca</a> | <span style="font-style:italic;">Follow us on</span>  
                
                <a href="https://www.facebook.com/sweetiepiebakeco.ca" style="color:#FFF;"><img src="{{url('assets/images/fb.png')}}" width="14" height="14"></a> <a href="https://www.instagram.com/sweetiepiebakeco.ca/" style="color:#FFF;"><img src="{{url('assets/images/ig.png')}}"  width="14" height="14"></a> 
                <a href="https://www.tiktok.com/@sweetiepiebakeco.ca" style="color:#FFF;"><img src="{{url('assets/images/tt.png')}}" width="14" height="14"></a> </p>
                <p style="text-align:center; margin-top:0px;"><small>If you do not wish to receive any further promotional emails from us, please <a href="#" style="color:#bbb;text-decoration:none;">unsubscribe</a>.</small></p>
            </div>
        </div>
        
    </div>

</body>
</html>