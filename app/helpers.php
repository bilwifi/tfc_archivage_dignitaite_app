<?php 
function img_profil($iddignitaires){
		$dignitaire = App\Models\Dignitaire::find($iddignitaires);
		if (!empty($dignitaire->picture)) {
			return url(\Storage::url($dignitaire->picture));
		}else{
			return asset('img/default-profil.png');
		}
	}






 ?>