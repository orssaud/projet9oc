
				

var engine = {
	block: null,
	speed: 3,
	speedMax: 6,
	jumpHeight: 15, //not in sizeSpeed
	jumpSpeed: 12,
	gravity: 6,
	walljumpSpeed: 10,
	walljumpDuration: 12, //not in sizeSpeed
	startx: 55,
	starty: 115,
	playerElement: null,
	minHeightWallJump: 6,   // 1 for every where 
	walljumpSapce: 15,
 	player: {
 		x: null, 
		y: null, 
		width: null, 
		height: null, 
		jump: false, 
		jumpFrame: 0, 
		wallJumpRight: false,
		wallJumpLeft: false, 
		currentSpeed: 0,
		jumpFrameLeft: 0,
		jumpFrameRight: 0
	},
	controller: {
		up: false,
		right: false,
		left: false,
		down: false,
	},

// fps limit
fps: 50,
now:0,
then: Date.now(),
interval: 0,
delta:0,

//save
//if save is not null we are in create mode
save: null,
pause:false,
buttonReplay: null,
				

	constructor: function(save = null){
		this.save = save;
		this.sizeSpeed();
		this.block = document.getElementsByClassName("block");
		this.playerElement = document.getElementById('player');
		this.player.x = this.playerElement.offsetLeft;
		this.player.y = this.playerElement.offsetTop;
		this.player.width = this.playerElement.offsetWidth;
		this.player.height = this.playerElement.offsetHeight;
		this.player.currentSpeed = this.speed;
		this.interval = 1000/this.fps;
		this.first = this.then;
		window.addEventListener("keydown", function (event) { this.keyController(event)}.bind(this));
		window.addEventListener("keyup", function (event) { this.keyController(event)}.bind(this));
		
		this.buttonReplay = document.getElementById('replay');
		this.buttonReplay.addEventListener("click", this.replay.bind(this));

		this.reset();
		this.loop();
	},

	restart: function() {
		this.sizeSpeed();
		this.block = document.getElementsByClassName("block");
		this.playerElement = document.getElementById('player');
		this.player.x = this.playerElement.offsetLeft;
		this.player.y = this.playerElement.offsetTop;
		this.player.width = this.playerElement.offsetWidth;
		this.player.height = this.playerElement.offsetHeight;
		this.reset();
		this.endPause();
	
	},

	sizeSpeed: function(){
		var grid = document.getElementById('grid');
		var gridWidth = grid.offsetWidth;
		var gridHeight = grid.offsetHeight;

		this.walljumpSapce = Math.round(gridWidth/100);

		this.speed = 3 * (gridWidth / 422);
		this.speedMax = 4 * (gridWidth / 422);

		this.gravity = 2.5*(gridHeight /256);

		this.jumpSpeed = 7*(gridHeight /256);

		this.walljumpSpeed = 5*(gridWidth /422);

	},


	colider: function(player, nx=0, ny=0, move=true, block = this.block){

		
		for (var i = 0; i < block.length; i++) {
		
				var rect1 = {x: block[i].offsetLeft, y: block[i].offsetTop, width: block[i].offsetWidth, height: block[i].offsetHeight}

					
					if (rect1.x < (player.x+nx) + player.width &&
					   rect1.x + rect1.width > (player.x+nx) &&
					   rect1.y < (player.y+ny) + player.height &&
					   rect1.height + rect1.y > (player.y+ny)) {
								    	
							for (var i2 = 0; i2 < block[i].classList.length; i2++) {
								if(block[i].classList[i2] == 'end' && move == true){
									//win
									this.startPause();
									if (this.save !== null) { //we are in create mode
										
										if (this.save.getWin()) { //we can save 
											
											this.saveScreen();
										}else{ // need to replay the lvl for save, without any modification
											
											this.replayForSaveScreen();
										}
									}else{ // we are in play mode, and we win
										
										this.winScreen();
									}

								// this.reset();
									 this.controller.up = false;
									 this.controller.down = false;
									 this.controller.right = false;
									 this.controller.left = false;
									
									
									//end
								}else if(block[i].classList[i2] == 'damage' && move == true){
									//reset
									this.killPlayer(player.x, player.y);
									this.reset();
									//damage
								}

							}

						return false;
					}

			}

			if (move) {
				this.player.x += nx;
				this.player.y += ny;
				this.playerElement.style.left = this.player.x + 'px';
				this.playerElement.style.top = this.player.y + 'px';

			}


		//no collision
		return true;

	},

	keyController: function(event){

		if (event.type == "keydown") {
			if (event.keyCode == 38 || event.keyCode == 90 ) { //arrow up or z
				this.controller.up = true;
			}
			if (event.keyCode == 39 || event.keyCode == 68) { //arrow right or d
				this.controller.right = true;
			}
			if (event.keyCode == 37 || event.keyCode == 81 ) { //arrow left or q
				this.controller.left = true;
			}
			if (event.keyCode == 40 || event.keyCode == 83) { //arrow down or s
				this.controller.down = true;
			}
			if (event.keyCode == 82) { //r
				this.reset();
			}
			if (event.keyCode == 80) { //r
				this.startPause();
			}
		}
		if (event.type == "keyup") {
			if (event.keyCode == 38 || event.keyCode == 90 ) { //arrow up or z
				this.controller.up = false;
			}
			if (event.keyCode == 39 || event.keyCode == 68) { //arrow right or d
				this.controller.right = false;
			}
			if (event.keyCode == 37 || event.keyCode == 81 ) { //arrow left or q
				this.controller.left = false;
			}
			if (event.keyCode == 40 || event.keyCode == 83) { //arrow down or s
				this.controller.down = false;
			}
			if (event.keyCode == 80) { //r
				this.endPause();
			}
		}
	},

	reset: function(){
		if (this.save !== null) {
			this.save.getReset();
		}
		// reset movement
		this.player.jump = true;
		this.player.currentSpeed = this.speed;
		this.player.jumpFrame = 0;
		this.player.jumpFrameLeft = 0;
		this.player.jumpFrameRight = 0;


		var start = document.getElementById('start');
			if (start) {
				this.player.x = start.offsetLeft + ( start.offsetWidth/2 ) - (this.player.width / 2);
				this.player.y = start.offsetTop + ( start.offsetHeight/2 ) - (this.player.height/2);
				this.playerElement.style.left = this.player.x + 'px';
				this.playerElement.style.top = this.player.y + 'px';
			}else{
				this.playerElement.style.left = '5%';
				this.playerElement.style.top = '20%';
				this.player.x = this.playerElement.offsetLeft;
				this.player.y = this.playerElement.offsetTop;
			}

			this.endPause();
	},

	killPlayer: function(x,y){

		        var elem = document.createElement('div');
		       
		        document.getElementById('grid').appendChild(elem);
		        elem.classList.add("despawn");
		       
		        elem.style.left = x + 'px';
				elem.style.top = y+ 'px';

				setTimeout(function () {
				  elem.parentNode.removeChild(elem);
				}, 1000);
	},

	startPause: function(){
		this.pause = true;

	},
	endPause: function(){
		this.pause = false;
		this.loop();
	},


/*__________________________


		end screen

__________________________*/

winScreen: function(){
	document.getElementById('winScreen').style.display = 'block';
},
saveScreen: function(){
	document.getElementById('save').style.display = 'inline-block';
	document.getElementById('saveScreen').style.display = 'block';
},
replayForSaveScreen: function(){
	document.getElementById('save').style.display = 'none';
	document.getElementById('saveScreen').style.display = 'block';
},


replay: function(){
	if (screen = document.getElementById('winScreen')) {
		screen.style.display = 'none';
	}else if(screen = document.getElementById('saveScreen')){
		screen.style.display = 'none';
	}
	
	
	this.reset();
},
/*__________________________


			LOOP

__________________________*/

	loop: function(){
		//console.log(this.pause);
	//limit fps
	this.now = Date.now();
	this.delta = this.now - this.then;
	
	if (this.delta > this.interval) {
		this.then = this.now - (this.delta % this.interval);




			 if (this.controller.up && this.player.jump == false) { //arrow up or z
			 	if (this.player.jumpFrame == 0) {
			 		this.player.jumpFrame = this.jumpHeight; 
			 		this.player.jump = true;
			 	}




			
			 }

			 if (this.controller.right) { //arrow right or d

			 	for (var i = 0; i < this.player.currentSpeed; i++) {
			 		this.colider(this.player,1,0);
			 	}

			 	//wall jump left to right
			 	 if (this.controller.up  && this.player.jump /*&& !this.player.wallJumpLeft */&&  this.jumpHeight/this.minHeightWallJump > this.player.jumpFrame) {
			 	 	
				 	if (!this.colider(this.player,-this.walljumpSapce,0,false)) {
				 			
				 			this.player.wallJumpRight = false;
						this.player.jumpFrameRight = 0;
				 		this.player.wallJumpLeft = true;
				 		this.player.jumpFrameLeft = this.walljumpDuration; 
				 	}

			 	 }
			 	
			 }

			 if (this.controller.left ) { //arrow left or q
			 	
			 	for (var i = 0; i < this.player.currentSpeed; i++) {

			 		this.colider(this.player,-1,0);

			 	}

			 	//wall jump right to left
				 if (this.controller.up && this.player.jump/* && !this.player.wallJumpright*/ &&  this.jumpHeight/this.minHeightWallJump > this.player.jumpFrame) {

					 	if (!this.colider(this.player,this.walljumpSapce,0,false)) {

						this.player.wallJumpLeft = false;
						this.player.jumpFrameLeft = 0;
					 		this.player.wallJumpRight = true;
					 		this.player.jumpFrameRight = this.walljumpDuration; 
					 		
					 	}

				 }
			 	
			 }








		if (!this.player.jump) {
			if (this.player.currentSpeed < this.speedMax && (this.controller.right || this.controller.left)) {
				this.player.currentSpeed +=1 * 0.1;
			}
		}else{
			if (this.player.currentSpeed > this.speed ) {
				this.player.currentSpeed -=1 *0.02;
			}
		}
		if  (!this.controller.right && !this.controller.left) {
			if (this.player.currentSpeed > this.speed ) {
				this.player.currentSpeed = this.speed;
			}
		}

// test mode
		/*document.getElementById("numbers").innerHTML = "gravity : " + this.gravity +"<br>jump : " + this.player.jump+ "<br>walljump left : " + this.player.wallJumpLeft + "<br>walljump right : " + this.player.wallJumpRight + "<br>speed : " + this.player.currentSpeed + "<br> x : " + this.player.x + "<br> y : " + this.player.y 
		+ '<br> z : '  + this.controller.up 
		+ '<br> d : '  + this.controller.right
		+ '<br> q : '  + this.controller.left
		+ '<br> s : '  + this.controller.down; */



		/*__________________________________

				wall jump left
		__________________________________*/


		//jump by frame walljump
			
			if (this.player.jumpFrameLeft != 0) {
				 	
			 	for (var i = 0; i < this.walljumpSpeed; i++) { 

					if (!this.colider(this.player,1,-1)) {
						this.player.wallJumpLeft = false;
						this.player.jumpFrameLeft = 1;
				 		break;
				 	}

			 	}

			 	this.player.jumpFrameLeft -= 1;

			}

		/*__________________________________

				wall jump right
		__________________________________*/


		//jump by frame walljump
			
			if (this.player.jumpFrameRight != 0) {
			 	for (var i = 0; i < this.walljumpSpeed; i++) { 


					if (!this.colider(this.player,-1,-1)) {
						this.player.wallJumpRight = false;
						this.player.jumpFrameRight = 1;
				 		break;
				 	}

			 	}

			 	this.player.jumpFrameRight -= 1;

			}


		//jump by frame
			
			if (this.player.jumpFrame != 0 ) {
			 	for (var i = 0; i < this.jumpSpeed; i++) { 

					if (!this.colider(this.player,0,-1)) {
						this.player.jumpFrame = 1;
				 		break;
						
				 	}


			 	}

			 	this.player.jumpFrame -= 1;

			}




		//gravity by frame

		for (var i = 0; i < this.gravity; i++) {

			 	if (this.colider(this.player,0,1)) {
			 		this.player.jump = true;
			 		
			 	}else{
			 		this.player.jump = false;
			 		this.player.wallJumpLeft = false;
			 		this.player.wallJumpRight = false;
			 	}
		}

	 	
	
	
		
		//if player drop out of grid
		if ((this.player.y) >  document.getElementById('grid').offsetHeight) {
			
			this.restart();
		}	
	}

if (!this.pause) {

	window.requestAnimationFrame(this.loop.bind(this));
}

		
	}

}