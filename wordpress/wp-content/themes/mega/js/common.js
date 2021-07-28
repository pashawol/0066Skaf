
(function ($) {
	const span = document.querySelector(".sPromocode__link");

	if ( span) {

		// span.onclick = function (event) {
		// 	event.preventDefault();
		// 	document.execCommand("copy");
		// 	console.log(1);
		// }
		
		span.addEventListener("click", function (event) {
			event.preventDefault();
			myFunction(); 
		});


		function myFunction() {
			/* Get the text field */
			var copyText = document.querySelector(".promo-text");

			/* Select the text field */
			copyText.select();

			/* Copy the text inside the text field */
			document.execCommand("copy");

			/* Alert the copied text */
			$(".tooltiptext").text("Copied the text: " + copyText.value);
		}
	}

 

	$(".toggle-menu-mobile--js, .body-before").click(function(){
		$(this).toggleClass('on')
		$(this).toggleClass('active')
		document.querySelector(".menu-mobile--js").classList.toggle('active')
		document.body.classList.toggle('fixed')
	})

	$(".toggle-el").click(function(){
		console.log(1);
		$(this).next().slideToggle();
	})

})(jQuery);

