var total=0;
for(var i=0 ; i<$('.pimage').length;i++){
var x = $('.pimage').get(i);
var val;
$(x).on('click',function(e){
var y = $(e.target).next().children().get(0);
var z = $(e.target).next().children().get(1);
if($(".drink:contains('"+$(y).val()+"')").length !=0){
$(".drink:contains('"+$(y).val()+"')").next()[0].value = parseInt($(".drink:contains('"+$(y).val()+"')").next()[0].value)+1;
 val = parseInt($(".drink:contains('"+$(y).val()+"')").next()[0].value) * $(z).val();
oldVal = val;
$(".drink:contains('"+$(y).val()+"')").next().next().text(val + " EGP");
$('.qty').val(parseInt($(".drink:contains('"+$(y).val()+"')").next()[0].value));
total += parseInt($(z).val());
$('#totalPrice').text(total+" EGP");
$('#hiddenTotal').val(total);
/*
$(".drink:contains('"+$(y).val()+"')").next().on('change',function(){
 val = parseInt($(".drink:contains('"+$(y).val()+"')").next()[0].value) * $(z).val();
$(".drink:contains('"+$(y).val()+"')").next().next().text(val+" EGP");
total += parseInt($(z).val());
$('#totalPrice').text(total+" EGP");

});*/
}else{
$('#notes').before("<label class='drink'>"+$(y).val()+"</label class='control-label'><input type='number' name='"+$(y).val()+"' class='value' value='1' width='20' min='1'/><label class='control-label price'>"+$(z).val()+" EGP</label><br>");
val = parseInt($(".drink:contains('"+$(y).val()+"')").next()[0].value) * $(z).val();
var oldVal = val;
$(".drink:contains('"+$(y).val()+"')").next().next().text(val+" EGP");
$('.qty').val(parseInt($(".drink:contains('"+$(y).val()+"')").next()[0].value));
total += parseInt($(z).val());
$('#totalPrice').text(total+" EGP");
$('#hiddenTotal').val(total);
$(".drink:contains('"+$(y).val()+"')").next().on('change',function(){
val = parseInt($(".drink:contains('"+$(y).val()+"')").next()[0].value) * $(z).val();
 $(".drink:contains('"+$(y).val()+"')").next().next().text(val+" EGP");
 $('.qty').val(parseInt($(".drink:contains('"+$(y).val()+"')").next()[0].value));
 
 if(val > oldVal){
total += parseInt($(z).val());
$('#totalPrice').text(total+" EGP");
$('#hiddenTotal').val(total);
}else if(val == oldVal){
total = parseInt($(z).val());
$('#totalPrice').text(total+" EGP");
$('#hiddenTotal').val(total);
}
else{
total -= parseInt($(z).val());
$('#totalPrice').text(total+" EGP");
$('#hiddenTotal').val(total);
}
});
}
});

}





