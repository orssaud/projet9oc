
var emailElem = document.getElementById("email");
var accountElem = document.getElementById("account");

emailElem.addEventListener("change", function(){
	check('email', emailElem);
});
accountElem.addEventListener("change", function(){
	check('account', accountElem);
});



var xhr = new XMLHttpRequest();



function check(type, elem){

	var elem = encodeURIComponent(elem.value);

	xhr.open('GET', 'index.php?action=ajax&'+ type +'=' + elem , true);
	xhr.send();
}




xhr.onreadystatechange = function() {

	if (xhr.readyState === 4 && xhr.status === 200) { // wait for end 
			
			var result = xhr.responseText;
			result = JSON.parse(result);

			//get elements for error menu
			ajaxError = document.getElementById('ajaxError');
			ajaxEmail = document.getElementById('ajaxEmail');
			ajaxAccount = document.getElementById('ajaxAccount');


			if (result.id == 'email') {

				if (result.status) {
					
					ajaxEmail.style.display = 'none';
						if (ajaxAccount.style.display == 'none' || ajaxAccount.style.display == '') {
							ajaxError.style.display = 'none';
						}
					
					emailElem.classList.remove("redBorder");
					emailElem.classList.add("greenBorder");
				}else{
					
					ajaxError.style.display = 'block';
					ajaxEmail.style.display = 'block';
					emailElem.classList.remove("greenBorder");
					emailElem.classList.add("redBorder");
				}

			}else if(result.id == 'account'){
				if (result.status) {
					
					ajaxAccount.style.display = 'none';
						if (ajaxEmail.style.display == 'none' || ajaxEmail.style.display == '') {
							ajaxError.style.display = 'none';
						}
					accountElem.classList.remove("redBorder");
					accountElem.classList.add("greenBorder");
				}else{
					
					ajaxError.style.display = 'block';
					ajaxAccount.style.display = 'block';
					accountElem.classList.remove("greenBorder");
					accountElem.classList.add("redBorder");
				}
			}
    }

}
