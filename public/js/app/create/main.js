

var reSize = Object.create(size);
var myEngine = Object.create(engine);
var gridManager = Object.create(gridClass);
var saveLvl = Object.create(save);



reSize.constructor(myEngine);
gridClass.constructor(myEngine, saveLvl);
myEngine.constructor(saveLvl);
saveLvl.constructor();


