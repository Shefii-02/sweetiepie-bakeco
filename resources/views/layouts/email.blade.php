<!DOCTYPE html>
<html>
<head>
  <title>SweetiePieBakeco </title>  
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
                <img width="100" src="{{url('assets/images/email_logo.png')}}"  style="height:auto; margin-top:-3px;border:2px solid #fff;border-radius:50%" alt="SWEETIE PIE - Made with Love" />
            </div>
            <div style="float:right;text-align:right;padding:10px 0;white-space:nowrap;position:absolute; right:10px; top:15px; z-index:25;" class="header-right">
                <img src="http://sweetiepiebakeco.ca/assets/images/ph.png" width="14" height="14"> <a href="tel:+16472453301" style="color:#FFF;font-weight:bold;text-decoration:none;">+1 647-245-3301</a><br/>
                <img src="http://sweetiepiebakeco.ca/assets/images/em.png" width="14" height="14"> <a href="mailto:contact@sweetiepie.ca" style="color:#FFF;font-weight:bold;text-decoration:none;">customerservice@sweetiepiebakeco.ca</a>
            </div>
        </div><!-- Header //-->
        <div style="padding:15px 25px; letter-spacing:0px;min-height: calc(100vh - 215px);clear:both;"><!-- Main Area //-->
        
            @yield('content')
           
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