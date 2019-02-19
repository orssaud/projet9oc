var gridClass = {
	engine:null,
	save:null,

	grid:null,
	buttonAdd:null,
	buttonStart:null,
	buttonEnd:null,
	buttonDamage:null,
	buttonDelete:null,

	delete:false,
	blocks:null,
	item:null,

	first:true,


	constructor: function(engine, save){
		this.grid = document.getElementById('grid');
		this.buttonAdd = document.getElementById('addBlock');
		this.buttonStart = document.getElementById('addStart');
		this.buttonEnd = document.getElementById('addEnd');
		this.buttonDamage = document.getElementById('addDamage');
		this.buttonDelete = document.getElementById("deleteItem");
		this.item = document.getElementsByClassName("item");

		this.engine = engine;
		this.save = save;

		this.grid.addEventListener("mousemove", this.coords.bind(this));
		this.grid.addEventListener("click", this.removeId.bind(this));
		// if we want add button for created mod 
		/*
		this.buttonAdd.addEventListener("click", this.addBlock.bind(this));
		this.buttonStart.addEventListener("click", this.addStart.bind(this));
		this.buttonEnd.addEventListener("click", this.addEnd.bind(this));
		this.buttonDamage.addEventListener("click", this.addDamage.bind(this));
		this.buttonDelete.addEventListener("click", this.deleteButton.bind(this));
		*/

		window.addEventListener("keydown", function (event) { this.keyController(event)}.bind(this));

	},

	coords: function(event) { // cusor position converts to class name



		var x = 0;
		var y = 0;
		var margin = 10;


		// x
		if (event.clientX <= (margin + this.grid.offsetLeft)) {//border left
			x=0;
		}else if(event.clientX > (this.grid.offsetWidth + this.grid.offsetLeft)){// border right
			x = this.grid.offsetWidth;
		}else{
			x = event.clientX ;
		}


		// y
		if (event.clientY <= (margin + this.grid.offsetTop)) {//border top
			y =0;
		}else if(event.clientY > (this.grid.offsetHeight + this.grid.offsetTop)){// border bottom
			y = this.grid.offsetHeight;
		}else{
			y = event.clientY ;
		}


		var xPer = this.getCol(x - this.grid.offsetLeft );
		var yPer = this.getRow(y - this.grid.offsetTop );
	

	    this.newBlock(xPer, yPer);
	 
	},

	newBlock: function(x,y){ // move

	this.item = document.getElementsByClassName("item");

	//move new block
		if (newBlock = document.getElementById("newBlock")) {

				var col = "grid-col-" + x ;
				var row = "grid-row-" + y ;
				

			var cross = document.getElementById("cross");

			// remove class like "grid-col-x" and "grid-row-y"
			for (var i = 0; i < newBlock.classList.length; i++) {
				
				if (newBlock.classList[i] != 'wood' && newBlock.classList[i] != 'block' && newBlock.classList[i] != 'start'  && newBlock.classList[i] != 'end'  && newBlock.classList[i] != 'damage') {
					newBlock.classList.remove(newBlock.classList[i]);
				}
			}
			
			// add nex class "grid-col-x" and "grid-row-y"
			newBlock.classList.add(col,row);

			//create ellement for test if collide
			var elem = {
				x: newBlock.offsetLeft+5, 
				y: newBlock.offsetTop+5,
				width: newBlock.offsetWidth-10,
				height: newBlock.offsetHeight-10,
			}
			

			if (this.engine.colider(elem, 0, 0, false, this.item)) {
				cross.style.display = "none";
				
			}else{
				cross.style.display = "block";
				
			}
			
		}

	// select for delete block
		if (this.delete) {
			

			var elem = null;

			/*

			the cursor positon have 2 class like "grid-col-x" and "grid-row-y"

			this is for check if the item have the 2 same class 

			*/

			for (var i = 0; i < this.item.length; i++) {
				
					var classCol = false;
					var classRow = false;

				for (var i2 = 0; i2 < this.item[i].classList.length; i2++) {


					if (this.item[i].classList[i2] == "grid-col-" + (x-1)) {

							classCol = (x-1);

					}else if (this.item[i].classList[i2] == "grid-row-" + (y-1)) {
						
						classRow = (y-1);

					}else if (this.item[i].classList[i2] == "grid-col-" + (x)) {
						
						classCol = (x);

					}else if (this.item[i].classList[i2] == "grid-row-" + (y)) {
						
						classRow = (y);
					}

					
				}

				
				if (classCol !== false && classRow !== false ) { //add red selector around items

					this.item[i].style["boxShadow"] = "inset 0px 0px 0px 5px rgba(255,3,3,1)" ;
					this.blocks = this.item[i];
					this.item[i].onclick = function(){ // if click delte this item


														var xPer = this.getCol(this.blocks.offsetLeft+5);// add 5px for around trouble 
														var yPer = this.getRow(this.blocks.offsetTop+5);

																if(this.blocks != null){
																	//remove at save 
																	this.save.removeToSave(xPer,yPer);
																	//delete block
																	this.blocks.parentNode.removeChild(this.blocks);

																}
						

													}.bind(this);

				}else{ //if the cursor go on a other place remove "red box"
					
						this.item[i].style["boxShadow"] = "none";
					
					
				}

			}

		}
	
	},

	deleteButton: function(){
	this.delete = !this.delete; // switch on/off

		this.item = document.getElementsByClassName("item");

		for (var i = 0; i < this.item.length; i++) { // set all item off, with no "red box"
			this.item[i].style["boxShadow"] = "none";
		}


	},

	removeId: function(){ //set block

			

		if ( newBlock = document.getElementById("newBlock")) {

			//create ellement for test if collide
			var elem = {
				x: newBlock.offsetLeft+5, 
				y: newBlock.offsetTop+5,
				width: newBlock.offsetWidth-10,
				height: newBlock.offsetHeight-10,
			}

			if (this.engine.colider(elem, 0, 0, false, this.item)) {

				

				newBlock.removeAttribute("id");

				var ifStart = false;
				var ifEnd = false;
				var ifDamage = false;

				//check what kinds of block it is
				for (var i = 0; i < newBlock.classList.length; i++) {

					if (newBlock.classList[i] == 'start') {

						ifStart = true;
						break;

					}else if(newBlock.classList[i] == 'end'){

						ifEnd = true;
						break;

					}else if(newBlock.classList[i] == 'damage'){

						ifDamage = true;
						break;

					}

				}
				
				var xPer = this.getCol((elem.x));
				var yPer = this.getRow((elem.y));
		



				// set attribute and save 
				if (ifStart) {
					newBlock.id = "start";
					this.save.addToSave(xPer,yPer,"S");
					newBlock.classList.add("item");

				}else if(ifEnd){
					newBlock.classList.add("block", "item");
					this.save.addToSave(xPer,yPer,"E");

				}else if(ifDamage){
					newBlock.classList.add("block", "item");
					this.save.addToSave(xPer,yPer,"D");

				}else{
					newBlock.classList.add("block", "item");	
					this.save.addToSave(xPer,yPer,"W");
				}



				// remove cross
				var cross = document.getElementById("cross");
				cross.parentNode.removeChild(cross);

				if (this.first) { // delete tuto
					var tuto = document.getElementById("tuto");
					tuto.classList.add("cleanTuto");
					this.first = false;
				}

			}
				
		}

	},

	addBlock: function(){ //create wood block
		this.block("wood");

	},

	addStart: function(){ // create start block
		if (!document.getElementById('start')) {
			this.block("start");
		}
		
	},

	addEnd: function(){ //create end block
		this.block("end");
	},

	addDamage: function(){ // create end block
		this.block("damage");
	},

	getCol: function(x){// convert x value to class number

		var xPer = 100/(this.grid.offsetWidth/x); // percentage
		xPer = Math.trunc(xPer/3.125) 

		if( xPer == 31 || xPer == 32){// in this game the 2 last col is useless and equal
			xPer = 30;
		}

		if(xPer < 0){
			xPer=0;
		}

		return xPer;
	},
	getRow: function(y){// conver y value tu class number

		var yPer = 100/(this.grid.offsetHeight/y); // percentage
		yPer = Math.trunc(yPer/5.555);

		if(yPer == 18 || yPer == 17){// in this game the 2 last row is useless and equal
			yPer = 16;
		}
		
		if(yPer < 0){
			yPer=0;
		}
		return yPer;
	},

	block: function(type){

		if (!document.getElementById("newBlock")) {

					/* create new block */

		        var elem = document.createElement('div');
		        elem.id = 'newBlock';
		        this.grid.appendChild(elem);
		        elem.classList.add(type , "grid-col-0", "grid-row-0");
		        elem.style.height = this.grid.offsetHeight/9 + 'px';
				elem.style.width = this.grid.offsetWidth/16 + 'px';



					/* create cross */

				var cross = document.createElement('i');
				cross.id = 'cross';
				elem.appendChild(cross);
				cross.classList.add("fas", "fa-times");
				cross.style.fontSize = this.grid.offsetHeight/10 + 'px';
				cross.style.display = "none";

		}
	},



		keyController: function(event){

			if (event.keyCode == 49 ) { //1 start	
				this.addStart();
			}
			if (event.keyCode == 50) { //2 block
				this.addBlock();
			}
			if (event.keyCode == 51 ) { //3 damage
				this.addDamage();
			}
			if (event.keyCode == 52) { //4 end
				this.addEnd();
			}
			if (event.keyCode == 53) { //5 delete
				this.deleteButton();
			}
		
	
	},


}

