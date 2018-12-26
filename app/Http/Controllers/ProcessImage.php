<?php
namespace App\Http\Controllers;
use Carbon\Carbon;

trait ProcessImage {

    //save images to images folder with different name
	public function process_image( $file ) {

		$destinationPath = 'images';
		$name            = md5( $file->getClientOriginalName() ) //first is hashed file name
                            . '_' . Carbon::now()->timestamp    //current timestamp
		                    . '.' .
                            pathinfo( $file->getClientOriginalName(), PATHINFO_EXTENSION ); //file extension
		$file->move( $destinationPath, $name );

		return $name;
	}
}
