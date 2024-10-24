 $(document).ready(function() {
            // Initialize the Autocomplete functionality for all forms
            $('.address_fill').each(function() {
                var addressInput = $(this);
                var parentForm = addressInput.closest('.address-form'); // Find the closest parent form

                var cityInput = parentForm.find('.city_fill');
                var provinceInput = parentForm.find('.province_fill');
                var postalCodeInput = parentForm.find('.postalCode_fill');

                var options = {
                    types: ['geocode'],  // Restrict results to geographic locations
                    componentRestrictions: { country: 'CA' }  // Restrict to Canada
                };

                var autocomplete = new google.maps.places.Autocomplete(addressInput[0], options);

                autocomplete.addListener('place_changed', function() {
                    var place = autocomplete.getPlace();
                    if (!place.geometry) {
                        console.log("No details available for input: '" + place.name + "'");
                        return;
                    }

                    var postalCode, city, province;
                    for (var i = 0; i < place.address_components.length; i++) {
                        var component = place.address_components[i];
                        if (component.types.includes('locality')) {
                            city = component.long_name;
                        } else if (component.types.includes('administrative_area_level_1')) {
                            province = component.long_name;
                        } else if (component.types.includes('postal_code')) {
                            postalCode = component.long_name;
                        }
                    }

                    addressInput.val(place.name || '');
                    cityInput.val(city || '');
                    provinceInput.val(province || '');
                    postalCodeInput.val(postalCode || '');
                });
            });



            // Postal code input change event for all forms
            $('.postalCode_fill').on('input', function() {
                var postalCodeInput = $(this);
                var parentForm = postalCodeInput.closest('.address-form');
                var cityInput = parentForm.find('.city_fill');
                var provinceInput = parentForm.find('.province_fill');

                var postalCode = postalCodeInput.val().replace(/\s/g, ''); // Remove spaces
                if (postalCode.length >= 6) {
                    retrieveCityAndProvince(postalCode, cityInput, provinceInput);
                }
            });
            
            $('.postalCode_fill_delivery').on('blur', function() {
                $('.s_postalError').text('')
                 var postalCodeInput = $(this);
                 var s_city = $('#s_city').val();
                 var postalCode = postalCodeInput.val().replace(/\s/g, ''); // Remove spaces
                 
                  if (postalCode.length >= 6) {
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ 'address': postalCode, 'region': 'CA' }, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            var addressComponents = results[0].address_components;
                            var city, province;
    
                            for (var i = 0; i < addressComponents.length; i++) {
                                var component = addressComponents[i];
                                if (component.types.includes('locality')) {
                                    city = component.long_name;
                                } else if (component.types.includes('administrative_area_level_1')) {
                                    province = component.long_name;
                                }
                            }
        
                            console.log(city,province)
                            if(s_city != city){
                                 

                                $('.s_postalError').html('<span class="fw-bold">'+postalCode +'</span> is not a '+city+' postalcode.')
                                $('#s_postal').val('');
                            }
    
                        } else {
                            console.error('Postal code not valid ' + status);
                           $('.s_postalError').html('this postal code <span class="fw-bold">"'+ postalCode +'"</span> is not valid')
                           $('#s_postal').val('');
                        }
                    });
                  }
                  else{
                      $('.s_postalError').text('enter valid postal code')
                  }
                    
                 
            });

            function retrieveCityAndProvince(postalCode, cityInput, provinceInput) {
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'address': postalCode, 'region': 'CA' }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        var addressComponents = results[0].address_components;
                        var city, province;

                        for (var i = 0; i < addressComponents.length; i++) {
                            var component = addressComponents[i];
                            if (component.types.includes('locality')) {
                                city = component.long_name;
                            } else if (component.types.includes('administrative_area_level_1')) {
                                province = component.long_name;
                            }
                        }

                        cityInput.val(city || '');
                        provinceInput.val(province || '');
                    } else {
                        console.error('Postal code not valid ' + status);
                        cityInput.val('');
                        provinceInput.val('');
                    }
                });
            }
        });