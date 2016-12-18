<?php
function GetInfoOwnerPicture($urlhtml) {  // return in json format data
	if ($urlhtml!=false) {
		preg_match_all("/window._sharedData = (.*?)\;<\/script>/s",$urlhtml,$hasil);
		//unset($urlhtml);
		$hasil = $hasil[1][0];
		$datason = json_decode($hasil);
		//unset($hasil);
		$datason = $datason->entry_data;
		$datason = $datason->PostPage[0]->media->owner;
		$owner_username	= $datason->username;
		$owner_fullname = $datason->full_name;
		$owner_picprofile = $datason->profile_pic_url;
		return json_encode(array("owner_username" => $owner_username, "owner_fullname" => $owner_fullname, "owner_picprofile" => $owner_picprofile));
	} else return false;
}

function GetInstaPhotoHashtag($searchtag,$searchcat = "recent") {
	$cari = "https://www.instagram.com/explore/tags/".$searchtag."/";
	$baca = fread_url($cari);
	if ($baca!=false) {
		preg_match_all("/window._sharedData = (.*?)\;<\/script>/s",$baca,$hasil);
		unset($baca);
		$hasil = $hasil[1][0];
		$datajson = json_decode($hasil);
		unset($hasil);
		if ($searchcat=="recent") $datajson = $datajson->entry_data->TagPage[0]->tag->media;
		else $datajson = $datajson->entry_data->TagPage[0]->tag->top_posts; //Top most popular
		$Userphotos = $datajson->nodes;
		$jumlah = count($Userphotos);
		$kode_photo = array();
		for ($i=0; $i<$jumlah; $i++) {
			array_push($kode_photo,$Userphotos[$i]->code);
		}
		$instapic = array();
		for ($i=0; $i<count($kode_photo); $i++) {
			array_push($instapic,"https://www.instagram.com/p/".$kode_photo[$i]."/");
		}
		$multiowner = array();
		$multiowner = fread_all_url($instapic);
		for ($i=0; $i<$jumlah; $i++) {
			$multiowner[$i] = GetInfoOwnerPicture($multiowner[$i]);  //json format data
		}
		$iphoto = array();
		for ($i=0; $i<$jumlah; $i++) {
			$json = json_decode($multiowner[$i]);

			$owner_username = $json->owner_username;
			$owner_fullname = $json->owner_fullname;
			$owner_picprofile = $json->owner_picprofile;
			$pic_title = $Userphotos[$i]->caption;
			$pic_thumbnail = $Userphotos[$i]->thumbnail_src;
			$pic_code = $Userphotos[$i]->code;
			$pic_date = $Userphotos[$i]->date;
			array_push($iphoto,json_encode(array("owner_username" => $owner_username, "owner_fullname" => $owner_fullname, "owner_picprofile" => $owner_picprofile, "pic_title" => $pic_title, "pic_thumbnail" => $pic_thumbnail, "pic_code" => $pic_code, "pic_date" => $pic_date)));
		}
		unset($multiowner);
		return $iphoto; // return in json format;
		
	} else return false;
}

function GetInstaPhotoUser($instausername) {
	$piclink = "https://www.instagram.com/".$instausername."/";
	$baca = fread_url($piclink);
	if ($baca!=false) {
		preg_match_all("/window._sharedData = (.*?)\;<\/script>/s",$baca,$hasil);
		$hasil = $hasil[1][0];
		$data = json_decode($hasil);
		unset($hasil);
		
		$Fullname = $data->entry_data->ProfilePage[0]->user->full_name;
		$Username = $data->entry_data->ProfilePage[0]->user->username;
		$Userpicprofile = $data->entry_data->ProfilePage[0]->user->profile_pic_url;
		
		$Userphotos = $data->entry_data->ProfilePage[0]->user->media->nodes;
		$jumlah = count($Userphotos);
		$iphoto = array();
		for ($i=0; $i<$jumlah; $i++) {
			$pic_title = $Userphotos[$i]->caption;
			$pic_thumbnail = $Userphotos[$i]->thumbnail_src;
			$pic_code = $Userphotos[$i]->code;
			$pic_date = $Userphotos[$i]->date;
			array_push($iphoto,json_encode(array("owner_username" => $Username, "owner_fullname" => $Fullname, "owner_picprofile" => $Userpicprofile, "pic_title" => $pic_title, "pic_thumbnail" => $pic_thumbnail, "pic_code" => $pic_code, "pic_date" => $pic_date)));
		}
		return $iphoto; // return in json format;
		
	} else return false;
}
?>