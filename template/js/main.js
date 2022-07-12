/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

	window.onload = function(){
		let preloader = document.getElementById('preloader');
		preloader.style.display = 'none';
	};


	$('.zal1').on('click', '.free', function(e) 
	{
		var count = $('.bay').length;
		if (count==10)
		{
			alert("Вы можете забронировать не более 10 билетов за один раз!");
			return false;
		}
		$(e.currentTarget).removeClass('free');
		$(e.currentTarget).addClass('bay');
		var ids = $('.title_osob').data().seansid;
		var id = $(this).attr("data-seatid");
			$.post("/cart/addAjax/", {'seat_id':id, 'seans_id': ids}, function (data) {
				//$("#sts").html(data);
				console.log(data);
			});
			showBaySeat();
			return false;
	});

	$('.zal1').on('click', '.bay', function(e) {
		$(e.currentTarget).removeClass('bay');
		$(e.currentTarget).addClass('free');
		var dps;
		var id = $(this).attr("data-seatid");
		$.post("/cart/delAjax/", {'seat_id': id}, function (data) {
			//$("#sts").html(data);
			console.log(data);
		});
		showBaySeat();
		return false;
    });

	$('.tkt').on('click', '.ticket1', function(e) {
		$.each($('.seat.bay'), function(key, item) {
			$(item).removeClass('bay');
			$(item).addClass('free');
		  });
		$.each($('.snip1568'), function(key, item) {
			$('.tkt').html('');
		  });
		$.post("/cart/delAll/", {}, function (data) {
			console.log(data);
		  });
		return false;
    });

	$('.tkt').on('click', '.muss',function(){
		var id = $(this).data().seatid;
		$.each($('.tipok'+id+''), function(key, item) {
			$(item).remove();
		  });

		$.each($('.seat.bay'), function(key, item) {
		    if($(item).data().seatid == id){
				$(item).removeClass('bay');
				$(item).addClass('free');
			}
		  });

		var count = $('.bay').length;
	    if (count == 0)
		{
			$('.tkt').html('');
		}
		$.post("/cart/delAjax/", {'seat_id': id}, function (data) {
			//$("#sts").html(data);
			console.log(data);
		});
		return false;
	  });

	function showBaySeat() {
		let arr_id = [];
		let id = 0;
		result = '';
		price=0;
		//id = $('.title_osob').data().seansid;
		$.each($('.seat.bay'), function(key, item) {
			id = $(item).attr("data-seatid")
			result += '<figure class="snip1568 tipok'+id+'"><figcaption><h3>'+$(item).data().row+' ряд, '+$(item).data().seat+' место, '+$(item).data().sectorname+'</h3><h4>'+$(item).data().price+' рублей</h4><div data-seatid = '+$(item).data().seatid+' class="muss"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-trash itops" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg></div></figcaption></figure>';
			price+=$(item).data().price;
			});

			if(result != '')
			{
				result = result+'<div class = "ticket1">Очистить всё<i class="fa fa-trash-o lolip" aria-hidden="true"></i></div><div class = "ticket">Сумма: ' + price + ' рублей</div><br><a href="/cart" id = "bron" class="btn btn-default add-to-cart"></i>Оформить заказ</a>';
			}
			else
				result = '';

			$('.tkt').html(result);
	}


//comments
$('.cmts').on('click', '#commentform',function(){//используйте id лучше
  //e.pereventDefault();//блокируем действия по умолчанию, чтобы не перезагружать страницу
  var user_id = $('.uid').val();//записываем сюда данные которые хотим передать
  var comment = $('.comm').val().trim();

  var spekt_id = $('.sid').val();
  //var spektid = $(this).attr("data-spekt");
  $.post("/spektakl/addComment", {'user_id':user_id,'comment':comment, 'spekt_id':spekt_id}, function (data) {
	console.log(data);
	var obj = jQuery.parseJSON(data);
	$('.all-comments').prepend('<div class = "one-comment col-10 pipas'+obj.comment_id+'"><h4>'+obj.user_firstname+' '+obj.user_surname+'</h4><span><i class="fa fa-calendar"></i>'+obj.date+'</span><span><i class="fa fa-clock-o">'+obj.time+'</i></span><div data-commentid = '+obj.comment_id+' class="comdel"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-trash itops" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg></div><div class="col-12 text">'+obj.comment_text+'</div></div>');
  });
  $('.comm').val('');
	return false;
});

$('#cmt').on('click', '.comdel',function(){
	var id = $(this).data().commentid;
	$.each($('.pipas'+id+''), function(key, item) {
		$(item).remove();
	  });

	  $.post("/spektakl/delComment", {'commentid':id}, function (data) {
		console.log(data);
	  });
	  return false;
  });

  

  $('.actf').on('click', '#actform',function(){//используйте id лучше
	//e.pereventDefault();//блокируем действия по умолчанию, чтобы не перезагружать страницу
	var pers_id = $('.persid').val();//записываем сюда данные которые хотим передать
	var pos_id = $('.posid').val();
	var role = $('.role').val().trim();
  
	var spekt_id = $('.spekt_id').val();
	//var spektid = $(this).attr("data-spekt");
	$.post("/admin/spektakl/addPersSpekt", {'spekt_id':spekt_id,'pers_id':pers_id, 'pos_id':pos_id, 'role':role}, function (data) {
	  console.log(data);
	  var obj = jQuery.parseJSON(data);
	  $('.actorsadmin').prepend('<div class = "one-comment col-10 pjija diplomzavtra'+spekt_id+'_'+pers_id+'"><h4>'+obj.name+'</h4><span>'+(obj.pos_name).toUpperCase()+'</span><span>, Роль: '+obj.role_spekt+'</i></span><div class="mussar" data-persid = '+pers_id+' data-spektid = '+spekt_id+'>Удалить</div></div><hr>');
	});
	//$('.comm').val('');
	  return false;
  });

  $('.actorsadmin').on('click', '.mussar',function(){
	var pers_id = $(this).data().persid;
	var spekt_id = $(this).data().spektid;
	$.each($('.diplomzavtra'+spekt_id+'_'+pers_id+''), function(key, item) {
		$(item).remove();
	  });

	  console.log(pers_id);
	  console.log(spekt_id);

	  $.post("/admin/spektakl/delPers", {'spektid':spekt_id, 'persid':pers_id}, function (data) {
		console.log(data);
	  });
	  return false;
  });


  

  $('.tatr').on('change', '#chek', function(e){
	var rdata = $(this).attr("data-ticket"); // reading the id of the checkbox through data-id   
	console.log(rdata);
// 	$.ajax({
// 	type: "POST",
//  	url: "admin/seans/ticketAjax",
// 	data: '{eid:'+rdata+'}',
// 	success: function (response) 
// 	{
// 		if (response != 0) 
// 	 	{
//  			alert();
//  		}  
//  	},  
//  	error: function (response) 
//  	{
//  		if (response != 1) 
//  		{
//  			alert("((9");
//  		}  
//  	}  
//  });  
 $.post("/admin/seans/brn", {'eid':rdata}, function (data) {
	console.log(data);
  });
	return false;
});  
