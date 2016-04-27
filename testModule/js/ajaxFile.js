var ajaxFile = {
		path:'',
		init:function(){ 
			$('#Action').empty(); $('#sendAjax').hide();
			$('#titleBig').empty().text('Select an option');
			$('#dropdown3, #dropdown2, #dropdown1').click(function(){
				$('#load').show();
			});
		},
		login:function(){
			this.path = 'user/login';
			$('#titleBig').empty().text('Enter the next Fields:');
			$('#sendAjax').show(); 
			$( "#Action" ).load( "modules/login.html", function(){
				$('#load').hide();
			});
			$('#sendAjax').off('click').click(function(){
					if( $('#UserName').val() && $('#Password').val()){
						ajaxFile.ajaxRequest({user:$('#UserName').val() , password:$('#Password').val() })
					}else{
						 Materialize.toast('You are missing some fields', 4000) 
					}

			});
		},
		signup:function(){
			this.path = 'user/signup';
			$('#titleBig').empty().text('Enter the next Fields:');
			$('#sendAjax').show(); 
			$( "#Action" ).load( "modules/signup.html", function(){
				$('#load').hide();
			});
			setTimeout(function(){$('select').material_select();},100)
			$('#sendAjax').off('click').click(function(){
				if( $('#FullName').val() && $('#Address').val()&& $('#zipCode').val()&& $('#Phone').val()&& $('#Email').val()&& $('#Gender').val()&& $('#Username').val()&& $('#Password').val() ){
					ajaxFile.ajaxRequest({name:$('#FullName').val(), address:$('#Address').val(), zipCode:$('#zipCode').val(), phone:$('#Phone').val(), email:$('#Email').val(), gender:$('#Gender').val(), user:$('#Username').val(), password:$('#Password').val()})
				}else{
					 Materialize.toast('You are missing some fields', 4000) 
				}
			});
		}, 
		updateUser:function(){
			this.path = 'user/update';
			$('#titleBig').empty().text('Enter the next Fields (username is the identifier):');
			$('#sendAjax').show(); 
			$( "#Action" ).load( "modules/updateUser.html", function(){
				$('#load').hide();
			});
			setTimeout(function(){$('select').material_select();},100)
			$('#sendAjax').off('click').click(function(){
				if( $('#FullName').val() && $('#Address').val()&& $('#zipCode').val()&& $('#Phone').val()&& $('#Email').val()&& $('#Gender').val()&& $('#Username').val()&& $('#Password').val() ){
					ajaxFile.ajaxRequest({name:$('#FullName').val(), address:$('#Address').val(), zipCode:$('#zipCode').val(), phone:$('#Phone').val(), email:$('#Email').val(), gender:$('#Gender').val(), user:$('#Username').val(), password:$('#Password').val()})
				}else{
					 Materialize.toast('You are missing some fields', 4000) 
				}
			});
		},
		getUserData:function(){
			this.path = 'user/getUserData';
			$('#titleBig').empty().text('Enter the next Fields:');
			$('#sendAjax').show(); 
			$( "#Action" ).load( "modules/getUserData.html", function(){
				$('#load').hide();
			});
			$('#sendAjax').off('click').click(function(){
				if( $('#username').val()){
					ajaxFile.ajaxRequest({username:$('#username').val()})
				}else{
					 Materialize.toast('You are missing some fields', 4000) 
				}
			});
		},
		getProducts:function(){
			this.path = 'products/getProducts';
			$('#titleBig').empty().text('Get products by category:');
			$('#sendAjax').show(); 
			$( "#Action" ).load( "modules/getProductsCategory.html", function(){
				$('#load').hide();
			});
			$('#sendAjax').off('click').click(function(){
				if( $('#Category').val()){
					ajaxFile.ajaxRequest({category:$('#Category').val()})
				}else{
					 Materialize.toast('You are missing some fields', 4000) 
				}
			});
		},
		makeOrder:function(){
			this.path = 'products/makeOrder';
			$('#titleBig').empty().text('Get products by category:');
			$('#sendAjax').show(); 
			$( "#Action" ).load( "modules/makeOrder.html", function(){
				$('#load').hide();
			});
			setTimeout(function(){$('.datepicker').pickadate({selectMonths: true, selectYears: 15  });},100)
			$('#sendAjax').off('click').click(function(){
				if( $('#order_date').val()&& $('#total_price').val()&& $('#customer_id').val()&& $('#order_distance').val()&& $('#product_id').val() && $('#quantity').val()&& $('#Description').val() ){
					ajaxFile.ajaxRequest({'total_price':$('#total_price').val(),'order_date':$('#order_date').val(), 'customer_id':$('#customer_id').val(), 'order_distance':$('#order_distance').val(), 'product_id':$('#product_id').val(), 'quantity':$('#quantity').val(), 'description':$('#Description').val()})
				}else{
					 Materialize.toast('You are missing some fields', 4000) 
				}
			});
		},		
		orderById:function(){
			this.path = 'order/orderById';
			$('#titleBig').empty().text('Get products by i:');
			$('#sendAjax').show(); 
			$( "#Action" ).load( "modules/orderById.html", function(){
				$('#load').hide();
			});
			$('#sendAjax').off('click').click(function(){
				if( $('#orderId').val()){
					ajaxFile.ajaxRequest({'orderId':$('#orderId').val()})
				}else{
					 Materialize.toast('You are missing some fields', 4000) 
				}
			});
		},	
		orderByCustomer:function(){
			this.path = 'order/orderByCustomer';
			$('#titleBig').empty().text('Get products by category:');
			$('#sendAjax').show(); 
			$( "#Action" ).load( "modules/orderByCustomer.html", function(){
				$('#load').hide();
			});
			$('#sendAjax').off('click').click(function(){
				if( $('#customerId').val()){
					ajaxFile.ajaxRequest({'customerId':$('#customerId').val()})
				}else{
					 Materialize.toast('You are missing some fields', 4000) 
				}
			});
		},
		countOrders:function(){
			this.path = 'order/countOrders';
			$('#titleBig').empty().text('Get products by category:');
			$('#sendAjax').show(); 
			$( "#Action" ).load( "modules/countOrders.html", function(){
				$('#load').hide();
			});
			$('#sendAjax').off('click').click(function(){
				if( $('#customerId').val()){
					ajaxFile.ajaxRequest({'customerId':$('#customerId').val()})
				}else{
					 Materialize.toast('You are missing some fields', 4000) 
				}
			});
		},
		ajaxRequest:function(data){
			console.log(data);
			console.log(this.path);
			var dataString = this.stringAjax.replace("path", this.path);
			$('#results').html(dataString.replace("dataArray", JSON.stringify(data)));
			$.ajax({
			     url:"http://pizzapi.esy.es/services/"+this.path,
			     dataType: 'jsonp',
			     beforeSend: function(  ) {
			     	$('#load').show();
			     }, 
			     data: data,
			     success:function(json){
			       	$('#Ajax').text(JSON.stringify(json));//conver object to string
			     	$('#load').hide();

			     },
			     error:function(){
			         alert("Error");
			     }      
			});
		},
		stringAjax: '$.ajax({<br>'
			     +'url:"http://pizzapi.esy.es/services/path",<br>'
			     +'dataType: "jsonp", <br>'
			     +'data: dataArray,<br>'
			     +'success:function(json){<br>'
			       	+'console.log(json);<br>'
			     +'},<br>'
			     +'error:function(){<br>'
			        +'alert("Error");<br>'
			     +'}<br>'
			+'});<br>'
};