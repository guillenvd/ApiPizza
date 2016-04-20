# PIZZAPI With Slim Framework 3 

## Example of ajax with JavasCript

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
```

## Elements of requests.
	url: Path of the section for request.
	dataType: Jsonp (For CrossCityRequest).
	data: Parameter for the request.

## The api return a array 
	Status: fail/done	
	code: the code indicate what was happend
	msg: Message of the process
	array: When the api request its a get

## Code list.
| code number| mesage | 
|------------|------:|
|'code'=>'10'| create account|
|'code'=>'11'| internal error|
|'code'=>'12'| missings fields|
|'code'=>'13'|This user already exists|
|'code'=>'14'| This email already exists.|
|'code'=>'15'| Login successfully|
|'code'=>'16'| Bad Login|
|'code'=>'17'|update successfully  |
|'code'=>'18'|bad update|

## PATH LIST API METHODS.

### ESTRUCTURE OF THE PATHS
	http://pizzapi.esy.es/services/SECTION/METHOD

### It's needed send the data with the name how its indicate in this readme.

| PATH |  DATA REQUIRED | DATA RETURNED |
|------------|:------:|---------------:|
| user/signup	| name, address, zipCode, phone, email, gender, user, password | 'code'=>'10' , 'code'=>'11' , 'code'=>'12', 'code'=>'13' , 'code'=>'14'|
|	user/login  |	user, password|  'code'=>'15' , 'code'=>'16', array(user, id) |
|	user/update | name, address, zipCode, phone, email, gender, user, password 	| 'code'=>'17', 'code'=>'18'|
|	|	| |
|	|	| |
|	|	| |
|	|	| |
|	|	| |
|	|	| |
|	|	| |
|	|	| |



