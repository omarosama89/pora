$(function(){
	function getDeliverdOrder(){
		var url = "../controller/deliver_server.php";
		$.ajax({
			url:url,
			method:'post',
			data:{
			},
			success:function(response){
				console.log(response);
				// $('td[id='+response.oid+']').text("Out For Delivery");
				getDeliverdOrder();
			},
			error:function(err,status,error){
				console.log(error);
			},
			complete:function(complete){
				console.log("complete");
			},
			dataType:'json'
		});

	}
	getDeliverdOrder();
});