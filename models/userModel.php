<?php

class userModel extends Model {

	// если нам нужны стандартные методы то тут ничего больше и писать то не нужно
	// оно само все закувыркается	


	public function load($id=false){
		// считаем файл
		$data=file_get_contents($this->dataFileName);
		// декодируем 
		$data=json_decode($data, true);

		// если id не передан - то возвращаем все записи, иначе только нужную
		if($id===false){
			return $data;
		}
		else{
			foreach ($data as $value) {
				if ($value['id'] == $id){
					return $value;
				}
			}
		}
		return false;
	}

	public function save(array $newItem, $id){

		$data=file_get_contents($this->dataFileName);
		// декодируем
		$data=json_decode($data, true);

		foreach ($data as $key => $value) {
				if ($value['id'] == $id){
					$data[$key] = $newItem;
				}
		}		
		return file_put_contents($this->dataFileName, json_encode($data));
	}

	public function delete($id){

		$data=file_get_contents($this->dataFileName);
		// декодируем 
		$data=json_decode($data, true);

		foreach ($data as $key => $value) {
				if ($value['id'] == $id){
					unset($data[$key]);
				}
		}
		return file_put_contents($this->dataFileName, json_encode($data));
	}
}