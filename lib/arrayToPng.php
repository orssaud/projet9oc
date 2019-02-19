<?php
namespace projet9\lib;

class arrayToPng{

	private $bg;
	private $wood; 
	private $damage; 
	private $start; 
	private $end;

	public function __construct(){

		$this->bg = imagecreatefrompng('./public/img/min/bg.png');
		$this->wood = imagecreatefrompng('./public/img/min/wood.png');
		$this->damage = imagecreatefrompng('./public/img/min/damage.png');
		$this->start = imagecreatefrompng('./public/img/min/start.png');
		$this->end = imagecreatefrompng('./public/img/min/end.png');
		
	}

	public function createPng($array){

		


		for($i = 0; $i < count($array); $i ++){
			
			for($i2 = 0; $i2 < count($array[$i]); $i2 ++){
					
					if ($array[$i][$i2] === 'W'){
						
						imagecopymerge($this->bg, $this->wood, ($i2 * 50), ($i * 50), 0, 0, 100, 100, 100);

					}else if ($array[$i][$i2] === 'D'){
						
						imagecopymerge($this->bg, $this->damage, ($i2 * 50), ($i * 50), 0, 0, 100, 100, 100);

					}else if ($array[$i][$i2] === 'S'){
						
						imagecopymerge($this->bg, $this->start, ($i2 * 50), ($i * 50), 0, 0, 100, 100, 100);

					}else if ($array[$i][$i2] === 'E'){
						
						imagecopymerge($this->bg, $this->end, ($i2 * 50), ($i * 50), 0, 0, 100, 100, 100);

					}

			}

		}

		$file =  time() . ".png";


		imagepng($this->bg, "./public/img/lvl/". $file);

		imagedestroy($this->bg);
		imagedestroy($this->wood);
		imagedestroy($this->damage);
		imagedestroy($this->start);
		imagedestroy($this->end);


		return $file;
	}

}
