$(function(){
		function getCancelOrder(){
			var url = "../controller/cancel_server.php";
			$.ajax({
			url:url,
			method:'post',
			data:{
			},
			success:function(response){
				$('.container[id='+response.oid+']').hide();
				getCancelOrder();
			},
			error:function(err,status,error){
				console.log(error);
			},
			complete:function(complete){
			},
			dataType:'json'
		});

	}
	getCancelOrder();
});