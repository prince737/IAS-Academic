$( function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: '1990:2017',
			altField: "#datepicker",
			altFormat: "yy-mm-dd",
		});
	} );
	
	//INput field validations
	
	/*$('#name').on('blur', function(){
		if(!this.value.match(/^[A-Za-z]*\s{1}[A-Za-z]*$/))
		{
			$('#error_name').html('Please provide a valid name.').css('color', '#D32F2F').css('padding-top','10px').css('font-size','16px');
			 $(this).focus(); 
			return false;
		} 
        $('#error_name').html('');           
        
	});	

	$('#gname').on('blur', function(){
		if(!this.value.match(/^[A-Za-z]*\s{1}[A-Za-z]*$/))
		{
			$('#error_gname').html('Please provide a valid name.').css('color', '#D32F2F').css('padding-top','10px').css('font-size','16px');
			 $(this).focus(); 
			return false;
		} 
        $('#error_gname').html('');           
        
	});	

	$('#contact').on('blur', function(){
		if(!this.value.match(/^[0-9]{10}$/))
		{
			$('#error_contact').html('Please provide a valid Contact Number.').css('color', '#D32F2F').css('padding-top','10px').css('font-size','16px');
			 $(this).focus(); 
			return false;
		} 
        $('#error_contact').html('');           
        
	});	

	$('#gcontact').on('blur', function(){
		if(!this.value.match(/^[0-9]{10}$/))
		{
			$('#error_gcontact').html('Please provide a valid Contact Number.').css('color', '#D32F2F').css('padding-top','10px').css('font-size','16px');
			 $(this).focus(); 
			return false;
		} 
        $('#error_gcontact').html('');           
        
	});		
	
	$('#email').on('blur', function(){
		if(!this.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/))
		{
			$('#error_email').html('Please provide a valid email address.').css('color', '#D32F2F').css('padding-top','10px').css('font-size','16px');
			 $(this).focus(); 
			return false;
		} 
        $('#error_email').html('');           
        
	});	
	
	
	
	
    //Confirm Password Validation
            
        $('#pwd,#cpwd').on('keyup', function () {
        if ($('#pwd').val() == $('#cpwd').val()) {
            $('#message').html('').css('color', '#5fcf80');
            $('#register').prop('disabled',false);
        } else{
            $('#message').html('Passwords do not Match. Sign Up Disabled.').css('color', '#D32F2F');
            $('#register').prop('disabled',true);
        }
        });  

		$('#pwd').on('blur', function(){
		if(this.value.length < 8){
			$('#message1').html('Passwords must be atleast 8 characters long.').css('color', '#D32F2F');
			$(this).focus(); 
			return false;
		} else{
            $('#message1').html('');           
        }
		});			
		
		
		//Imge validation
		
		/*$(document).ready(function(){  
        $('#register').click(function(){  
            var extension = $('#img').val().split('.').pop().toLowerCase();  
            if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)  
            {  
                 $('#error_image').html('Please provide a proper image file .').css('color', '#D32F2F').css('padding-top','10px').css('font-size','16px');
                $('#img').val('');  
                return false;  
            }  
             
        });  
        });  */
		
		
		