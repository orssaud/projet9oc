
var save = {

	//var
	arraySave: null,
	dataLvl: null,
	buttonsSave: null,

	

	start: false,
	end: false,
	newBlock: false,
	win: false,
	reset: false,

	constructor: function() {
		

		this.arraySave = new Array(19);

		for (var i = 0; i < this.arraySave.length; i++) {
			this.arraySave[i] = new Array(33);
			for (var i2 = 0; i2 < 33; i2++) {
				this.arraySave[i][i2] = 0;
			}
		}

		this.dataLvl = document.getElementById('lvl');
		this.buttonsSave = document.getElementById('save');
		
	},



	addToSave: function(col, row, type) { // add a block at the save array
		this.newBlock = true;

		if (type === 'S' && this.start === false) {

			this.start = true;
		}else if ( type === 'E' && this.end === false){
			this.end = true;
		}
		
		this.canSave();
		this.arraySave[row][col] = type;
		this.save();
		

	},

	removeToSave: function(col, row){ // remove a block at the save array 
		this.newBlock = true;

		this.arraySave[row][col] = 0;
		this.save();
		

	},

	save: function(){ // convert the save array into the json file 
		
		this.dataLvl.value = JSON.stringify(this.arraySave);

	},

	getWin: function(){ // check if we have the win condition
		
		this.win=true;
		var win = this.canSave();

		return win;
	},
	getReset: function(){ //check if we have no reset 
		this.win=false;
		this.newBlock=false;
		
	},

	canSave: function(){ //check if all condition is ok 
		
		if (this.start === true && this.end === true && this.newBlock === false && this.win === true ) {
		
			return true;

		}else{

			return false;

		}
	}


}