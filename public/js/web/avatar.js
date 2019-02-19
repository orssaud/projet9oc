
var avatar = document.getElementById('imgAvatar');
var myInput = document.getElementById('file');
var downloadButton = document.getElementById('downloadButton');
var menu = document.getElementById('menuAvatar');


var saveImg = avatar.src;


document.getElementById('cancel').addEventListener("click", function(event) {
	event.preventDefault();
	defaultImg();
});


	
function defaultImg(){
	menu.style.display = 'none';
	avatar.src = saveImg;
}

myInput.addEventListener("mouseover", function(event) {
	downloadButton.style.display = "block";
});

myInput.addEventListener("mouseout", function(event) {
downloadButton.style.display = "none";
});


	myInput.addEventListener("change", previewFile);


   function previewFile(){
    
       var menuAvatarError = document.getElementById('menuAvatarError');
       var errorAvatar = document.getElementById('errorAvatar');
       var file    = document.getElementById('file').files[0]; //sames as here
       var reader  = new FileReader();



       reader.onloadend = function () {
       

		var errors = Array();
		if (file.size > 2097152) {//2mo
			errors.push("Le fichier est trop volumineux. (max 2Mo)");
			defaultImg();
		}

		if(!(file.type == 'image/png' || file.type == 'image/jpeg')){
			errors.push("Le format du fichier n'est pas bon. (jpeg, jpg ou png)");
			console.log('bad format');
			console.log(file.type);
			defaultImg();
		}
	

		if(errors.length == 0){
			 avatar.src = reader.result;
			menu.style.display = 'block';


			menuAvatarError.style.display = 'none'
				
					errorAvatar.innerHTML="";
		}else{
					console.log(errors);
					menuAvatarError.style.display = 'block'
					var error = '';
					for (var i = 0; i < errors.length; i++) {
						error += errors[i] + '<br>' ;

					}
					errorAvatar.innerHTML =  error ;
		}
       console.log(file);
       console.log(file.size);
       console.log(file.type);
       }

       if (file) {
           reader.readAsDataURL(file); //reads the data as a URL
       }
  }