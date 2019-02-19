document.getElementById('info').addEventListener("click", function() {	
	infoShow();
});

document.getElementById('infoPopup').addEventListener("click", function() {	
	infoHide();	
});


function infoShow(){
	
	document.getElementById('infoPopup').style.display = "block";

}

function infoHide(){

	document.getElementById('infoPopup').style.display = "none";

}