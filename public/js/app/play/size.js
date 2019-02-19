var size = {
	engine:null,
	grid: null,
	player: null,
	block: null,
	start: null,
	
	margin:20, //default 20
	screenWidth:null,
	screenHeight:null,

	offsetTop: 10, // default value 10
	offsetLeft: 10, // default value 10
	

	constructor: function(engine){
		this.engine=engine;

		this.grid = document.getElementById('grid');
		this.player = document.getElementById('player');
		this.block = document.getElementsByClassName("block");
		this.start = document.getElementById("start");
		
		this.screenWidth = window.innerWidth;
		this.screenHeight = window.innerHeight;

		this.checkWidth();
		this.reSize();

	},

	reSize: function() {

	//get nav size
		var nav = document.getElementById('nav').clientHeight ;
		var mobile = document.getElementById('mobile').clientHeight ;
		nav = mobile + nav;

		var offsetTop = this.offsetTop + nav;

	//add margin for top and left
		this.grid.style.top = offsetTop + "px";
		this.grid.style.left = this.offsetLeft + "px";

		var wHeight = window.innerHeight - offsetTop;
		var wWidth = window.innerWidth - this.offsetLeft;

	// clear new BLock
		if (newBlock = document.getElementById("newBlock")) {
			newBlock.parentNode.removeChild(newBlock);
		}

	//grid
		if (wWidth*9/16 >= wHeight) {

			this.grid.style.height = wHeight - this.margin + 'px';
			this.grid.style.width = wHeight/9*16 - this.margin + 'px';



		}else{

			this.grid.style.width = wWidth - this.margin + 'px';
			this.grid.style.height = wWidth*9/16 - this.margin + 'px';

		}



		
			var left = wWidth - (parseInt(this.grid.style.width)- this.margin/2 );
			this.grid.style.left = (left/2) + "px";
		


		var top = wHeight - (parseInt(this.grid.style.height)- this.margin/2 );
		this.grid.style.top = (top/2) + nav + "px";
	
		//player
		this.player.style.height =  Math.round(this.grid.offsetHeight/18)-1 + 'px';
		this.player.style.width =  Math.round(this.grid.offsetHeight/18)-1 + 'px';

		//blocks
		for (var i = 0; i < this.block.length; i++) {
			if (!this.block[i].classList.contains('border-grid')) {

					this.block[i].style.height = Math.round(this.grid.offsetHeight/9) + 'px';
					this.block[i].style.width = Math.round(this.grid.offsetHeight/9) + 'px';

			}
		}

		//start
		if (start = document.getElementById("start")) {
			start.style.height = this.grid.offsetHeight/9 + 'px';
			start.style.width = this.grid.offsetWidth/16 + 'px';
		}

	},

	checkWidth: function() {

	
	setInterval(function()	{ // check if screen size change every 500ms
								if (this.screenWidth != window.innerWidth || this.screenHeight != window.innerHeight) {

							    	this.reSize();
							    	this.screenWidth = window.innerWidth;
							    	this.screenHeight = window.innerHeight;
							    	
							    	
									this.engine.restart();
							    	
							    	
							    }
						    }.bind(this), 500);
					
	
    
	},


}

