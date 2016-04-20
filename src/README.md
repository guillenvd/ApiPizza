# PIZZAPI With Slim Framework 3 

## Example off ajax with JavasCript

```javascript
$.ajax({
     url:"http://pizzapi.esy.es/services/user/signup",
     dataType: 'jsonp', 
     data:  { name: 'David', 
              address: 'Palmas', 
              zipCode: '24010', 
              phone: '6462236390', 
              email: 'dguilessn@arkusnexus.com', 
              gender: 'M',
              user: 'gulsn', password:'12348'},
     success:function(json){
         console.log(json);
     },
     error:function(){
         alert("Error");
     }      
});
alert(s);
```

## Elments of the requests.
	url: Path of the section for request.
	dataType: Jsonp (For CrossCityRequest).
	data: Parameter for the request.


## The api return a array 
	Status: fail/done	
	code: the code indicate what was happend
	msg: Message of the process
	array: When the api request its a get

## Code list.
| code number| mesage | which indicates|
|------------|:------:|---------------:|


## PATH LIST API METHODS.

###ESTRUCTURE OF THE PATHS
	http://pizzapi.esy.es/services/SECTION/METHOD
### It's needed send the data with the name how its indicate in this readme.

| signupCustomer |  DATA REQUIRED | DATA RETURNED |
|------------|:------:|---------------:|
| user/signup	| name, address, zipCode, phone, email, gender, user, password | |
|	|	| |
|	|	| |
|	|	| |
|	|	| |
|	|	| |
|	|	| |
|	|	| |
|	|	| |
|	|	| |
|	|	| |



