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
                  <div>
                     <p style="text-align:center;font-weight:700;font-size:30px;margin-top:10px">Daily Order Reminder</p></div>
                  
                  <table cellpadding="10" cellspacing="0" border="0" align="center" style="margin:15px auto;border:1px solid #ddd;border-radius:10px" width="500">
                        <thead>
                            <tr>
                                <th align="center">Order ID#</th>
                                <th align="center">Location</th>
                                <th align="center">Customer Name</th>
                            </tr>
                        </thead>
                        <tbody> 
                        @foreach($orders as $listing)
                            <tr>
                                <td align="center">{{$listing->invoice_id}}</td> 
                                <td align="center" style="text-transform: capitalize;">
                                    {{$listing->location}}
                                    <br>
                                    <span style="text-transform: capitalize;">({{$listing->order_type}})</span>
                                </td>
                                <td align="center" style="text-transform: capitalize;">{{$listing->customer }}</td>
                            </tr>
                        @endforeach
                          
                        </tbody>
                  </table>
                  <div style="text-align:center;margin:15px">
                      <a href="http://takeitngo.ca" style="margin:15px auto;padding:7px 10px;border-radius:5px;background-color:#f591c1;color:#fff;opacity:1;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.sweetiepiebakeco.ca/order-inquiry?token%3DcVwPIWp2FXh0tnbjKBPC9yhJbExagfIBxXQWFaXRGSvbF%26invoiceId%3DSWP2310100002%26activatedSession%3D541f5416cb76ff2f1e8b062948f3eac2&amp;source=gmail&amp;ust=1699425167842000&amp;usg=AOvVaw2DCa-fsz1CI-bIj59hq19b">LOGIN TO TNG</a></div>
                  
                            <br>
                      <div style="clear:both;float:none"></div>
                      <table cellpadding="7" cellspacing="0">
                        <tbody><tr>
            		        		    </tr>
            		    <tr>
            		        			</tr>
            			
                      </tbody></table>
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