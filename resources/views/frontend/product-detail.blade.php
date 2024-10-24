<html>
    <head>
        <title>Product Detail</title>
    </head>
    <body>
        
            <h1>{{$product->name}}</h1>
            <h3 id="selected-price">{{$product->product_variation->first()->price}}</h3>
            
            <!------------------------images---->
               
                @foreach($variation_images as $key => $keys) 
                    @php
                        $keys = $keys->where('type','<>','Nutritional Facts');                              
                    @endphp
                    <div class="slider_{{$key}} slider_images" style="display:none">
                        @foreach($keys as $images_src)
                            <img src="{{asset('images/products/'.$images_src->picture)}}" width="50">
                        @endforeach
                    </div>
                @endforeach
            <!------------------------images---->
            <ul>
                @foreach($options as $optionkey=>$option)
                    <li>{{$optionkey}}
                        <ul class="options">
                        @foreach($option as $subkey=>$suboption)
                            <li><label><input class="option" type="radio" name="{{$optionkey}}" value="{{$subkey}}"  data-variation-ids="{{implode(',',$suboption)}}" data-attr="{{$optionkey.':'.$subkey}}">{{$subkey}}</label></li>
                        @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
            
             <!--<----------------------images---->
            @foreach($variation_images as $key => $keys) 
                    @php
                        $keys = $keys->where('type','Nutritional Facts');                              
                    @endphp
                    <div class="nutri_{{$key}} nutri_images" style="display:none">
                        @foreach($keys as $images_src)
                            <img src="{{asset('images/products/'.$images_src->picture)}}" width="50">
                        @endforeach
                    </div>
                @endforeach
             <!--<----------------------images---->
             
            @foreach($product->product_variation as $variation)
                <input type="hidden" id="{{$variation->id}}" value="{{$variation->price}}" />
            @endforeach
            
            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
            <script>
                
                $(document).ready(function(){
                    $(".options").each(function(){
                        $(this).find(".option").first().attr("checked","checked");
                    });
                    
                    function selectVariant() {
                        var choosen_vars = [];
                        $('.slider_images, .nutri_images').hide();
                        
                        $(".options").each(function(){
                            $(this).find(".option").each(function(){
                                if($(this).is(":checked")) {
                                    var vars = $(this).attr("data-variation-ids");
                                    choosen_vars.push(vars.split(","));
                                }
                            })
                        });
                        
                        var final = choosen_vars[0];
                        
                        for(i=1;i<choosen_vars.length;i++) {
                            var final = $(final).filter(choosen_vars[i]);
                            
                        }
                        
                        var idClicked =  final[0];
                        var price = $("#"+idClicked).val();
                        console.log(idClicked);
                        console.log(price);
                        
                        $("#selected-price").html(price)
                        $('.slider_'+idClicked).show();
                        $('.nutri_'+idClicked).show();


                    }
                    
                    $(".option").click(function(){
                        selectVariant();
                    })
                    
                    selectVariant();
                    
                    
                })
                
            </script>
            
    </body>
</html>